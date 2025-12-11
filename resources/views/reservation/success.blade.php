<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservasi Berhasil!</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="max-w-xl mx-auto bg-white p-10 rounded-xl shadow-2xl text-center">
        <div class="text-6xl text-green-500 mb-6">🎉</div>
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Reservasi Berhasil Dikonfirmasi!</h1>
        <p class="text-gray-600 mb-6">Reservasi meja Anda telah selesai. Detail konfirmasi telah dikirim ke email Anda.</p>
        
        <div class="p-6 bg-green-50 border border-green-200 rounded-lg mb-8">
            <p class="text-lg font-semibold text-green-700">Kode Booking Anda:</p>
            <p class="text-4xl font-extrabold text-green-600 mt-2 p-2 bg-white rounded shadow-inner inline-block tracking-wider">{{ $code }}</p>
        </div>

        <p class="text-sm text-gray-500 mb-8">Gunakan kode ini untuk **check-in** di restoran. Anda juga dapat menggunakannya untuk **Check My Booking** di halaman utama.</p>
        
        <a href="{{ route('home') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-full shadow-lg transition duration-300">
            Kembali ke Halaman Utama
        </a>
    </div>
</body>
</html>