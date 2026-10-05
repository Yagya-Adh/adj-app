<footer class="overflow-hidden bg-footer-bg">
    <div class="mx-auto max-w-screen-xl px-4 py-10 md:py-16">
        <div class="overflow-hidden border border-gray-200 bg-white shadow-sm">
            <div class="flex flex-col lg:flex-row">
                <div class="flex flex-1 flex-col items-center justify-center bg-white px-6 py-10 text-center lg:items-start lg:px-10 lg:text-left">
                    <a href="{{ route('home') }}"
                        aria-label="Home"
                        class="group mb-5 flex items-center">

                        <div class="rounded-2xl border border-gray-200 bg-white p-3 shadow-sm transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-md">

                            <x-application-logo class="block h-10 w-auto fill-current" />

                        </div>
                    </a>
                    <p class="text-xl font-semibold tracking-tight text-gray-800">
                        Get In Touch
                    </p>
                </div>
                <div class="flex flex-1 flex-col justify-center bg-footblack px-6 py-8 text-center text-white lg:border-l lg:border-white/10 lg:px-8 lg:text-left">

                    <p class="mb-2 text-xs font-semibold uppercase tracking-[0.2em] text-white/60">
                        Mail Us
                    </p>

                    <a href="mailto:Ankitdhakal242@gmail.com"
                        class="text-base font-medium text-white transition-colors duration-300 hover:text-white/70 md:text-lg">
                        Ankitdhakal242@gmail.com
                    </a>

                </div>
                <div class="flex flex-1 flex-col justify-center border-t border-white/10 bg-footblack px-6 py-8 text-center text-white lg:border-l lg:border-t-0 lg:px-8 lg:text-left">

                    <p class="mb-2 text-xs font-semibold uppercase tracking-[0.2em] text-white/60">
                        Call Us
                    </p>

                    <a href="tel:+9779845367242"
                        class="text-base font-medium text-white transition-colors duration-300 hover:text-white/70 md:text-lg">
                        +977 984-5367242
                    </a>

                </div>
                <div class="flex flex-1 flex-col justify-center border-t border-white/10 bg-footblack px-6 py-8 text-center text-white lg:border-l lg:border-t-0 lg:px-8 lg:text-left">

                    <p class="mb-2 text-xs font-semibold uppercase tracking-[0.2em] text-white/60">
                        Address
                    </p>

                    <p class="text-base font-medium text-white md:text-lg">
                        Bharatpur, Chitwan, Nepal
                    </p>

                </div>
            </div>
            <div class="border-t border-white/10 bg-footblack px-6 py-8 text-white md:px-10">

                <div class="flex flex-col items-center justify-between gap-6 md:flex-row">

                    <p class="text-center text-xs font-medium tracking-wide text-white/60 md:text-left md:text-sm">
                        ©
                        <span x-data="{ year: new Date().getFullYear() }" x-text="year"></span>
                        <span class="font-semibold text-white">Jewelleryz</span>.
                        All rights reserved.
                    </p>
                    <div class="flex flex-col items-center gap-4 sm:flex-row">

                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/60">
                            Follow Us
                        </p>

                        <div class="flex items-center gap-3">

                            <a href="https://www.facebook.com"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Facebook"
                                class="group flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/10 text-white transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:text-footblack">

                                <i class="fa-brands fa-facebook-f text-base transition-transform duration-300 group-hover:scale-110"></i>

                            </a>

                            <a href="https://www.instagram.com"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Instagram"
                                class="group flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/10 text-white transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:text-footblack">

                                <i class="fa-brands fa-instagram text-base transition-transform duration-300 group-hover:scale-110"></i>

                            </a>

                            <a href="https://twitter.com"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Twitter"
                                class="group flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/10 text-white transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:text-footblack">

                                <i class="fa-brands fa-x-twitter text-base transition-transform duration-300 group-hover:scale-110"></i>

                            </a>

                            <a href="https://www.pinterest.com"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Pinterest"
                                class="group flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/10 text-white transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:text-footblack">

                                <i class="fa-brands fa-pinterest-p text-base transition-transform duration-300 group-hover:scale-110"></i>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
