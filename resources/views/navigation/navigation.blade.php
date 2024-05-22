<nav class='flex items-center px-4 pt-6 mx-auto max-w-7xl sm:px-6 lg:px-8'>
    <div class='flex justify-between items-center w-full'>

        <!-- Logo -->
        <div class='flex items-center'>

            <!-- Large logo -->
            <a href="/" class='hidden text-2xl font-black md:hidden xs:hidden lg:block group'>
                <span class="text-white transition duration-200 ease-in-out group-hover:text-dark-300"><span class='transition duration-200 ease-in-out text-dark-300 group-hover:text-white -ml-4'></span></span>

{{--                <span class='text-white transition duration-200 ease-in-out group-hover:text-dark-300'> . $end }}</span>--}}
{{--                <span class='transition duration-200 ease-in-out text-dark-300 group-hover:text-white'> @🧙</span>--}}
            </a>

            <!-- Small logo for mobile screens -->
            <a href="/" class='block text-3xl font-black md:block sm:block lg:hidden group'>
                <span class='text-white transition duration-200 ease-in-out group-hover:text-dark-300'></span>
                <span class='transition duration-200 ease-in-out text-dark-300 group-hover:text-white'></span>
            </a>
        </div>

        <!-- Main menu for large screens -->
        <div class='hidden md:flex justify-between items-center md:space-x-0.5 lg:space-x-2 text-xl md:text-base font-medium text-dark-300'>
            <a href="/" class="block py-1 px-4 rounded-full transition duration-200 ease-in-out sm:inline-block hover:text-white hover:bg-dark-700">
                Home
            </a>
            <a href="services" class="block py-1 px-4 rounded-full transition duration-200 ease-in-out sm:inline-block hover:text-white hover:bg-dark-700">
                Services
            </a>
            <a href="about" class="block py-1 px-4 rounded-full transition duration-200 ease-in-out sm:inline-block hover:text-white hover:bg-dark-700">
                About
            </a>
            <a href="case-study" class="block py-1 px-4 rounded-full transition duration-200 ease-in-out sm:inline-block hover:text-white hover:bg-dark-700">
                Case Study
            </a>
        </div>

        <div class='hidden md:block'>
            <!-- Authentication -->
            @auth
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf

                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        this.closest('form').submit(); "
                       class="flex justify-center items-center py-3 px-8 w-auto text-base font-semibold leading-snug bg-white rounded-full transition ease-in-out duration-250 text-dark-900 hover:text-white focus:outline-none hover:bg-dark-800" href="contact">
                        {{ __('Log Out') }}
                    </a>
            </form>
            @elseguest
                <a href="{{ route('login') }}"
                   class="flex justify-center items-center py-3 px-8 w-auto text-base font-semibold leading-snug bg-white rounded-full transition ease-in-out duration-250 text-dark-900 hover:text-white focus:outline-none hover:bg-dark-800" href="contact">
                    {{ __('Log In') }}
                </a>
            @endauth


        </div>

        <!-- Mobile menu container -->
        <div class='block md:hidden' x-data="{ open: false }">

            <!-- Hamburger menu button -->
            <!--
              Toggle "js-hamburger-open" class based on menu state
            -->
            <button class='relative z-50 w-6 h-5 transition duration-500 ease-in-out transform rotate-0 cursor-pointer group focus:outline-none' :class="{ 'js-hamburger-open': open }" @click="open = !open">
                <span class='block absolute top-0 left-0 w-full h-1 rounded-full opacity-100 transition duration-200 ease-in-out transform rotate-0 bg-dark-300 group-hover:bg-white'></span>
                <span class='block absolute left-0 top-2 w-full h-1 rounded-full opacity-100 transition duration-200 ease-in-out transform rotate-0 bg-dark-300 group-hover:bg-white'></span>
                <span class='block absolute left-0 top-2 w-full h-1 rounded-full opacity-100 transition duration-200 ease-in-out transform rotate-0 bg-dark-300 group-hover:bg-white'></span>
                <span class='block absolute left-0 top-4 w-full h-1 rounded-full opacity-100 transition duration-200 ease-in-out transform rotate-0 bg-dark-300 group-hover:bg-white'></span>
            </button>

            <!-- Mobile menu -->
            <!--
              Toggle "js-mobileNav-open" class based on menu state
            -->
            <div class='hidden absolute top-0 left-0 z-40 justify-center items-center w-screen h-screen bg-gradient-to-tr from-dark-800 to-dark-900' :class="{ 'js-mobileNav-open': open }" @keydown.escape.window="open = false">
                <div class='flex flex-col justify-evenly items-center p-4 mx-auto space-y-8 w-full text-xl'>
                    <a href="/" class="block py-2 px-6 font-medium rounded-full transition duration-200 ease-in-out text-dark-300 hover:text-white hover:bg-dark-700 sm:inline-block">
                        Home
                    </a>
                    <a href="services" class="block py-2 px-6 font-medium rounded-full transition duration-200 ease-in-out text-dark-300 hover:text-white hover:bg-dark-700 sm:inline-block">
                        Services
                    </a>
                    <a href="about" class="block py-2 px-6 font-medium rounded-full transition duration-200 ease-in-out text-dark-300 hover:text-white hover:bg-dark-700 sm:inline-block">
                        About
                    </a>
                    <a href="about" class="block py-2 px-6 font-medium rounded-full transition duration-200 ease-in-out text-dark-300 hover:text-white hover:bg-dark-700 sm:inline-block">
                        Case Study
                    </a>
                    <a href="pricing" class="block py-2 px-6 font-medium rounded-full transition duration-200 ease-in-out text-dark-300 hover:text-white hover:bg-dark-700 sm:inline-block">
                        Pricing
                        <a class="flex justify-center items-center py-4 px-8 w-auto text-lg font-semibold leading-snug bg-white rounded-full transition ease-in-out duration-250 text-dark-900 hover:text-white focus:outline-none hover:bg-dark-700" href="contact">
                            Let's talk 2
                        </a>
                </div>
            </div>
        </div>
    </div>
</nav>
