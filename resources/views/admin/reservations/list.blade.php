<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - All Reservations</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar {
            background-color: #1f2937;
        }

        .text-primary-red {
            color: #8B0000;
        }

        .bg-primary-red {
            background-color: #8B0000;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    @php
        // Helper untuk styling status
        $statusClasses = [
            'confirmed' => 'bg-green-100 text-green-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'cancel' => 'bg-red-100 text-red-800',
        ];
        $paymentClasses = [
            'paid' => 'bg-blue-100 text-blue-800',
            'unpaid' => 'bg-yellow-100 text-yellow-800',
            'refunded' => 'bg-red-100 text-red-800',
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
                <a href="{{ route('admin.dashboard') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 text-gray-400 hover:bg-gray-700">
                    Dashboard
                </a>
                <a href="{{ route('admin.tables.index') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 text-gray-400 hover:bg-gray-700">
                    Manage Tables
                </a>
                <a href="{{ route('admin.reservations.list') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 text-white bg-gray-700 font-semibold">
                    Reservations List
                </a>
                <a href="{{ route('admin.reports.index') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 text-gray-400 hover:bg-gray-700">
                    Reports
                </a>
            </nav>

            <form method="POST" action="{{ route('admin.logout') }}" class="px-4 absolute bottom-0 w-full mb-6">
                @csrf
                <button type="submit"
                    class="w-full text-left py-2.5 px-4 rounded transition duration-200 text-red-400 hover:bg-gray-700">
                    Logout
                </button>
            </form>
        </div>

        <!-- Konten Utama -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header Konten Utama -->
            <header class="bg-white shadow-md">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-3xl font-semibold text-gray-800">All Upcoming Reservations</h1>
                </div>
            </header>

            <!-- Body Konten Utama -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="flex justify-between items-center mb-6 border-b pb-4">
                        <h2 class="text-2xl font-bold text-gray-800">Daftar Reservasi Mendatang</h2>

                        <!-- Filter Status -->
                        <div class="flex items-center space-x-3">
                            <label for="filterStatus" class="text-sm font-medium text-gray-700">Filter:</label>
                            <select id="filterStatus" onchange="window.location.href = '?status=' + this.value"
                                class="border border-gray-300 rounded-md shadow-sm p-2 text-sm focus:ring-primary-red focus:border-primary-red">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status
                                </option>
                                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>
                                    Confirmed</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="cancel" {{ request('status') == 'cancel' ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date/Time</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Code</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Customer</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Guests/Table</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Payment</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($reservations as $reservation)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold">
                                                {{ \Carbon\Carbon::parse($reservation->date)->format('d/M/Y') }}</div>
                                            <div class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-red font-semibold">
                                            {{ $reservation->bookingCode }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ optional($reservation->customer)->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $reservation->numOfPeople }} Guests <br>
                                            <span class="font-medium text-xs text-blue-600">Table:
                                                {{ optional(optional($reservation->assignedTables->first())->table)->tableNumber ?? 'Unassigned' }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <span
                                                class="px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $paymentClasses[optional($reservation->payment)->status ?? 'unpaid'] }}">
                                                {{ ucfirst(optional($reservation->payment)->status ?? 'unpaid') }}
                                                ({{ optional($reservation->payment)->method ?? 'N/A' }})
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$reservation->status] }}">
                                                {{ ucfirst($reservation->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <!-- Tombol Aksi -->
                                            <a href="#"
                                                class="text-indigo-600 hover:text-indigo-900 mr-2">Detail</a>
                                            @if ($reservation->status != 'cancel')
                                                <form
                                                    action="{{ route('reservation.cancel', $reservation->reservationId) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('ADMIN ACTION: Batalkan reservasi {{ $reservation->bookingCode }}?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900">Cancel</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-10 text-center text-gray-500">No upcoming
                                            reservations found.</td>
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
