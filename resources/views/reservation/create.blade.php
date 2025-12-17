<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserve Your Table - The Family Table</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700|poppins:300,400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; }
        h1, h2, h3 { font-family: 'Playfair Display', serif; }

        .btn-primary {
            background: linear-gradient(135deg, #8B0000 0%, #B22222 100%);
            box-shadow: 0 10px 30px rgba(139, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            box-shadow: 0 15px 40px rgba(139, 0, 0, 0.4);
            transform: translateY(-2px);
        }

        .info-card {
            background: linear-gradient(135deg, #8B0000 0%, #B22222 100%);
            position: relative;
            overflow: hidden;
        }
        .info-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 15s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.2); opacity: 0.8; }
        }

        .feature-item {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        .feature-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(8px);
        }

        .gallery-mini {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
        }
        .gallery-mini img {
            transition: transform 0.3s ease;
        }
        .gallery-mini img:hover {
            transform: scale(1.05);
        }

        .form-input:focus {
            border-color: #8B0000;
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
        }

        .main-background {
            position: relative;
            background-image: 
                linear-gradient(135deg, rgba(250, 240, 230, 0.5) 0%, rgba(255, 248, 220, 0.5) 100%),
                url('https://images.pexels.com/photos/3184183/pexels-photo-3184183.jpeg?auto=compress&cs=tinysrgb&w=1920');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .form-card-with-bg {
            position: relative;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }

        .info-banner-bg {
            background-image: 
                linear-gradient(135deg, rgba(139, 0, 0, 0.5) 0%, rgba(178, 34, 34, 0.5) 100%),
                url('https://images.pexels.com/photos/262978/pexels-photo-262978.jpeg?auto=compress&cs=tinysrgb&w=800');
            background-size: cover;
            background-position: center;
        }

        @media (max-width: 768px) {
            .main-background {
                background-attachment: scroll;
            }
        }
    </style>
</head>
<body class="bg-[#FAF0E6]">

    <!-- Header -->
    <header class="bg-white/95 backdrop-blur-sm shadow-lg sticky top-0 z-50">
        <nav class="container mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                <span class="text-4xl group-hover:scale-110 transition-transform duration-300">🍽️</span>
                <span class="text-2xl sm:text-3xl font-bold text-[#8B0000] tracking-wide">The Family Table</span>
            </a>
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-[#8B0000] transition duration-300 font-medium">
                ← Back to Home
            </a>
        </nav>
    </header>

    <main class="main-background min-h-screen py-8">
        <!-- Two Column Layout: Form + Info -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                    
                    <!-- LEFT: Reservation Form Card -->
                    <div class="form-card-with-bg rounded-3xl shadow-2xl p-6 sm:p-8 lg:sticky lg:top-24">
                        <div class="mb-6">
                            <div class="flex items-center space-x-3 mb-2">
                                <span class="text-4xl">📅</span>
                                <h1 class="text-3xl sm:text-4xl font-bold text-[#8B0000]">Reserve Your Table</h1>
                            </div>
                            <p class="text-gray-600">Fill in the details below to secure your spot</p>
                        </div>

                        @if(session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('reservation.check') }}" method="POST" class="space-y-6">
                            @csrf

                            <!-- Date & Time Section -->
                            <div class="bg-gradient-to-br from-[#8B0000]/5 to-[#B22222]/5 p-4 rounded-2xl">
                                <div class="flex items-center space-x-2 mb-3">
                                    <span class="text-xl">🗓️</span>
                                    <h3 class="text-lg font-semibold text-[#8B0000]">When?</h3>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label for="date" class="block text-sm font-medium text-gray-700 mb-1.5">Date</label>
                                        <input type="date" id="date" name="date" value="{{ old('date') }}" required
                                               class="form-input w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm transition">
                                        @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="time" class="block text-sm font-medium text-gray-700 mb-1.5">Time</label>
                                        <input type="time" id="time" name="time" value="{{ old('time') }}" required
                                               class="form-input w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm transition">
                                        @error('time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="numOfPeople" class="block text-sm font-medium text-gray-700 mb-1.5">Number of Guests</label>
                                    <input type="number" id="numOfPeople" name="numOfPeople" value="{{ old('numOfPeople') }}" min="1" required placeholder="e.g. 4"
                                           class="form-input w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm transition">
                                    @error('numOfPeople') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <!-- Contact Information Section -->
                            <div class="bg-gradient-to-br from-[#8B0000]/5 to-[#B22222]/5 p-4 rounded-2xl">
                                <div class="flex items-center space-x-2 mb-3">
                                    <span class="text-xl">👤</span>
                                    <h3 class="text-lg font-semibold text-[#8B0000]">Your Details</h3>
                                </div>
                                <div class="space-y-3">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Full Name</label>
                                        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="John Doe"
                                               class="form-input w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm transition">
                                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="phoneNumber" class="block text-sm font-medium text-gray-700 mb-1.5">Phone Number</label>
                                        <input type="tel" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber') }}" required placeholder="0812xxxxxxxx"
                                               class="form-input w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm transition">
                                        @error('phoneNumber') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email Address</label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com"
                                               class="form-input w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm transition">
                                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                    class="btn-primary w-full text-white font-bold py-4 px-8 rounded-full text-base border-2 border-[#FFD700] flex items-center justify-center space-x-2 group">
                                <span>Check Availability & Book</span>
                                <span class="group-hover:translate-x-1 transition-transform">→</span>
                            </button>
                        </form>
                    </div>

                    <!-- RIGHT: Info & Features -->
                    <div class="space-y-6">
                        <!-- Welcome Banner -->
                        <div class="info-banner-bg text-white rounded-3xl shadow-2xl p-8 relative overflow-hidden">
                            <div class="relative z-10">
                                <h2 class="text-3xl sm:text-4xl font-bold mb-4">Welcome to The Family Table</h2>
                                <p class="text-white/90 text-lg leading-relaxed mb-6">
                                    Experience the warmth of home with exceptional cuisine. Our reservation system ensures you get the perfect table for your special moments.
                                </p>
                                <div class="flex items-center space-x-4">
                                    <div class="text-center">
                                        <div class="text-3xl font-bold">15+</div>
                                        <div class="text-sm text-white/80">Years</div>
                                    </div>
                                    <div class="h-12 w-px bg-white/30"></div>
                                    <div class="text-center">
                                        <div class="text-3xl font-bold">50K+</div>
                                        <div class="text-sm text-white/80">Happy Guests</div>
                                    </div>
                                    <div class="h-12 w-px bg-white/30"></div>
                                    <div class="text-center">
                                        <div class="text-3xl font-bold">4.9★</div>
                                        <div class="text-sm text-white/80">Rating</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Why Book With Us -->
                        <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl p-6 sm:p-8">
                            <h3 class="text-2xl font-bold text-[#8B0000] mb-6 flex items-center space-x-2">
                                <span>✨</span>
                                <span>Why Book With Us?</span>
                            </h3>
                            <div class="space-y-4">
                                <div class="feature-item p-4 rounded-xl bg-gradient-to-r from-white/80 to-white/60">
                                    <div class="flex items-start space-x-3">
                                        <span class="text-2xl">⏱️</span>
                                        <div>
                                            <h4 class="font-semibold text-gray-800 mb-1">Real-Time Availability</h4>
                                            <p class="text-sm text-gray-600">Instant table status updates. No waiting, no double bookings.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature-item p-4 rounded-xl bg-gradient-to-r from-white/80 to-white/60">
                                    <div class="flex items-start space-x-3">
                                        <span class="text-2xl">✅</span>
                                        <div>
                                            <h4 class="font-semibold text-gray-800 mb-1">Instant Confirmation</h4>
                                            <p class="text-sm text-gray-600">Get your booking code immediately via email and SMS.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature-item p-4 rounded-xl bg-gradient-to-r from-white/80 to-white/60">
                                    <div class="flex items-start space-x-3">
                                        <span class="text-2xl">🔔</span>
                                        <div>
                                            <h4 class="font-semibold text-gray-800 mb-1">Smart Reminders</h4>
                                            <p class="text-sm text-gray-600">Automatic notifications so you never miss your reservation.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature-item p-4 rounded-xl bg-gradient-to-r from-white/80 to-white/60">
                                    <div class="flex items-start space-x-3">
                                        <span class="text-2xl">🍽️</span>
                                        <div>
                                            <h4 class="font-semibold text-gray-800 mb-1">Table Preferences</h4>
                                            <p class="text-sm text-gray-600">Choose from available tables that match your party size.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gallery Preview -->
                        <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl p-6 sm:p-8">
                            <h3 class="text-2xl font-bold text-[#8B0000] mb-4 flex items-center space-x-2">
                                <span>🖼️</span>
                                <span>Our Cozy Atmosphere</span>
                            </h3>
                            <div class="gallery-mini">
                                <div class="rounded-xl overflow-hidden shadow-md h-32">
                                    <img src="https://images.pexels.com/photos/262978/pexels-photo-262978.jpeg?auto=compress&cs=tinysrgb&w=400" alt="Interior" class="w-full h-full object-cover">
                                </div>
                                <div class="rounded-xl overflow-hidden shadow-md h-32">
                                    <img src="https://images.pexels.com/photos/1410235/pexels-photo-1410235.jpeg?auto=compress&cs=tinysrgb&w=400" alt="Food" class="w-full h-full object-cover">
                                </div>
                                <div class="rounded-xl overflow-hidden shadow-md h-32">
                                    <img src="https://images.pexels.com/photos/3184183/pexels-photo-3184183.jpeg?auto=compress&cs=tinysrgb&w=400" alt="Dining" class="w-full h-full object-cover">
                                </div>
                                <div class="rounded-xl overflow-hidden shadow-md h-32">
                                    <img src="https://images.pexels.com/photos/3184192/pexels-photo-3184192.jpeg?auto=compress&cs=tinysrgb&w=400" alt="Family" class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-3xl shadow-xl p-6 sm:p-8 border-2 border-[#FFD700]/30">
                            <h3 class="text-xl font-bold text-[#8B0000] mb-4">📞 Need Help?</h3>
                            <div class="space-y-2 text-sm text-gray-700">
                                <p><strong>Phone:</strong> (555) 123-4567</p>
                                <p><strong>Email:</strong> info@familytable.com</p>
                                <p><strong>Hours:</strong> Mon-Sun, 11am - 10pm</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-[#700000] text-white py-8">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <p class="text-sm">&copy; 2025 The Family Table Digital Reservation System. Made with ❤️ for memorable family moments.</p>
        </div>
    </footer>

    <script>
        // Set minimum date to today
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('date');
            const today = new Date().toISOString().split('T')[0];
            dateInput.setAttribute('min', today);
            
            // Auto-focus on date field for better UX
            dateInput.focus();
        });
    </script>
</body>
</html>