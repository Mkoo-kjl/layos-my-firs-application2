<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $heading ?? 'My Site' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="animated-gradient min-h-screen flex flex-col font-sans text-gray-800 overflow-x-hidden">

    <!-- Navbar -->
    <header class="glass-nav shadow-xl sticky top-0 z-50 transition duration-300 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo / Brand -->
                <div class="flex-shrink-0">
                    <a href="/" class="text-2xl font-extrabold text-white tracking-tight hover:text-yellow-300 transition duration-300 ease-in-out transform hover:scale-105">
                        🌟DreamPath
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="hidden md:flex space-x-6">
                    <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                    <x-nav-link href="/jobs" :active="request()->is('jobs')">Jobs</x-nav-link>
                </nav>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button type="button" class="text-white hover:text-yellow-300 focus:outline-none transition duration-300" id="menu-toggle">
                        <!-- Heroicon: Menu -->
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <nav class="md:hidden hidden px-4 pb-4 space-y-2 glass-mobile rounded-b-lg shadow-lg" id="mobile-menu">
            <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link href="/jobs" :active="request()->is('jobs')">Jobs</x-nav-link>
        </nav>
    </header>


    <!-- Main Content -->
    <main class="flex-grow relative z-10">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="glass-main-card group">
                <h1 class="text-4xl font-extrabold text-white mb-6 flex items-center gap-3 drop-shadow-lg">
                    <span class="inline-block w-2 h-10 bg-gradient-to-b from-yellow-400 to-orange-500 rounded-full shadow-lg animate-pulse"></span>
                    {{ $heading }}
                </h1>
                <div class="text-gray-700 leading-relaxed animate-fadeIn">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
   <footer class="glass-footer relative z-10 py-8 mt-8 border-t border-white/20">
        <div class="max-w-7xl mx-auto text-center">
            <div class="text-white/90 mb-4">
                © 2024 My Site. All rights reserved. | Built with ❤️ using Laravel & TailwindCSS
            </div>
            <div class="flex justify-center space-x-6 text-purple-200">
                <a href="#" class="hover:text-yellow-300 transition duration-300 transform hover:scale-110">Privacy</a>
                <a href="#" class="hover:text-yellow-300 transition duration-300 transform hover:scale-110">Terms</a>
                <a href="#" class="hover:text-yellow-300 transition duration-300 transform hover:scale-110">Contact</a>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Toggle Script -->
    <script>
        const btn = document.getElementById('menu-toggle');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            menu.classList.toggle('animate-slideDown');
        });
    </script>

    <!-- Extra Animations -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animated-gradient {
            background: linear-gradient(-45deg, #1e1b4b, #312e81, #5b21b6, #7c3aed, #a855f7, #c084fc);
            background-size: 400% 400%;
            animation: gradientBG 20s ease infinite;
        }

        .glass-nav {
            background: rgba(99, 102, 241, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glass-mobile {
            background: rgba(67, 56, 202, 0.2);
            backdrop-filter: blur(10px);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            padding: 2rem;
            transition: all 0.3s ease;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px 0 rgba(31, 38, 135, 0.5);
            background: rgba(255, 255, 255, 0.15);
        }

        .glass-main-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            padding: 3rem;
            transition: all 0.5s ease;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .glass-main-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.4);
            background: rgba(255, 255, 255, 0.15);
        }

        .glass-footer {
            background: rgba(15, 23, 42, 0.3);
            backdrop-filter: blur(10px);
        }

        .nav-link-glass {
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
            border: 1px solid transparent;
        }

        .nav-link-glass:hover {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            color: #fde047;
        }

        .nav-link-mobile {
            display: block;
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .nav-link-mobile:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
            color: #fde047;
        }
        .animate-fadeIn {
            animation: fadeIn 0.8s ease-in-out;
        }
        
        .animate-slideDown {
            animation: slideDown 0.3s ease-in-out;
        }

        /* Scroll animations */
        @keyframes slideInFromLeft {
            0% { opacity: 0; transform: translateX(-50px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        .glass-card:nth-child(1) { animation: slideInFromLeft 0.6s ease-out 0.1s both; }
        .glass-card:nth-child(2) { animation: slideInFromLeft 0.6s ease-out 0.3s both; }
        .glass-card:nth-child(3) { animation: slideInFromLeft 0.6s ease-out 0.5s both; }
    </style>

</body>
</html>