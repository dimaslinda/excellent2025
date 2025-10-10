{{-- navbar --}}
<nav class="bg-transparent top-0 fixed w-full z-20">
    <div
        class="flex flex-wrap justify-between items-center p-4 mx-auto max-w-screen-xl bg-bgnavbar backdrop-blur-md rounded-lg md:rounded-full border-2 border-navbar shadow-xl drop-shadow-xl md:px-8 md:mt-5">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('img/general/logo.webp') }}" class="h-8 xl:h-10" alt="logo ET" />
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            @if (!request()->routeIs('assessment'))
                <a href="/registrasi"
                    class="text-white font-poppins cursor-pointer capitalize bg-tombol hover:bg-tombol focus:ring-4 focus:outline-none focus:ring-navbar font-medium rounded-full text-sm px-9 py-2 text-center">
                    asesmen
                </a>
            @endif

            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-tombol rounded-lg md:hidden hover:bg-tombol focus:outline-none focus:ring-2 focus:ring-tombol"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul
                class="flex flex-col font-poppins text-base xl:text-xl capitalize p-4 md:p-0 mt-4 font-medium border border-navbar rounded-lg bg-cardhitam md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
                <li>
                    <a href="/"
                        class="block py-2 px-3 {{ route('beranda') == url()->current() ? 'md:text-tombol text-white bg-tombol' : 'md:text-cardhitam text-white' }} hover:bg-tombol hover:text-white md:hover:bg-transparent md:border-0 md:hover:text-tombol rounded-sm md:bg-transparent md:text-cardhitam capitalize"
                        aria-current="page">
                        beranda
                    </a>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                        class="flex items-center justify-between w-full font-poppins cursor-pointer px-3 py-2 capitalize rounded md:bg-transparent {{ route('inhouse') == url()->current() || route('modul') == url()->current() || route('webinar') == url()->current() || route('ecourse') == url()->current() || route('bootcamp') == url()->current() || route('eskul') == url()->current() ? 'md:text-tombol text-white bg-tombol' : 'text-white md:text-cardhitam' }}  hover:bg-tombol hover:text-white md:hover:bg-transparent md:border-0 md:hover:text-tombol">
                        Layanan Kami
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar"
                        class="z-10 hidden font-normal bg-white divide-y rounded-lg shadow divide-primary w-44">
                        <ul class="py-2 text-sm font-bold" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="/inhouse"
                                    class="block px-4 py-2 hover:bg-tombol hover:text-white {{ route('inhouse') == url()->current() ? 'text-white bg-tombol' : 'text-primary font-bold' }}">
                                    In House Training
                                </a>
                            </li>
                            <li>
                                <a href="/modul"
                                    class="block px-4 py-2 hover:bg-tombol hover:text-white {{ route('modul') == url()->current() ? 'text-white bg-tombol' : 'text-primary font-bold' }}">
                                    Modul Ajar
                                </a>
                            </li>
                            <li>
                                <a href="/webinar"
                                    class="block px-4 py-2 hover:bg-tombol hover:text-white {{ route('webinar') == url()->current() ? 'text-white bg-tombol' : 'text-primary font-bold' }}">
                                    Webinar
                                </a>
                            </li>
                            <li>
                                <a href="/ecourse"
                                    class="block px-4 py-2 hover:bg-tombol hover:text-white {{ route('ecourse') == url()->current() ? 'text-white bg-tombol' : 'text-primary font-bold' }}">
                                    e-course
                                </a>
                            </li>
                            <li>
                                <a href="/bootcamp"
                                    class="block px-4 py-2 hover:bg-tombol hover:text-white {{ route('bootcamp') == url()->current() ? 'text-white bg-tombol' : 'text-primary font-bold' }}">
                                    bootcamp
                                </a>
                            </li>
                            <li>
                                <a href="/eskul"
                                    class="block px-4 py-2 hover:bg-tombol hover:text-white {{ route('eskul') == url()->current() ? 'text-white bg-tombol' : 'text-primary font-bold' }}">
                                    ekskul
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="/galeri"
                        class="block py-2 px-3 {{ route('galeri') == url()->current() ? 'md:text-tombol text-white bg-tombol' : 'md:text-cardhitam text-white' }} hover:bg-tombol hover:text-white md:hover:bg-transparent md:border-0 md:hover:text-tombol rounded-sm md:bg-transparent md:text-cardhitam capitalize">
                        gallery
                    </a>
                </li>
                <li>
                    <a href="https://excellentteam.id/artikel/" target="_blank"
                        class="block py-2 px-3 text-white md:text-cardhitam capitalize rounded-sm hover:bg-tombol hover:text-white md:hover:bg-transparent md:hover:text-tombol">
                        artikel
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
{{-- end navbar --}}
