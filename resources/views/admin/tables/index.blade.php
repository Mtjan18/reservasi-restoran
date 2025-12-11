<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Manage Tables</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar { background-color: #1f2937; }
        .text-primary-red { color: #8B0000; }
        .bg-primary-red { background-color: #8B0000; }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    @php
        // Helper untuk styling status
        $statusClasses = [
            'available' => 'bg-green-100 text-green-800',
            'reserved' => 'bg-blue-100 text-blue-800',
            'unavailable' => 'bg-red-100 text-red-800',
        ];
    @endphp
    
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar w-64 space-y-6 py-7 px-2 md:relative transition duration-200 ease-in-out">
            <a href="{{ route('admin.dashboard') }}" class="text-white flex items-center space-x-2 px-4">
                <span class="text-2xl font-extrabold tracking-wider">RESERVO ADMIN</span>
            </a>

            <!-- Navigasi -->
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 text-gray-400 hover:bg-gray-700">
                    Dashboard
                </a>
                <a href="{{ route('admin.tables.index') }}" class="block py-2.5 px-4 rounded transition duration-200 text-white bg-gray-700 font-semibold">
                    Manage Tables
                </a>
                <a href="{{ route('admin.reservations.list') }}" class="block py-2.5 px-4 rounded transition duration-200 text-gray-400 hover:bg-gray-700">
                    Reservations List
                </a>
                <a href="{{ route('admin.reports.index') }}" class="block py-2.5 px-4 rounded transition duration-200 text-gray-400 hover:bg-gray-700">
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
                    <h1 class="text-3xl font-semibold text-gray-800">Table Management</h1>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="flex justify-between items-center mb-6 border-b pb-4">
                        <h2 class="text-2xl font-bold text-gray-800">Daftar Semua Meja</h2>
                        <a href="{{ route('admin.tables.create') }}" 
                           class="bg-primary-red hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md shadow-md transition duration-300">
                            + Add New Table
                        </a>
                    </div>
                    
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Table No.</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacity (Pax)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($tables as $table)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $table->tableId }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-lg font-semibold text-primary-red">{{ $table->tableNumber }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $table->capacity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$table->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($table->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.tables.edit', $table->tableId) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                            
                                            <form action="{{ route('admin.tables.destroy', $table->tableId) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete Table No. {{ $table->tableNumber }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No tables found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>