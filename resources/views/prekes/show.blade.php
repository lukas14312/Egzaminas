{{-- resources/views/prekes/show.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="product-detail">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $preke->nuotrauka ? Storage::url($preke->nuotrauka) : 'https://via.placeholder.com/300' }}" alt="{{ $preke->pavadinimas }}" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2>{{ $preke->pavadinimas }}</h2>
                <p><strong>Kaina:</strong> ${{ number_format($preke->kaina, 2) }}</p>
                <p><strong>Aprašymas:</strong> {{ $preke->aprasymas }}</p>
                <p><strong>Kategorija:</strong> {{ $preke->kategorija->pavadinimas }}</p>

                <div class="mt-3">
                    <a href="{{ route('prekes.edit', $preke->id) }}" class="btn btn-primary">Redaguoti</a>
                    <form action="{{ route('prekes.destroy', $preke->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ištrinti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
