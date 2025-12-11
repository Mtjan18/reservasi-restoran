<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warm Family Dining - Restaurant Reservation</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Definisi Palet Warna Warm */
        .bg-warm-red { background-color: #8B0000; } /* Merah Tua/Maroon */
        .text-warm-red { color: #8B0000; }
        .bg-cream { background-color: #FAF0E6; } /* Cream */
        .border-gold { border-color: #FFD700; } /* Gold */
        .text-gold { color: #FFD700; }
        .hover\:bg-warm-red\:dark { background-color: #700000; }

        .hero-section {
            /* Contoh Gambar Restoran yang hangat */
            background-image: url('https://source.unsplash.com/1600x900/?restaurant,interior,warm,family'); 
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .hero-overlay {
            background-color: rgba(0, 0, 0, 0.4);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
    </style>
</head>
<body class="bg-cream font-sans">

    <header class="bg-white shadow-lg sticky top-0 z-10">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-bold text-warm-red tracking-wide">
                🍽️ <span class="hidden sm:inline">The Family Table</span>
            </a>
            <div class="space-x-4">
                {{-- Tombol Login (Untuk Admin) --}}
                <a href="/login" class="text-gray-600 hover:text-warm-red transition duration-300 font-semibold">Admin Login</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero-section h-[70vh] flex items-center justify-center">
            <div class="hero-overlay"></div>
            <div class="text-center z-10 p-10 max-w-4xl">
                <h1 class="text-6xl font-extrabold mb-4 leading-tight text-white tracking-tight drop-shadow-lg">
                    Welcome to our family restaurant.
                </h1>
                <p class="text-2xl mb-10 font-light text-cream drop-shadow-md">
                    Reserve your table and join us for a warm, memorable dining experience.
                </p>
                <div class="space-x-4 flex justify-center">
                    {{-- Tombol utama untuk Reservasi --}}
                    <a href="{{ route('reservation.create') }}" 
                       class="bg-warm-red hover:bg-warm-red:dark text-white font-bold py-4 px-10 rounded-full shadow-xl transition duration-300 transform hover:scale-105 text-lg border-2 border-gold">
                        Reserve a Table ✨
                    </a>
                    
                    {{-- Tombol untuk Cek Booking --}}
                    <a href="{{ route('booking.check.form') }}" 
                       class="bg-white hover:bg-gray-100 text-warm-red font-bold py-4 px-10 rounded-full shadow-xl transition duration-300 transform hover:scale-105 text-lg border-2 border-warm-red">
                        Check My Booking 🔍
                    </a>
                </div>
            </div>
        </section>

        <section class="container mx-auto px-6 py-16 text-center">
            <h2 class="text-4xl font-bold text-warm-red mb-4">Seamless Experience</h2>
            <p class="text-gray-600 mb-12 max-w-3xl mx-auto">
                Our digital reservation system is designed to simplify your booking process and ensure operational efficiency.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 bg-white rounded-xl shadow-lg border-t-4 border-gold transition duration-300 hover:shadow-2xl">
                    <div class="text-5xl text-warm-red mb-4">⏱️</div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Real-time Availability</h3>
                    <p class="text-gray-600 text-sm">Monitor table status instantly and secure your spot without double booking worries.</p>
                </div>
                <div class="p-8 bg-white rounded-xl shadow-lg border-t-4 border-gold transition duration-300 hover:shadow-2xl">
                    <div class="text-5xl text-warm-red mb-4">✅</div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Instant Confirmation</h3>
                    <p class="text-gray-600 text-sm">Receive a unique **Booking Code** immediately for fast and easy check-in.</p>
                </div>
                <div class="p-8 bg-white rounded-xl shadow-lg border-t-4 border-gold transition duration-300 hover:shadow-2xl">
                    <div class="text-5xl text-warm-red mb-4">🔔</div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Automatic Notification</h3>
                    <p class="text-gray-600 text-sm">Get automatic reminders (email/SMS) about your reservation status and time.</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-warm-red text-cream py-8">
        <div class="container mx-auto px-6 text-center">
            <p class="text-sm">&copy; 2025 The Family Table Digital Reservation System. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>