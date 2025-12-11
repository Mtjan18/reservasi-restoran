<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
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
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-3 text-center">Restaurant Admin Login</h1>

        <form method="POST" action="{{ route('admin.login.attempt') }}">
            @csrf
            
            @if(session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-sm">
                    {{ session('status') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-warm-red focus:border-warm-red">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required 
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-warm-red focus:border-warm-red">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me (Optional) -->
            <div class="mb-6">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-warm-red shadow-sm focus:ring-warm-red" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div>
                <button type="submit" 
                        class="w-full bg-warm-red hover:bg-red-900 text-white font-bold py-3 px-4 rounded-md shadow-lg transition duration-300 text-lg">
                    Log in
                </button>
            </div>
        </form>
        
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-warm-red">← Back to Customer Page</a>
        </div>
    </div>
</body>
</html>