<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prekių Katalogas</title>
    <!-- Įtraukiame Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #343a40;
            color: white;
        }
        .btn-primary {
            background-color: #0062cc;
            border: none;
        }
        .btn-primary:hover {
            background-color: #004085;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Prekių Katalogas</h3>
                </div>
                <div class="card-body">
                    <div class="text-end mb-3">
                        <a href="{{ route('prekes.create') }}" class="btn btn-primary">Pridėti prekę</a>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Pavadinimas</th>
                                <th>Aprašymas</th>
                                <th>Kaina</th>
                                <th>Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prekes as $preke)
                                <tr>
                                    <td>{{ $preke->pavadinimas }}</td>
                                    <td>{{ $preke->aprasymas }}</td>
                                    <td>{{ $preke->kaina }}€</td>
                                    <td>
                                        <a href="{{ route('prekes.edit', $preke->id) }}" class="btn btn-warning btn-sm">Redaguoti</a>
                                        <form action="{{ route('prekes.destroy', $preke->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Ištrinti</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Įtraukiame Bootstrap JavaScript biblioteką -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
