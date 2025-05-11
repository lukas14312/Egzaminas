<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>PDF Dokumentas</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #007BFF;
        }

        .sub-header {
            text-align: center;
            font-size: 16px;
            font-weight: normal;
            margin-bottom: 30px;
            color: #555;
        }

        .content {
            margin-bottom: 30px;
            font-size: 14px;
        }

        .content p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            font-size: 14px;
        }

        td {
            font-size: 13px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #777;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <div class="header">{{ $title }}</div>
    <div class="sub-header">{{ $date }}</div>

    <!-- Content Section -->
    <div class="content">
        <p><strong>Aprašymas:</strong> {{ $content }}</p>
    </div>

    <!-- Product Table -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Pavadinimas</th>
                <th>Kaina (€)</th>
                <th>Kategorija</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prekes as $index => $preke)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $preke->pavadinimas }}</td>
                    <td>{{ number_format($preke->kaina, 2) }} €</td>
                    <td>{{ $preke->kategorija->pavadinimas ?? 'Nenurodyta' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer Section -->
    <div class="footer">
        <p>Įmonės pavadinimas - Visos teisės saugomos</p>
    </div>

</body>
</html>
