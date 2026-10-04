<footer class="relative overflow-hidden bg-[#eef1f5]">
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -left-32 -bottom-40 h-[420px] w-[420px] rounded-full bg-white/80 blur-[100px]"></div>
    
        <div class="absolute -right-32 -top-40 h-[400px] w-[400px] rounded-full bg-slate-200/70 blur-[100px]"></div>
    
        <div class="absolute left-1/2 top-1/2 h-72 w-72 -translate-x-1/2 -translate-y-1/2 rounded-full bg-white/50 blur-[90px]"></div>
    
        <div class="absolute left-[5%] top-[20%] h-32 w-32 rotate-12 rounded-[40%_60%_55%_45%] border border-white/70 bg-white/20 shadow-[inset_8px_8px_30px_rgba(255,255,255,0.7)] backdrop-blur-xl"></div>
    
        <div class="absolute right-[7%] bottom-[10%] h-40 w-40 -rotate-12 rounded-[65%_35%_45%_55%] border border-white/70 bg-white/20 shadow-[inset_-8px_-8px_30px_rgba(255,255,255,0.7)] backdrop-blur-xl"></div>
    </div>
    
    <div class="relative mx-auto max-w-screen-xl px-4 py-10 md:py-16">
    
        <div class="relative overflow-hidden rounded-[2.5rem] border border-white/90 bg-white/30 p-[1px] shadow-[0_25px_80px_-30px_rgba(50,60,80,0.25)] backdrop-blur-3xl">
    
            <div class="rounded-[2.5rem] border border-white/60 bg-white/20 px-6 py-8 shadow-[inset_0_1px_0_rgba(255,255,255,0.9),inset_0_-20px_50px_rgba(255,255,255,0.12)] backdrop-blur-3xl md:px-10 md:py-10">
    
                <div class="flex flex-col items-center gap-8 text-center md:flex-row md:justify-between md:text-left">
    
                    <div class="flex items-center justify-center md:justify-start">
                        <a href="{{ route('home') }}"
                            aria-label="Home"
                            class="group flex items-center">
    
                            <div class="rounded-2xl border border-white/80 bg-white/35 p-3 shadow-[inset_2px_2px_10px_rgba(255,255,255,0.8),0_8px_25px_rgba(80,90,110,0.08)] backdrop-blur-xl transition-all duration-300 group-hover:-translate-y-1 group-hover:bg-white/50">
    
                                <x-application-logo class="block h-9 w-auto fill-current" />
    
                            </div>
                        </a>
                    </div>
    
                    <div class="flex items-center justify-center gap-3">
    
                        <a href="https://www.twitter.com"
                            target="_blank"
                            aria-label="Twitter"
                            class="group flex h-12 w-12 items-center justify-center rounded-2xl border border-white/80 bg-white/30 text-gray-600 shadow-[inset_2px_2px_8px_rgba(255,255,255,0.7),0_8px_25px_rgba(80,90,110,0.06)] backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:bg-white/55 hover:text-gray-900">
    
                            <i class="fa-brands fa-x-twitter text-lg transition-transform duration-300 group-hover:scale-110"></i>
    
                        </a>
    
                        <a href="https://www.linkedin.com"
                            target="_blank"
                            aria-label="LinkedIn"
                            class="group flex h-12 w-12 items-center justify-center rounded-2xl border border-white/80 bg-white/30 text-gray-600 shadow-[inset_2px_2px_8px_rgba(255,255,255,0.7),0_8px_25px_rgba(80,90,110,0.06)] backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:bg-white/55 hover:text-gray-900">
    
                            <i class="fa-brands fa-linkedin text-lg transition-transform duration-300 group-hover:scale-110"></i>
    
                        </a>
    
                        <a href="https://www.github.com"
                            target="_blank"
                            aria-label="GitHub"
                            class="group flex h-12 w-12 items-center justify-center rounded-2xl border border-white/80 bg-white/30 text-gray-600 shadow-[inset_2px_2px_8px_rgba(255,255,255,0.7),0_8px_25px_rgba(80,90,110,0.06)] backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:bg-white/55 hover:text-gray-900">
    
                            <i class="fa-brands fa-github text-lg transition-transform duration-300 group-hover:scale-110"></i>
    
                        </a>
    
                    </div>
    
                    <div class="flex items-center justify-center md:justify-end">
    
                        <p x-data="{ year: new Date().getFullYear() }"
                            class="text-xs font-medium tracking-wide text-gray-500 md:text-sm">
    
                            © <span x-text="year"></span>
                            <span class="font-semibold text-gray-700">Cupstack</span>.
                            All rights reserved.
    
                        </p>
    
                    </div>
    
                </div>
    
            </div>
        </div>
    
        <div class="mx-auto mt-4 h-px w-1/3 bg-gradient-to-r from-transparent via-white to-transparent opacity-80"></div>
    
    </div>
    </footer>
    