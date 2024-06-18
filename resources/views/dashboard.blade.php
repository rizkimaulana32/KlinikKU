<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <!-- Logo -->
                    <div>
                        <a href="#" class="flex items-center px-2 py-4">
                            <span class="text-lg font-semibold text-gray-500">MyApp</span>
                        </a>
                    </div>
                </div>
                <!-- Primary Navbar items -->
                <div class="items-center hidden space-x-1 md:flex">
                    <a href="{{ route('login') }}"
                        class="px-2 py-4 font-semibold text-gray-500 transition duration-300 hover:text-gray-900">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-2 py-2 font-semibold text-white transition duration-300 bg-blue-500 rounded-lg shadow-md hover:bg-blue-700">Register</a>
                </div>
                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button class="outline-none mobile-menu-button">
                        <svg class="w-6 h-6 text-gray-500 hover:text-gray-900" x-show="!showMenu" fill="none"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <!-- Mobile menu -->
    <div class="hidden mobile-menu">
        <ul class="">
            <li><a href="{{ route('login') }}"
                    class="block px-2 py-4 text-sm text-gray-500 transition duration-300 hover:bg-gray-200">Login</a>
            </li>
            <li><a href="{{ route('register') }}"
                    class="block px-2 py-4 text-sm text-gray-500 transition duration-300 hover:bg-gray-200">Register</a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="container px-4 mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center text-gray-800">Welcome to MyApp</h1>
        <p class="mt-4 text-center text-gray-600">Your favorite place to manage things</p>
    </div>

    <script>
        const btn = document.querySelector('button.mobile-menu-button');
        const menu = document.querySelector('.mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>
