<section class="relative overflow-hidden bg-[#eef1f5] py-16 md:py-24">
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -left-40 -top-40 h-[450px] w-[450px] rounded-full bg-white/80 blur-[110px]"></div>
    
        <div class="absolute -right-40 top-20 h-[420px] w-[420px] rounded-full bg-slate-200/70 blur-[100px]"></div>
    
        <div class="absolute bottom-[-200px] left-1/3 h-[450px] w-[450px] rounded-full bg-white/70 blur-[110px]"></div>
    
        <div class="absolute left-[8%] top-[45%] h-32 w-32 rotate-12 rounded-[45%_55%_60%_40%] border border-white/70 bg-white/20 shadow-[inset_8px_8px_30px_rgba(255,255,255,0.8)] backdrop-blur-2xl"></div>
    
        <div class="absolute right-[8%] bottom-[15%] h-40 w-40 -rotate-12 rounded-[60%_40%_45%_55%] border border-white/70 bg-white/20 shadow-[inset_-8px_-8px_30px_rgba(255,255,255,0.8)] backdrop-blur-2xl"></div>
    </div>
    <div class="relative mx-auto max-w-screen-xl px-4">
    
        <div class="mx-auto mb-12 max-w-2xl text-center md:mb-14">
    
            <span class="inline-flex items-center gap-2 rounded-full border border-white/90 bg-white/35 px-5 py-2 text-[10px] font-bold uppercase tracking-[0.3em] text-gray-500 shadow-[0_8px_30px_rgba(80,90,110,0.08)] backdrop-blur-2xl">
    
                <span class="h-1.5 w-1.5 rounded-full bg-gray-500 shadow-[0_0_10px_rgba(0,0,0,0.3)]"></span>
    
                Find Us
            </span>
    
            <h2 class="mt-6 text-4xl font-bold tracking-[-0.05em] text-gray-900 md:text-6xl">
                Our Location
            </h2>
    
            <p class="mx-auto mt-5 max-w-xl text-sm leading-7 text-gray-500 md:text-base">
                Visit our office or find us on the map below.
            </p>
    
        </div>
    
        <div class="relative mx-auto max-w-6xl">
    
            <div class="absolute -inset-2 rounded-[3rem] bg-white/40 blur-2xl"></div>
    
            <div class="relative rounded-[3rem] border border-white/90 bg-white/30 p-[1px] shadow-[0_35px_100px_-30px_rgba(50,60,80,0.3)] backdrop-blur-3xl">
    
                <div class="rounded-[3rem] border border-white/60 bg-white/20 p-2 shadow-[inset_0_1px_0_rgba(255,255,255,0.9)] backdrop-blur-3xl md:p-3">
    
                    <div class="relative h-[400px] overflow-hidden rounded-[2.5rem] border border-white/70 bg-white/20 shadow-[inset_0_2px_15px_rgba(255,255,255,0.5)] md:h-[500px]">
    
                        <div id="map" class="h-full w-full"></div>
    
                        <div class="pointer-events-none absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-white/30 to-transparent"></div>
    
                    </div>
    
                </div>
            </div>
    
        </div>
    
    </div>
    
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" async defer></script>
    
    <script>
        function initMap() {
            const location = {
                lat: 27.671132,
                lng: 84.435511
            };
    
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13,
                center: location,
                mapTypeControl: false,
                streetViewControl: false,
                fullscreenControl: false,
                zoomControl: true,
                gestureHandling: "cooperative"
            });
    
            new google.maps.Marker({
                position: location,
                map: map,
                title: "Cupstack, we are here!"
            });
        }
    </script>
    </section>
    