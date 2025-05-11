<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Preke;

class PDFController extends Controller
{
    public function generatePDF()
    {
        //  duomenys, kurie bus perduoti į PDF šabloną
        $data = [
            'title' => 'Produktų katalogas',
            'date' => date('Y-m-d'), 
            'content' => 'Žemiau pateikiamas prekių sąrašas.', 
            'prekes' => Preke::all() 
        ];

        // pdf kurimas
        $pdf = Pdf::loadView('pdf.document', $data);

        // pdf atsiuntimas
        return $pdf->download('produktai.pdf');
    }
}
