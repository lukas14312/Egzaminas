<?php

namespace App\Http\Controllers;

use App\Models\Preke;
use App\Models\Kategorija;
use Illuminate\Http\Request;

class PrekeController extends Controller
{
    // Prekės sąrašas su paieška ir filtravimu
    public function index(Request $request)
    {
        $query = $request->input('query');
        $kategorija_id = $request->input('kategorija_id');

        // Filtruoja prekes pagal paiešką ir kategoriją
        $prekes = Preke::with('kategorija');

        if ($query) {
            $prekes->where('pavadinimas', 'like', "%$query%");
        }

        if ($kategorija_id) {
            $prekes->where('kategorija_id', $kategorija_id);
        }

        $prekes = $prekes->paginate(10);
        $kategorijos = Kategorija::all();  // Kategorijų gavimas

        return view('prekes.index', compact('prekes', 'kategorijos'));
    }

    // Prekės kūrimas
    public function create()
    {
        $kategorijos = Kategorija::all();  // Kategorijų gavimas
        return view('prekes.create', compact('kategorijos'));
    }

    // Prekės įrašymas į duomenų bazę
    public function store(Request $request)
    {
        // Validacija
        $request->validate([
            'pavadinimas' => 'required|string|max:255',
            'kaina' => 'required|numeric',
            'aprasymas' => 'nullable|string',
            'kategorija_id' => 'required|exists:kategorijos,id',
            'nuotrauka' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // nuotraukos validacija
            'prek_kodas' => 'required|string|max:255',
        ]);

        // Prekės įrašymas į duomenų bazę
        $preke = new Preke();
        $preke->pavadinimas = $request->pavadinimas;
        $preke->kaina = $request->kaina;
        $preke->aprasymas = $request->aprasymas;
        $preke->kategorija_id = $request->kategorija_id;
        $preke->prek_kodas = $request->prek_kodas;

        // Jei yra nuotrauka, išsaugome ją
        if ($request->hasFile('nuotrauka')) {
            $preke->nuotrauka = $request->file('nuotrauka')->store('prekes', 'public');
        }

        $preke->save();

        return redirect()->route('prekes.index')->with('success', 'Prekė sėkmingai pridėta!');
    }

    // Prekės redagavimas
    public function edit($id)
    {
        $preke = Preke::findOrFail($id);
        $kategorijos = Kategorija::all();
        return view('prekes.edit', compact('preke', 'kategorijos'));
    }

    // Prekės atnaujinimas
    public function update(Request $request, $id)
    {
        $request->validate([
            'pavadinimas' => 'required|string|max:255',
            'kaina' => 'required|numeric',
            'aprasymas' => 'nullable|string',
            'kategorija_id' => 'required|exists:kategorijos,id',
            'nuotrauka' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prek_kodas' => 'required|string|max:255',
        ]);

        $preke = Preke::findOrFail($id);
        $preke->pavadinimas = $request->pavadinimas;
        $preke->kaina = $request->kaina;
        $preke->aprasymas = $request->aprasymas;
        $preke->kategorija_id = $request->kategorija_id;
        $preke->prek_kodas = $request->prek_kodas;

        if ($request->hasFile('nuotrauka')) {
            // Pašaliname seną nuotrauką, jei reikia
            if ($preke->nuotrauka) {
                \Storage::delete('public/' . $preke->nuotrauka);
            }

            $preke->nuotrauka = $request->file('nuotrauka')->store('prekes', 'public');
        }

        $preke->save();

        return redirect()->route('prekes.index')->with('success', 'Prekė sėkmingai atnaujinta!');
    }

    // Prekės pašalinimas
    public function destroy($id)
    {
        $preke = Preke::findOrFail($id);

        // Pašaliname nuotrauką, jei ji egzistuoja
        if ($preke->nuotrauka) {
            \Storage::delete('public/' . $preke->nuotrauka);
        }

        $preke->delete();

        return redirect()->route('prekes.index')->with('success', 'Prekė sėkmingai ištrinta!');
    }
}
