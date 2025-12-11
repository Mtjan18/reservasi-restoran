<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Dashboard</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar { background-color: #1f2937; }
        .text-primary-red { color: #8B0000; }
        .bg-primary-red { background-color: #8B0000; }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    @php
        // Helper untuk styling status di tabel reservasi
        $statusClasses = [
            'confirmed' => 'bg-green-100 text-green-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'cancel' => 'bg-red-100 text-red-800',
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
                <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 text-white bg-gray-700 font-semibold">
                    Dashboard
                </a>
                <a href="{{ route('admin.tables.index') }}" class="block py-2.5 px-4 rounded transition duration-200 text-gray-400 hover:bg-gray-700">
                    Manage Tables
                </a>
                <a href="{{ route('admin.reservations.list') }}" class="block py-2.5 px-4 rounded transition duration-200 text-gray-400 hover:bg-gray-700">
                    Reservations List
                </a>
                <a href="{{ route('admin.reports.index') }}" class="block py-2.5 px-4 rounded transition duration-200 text-gray-400 hover:bg-gray-700">
                    Reports
                </a>
            </nav>
            
            <!-- Logout -->
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
                    <h1 class="text-3xl font-semibold text-gray-800">Admin Dashboard</h1>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                
                <!-- Statistik Ringkasan -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Reservations Today -->
                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-primary-red">
                        <p class="text-sm font-medium text-gray-500">Reservations Today</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['totalReservationsToday'] }}</p>
                    </div>
                    
                    <!-- Confirmed Reservations -->
                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-green-500">
                        <p class="text-sm font-medium text-gray-500">Confirmed (Today)</p>
                        <p class="text-3xl font-bold text-green-600 mt-1">{{ $stats['confirmedReservations'] }}</p>
                    </div>
                    
                    <!-- Pending Reservations -->
                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-yellow-500">
                        <p class="text-sm font-medium text-gray-500">Pending (Today)</p>
                        <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $stats['pendingReservations'] }}</p>
                    </div>

                    <!-- Available Tables -->
                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-blue-500">
                        <p class="text-sm font-medium text-gray-500">Available Tables</p>
                        <p class="text-3xl font-bold text-blue-600 mt-1">{{ $stats['availableTables'] }} / {{ $stats['totalTables'] }}</p>
                    </div>
                </div>

                <!-- Reservasi Hari Ini -->
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Today's Reservations ({{ \Carbon\Carbon::now()->format('d F Y') }})</h2>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pax</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Table Assigned</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($reservationsToday as $reservation)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ optional($reservation->customer)->name ?? 'Guest' }} ({{ optional($reservation->customer)->phone ?? 'N/A' }})
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $reservation->numOfPeople }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-red font-semibold">
                                            {{ optional(optional($reservation->assignedTables->first())->table)->tableNumber ?? 'Unassigned' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$reservation->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($reservation->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs text-gray-400">
                                            {{ $reservation->bookingCode }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">No reservations for today. Enjoy your day!</td>
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