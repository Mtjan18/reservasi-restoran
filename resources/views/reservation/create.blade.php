<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserve Your Table</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-warm-red { background-color: #8B0000; }
        .text-warm-red { color: #8B0000; }
        .bg-cream { background-color: #FAF0E6; }
        .border-gold { border-color: #FFD700; }
        .text-gold { color: #FFD700; }
        .focus\:ring-warm-red:focus { ring-color: #8B0000; }
        .focus\:border-warm-red:focus { border-color: #8B0000; }
    </style>
</head>
<body class="bg-cream font-sans">

    <!-- Header -->
    <header class="bg-white shadow-lg">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-bold text-warm-red tracking-wide">
                🍽️ The Family Table
            </a>
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-warm-red transition duration-300 font-semibold">
                ← Back to Home
            </a>
        </nav>
    </header>

    <main class="container mx-auto px-6 py-12">
        <div class="max-w-4xl mx-auto bg-white p-10 rounded-xl shadow-2xl border-t-4 border-warm-red">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 border-b pb-3 text-center">Book Your Family Table Online</h1>

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form Reservasi Meja Online -->
            <form action="{{ route('reservation.check') }}" method="POST">
                @csrf

                <!-- Section: Input Kriteria Reservasi -->
                <h2 class="text-xl font-semibold text-warm-red mb-4">1. When and How Many Guests?</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 p-6 bg-cream rounded-lg">
                    <!-- Tanggal -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Reservation Date</label>
                        <input type="date" id="date" name="date" value="{{ old('date') }}" required 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-warm-red focus:border-warm-red">
                        @error('date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Waktu -->
                    <div>
                        <label for="time" class="block text-sm font-medium text-gray-700 mb-1">Time (Hour)</label>
                        <input type="time" id="time" name="time" value="{{ old('time') }}" required 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-warm-red focus:border-warm-red">
                        @error('time')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Orang -->
                    <div>
                        <label for="numOfPeople" class="block text-sm font-medium text-gray-700 mb-1">Number of Guests</label>
                        <input type="number" id="numOfPeople" name="numOfPeople" value="{{ old('numOfPeople') }}" min="1" required 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-warm-red focus:border-warm-red" placeholder="Minimum 1 person">
                        @error('numOfPeople')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Section: Input Data Diri Pelanggan -->
                <h2 class="text-xl font-semibold text-warm-red mb-4">2. Your Contact Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 p-6 bg-white border border-gray-200 rounded-lg">
                    <!-- Nama -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-warm-red focus:border-warm-red" placeholder="Enter your full name">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Nomor Telepon -->
                    <div>
                        <label for="phoneNumber" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber') }}" required 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-warm-red focus:border-warm-red" placeholder="Ex: 0812...">
                        @error('phoneNumber')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Email -->
                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email (for Confirmation)</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-warm-red focus:border-warm-red" placeholder="Enter your active email">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div>
                    <button type="submit" 
                            class="w-full bg-warm-red hover:bg-red-900 text-white font-bold py-3 px-4 rounded-md shadow-xl transition duration-300 transform hover:scale-[1.01] text-lg">
                        Check Table Availability
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-warm-red text-cream py-6 mt-12">
        <div class="container mx-auto px-6 text-center">
            <p class="text-sm">&copy; 2025 The Family Table Digital Reservation System.</p>
        </div>
    </footer>
</body>
</html>