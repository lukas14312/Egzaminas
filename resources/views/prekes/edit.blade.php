@extends('layouts.app')

@section('title', 'Redaguoti prekę')

@section('content')
<style>
    .product-card {
        width: 100%;
        max-width: 600px;
        margin: 40px auto;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        padding: 30px;
    }

    .product-card h3 {
        margin-bottom: 25px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .btn {
        padding: 10px 20px;
        font-size: 1rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .d-grid {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
</style>

<div class="product-card">
    <h3>Redaguoti prekę: {{ $preke->pavadinimas }}</h3>
    <form action="{{ route('prekes.update', $preke->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="pavadinimas" class="form-label">Prekės pavadinimas</label>
            <input type="text" class="form-control" id="pavadinimas" name="pavadinimas" value="{{ $preke->pavadinimas }}" required>
        </div>

        <div class="form-group">
            <label for="aprasymas" class="form-label">Aprašymas</label>
            <textarea class="form-control" id="aprasymas" name="aprasymas" rows="4" required>{{ $preke->aprasymas }}</textarea>
        </div>

        <div class="form-group">
            <label for="kaina" class="form-label">Kaina (€)</label>
            <input type="number" class="form-control" id="kaina" name="kaina" step="0.01" value="{{ $preke->kaina }}" required>
        </div>

        <div class="form-group">
            <label for="prek_kodas" class="form-label">Prekės kodas</label>
            <input type="text" class="form-control" id="prek_kodas" name="prek_kodas" value="{{ $preke->prek_kodas }}" required>
        </div>

        <div class="form-group">
            <label for="kategorija_id" class="form-label">Kategorija</label>
            <select class="form-control" id="kategorija_id" name="kategorija_id" required>
                @foreach($kategorijos as $kategorija)
                    <option value="{{ $kategorija->id }}" {{ $preke->kategorija_id == $kategorija->id ? 'selected' : '' }}>
                        {{ $kategorija->pavadinimas }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nuotrauka" class="form-label">Nauja nuotrauka (jei norite pakeisti)</label>
            <input type="file" class="form-control" id="nuotrauka" name="nuotrauka">
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Atnaujinti prekę</button>
        </div>
    </form>
</div>
@endsection
