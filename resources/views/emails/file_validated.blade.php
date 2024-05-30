<!DOCTYPE html>
<html>
<head>
    <title>Berkas Beasiswa Berhasil Divalidasi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-700">
    <div class="max-w-lg mx-auto bg-white border border-gray-300 rounded-lg overflow-hidden shadow-lg mt-6">
        <div class="bg-green-500 text-white text-center py-4">
            <h1 class="text-xl font-bold">Validasi Berkas Beasiswa</h1>
        </div>
        <div class="p-6">
            <p>Halo {{ $studentName }},</p>
            <p>Kami ingin menginformasikan bahwa berkas beasiswa yang Anda ajukan telah berhasil divalidasi oleh admin. Berikut adalah detailnya:</p>
            <ul class="list-disc list-inside my-4">
                <li><strong>Nama Beasiswa:</strong> {{ $scholarshipName }}</li>
            </ul>
            <p>Selanjutnya, Anda dapat menunggu proses pendaftaran beasiswa atau menunggu informasi lebih lanjut dari kami.</p>
            <p>Terima kasih atas perhatian dan kerja samanya.</p>
            <p>Salam,<br>Bidang Kemahasiswaan Universitas Syiah Kuala</p>
        </div>
        <div class="bg-gray-100 text-gray-600 text-center py-2 border-t border-gray-300">
            <p>&copy; {{ date('Y') }} Universitas Syiah Kuala. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
