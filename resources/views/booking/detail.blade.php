<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Reservasi: {{ $reservation->bookingCode }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-12">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-3">Detail Reservasi</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-2 gap-y-4 gap-x-8 text-gray-700 mb-8 p-6 border rounded-lg">
            <div>
                <p class="text-sm font-medium">Kode Booking</p>
                <p class="text-2xl font-extrabold text-red-600">{{ $reservation->bookingCode }}</p>
            </div>
            <div>
                <p class="text-sm font-medium">Status</p>
                <span class="px-3 py-1 text-sm font-semibold rounded-full 
                    {{ $reservation->status == 'confirmed' ? 'bg-green-100 text-green-800' : 
                       ($reservation->status == 'cancel' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                    {{ ucfirst($reservation->status) }}
                </span>
            </div>
            <div class="col-span-2 md:col-span-1">
                <p class="text-sm font-medium">Tanggal & Waktu</p>
                <p class="text-lg font-semibold">{{ \Carbon\Carbon::parse($reservation->date)->translatedFormat('d F Y') }} pukul {{ $reservation->time }}</p>
            </div>
            <div class="col-span-2 md:col-span-1">
                <p class="text-sm font-medium">Tamu / Meja</p>
                <p class="text-lg font-semibold">{{ $reservation->numOfPeople }} orang / Meja No. {{ optional($reservation->assignedTables->first())->table->tableNumber ?? 'N/A' }}</p>
            </div>
        </div>

        @if ($reservation->status != 'cancel')
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Kelola Reservasi Anda</h2>
            <div class="flex space-x-4">
                <a href="{{ route('reservation.edit', $reservation->reservationId) }}"
                   class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-md text-center transition duration-300">
                    <i class="fas fa-edit"></i> Ubah Reservasi
                </a>

                <form action="{{ route('reservation.cancel', $reservation->reservationId) }}" method="POST" class="flex-1"
                      onsubmit="return confirm('Apakah Anda yakin ingin membatalkan reservasi ini? Aksi ini tidak dapat diurungkan.');">
                    @csrf
                    @method('PUT') 
                    <button type="submit" 
                            class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-md transition duration-300">
                        <i class="fas fa-times-circle"></i> Batalkan Reservasi
                    </button>
                </form>
            </div>
        @else
            <div class="p-4 bg-red-50 border border-red-300 text-red-700 rounded-lg text-center font-medium">
                Reservasi ini telah dibatalkan.
            </div>
        @endif
        
        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-red-600">Kembali ke Halaman Utama</a>
        </div>
    </div>
</body>
</html>