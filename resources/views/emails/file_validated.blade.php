<!DOCTYPE html>
<html>
<head>
    <title>Berkas Beasiswa Berhasil Divalidasi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-700">
    <div class="max-w-lg mx-auto bg-white border border-gray-300 rounded-lg overflow-hidden shadow-lg mt-6">
        <div class="bg-green-500 text-white text-center py-4">
            <h1 class="text-xl font-bold">Pengumuman Seleksi Berkas - <strong>{{ $scholarshipName }}</strong></h1>
        </div>
        <div class="p-6">
            <p>Halo, <strong>{{ $userName }}</strong></p>
            <p>Kami ingin menginformasikan bahwa berkas beasiswa yang Anda ajukan telah diperiksa, Anda telah dinyatakan <strong>Lulus Seleksi Berkas</strong>
            <p>Selanjutnya, Anda dapat menunggu proses <strong>Seleksi Selanjutnya.</strong> untuk informasi lebih lanjut silahkan hubungi pihak Bidang Kemahasiswaan Universitas Syiah Kuala.</p>
            <p>Terima kasih atas perhatian dan kerja samanya.</p>
            <p>Salam,<br>Bidang Kemahasiswaan Universitas Syiah Kuala</p>
        </div>
        <div class="bg-gray-100 text-gray-600 text-center py-2 border-t border-gray-300">
            <p>&copy; {{ date('Y') }} Universitas Syiah Kuala. All rights reserved.</p>
            <p>Email dikirim pada {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
    </div>
</body>
</html>
