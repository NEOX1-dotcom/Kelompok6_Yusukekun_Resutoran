<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Manajemen') - yusukekun</title>

    <!-- Tailwind CSS CDN (v3.4) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Google Fonts Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col antialiased">

    <!-- Header / Navbar -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2">
                        <div class="w-10 h-10 rounded-xl bg-orange-600 flex items-center justify-center text-white shadow-md shadow-orange-200">
                            <i class="fa-solid fa-utensils text-lg"></i>
                        </div>
                        <div>
                            <span class="text-xl font-bold text-gray-900 tracking-tight block">yusukekun</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('bahan-masuk.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('bahan-masuk.*') ? 'bg-orange-50 text-orange-600 font-semibold' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-arrow-down-long mr-1.5 text-orange-500"></i> Bahan Masuk
                    </a>
                </div>

                <!-- User / Action -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('bahan-masuk.create') }}" class="hidden sm:inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg text-white bg-orange-600 hover:bg-orange-700 shadow-sm transition">
                        <i class="fa-solid fa-plus mr-1.5"></i> Tambah Bahan Masuk
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Notification / Flash Messages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full mt-4">
        @if (session('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-xl bg-green-50 border border-green-200 shadow-sm" role="alert">
                <i class="fa-solid fa-circle-check text-green-600 text-lg mr-3"></i>
                <div class="flex-1 font-medium">
                    {{ session('success') }}
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800 p-1">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200 shadow-sm" role="alert">
                <i class="fa-solid fa-circle-exclamation text-red-600 text-lg mr-3"></i>
                <div class="flex-1 font-medium">
                    {{ session('error') }}
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800 p-1">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200 shadow-sm" role="alert">
                <div class="flex items-center mb-2 font-semibold">
                    <i class="fa-solid fa-triangle-exclamation mr-2 text-red-600"></i> Ada beberapa kesalahan pada formulir:
                </div>
                <ul class="list-disc list-inside space-y-1 text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-auto py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} <strong>yusukekun</strong> &bull; Sistem Inventaris & Bahan Baku.
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
