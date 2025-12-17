<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Check My Booking - The Family Table</title>
    
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

        .main-background {
            position: relative;
            background-image: 
                linear-gradient(135deg, rgba(250, 240, 230, 0.5) 0%, rgba(255, 248, 220, 0.5) 100%),
                url('https://images.pexels.com/photos/3184183/pexels-photo-3184183.jpeg?auto=compress&cs=tinysrgb&w=1920');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .card-with-bg {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }

        .form-input:focus {
            border-color: #8B0000;
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
            outline: none;
        }

        .divider {
            position: relative;
            text-align: center;
            margin: 1.5rem 0;
        }
        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: linear-gradient(to right, transparent, #D1D5DB, transparent);
        }
        .divider::before { left: 0; }
        .divider::after { right: 0; }

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

    <!-- Main Content -->
    <main class="main-background min-h-screen flex items-center justify-center py-12 px-4 sm:px-6">
        <div class="max-w-2xl w-full">
            <!-- Main Card -->
            <div class="card-with-bg rounded-3xl shadow-2xl p-8 sm:p-10">
                <!-- Header Section -->
                <div class="text-center mb-8">
                    <div class="flex justify-center mb-4">
                        <span class="text-6xl">🔍</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-[#8B0000] mb-3">Find Your Reservation</h1>
                    <p class="text-gray-600">Enter your booking details to view, modify, or cancel your reservation</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-[#FFD700] to-[#FFA500] mx-auto mt-4"></div>
                </div>

                <!-- Form -->
                <form action="{{ route('booking.check.result') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Option 1: Booking Code -->
                    <div class="bg-gradient-to-br from-[#8B0000]/5 to-[#B22222]/5 p-6 rounded-2xl">
                        <div class="flex items-center space-x-3 mb-4">
                            <span class="text-2xl">🎫</span>
                            <h3 class="text-lg font-semibold text-[#8B0000]">Option 1: Booking Code</h3>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">Enter the unique code you received after booking</p>
                        
                        <div>
                            <label for="bookingCode" class="block text-sm font-medium text-gray-700 mb-2">Booking Code</label>
                            <input type="text" 
                                   id="bookingCode" 
                                   name="bookingCode" 
                                   class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl text-lg tracking-wider font-mono uppercase transition" 
                                   placeholder="e.g., A1B2C3D4"
                                   maxlength="8">
                            @error('bookingCode')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="divider">
                        <span class="bg-white px-4 text-gray-500 font-semibold text-sm relative z-10">OR</span>
                    </div>

                    <!-- Option 2: Phone Number -->
                    <div class="bg-gradient-to-br from-[#8B0000]/5 to-[#B22222]/5 p-6 rounded-2xl">
                        <div class="flex items-center space-x-3 mb-4">
                            <span class="text-2xl">📱</span>
                            <h3 class="text-lg font-semibold text-[#8B0000]">Option 2: Phone Number</h3>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">Use the phone number you registered with</p>
                        
                        <div>
                            <label for="phoneNumber" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" 
                                   id="phoneNumber" 
                                   name="phoneNumber" 
                                   class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl transition" 
                                   placeholder="e.g., 08123456789">
                            @error('phoneNumber')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Error Message -->
                    @if(session('error'))
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl" role="alert">
                            <div class="flex items-center">
                                <span class="text-2xl mr-3">⚠️</span>
                                <div>
                                    <p class="font-semibold text-red-800">Error</p>
                                    <p class="text-sm text-red-600">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Submit Button -->
                    <button type="submit" 
                            class="btn-primary w-full text-white font-bold py-4 px-8 rounded-full text-lg border-2 border-[#FFD700] flex items-center justify-center space-x-3 group">
                        <span>🔍</span>
                        <span>Find My Reservation</span>
                        <span class="group-hover:translate-x-1 transition-transform">→</span>
                    </button>
                </form>

                <!-- Info Section -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div class="flex items-start space-x-2">
                            <span class="text-xl">💡</span>
                            <div>
                                <p class="font-semibold text-gray-800">Need Help?</p>
                                <p class="text-gray-600 text-xs">Contact us at (555) 123-4567</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span class="text-xl">📧</span>
                            <div>
                                <p class="font-semibold text-gray-800">Email Support</p>
                                <p class="text-gray-600 text-xs">info@familytable.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600 mb-3">Don't have a reservation yet?</p>
                    <a href="{{ route('reservation.create') }}" 
                       class="inline-block text-[#8B0000] hover:text-[#B22222] font-semibold text-sm transition border-b-2 border-[#8B0000] hover:border-[#B22222] pb-1">
                        Make a New Reservation →
                    </a>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-focus on booking code input
            const bookingCodeInput = document.getElementById('bookingCode');
            if (bookingCodeInput) {
                bookingCodeInput.focus();
            }

            // Auto-uppercase for booking code
            bookingCodeInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.toUpperCase();
            });

            // Phone number formatting (basic)
            const phoneInput = document.getElementById('phoneNumber');
            phoneInput.addEventListener('input', function(e) {
                // Remove non-numeric characters
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
</body>
</html>