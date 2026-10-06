<section class="bg-[#f8f7f4] px-4 py-20 md:py-28">
    <div class="mx-auto max-w-[1240px]">

        <div class="mx-auto mb-14 max-w-2xl text-center md:mb-20 animate-fade-in-up">
            <span class="mb-4 block text-[11px] font-medium uppercase tracking-[0.3em] text-gray-500">
                Contact Us
            </span>

            <h2 class="font-serif text-4xl font-medium tracking-tight text-gray-900 md:text-5xl lg:text-6xl">
                Get In Touch Today
            </h2>

            <p class="mx-auto mt-5 max-w-xl text-sm leading-7 text-gray-500 md:text-base">
                Have a question about our collections or need assistance?
                We would love to hear from you. Send us a message and our
                team will get back to you shortly.
            </p>
        </div>

        <div class="grid overflow-hidden rounded-[2rem] border border-black/10 bg-white shadow-[0_20px_70px_rgba(0,0,0,0.06)] lg:grid-cols-2">
            <div class="p-7 sm:p-10 md:p-14 lg:p-16">
                <div class="mb-10">
                    <span class="text-[10px] font-medium uppercase tracking-[0.25em] text-gray-400">
                        Send a Message
                    </span>

                    <h3 class="mt-3 font-serif text-3xl text-gray-900">
                        We'd love to hear from you
                    </h3>
                </div>

                <form action="{{route('contact.store')}}" method="POST" class="space-y-7">
                    @csrf

                    <div class="grid gap-7 sm:grid-cols-2">

                        <div class="group">
                            <label
                                for="name"
                                class="mb-2 block text-[11px] font-medium uppercase tracking-[0.15em] text-gray-500"
                            >
                                Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="John Doe"
                                class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-black focus:ring-0"
                            >
                        </div>

                        <div class="group">
                            <label
                                for="email"
                                class="mb-2 block text-[11px] font-medium uppercase tracking-[0.15em] text-gray-500"
                            >
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="example@email.com"
                                required
                                class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-black focus:ring-0"
                            >
                        </div>

                        <div class="group">
                            <label
                                for="phone"
                                class="mb-2 block text-[11px] font-medium uppercase tracking-[0.15em] text-gray-500"
                            >
                                Phone
                            </label>

                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="+977 98XXXXXXXX"
                                class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-black focus:ring-0"
                            >
                        </div>

                        <div class="group">
                            <label
                                for="subject"
                                class="mb-2 block text-[11px] font-medium uppercase tracking-[0.15em] text-gray-500"
                            >
                                Subject
                            </label>

                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                value="{{ old('subject') }}"
                                placeholder="How can we help?"
                                required
                                class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-black focus:ring-0"
                            >
                        </div>
                    </div>

                    <div class="group">
                        <label
                            for="message"
                            class="mb-2 block text-[11px] font-medium uppercase tracking-[0.15em] text-gray-500"
                        >
                            Your Message
                        </label>

                        <textarea
                            id="message"
                            name="message"
                            rows="5"
                            maxlength="5000"
                            placeholder="Tell us how we can assist you..."
                            required
                            class="w-full resize-none border-0 border-b border-gray-200 bg-transparent px-0 py-3 text-sm leading-7 text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-black focus:ring-0"
                        >{{ old('message') }}</textarea>
                    </div>

                    <div class="pt-3">
                        <button
                            type="submit"
                            class="group relative inline-flex items-center gap-5 overflow-hidden rounded-full bg-black px-7 py-4 text-xs font-medium uppercase tracking-[0.18em] text-white transition-all duration-500 hover:px-9"
                        >
                            <span class="relative z-10">
                                Send Message
                            </span>

                            <span class="relative z-10 text-base transition-transform duration-500 group-hover:translate-x-1">
                                →
                            </span>

                            <span class="absolute inset-0 -translate-x-full bg-gray-800 transition-transform duration-500 group-hover:translate-x-0"></span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="relative min-h-[520px] overflow-hidden lg:min-h-full">

                <img
                    src="{{ asset('build/contact-form.avif') }}"
                    alt="Contact us"
                    class="absolute inset-0 h-full w-full object-cover transition-transform duration-[1200ms] hover:scale-105"
                >

                <div class="absolute inset-0 bg-black/35"></div>

                <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/10 to-transparent"></div>

                <div class="absolute inset-x-0 bottom-0 p-8 sm:p-10 md:p-14">

                    <span class="text-[10px] font-medium uppercase tracking-[0.3em] text-white/60">
                        We're Here For You
                    </span>

                    <h3 class="mt-4 max-w-md font-serif text-3xl leading-tight text-white md:text-4xl">
                        Let’s create something beautiful together.
                    </h3>

                    <p class="mt-5 max-w-md text-sm leading-7 text-white/70">
                        Whether you have a question, need styling advice,
                        or simply want to learn more about our collection,
                        our team is always happy to assist.
                    </p>

                    <div class="mt-8 flex items-center gap-4">
                        <span class="h-px w-10 bg-white/50"></span>

                        <span class="text-[10px] uppercase tracking-[0.25em] text-white/60">
                            Premium Jewellery
                        </span>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>