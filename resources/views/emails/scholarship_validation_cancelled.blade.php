<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Beasiswa Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-700">
    <div class="max-w-lg mx-auto bg-white border border-gray-300 rounded-lg overflow-hidden shadow-lg mt-6">
        <div class="bg-red-500 text-white text-center py-4">
            <h1 class="text-xl font-bold">Pengumuman Hasil Seleksi Beasiswa - <strong>{{ $scholarshipName }}</strong></h1>
        </div>
        <div class="p-6">
            <p>Mohon maaf, <strong>{{ $name }}</strong></p>
            <p>Anda dinyatakan tidak lulus beasiswa <strong>{{ $scholarshipName }}</strong>. Tetap semangat dalam mencari peluang baru!</p>
            <p>Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami.</p>
            <p>Terima kasih atas perhatian dan kerja sama Anda.</p>
            <p>Salam,<br>Bidang Kemahasiswaan Universitas Syiah Kuala</p>
        </div>
        <div class="bg-gray-100 text-gray-600 text-center py-2 border-t border-gray-300">
            <p>&copy; {{ date('Y') }} Universitas Syiah Kuala. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
