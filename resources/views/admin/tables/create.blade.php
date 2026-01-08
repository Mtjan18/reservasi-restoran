<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Add New Table</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar { background-color: #1f2937; }
        .text-primary-red { color: #8B0000; }
        .bg-primary-red { background-color: #8B0000; }
        .focus\:ring-primary-red:focus { ring-color: #8B0000; }
        .focus\:border-primary-red:focus { border-color: #8B0000; }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen">
        <!-- Sidebar (Sama seperti index) -->
        <div class="sidebar w-64 space-y-6 py-7 px-2 md:relative transition duration-200 ease-in-out">
            <a href="{{ route('admin.dashboard') }}" class="text-white flex items-center space-x-2 px-4">
                <span class="text-2xl font-extrabold tracking-wider">RESERVO ADMIN</span>
            </a>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 text-gray-400 hover:bg-gray-700">
                    Dashboard
                </a>
                <a href="{{ route('admin.tables.index') }}" class="block py-2.5 px-4 rounded transition duration-200 text-white bg-gray-700 font-semibold">
                    Manage Tables
                </a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 text-gray-400 hover:bg-gray-700">
                    Reservations List
                </a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 text-gray-400 hover:bg-gray-700">
                    Reports
                </a>
            </nav>
            <form method="POST" action="{{ route('admin.logout') }}" class="px-4 absolute bottom-0 w-full mb-6">
                @csrf
                <button type="submit" class="w-full text-left py-2.5 px-4 rounded transition duration-200 text-red-400 hover:bg-gray-700">
                    Logout
                </button>
            </form>
        </div>

        <!-- Konten Utama -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-md">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-3xl font-semibold text-gray-800">Add New Table</h1>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-lg">
                    <form action="{{ route('admin.tables.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            
                            <!-- Capacity -->
                            <div>
                                <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity (Number of Guests)</label>
                                <input type="number" id="capacity" name="capacity" value="{{ old('capacity') }}" required min="1"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-primary-red focus:border-primary-red">
                                @error('capacity')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Initial Status</label>
                                <select id="status" name="status" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-primary-red focus:border-primary-red">
                                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Unavailable (Under maintenance)</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="mt-8 flex justify-end space-x-4">
                            <a href="{{ route('admin.tables.index') }}" class="py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                            <button type="submit" 
                                    class="bg-primary-red hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md shadow-md transition duration-300">
                                Save Table
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>