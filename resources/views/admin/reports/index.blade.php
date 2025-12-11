<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Reservation Reports</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar { background-color: #1f2937; }
        .text-primary-red { color: #8B0000; }
        .bg-primary-red { background-color: #8B0000; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    @php
        $statusClasses = [
            'confirmed' => 'bg-green-100 text-green-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'cancel' => 'bg-red-100 text-red-800',
        ];
    @endphp
    
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar w-64 space-y-6 py-7 px-2 md:relative transition duration-200 ease-in-out no-print">
            <a href="{{ route('admin.dashboard') }}" class="text-white flex items-center space-x-2 px-4">
                <span class="text-2xl font-extrabold tracking-wider">RESERVO ADMIN</span>
            </a>

            <!-- Navigasi -->
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 text-gray-400 hover:bg-gray-700">
                    Dashboard
                </a>
                <a href="{{ route('admin.tables.index') }}" class="block py-2.5 px-4 rounded transition duration-200 text-gray-400 hover:bg-gray-700">
                    Manage Tables
                </a>
                <a href="{{ route('admin.reservations.list') }}" class="block py-2.5 px-4 rounded transition duration-200 text-gray-400 hover:bg-gray-700">
                    Reservations List
                </a>
                <a href="{{ route('admin.reports.index') }}" class="block py-2.5 px-4 rounded transition duration-200 text-white bg-gray-700 font-semibold">
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
            <header class="bg-white shadow-md no-print">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-3xl font-semibold text-gray-800">Reservation Reports</h1>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Laporan Periode: 
                        {{ \Carbon\Carbon::parse($startDate)->format('d/M/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d/M/Y') }}
                    </h2>
                    
                    <!-- Form Filter Tanggal -->
                    <form method="GET" action="{{ route('admin.reports.index') }}" class="no-print mb-8 p-4 bg-gray-50 rounded-lg shadow-inner flex items-end space-x-4">
                        <div class="flex-1">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ \Carbon\Carbon::parse($startDate)->format('Y-m-d') }}" required
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-red focus:border-primary-red">
                        </div>
                        <div class="flex-1">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ \Carbon\Carbon::parse($endDate)->format('Y-m-d') }}" required
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-red focus:border-primary-red">
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                            View Report
                        </button>
                        <button type="button" onclick="window.print()" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                            Print
                        </button>
                    </form>

                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-primary-red text-white p-5 rounded-lg shadow-md">
                            <p class="text-sm font-medium opacity-80">Total Reservations</p>
                            <p class="text-3xl font-bold mt-1">{{ $summary['total_reservations'] }}</p>
                        </div>
                        <div class="bg-green-600 text-white p-5 rounded-lg shadow-md">
                            <p class="text-sm font-medium opacity-80">Confirmed</p>
                            <p class="text-3xl font-bold mt-1">{{ $summary['confirmed_count'] }}</p>
                        </div>
                        <div class="bg-yellow-600 text-white p-5 rounded-lg shadow-md">
                            <p class="text-sm font-medium opacity-80">Total Guests</p>
                            <p class="text-3xl font-bold mt-1">{{ $summary['total_guests'] }}</p>
                        </div>
                        <div class="bg-red-600 text-white p-5 rounded-lg shadow-md">
                            <p class="text-sm font-medium opacity-80">Cancelled</p>
                            <p class="text-3xl font-bold mt-1">{{ $summary['cancelled_count'] }}</p>
                        </div>
                    </div>

                    <!-- Detail Data Reservasi -->
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Detail Reservations</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date/Time</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guests/Table</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($reservations as $reservation)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold">{{ \Carbon\Carbon::parse($reservation->date)->format('d/M/Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-red font-semibold">{{ $reservation->bookingCode }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ optional($reservation->customer)->name ?? 'Guest' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $reservation->numOfPeople }} Guests <br>
                                            <span class="font-medium text-xs text-blue-600">Table: {{ optional(optional($reservation->assignedTables->first())->table)->tableNumber ?? 'Unassigned' }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$reservation->status] }}">
                                                {{ ucfirst($reservation->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <span class="text-xs">
                                                {{ ucfirst(optional($reservation->payment)->method ?? 'N/A') }} ({{ ucfirst(optional($reservation->payment)->status ?? 'Unpaid') }})
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">No reservations found in this date range.</td>
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