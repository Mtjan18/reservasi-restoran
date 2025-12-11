<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Check My Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-warm-red { background-color: #8B0000; }
        .text-warm-red { color: #8B0000; }
        .bg-cream { background-color: #FAF0E6; }
        .focus\:ring-warm-red:focus { ring-color: #8B0000; }
        .focus\:border-warm-red:focus { border-color: #8B0000; }
    </style>
</head>
<body class="bg-cream flex items-center justify-center min-h-screen font-sans">

    <div class="max-w-md w-full bg-white p-10 rounded-xl shadow-2xl border-t-4 border-warm-red">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3 text-center">Find Your Reservation</h1>

        <form action="{{ route('booking.check.result') }}" method="POST">
            @csrf
            
            <p class="text-sm text-gray-600 mb-6">Enter your unique Booking Code to view, modify, or cancel your reservation.</p>

            <div class="mb-6">
                <label for="bookingCode" class="block text-sm font-medium text-gray-700 mb-1">Booking Code</label>
                <input type="text" id="bookingCode" name="bookingCode" required 
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-warm-red focus:border-warm-red uppercase text-lg tracking-wider font-mono" 
                       placeholder="Ex: A1B2C3D4">
                @error('bookingCode')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 text-center text-gray-400 font-semibold">
                — OR —
            </div>

            <div class="mb-4">
                <label for="phoneNumber" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" 
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-warm-red focus:border-warm-red" 
                       placeholder="Enter registered Phone Number">
            </div>
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            
            <div>
                <button type="submit" 
                        class="w-full bg-warm-red hover:bg-red-900 text-white font-bold py-3 px-4 rounded-md shadow-lg transition duration-300 text-lg">
                    Find Reservation
                </button>
            </div>
        </form>
        
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-warm-red">← Back to Home</a>
        </div>
    </div>
</body>
</html>