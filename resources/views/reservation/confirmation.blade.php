<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi & Pilih Meja</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800">🍽️ Reservasi Restoran</a>
            <a href="{{ route('reservation.create') }}" class="text-gray-600 hover:text-red-600 transition duration-300">← Ubah Kriteria</a>
        </nav>
    </header>

    <main class="container mx-auto px-6 py-12">
        <div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-lg">
            <h1 class="text-3xl font-bold text-red-600 mb-6 border-b pb-3">Konfirmasi Reservasi & Pilih Meja</h1>

            <form action="{{ route('reservation.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-1 border-r pr-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Ringkasan Data</h2>
                        <div class="space-y-3 text-sm text-gray-600">
                            <p><strong>Nama:</strong> <span class="float-right text-gray-800">{{ $data['name'] }}</span></p>
                            <p><strong>Kontak:</strong> <span class="float-right text-gray-800">{{ $data['phoneNumber'] }}</span></p>
                            <p><strong>Email:</strong> <span class="float-right text-gray-800">{{ $data['email'] }}</span></p>
                            <hr>
                            <p><strong>Tanggal:</strong> <span class="float-right text-gray-800">{{ \Carbon\Carbon::parse($data['date'])->translatedFormat('l, d F Y') }}</span></p>
                            <p><strong>Waktu:</strong> <span class="float-right text-gray-800">{{ $data['time'] }} WIB</span></p>
                            <p><strong>Jumlah Tamu:</strong> <span class="float-right text-gray-800">{{ $data['numOfPeople'] }} orang</span></p>
                            
                            {{-- Hidden inputs untuk menyimpan data reservasi ke form --}}
                            @foreach ($data as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">1. Pilih Meja Tersedia</h2>
                        <div class="space-y-4 mb-8">
                            @forelse ($tables as $table)
                                <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 transition duration-200">
                                    <input type="radio" name="tableId" value="{{ $table->tableId }}" required 
                                           class="form-radio h-5 w-5 text-red-600 focus:ring-red-500"
                                           data-capacity="{{ $table->capacity }}">
                                    <span class="ml-4 font-medium text-gray-700">
                                        Meja Nomor: <strong>{{ $table->tableNumber }}</strong> (Kapasitas: {{ $table->capacity }} orang)
                                    </span>
                                </label>
                            @empty
                                <p class="text-red-500">❌ Maaf, tidak ditemukan meja yang cocok.</p>
                            @endforelse
                        </div>

                        <h2 class="text-xl font-semibold text-gray-800 mb-4">2. Pilih Metode Pembayaran</h2>
                        <div class="grid grid-cols-3 gap-4 mb-10">
                            @foreach (['Transfer', 'QRIS', 'Cash'] as $method)
                                <label class="flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50 transition duration-200">
                                    <input type="radio" name="paymentMethod" value="{{ $method }}" required 
                                           class="form-radio h-4 w-4 text-blue-600 focus:ring-blue-500">
                                    <span class="mt-2 text-sm font-medium text-gray-700">{{ $method }}</span>
                                </label>
                            @endforeach
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-md shadow-lg transition duration-300">
                            Selesaikan & Konfirmasi Reservasi
                        </button>
                    </div>

                </div>
            </form>
        </div>
        
        @if(session('error'))
            <div class="mt-4 max-w-5xl mx-auto bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
    </main>
</body>
</html>