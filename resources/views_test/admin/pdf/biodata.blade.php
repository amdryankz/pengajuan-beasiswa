<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Pendaftar</title>
</head>

<body>
    <h1>Biodata Pendaftar</h1>
    <p>Nama Mahasiswa: {{ $user->name }}</p>
    <p>NIM: {{ $user->nim }}</p>
    <p>Nama Beasiswa: {{ $scholarship->name }}</p>
</body>

</html>
