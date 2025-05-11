@extends('layouts.app')

@section('title', 'Pridėti prekę')

@section('content')
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fa;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 100vh;
        
    }

    .container {
        margin-top: 50px;
        width: 100%;
        max-width: 1400px;
        display: flex;
        justify-content: center;
        padding: 20px;
        margin-bottom:25px;
        

    }

    .row {
        display: flex;
        width: 100%;
        justify-content: space-between;
        gap: 10px;
        
    }

    .form-container, .preview-container {
        width: 48%;
        padding: 15px; 
        border-radius: 12px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        background-color: #ffffff;
        
    }

  

    .preview-container {
        background-color: #f0f0f0;
        text-align: center;
        padding: 20px;
        border-radius: 12px;
        height: auto;
        max-height: 400px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 200px;
        margin-right: 25px;
        margin-left: 25px;

    }

    .preview-container img {
        max-width: 100%;
        max-height: 350px;
        object-fit: contain;
        border-radius: 8px;
    }

    .card {
        width: 100%;
        height: 978px;
        border-radius: 12px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        background-color: #ffffff;
    }

    .card-header {
        background-color: #343a40;
        color: white;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        text-align: center;
        font-size: 1.5rem;
        padding: 20px;
    }

    .form-label {
        font-size: 1.1rem;
        font-weight: bold;
    }

    .form-control {
        font-size: 1rem;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease;
        margin-bottom: 20px;
        width: 100%;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
    }

    .mb-3 {
        margin-bottom: 20px;
    }

    .d-flex {
        justify-content: space-between;
    }

    .btn-secondary, .btn-primary {
        font-size: 1rem;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
        margin-top: 10px;
        margin-bottom: 25px;
        margin-right: 25px;
        margin-left: 25px;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .form-control-file {
        padding: 10px;
        font-size: 0.95rem;
        height: auto;
    }

    .form-container {
        margin-left: 25px;
    }

    .custom-margin {
        margin-top: 25px;
        margin-left: 25px;
    }

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <a href="{{ route('prekes.index') }}" class="btn btn-outline-secondary btn-back">← Grįžti į prekių sąrašą</a>

            <div class="card">
                <div class="card-header">Pridėti prekę</div>
                <div class="card-body">
                    <form action="{{ route('prekes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Kairė pusė - formos laukai -->
                            <div class="form-container">
                                <div class="mb-3">
                                    <label for="pavadinimas" class="form-label">Prekės pavadinimas</label>
                                    <input type="text" class="form-control" id="pavadinimas" name="pavadinimas" required minlength="3" title="Prekės pavadinimas turi būti ne trumpesnis nei 3 simboliai.">
                                </div>
                                <div class="mb-3">
                                    <label for="aprasymas" class="form-label">Aprašymas</label>
                                    <textarea class="form-control" id="aprasymas" name="aprasymas" required minlength="10" title="Aprašymas turi būti ne trumpesnis nei 10 simbolių."></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="kaina" class="form-label">Kaina (€)</label>
                                    <input type="number" class="form-control" id="kaina" name="kaina" required step="0.01" min="0.01" title="Kaina turi būti teigiama ir ne mažesnė už 0.01 €.">
                                </div>
                                <div class="mb-3">
                                    <label for="prek_kodas" class="form-label">Prekės kodas</label>
                                    <input type="text" class="form-control" id="prek_kodas" name="prek_kodas" required minlength="3" title="Prekės kodas turi būti ne trumpesnis nei 3 simboliai.">
                                </div>
                                <div class="mb-3">
                                    <label for="prekybininko_kodas" class="form-label">Prekybininko kodas (9 arba 11 skaitmenų)</label>
                                    <input type="text" class="form-control" id="prekybininko_kodas" name="prekybininko_kodas" required pattern="\d{9}|\d{11}" title="Kodas turi būti sudarytas iš 9 arba 11 skaitmenų.">
                                </div>
                                <div class="mb-3">
                                    <label for="kategorija_id" class="form-label">Kategorija</label>
                                    <select class="form-control" id="kategorija_id" name="kategorija_id" required>
                                        @foreach($kategorijos as $kategorija)
                                            <option value="{{ $kategorija->id }}">{{ $kategorija->pavadinimas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="nuotrauka" class="form-label">Įkelti nuotrauką</label>
                                    <input type="file" class="form-control-file" id="nuotrauka" name="nuotrauka" accept="image/*" onchange="previewImage(event)">
                                </div>
                            </div>

                            <!-- Dešinė pusė - nuotraukos peržiūra -->
                            <div class="preview-container">
                                <h5>Čia galima matyti nuotrauką</h5>
                                <img id="preview" src="" alt="Prekės nuotrauka" />
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-3 custom-margin">
                            <a href="{{ route('prekes.index') }}" class="btn btn-secondary">Atšaukti</a>
                            <button type="submit" class="btn btn-primary">Pridėti</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection
