<header class="sticky top-0 bg-white shadow-md z-5 z-50">
    <div class="relative flex items-center justify-between mx-auto max-w-7xl px-2 py-5 lg:py-0 lg:h-14 lg :px-6 lg:px-8"">

        <!-- Mobile hamburger menu -->
        <div class="absolute top-1 right-0 flex items-center lg:hidden">

            <!-- Mobile menu button-->
            <button type="button" onclick="toggleDropdown('mobile-controls')"
                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-blue-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                aria-controls="mobile-menu" aria-expanded="false">
                <span class="sr-only">Open main menu</span>

                <!-- Icon when menu is closed. Menu open: "hidden", Menu closed: "block -->
                <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>

                <!-- Icon when menu is open. Menu open: "block", Menu closed: "hidden" -->
                <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Main bar -->
        <div class="flex flex-1 flex-col lg:flex-row items-center justify-center sm:items-stretch lg:justify-start">

            <!-- Icon -->
            <div class="flex flex-shrink-0 items-center sm:justify-start">
                <p class="header-title block w-auto"
                    src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500">Admin
                    panel</p>
            </div>


            <!-- Mobile menu: hidden on desktop -->
            <div id="mobile-controls"
                class="flex flex-col mt-10 hidden lg:hidden mt-2 pt-1 w-full text-center mx-auto border-t">
                    <a href="/admin/product/add" class="text-gray-600 mt-2">Pridať produkt</a>
                    <a href="/admin/manage-products" class="text-gray-600 mt-3">Manažovať produktov</a>
                    <a href="/admin/orders" class="text-gray-600 mt-3">Objednávky</a>
                    <a href="/admin/add-parameters" class="text-gray-600 mt-3">Objednávky</a>
            
                    <a href="/admin/logout"
                    class=" bg-red-500 max-w-[2rem]rounded-md ring-black ring-1 mt-5 px-3 py-2 text-sm font-medium text-white"
                    aria-current="page">Odhlásiť sa
                </a>
                </button>
            </div>

            <!-- Desktop menu: hidden on mobile -->
            <div class="hidden lg:ml-6 lg:block w-full">

                <!-- Navbar menu part -->
                <div class="flex flex-auto items-center lg:justify-end">
                    <!-- Menu items -->
                    <div>
                        <a href="/admin/logout"
                            class=" bg-red-500 rounded-md ring-black ring-1 mt-5 px-3 py-2 text-sm font-medium text-white"
                            aria-current="page">Odhlásiť sa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>