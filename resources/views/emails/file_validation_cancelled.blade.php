<!DOCTYPE html>
<html>
<head>
    <title>Validasi Berkas Beasiswa Dibatalkan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-700">
    <div class="max-w-lg mx-auto bg-white border border-gray-300 rounded-lg overflow-hidden shadow-lg mt-6">
        <div class="bg-red-500 text-white text-center py-4">
            <h1 class="text-xl font-bold">Pengumuman Seleksi Berkas - <strong>{{ $scholarshipName }}</strong></h1>
        </div>
        <div class="p-6">
            <p>Halo, <strong>{{ $userName }}</strong></p>
            <p>Kami ingin menginformasikan bahwa berkas beasiswa yang Anda ajukan untuk beasiswa <strong>{{ $scholarshipName }}</strong> telah ditolak. Alasan pembatalan adalah sebagai berikut:</p>
            <strong class="bg-gray-100 p-4 border-l-4 border-red-500 my-4">{{ $reason }}</strong>
            <p>Jangan Putus Asa dan Tetap Semangat!!. Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami.</p>
            <p>Terima kasih atas perhatian dan kerja samanya.</p>
            <p>Salam,<br>Bidang Kemahasiswaan Universitas Syiah Kuala</p>
        </div>
        <div class="bg-gray-100 text-gray-600 text-center py-2 border-t border-gray-300">
            <p>&copy; {{ date('Y') }} Universitas Syiah Kuala. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
