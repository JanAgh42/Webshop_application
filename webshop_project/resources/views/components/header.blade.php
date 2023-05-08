@php
$numOfCartItems = session()->get('cartItemIds') !== null ? count(session()->get('cartItemIds')) : 0;
@endphp

<header class="sticky top-0 bg-white shadow-md z-10">
    <div class="relative flex items-center justify-between mx-auto max-w-7xl px-2 py-2 sm:py-0 sm:h-14 sm:px-6 lg:px-8">

        <!-- Mobile hamburger menu -->
        <div class="absolute top-1 right-0 flex items-center sm:hidden">

            <!-- Mobile menu button-->
            <button type="button" class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-[var(--color-button)] hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false" onclick="toggleHeaderDropdown('mobile-controls', 'mobile-login')">
                <span class="sr-only">Open main menu</span>

                <!-- Icon when menu is closed. Menu open: "hidden", Menu closed: "block -->
                <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>

                
            </button>
        </div>

        <!-- Main bar -->
        <div class="flex flex-1 flex-col sm:flex-row items-center justify-center sm:items-stretch sm:justify-start">

            <!-- Icon -->
            <div class="relative z-10 shrink-0">
                <a href="/">
                    <!-- <img class="block h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />-->

                    <img class="block h-8 w-auto" src="{{asset('images/eggplant.png')}}">
                    </a> 
            </div>

            <!-- Mobile search bar -->
            <form id="mobile-search-bar" class="hidden sm:hidden mt-2 w-full text-center" action="/catalog" method="GET">
                <input class="w-[60%] p-1 border text-sm rounded-l-lg focus:outline-none" type="text" placeholder="Vyhľadať..." name="search"/><button type="submit" class="rounded-r-lg colored-button p-1 px-2 text-white text-sm bg-[var(--color-button)]">
                    Hľadať
                </button>
            </form>

            <!-- Mobile profile dropdown & shopping cart -->
            <div id="mobile-controls" class="flex flex-col hidden sm:hidden mt-2 pt-1 w-full text-center mx-auto border-t">
                <a href="/cart" class="relative shrink-0 rounded-md px-3 py-2 text-sm font-medium" aria-current="page">
                    <span class="text-gray-600">Nákupný košík</span>
                    <span class="absolute inline-flex right-4 items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">9</span></a>
                <button type="button" class="flex justify-center gap-x-1.5 rounded-md w-full bg-white px-3 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true" onclick="toggleDropdown('mobile-login')">
                    <span class="lg:inline sm:hidden text-gray-600">Môj účet</span>
                    <svg class="-ml-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Mobile log in & register -->
            <div id="mobile-login" class="hidden sm:hidden mt-2 w-full text-center">
                <x-logindropdown />
            </div>

            <!-- Desktop menu: hidden on mobile -->
            <div class="hidden sm:ml-6 sm:block w-full">

                <!-- Navbar menu part -->
                <div class="flex flex-auto items-center sm:justify-end">

                    <!-- Search bar container -->
                    <form class="absolute flex justify-center align-center text-center w-full" action="/catalog" method="GET">
                        <input class="relative w-64 lg:w-full max-w-md margin h-9 px-3 text-base text-gray-700 placeholder-gray-600 border rounded-l-lg focus:outline-none focus:bg-gray-100" type="text" placeholder="Vyhľadať..." name="search"/>
                        <button type="submit" class="rounded-r-lg colored-button px-3 text-white bg-[var(--color-button)]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFFFFF" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </form>

                    <!-- Menu items -->
                    <div>

                        <!-- Profile dropdown -->
                        <div class="relative inline-block flex-shrink-0">
                            <button type="button" class="inline-flex w-full justify-start gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                <span class="lg:inline sm:hidden text-gray-600">Môj účet</span>
                                <span class="lg:hidden sm:inline text-gray-600">Účet</span>
                                <svg class="-ml-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div class="hide absolute right-0 z-10 w-56 origin-top-right rounded-md bg-white shadow-lg p-2 text-center" id="menu-dropdown" role="hidden" role="none">
                                <x-logindropdown />
                            </div>
                        </div>

                        <a href="/cart" class="relative z-10 shrink-0 rounded-md px-3 py-2 text-sm font-medium" aria-current="page">
                            <span class="lg:inline sm:hidden text-gray-600">Nákupný košík</span>
                            <span class="lg:hidden sm:inline text-gray-600">Košík</span>
                            <span class="absolute inline-flex -bottom-2 items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">{{ $numOfCartItems }}</span></a>
                    </div>
                </div>
            </div>

            <!-- Mobile menu: hidden on desktop -->
            <div class="sm:hidden absolute right-10 top-2" id="mobile-menu" onclick="toggleDropdown('mobile-search-bar')">
                <div class="space-y-1 p-2 hover:cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" class="bi bi-search h-4 w-4" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</header>