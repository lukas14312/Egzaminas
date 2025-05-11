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
    </style>
</head>
<body>

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <a href="{{ route('prekes.index') }}" class="btn btn-primary">
        Prekių katalogas
    </a>
</div>

<!-- Įtraukiame Bootstrap JavaScript biblioteką -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
