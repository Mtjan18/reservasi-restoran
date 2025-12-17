<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm Your Reservation - The Family Table</title>
    
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

        .table-option {
            transition: all 0.3s ease;
        }
        .table-option:hover {
            transform: translateX(5px);
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.15);
        }

        .payment-option {
            transition: all 0.3s ease;
        }
        .payment-option:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.15);
        }

        input[type="radio"]:checked + .option-content {
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.05) 0%, rgba(178, 34, 34, 0.05) 100%);
            border-color: #8B0000;
        }

        @media (max-width: 768px) {
            .main-background {
                background-attachment: scroll;
            }
        }
    </style>
</head>
<body class="bg-[#FAF0E6]">

    <header class="bg-white/95 backdrop-blur-sm shadow-lg sticky top-0 z-50">
        <nav class="container mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                <span class="text-4xl group-hover:scale-110 transition-transform duration-300">🍽️</span>
                <span class="text-2xl sm:text-3xl font-bold text-[#8B0000] tracking-wide">The Family Table</span>
            </a>
            <a href="{{ route('reservation.create') }}" class="text-gray-700 hover:text-[#8B0000] transition duration-300 font-medium">
                ← Back to Form
            </a>
        </nav>
    </header>

    <main class="main-background min-h-screen py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <!-- Page Title -->
                <div class="text-center mb-8">
                    <h1 class="text-4xl sm:text-5xl font-bold text-[#8B0000] mb-3">Confirm Your Reservation</h1>
                    <p class="text-gray-600 text-lg">Review your details and select your preferred table</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-[#FFD700] to-[#FFA500] mx-auto mt-4"></div>
                </div>

            <form action="{{ route('reservation.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- LEFT: Booking Summary -->
                    <div class="lg:col-span-1">
                        <div class="card-with-bg rounded-3xl shadow-2xl p-6 lg:sticky lg:top-24">
                            <div class="flex items-center space-x-3 mb-6">
                                <span class="text-3xl">📋</span>
                                <h2 class="text-2xl font-bold text-[#8B0000]">Your Details</h2>
                            </div>
                            
                            <div class="space-y-4">
                                <!-- Guest Info -->
                                <div class="bg-gradient-to-br from-[#8B0000]/5 to-[#B22222]/5 p-4 rounded-xl">
                                    <div class="flex items-center space-x-2 mb-3">
                                        <span class="text-xl">👤</span>
                                        <h3 class="font-semibold text-gray-800">Guest Information</h3>
                                    </div>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Name:</span>
                                            <span class="font-semibold text-gray-800">{{ $data['name'] }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Phone:</span>
                                            <span class="font-semibold text-gray-800">{{ $data['phoneNumber'] }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Email:</span>
                                            <span class="font-semibold text-gray-800 text-xs">{{ $data['email'] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reservation Details -->
                                <div class="bg-gradient-to-br from-[#8B0000]/5 to-[#B22222]/5 p-4 rounded-xl">
                                    <div class="flex items-center space-x-2 mb-3">
                                        <span class="text-xl">🗓️</span>
                                        <h3 class="font-semibold text-gray-800">Reservation Details</h3>
                                    </div>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Date:</span>
                                            <span class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($data['date'])->format('d M Y') }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Time:</span>
                                            <span class="font-semibold text-gray-800">{{ $data['time'] }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Guests:</span>
                                            <span class="font-semibold text-gray-800">{{ $data['numOfPeople'] }} people</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Info Badge -->
                                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                                    <p class="text-xs text-blue-800">
                                        <strong>💡 Note:</strong> Please arrive 15 minutes before your reservation time.
                                    </p>
                                </div>
                            </div>
                            
                            {{-- Hidden inputs untuk menyimpan data reservasi ke form --}}
                            @foreach ($data as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                        </div>
                    </div>

                    <!-- RIGHT: Selection Options -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        <!-- Step 1: Choose Table -->
                        <div class="card-with-bg rounded-3xl shadow-2xl p-6 sm:p-8">
                            <div class="flex items-center space-x-3 mb-6">
                                <span class="text-3xl">🪑</span>
                                <div>
                                    <h2 class="text-2xl font-bold text-[#8B0000]">Step 1: Choose Your Table</h2>
                                    <p class="text-sm text-gray-600">Select from available tables that fit your party</p>
                                </div>
                            </div>
                            
                            <div class="space-y-3">
                                @forelse ($tables as $table)
                                    <label class="table-option block cursor-pointer">
                                        <div class="flex items-center p-4 border-2 border-gray-200 rounded-xl hover:border-[#8B0000] transition-all">
                                            <input type="radio" name="tableId" value="{{ $table->tableId }}" required 
                                                   class="hidden peer"
                                                   data-capacity="{{ $table->capacity }}">
                                            <div class="option-content w-full flex items-center justify-between p-3 rounded-lg border-2 border-transparent peer-checked:border-[#8B0000] peer-checked:bg-[#8B0000]/5 transition-all">
                                                <div class="flex items-center space-x-4">
                                                    <div class="w-12 h-12 bg-gradient-to-br from-[#8B0000] to-[#B22222] rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-md">
                                                        {{ $table->tableNumber }}
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold text-gray-800">Table {{ $table->tableNumber }}</p>
                                                        <p class="text-sm text-gray-600">Capacity: {{ $table->capacity }} guests</p>
                                                    </div>
                                                </div>
                                                <div class="text-2xl">
                                                    @if($table->capacity >= 6)
                                                        👨‍👩‍👧‍👦
                                                    @elseif($table->capacity >= 4)
                                                        👨‍👩‍👧
                                                    @else
                                                        👫
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                @empty
                                    <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-xl">
                                        <div class="flex items-center">
                                            <span class="text-3xl mr-3">❌</span>
                                            <div>
                                                <p class="font-semibold text-red-800">No Tables Available</p>
                                                <p class="text-sm text-red-600">Sorry, no suitable tables found for your criteria.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Step 2: Payment Method -->
                        <div class="card-with-bg rounded-3xl shadow-2xl p-6 sm:p-8">
                            <div class="flex items-center space-x-3 mb-6">
                                <span class="text-3xl">💳</span>
                                <div>
                                    <h2 class="text-2xl font-bold text-[#8B0000]">Step 2: Payment Method</h2>
                                    <p class="text-sm text-gray-600">Choose how you'd like to pay</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                @foreach ([
                                    ['value' => 'Transfer', 'icon' => '🏦', 'label' => 'Bank Transfer'],
                                    ['value' => 'QRIS', 'icon' => '📱', 'label' => 'QRIS'],
                                    ['value' => 'Cash', 'icon' => '💵', 'label' => 'Cash']
                                ] as $method)
                                    <label class="payment-option block cursor-pointer">
                                        <div class="border-2 border-gray-200 rounded-xl hover:border-[#8B0000] transition-all">
                                            <input type="radio" name="paymentMethod" value="{{ $method['value'] }}" required 
                                                   class="hidden peer">
                                            <div class="option-content flex flex-col items-center justify-center p-6 text-center peer-checked:border-[#8B0000] peer-checked:bg-[#8B0000]/5 rounded-xl transition-all">
                                                <span class="text-4xl mb-3">{{ $method['icon'] }}</span>
                                                <span class="font-semibold text-gray-800">{{ $method['label'] }}</span>
                                                @if($method['value'] === 'Cash')
                                                    <span class="text-xs text-gray-500 mt-1">Pay at venue</span>
                                                @endif
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" 
                                class="btn-primary w-full text-white font-bold py-5 px-8 rounded-full text-lg border-2 border-[#FFD700] flex items-center justify-center space-x-3 group">
                            <span>✓</span>
                            <span>Confirm Reservation</span>
                            <span class="group-hover:translate-x-1 transition-transform">→</span>
                        </button>
                    </div>

                </div>
            </form>

            @if(session('error'))
                <div class="mt-6 bg-red-50 border-l-4 border-red-500 p-6 rounded-xl shadow-lg">
                    <div class="flex items-center">
                        <span class="text-3xl mr-3">⚠️</span>
                        <div>
                            <p class="font-semibold text-red-800">Error</p>
                            <p class="text-sm text-red-600">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif
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
            // Auto-scroll to first selection if needed
            const firstRadio = document.querySelector('input[type="radio"]');
            if (firstRadio) {
                firstRadio.focus();
            }

            // Add visual feedback for selections
            const radioButtons = document.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Visual confirmation
                    const label = this.closest('label');
                    if (label) {
                        label.style.transform = 'scale(0.98)';
                        setTimeout(() => {
                            label.style.transform = 'scale(1)';
                        }, 150);
                    }
                });
            });
        });
    </script>
</body>
</html>