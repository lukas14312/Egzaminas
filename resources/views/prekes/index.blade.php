@extends('layouts.app')

@section('title', 'Prekių katalogas')

@section('content')

<style>
    .product-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: center;
        padding: 30px 0;
    }

    .product-card {
        width: 300px;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-img {
        width: 100%;
        height: 240px;
        background-color: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-img img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .product-info {
        padding: 20px;
    }

    .product-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .product-price {
        font-size: 1.1rem;
        font-weight: bold;
        color: #28a745;
        margin-bottom: 10px;
    }

    .product-desc {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 15px;
    }

    .product-actions {
        display: flex;
        justify-content: space-between;
        gap: 5px;
    }

    .btn {
        padding: 8px 16px;
        font-size: 0.9rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Stilius mygtukams */
    .button-55 {
        align-self: center;
        background-color: #fff;
        background-image: none;
        background-position: 0 90%;
        background-repeat: repeat no-repeat;
        background-size: 4px 3px;
        border-radius: 15px 225px 255px 15px 15px 255px 225px 15px;
        border-style: solid;
        border-width: 2px;
        box-shadow: rgba(0, 0, 0, .2) 15px 28px 25px -18px;
        box-sizing: border-box;
        color: #41403e;
        cursor: pointer;
        display: inline-block;
        font-family: Neucha, sans-serif;
        font-size: 1rem;
        line-height: 23px;
        outline: none;
        padding: .75rem;
        text-decoration: none;
        transition: all 235ms ease-in-out;
        border-bottom-left-radius: 15px 255px;
        border-bottom-right-radius: 225px 15px;
        border-top-left-radius: 255px 15px;
        border-top-right-radius: 15px 225px;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        margin-bottom: 10px;
    height: 48px;
    }

    .button-55:hover {
        box-shadow: rgba(0, 0, 0, .3) 2px 8px 8px -5px;
        transform: translate3d(0, 2px, 0);
    }

    .button-55:focus {
        box-shadow: rgba(0, 0, 0, .3) 2px 8px 4px -6px;
    }

    /* Top bar stilius */
    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin: 25px;
    }

    .top-bar form {
        display: flex;
        align-items: center;
    }

    .top-bar select, .top-bar input {
        font-size: 1rem;
        margin-bottom: 10px;
        margin-right: 10px;
    }

    .top-bar .actions {
        display: flex;
        gap: 10px;
    }
</style>

<div class="container">
    <div class="top-bar">
        <!-- Kairėje: filtras -->
        <form method="GET" action="{{ route('prekes.index') }}">
            <input type="text" name="query" class="form-control" placeholder="Ieškoti pagal pavadinimą..." value="{{ request('query') }}">

            <select name="kategorija_id" class="form-control">
                <option value="">Visos kategorijos</option>
                @foreach($kategorijos as $kategorija)
                    <option value="{{ $kategorija->id }}" {{ request('kategorija_id') == $kategorija->id ? 'selected' : '' }}>
                        {{ $kategorija->pavadinimas }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="button-55">Ieškoti</button>
        </form>

        <!-- Dešinėje: veiksmai -->
        <div class="actions">
            <a href="{{ route('prekes.create') }}" class="button-55">+ Pridėti Prekę</a>
            <a href="{{ route('prekes.generate-pdf') }}" class="button-55">Generuoti PDF</a>
        </div>
    </div>

    <div class="product-grid">
        @foreach($prekes as $preke)
            <div class="product-card">
                <div class="product-img">
                    <!-- Patikrinkite, ar nuotrauka egzistuoja, prieš rodant -->
                    @if($preke->nuotrauka)
                        <img src="{{ asset('storage/' . $preke->nuotrauka) }}" alt="{{ $preke->pavadinimas }}">
                    @else
                        <img src="{{ asset('storage/default.jpg') }}" alt="Default image">  <!-- Naudokite numatytąją nuotrauką, jei nėra įkelta -->
                    @endif
                </div>
                <div class="product-info">
                    <div class="product-title">{{ $preke->pavadinimas }}</div>
                    <div class="product-price">{{ $preke->kaina }} €</div>
                    <div class="product-desc">{{ Str::limit($preke->aprasymas, 100) }}</div>
                    <div class="product-actions">
                        <a href="{{ route('prekes.edit', $preke->id) }}" class="button-55">Redaguoti</a>
                        <form action="{{ route('prekes.destroy', $preke->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button-55">Ištrinti</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $prekes->links() }}
    </div>
</div>

@endsection
