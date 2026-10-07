@extends('client.app')

@section('content')

@php
$faqs = [
[
'question' => 'How can I place an order?',
'answer' => 'Browse our collections, select your preferred piece, choose the available options, and complete your purchase securely through checkout.',
],
[
'question' => 'What payment methods do you accept?',
'answer' => 'We accept the secure payment methods available at checkout. Your payment details are processed through trusted payment providers.',
],
[
'question' => 'How long does delivery take?',
'answer' => 'Delivery times vary depending on your location and product availability. Estimated delivery information is provided during checkout.',
],
[
'question' => 'Can I return or exchange my order?',
'answer' => 'Eligible products can be returned or exchanged according to our return and exchange policy. Please contact us if you need assistance.',
],
[
'question' => 'How can I track my order?',
'answer' => 'Once your order has been dispatched, you will receive the relevant tracking information so you can follow its journey.',
],
[
'question' => 'Do you offer international delivery?',
'answer' => 'International delivery may be available for selected destinations. Please contact our team before placing an international order.',
],
[
'question' => 'How can I contact customer support?',
'answer' => 'Our team is happy to help. Visit our contact page and send us your question, and we will get back to you as soon as possible.',
],
];
@endphp

<section class="overflow-hidden bg-[#f7f6f2] text-gray-950">
<div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8 lg:py-6">

    {{-- Hero --}}
    <div class="grid overflow-hidden rounded-[2rem] bg-[#ebe9e3] lg:grid-cols-2">

        {{-- Hero Content --}}
        <div class="flex flex-col justify-center px-7 py-16 sm:px-12 lg:px-16 lg:py-20">

            <div class="mb-8 flex items-center gap-3">

                <span class="h-px w-8 bg-gray-400"></span>

                <span class="text-[10px] font-medium uppercase tracking-[0.3em] text-gray-500">
                    Customer Care
                </span>

            </div>

            <h1 class="max-w-xl text-5xl font-medium leading-[0.92] tracking-[-0.055em] sm:text-6xl lg:text-7xl">
                How can we
                <br>
                <span class="font-serif font-normal italic text-gray-500">
                    help?
                </span>
            </h1>

            <p class="mt-7 max-w-md text-sm leading-7 text-gray-500 sm:text-base">
                Find quick answers about orders, payments, delivery,
                returns and everything in between.
            </p>

            <a
                href="{{ route('contact-us') }}"
                class="group mt-9 flex w-fit items-center gap-4 rounded-full bg-gray-950 py-2 pl-6 pr-2 text-sm font-medium text-white transition duration-300 hover:bg-gray-800"
            >

                <span>
                    Contact us
                </span>

                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-white text-gray-950 transition duration-300 group-hover:translate-x-1">

                    <svg
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                    >
                        <path d="M5 12h14"/>
                        <path d="m13 6 6 6-6 6"/>
                    </svg>

                </span>

            </a>

        </div>

        {{-- Hero Image --}}
        <div class="relative min-h-[360px] overflow-hidden sm:min-h-[430px] lg:min-h-[560px]">

            <img
                src="{{ asset('build/contact-ring.jpg') }}"
                alt="Jewelry collection"
                class="absolute inset-0 h-full w-full object-cover"
            >

            <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent"></div>

            {{-- Image Badge --}}
            <div class="absolute right-5 top-5 sm:right-7 sm:top-7">

                <div class="flex items-center gap-2 rounded-full border border-white/40 bg-white/20 px-4 py-2.5 backdrop-blur-xl">

                    <span class="h-1.5 w-1.5 rounded-full bg-white"></span>

                    <span class="text-[9px] font-medium uppercase tracking-[0.3em] text-white">
                        FAQ
                    </span>

                </div>

            </div>

            {{-- Image Bottom Info --}}
            <div class="absolute bottom-5 left-5 right-5 sm:bottom-7 sm:left-7 sm:right-7">

                <div class="flex items-center justify-between gap-5 rounded-2xl border border-white/30 bg-black/20 px-5 py-4 backdrop-blur-xl">

                    <div>

                        <p class="text-[9px] font-medium uppercase tracking-[0.25em] text-white/60">
                            Customer Care
                        </p>

                        <p class="mt-1 text-sm font-medium text-white">
                            We're here when you need us.
                        </p>

                    </div>

                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white text-gray-950">

                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path d="M7 8h10"/>
                            <path d="M7 12h7"/>
                            <path d="M7 16h5"/>
                        </svg>

                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- FAQ Section --}}
    <div
        id="faq-list"
        class="mx-auto max-w-4xl py-20 sm:py-28"
    >

        {{-- FAQ Header --}}
        <div class="mb-12 flex items-end justify-between gap-6">

            <div>

                <div class="flex items-center gap-3">

                    <span class="h-px w-7 bg-gray-400"></span>

                    <p class="text-[10px] font-medium uppercase tracking-[0.3em] text-gray-400">
                        Frequently asked
                    </p>

                </div>

                <h2 class="mt-4 text-3xl font-medium tracking-[-0.04em] sm:text-4xl">
                    Find your answer.
                </h2>

            </div>

            <button
                id="close-all"
                type="button"
                class="hidden rounded-full border border-gray-300 px-4 py-2 text-[10px] font-medium uppercase tracking-[0.2em] text-gray-500 transition duration-300 hover:border-gray-950 hover:bg-gray-950 hover:text-white sm:block"
            >
                Close all
            </button>

        </div>


        {{-- FAQ List --}}
        <div class="border-t border-gray-300">

            @foreach ($faqs as $index => $faq)

                <div
                    class="faq-item border-b border-gray-300"
                    data-index="{{ $index }}"
                >

                    <button
                        type="button"
                        class="faq-button flex w-full items-center gap-4 py-6 text-left sm:py-7"
                        aria-expanded="false"
                        aria-controls="faq-{{ $index }}"
                    >

                        {{-- Number --}}
                        <span class="faq-number w-7 shrink-0 text-[10px] font-medium tracking-[0.2em] text-gray-400 transition duration-300">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        {{-- Question --}}
                        <span class="faq-question flex-1 text-base font-medium tracking-tight text-gray-800 transition duration-300 sm:text-lg">
                            {{ $faq['question'] }}
                        </span>

                        {{-- Icon --}}
                        <span class="faq-icon flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-gray-300 text-gray-700 transition-all duration-300">

                            <svg
                                class="h-4 w-4 transition-transform duration-300"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.7"
                            >
                                <path d="M12 5v14"/>
                                <path d="M5 12h14"/>
                            </svg>

                        </span>

                    </button>


                    {{-- Answer --}}
                    <div
                        id="faq-{{ $index }}"
                        class="faq-answer grid grid-rows-[0fr] opacity-0 transition-all duration-300 ease-out"
                    >

                        <div class="overflow-hidden">

                            <div class="pb-7 pl-11 pr-10 sm:pl-12 sm:pr-14">

                                <p class="max-w-2xl text-sm leading-7 text-gray-500">
                                    {{ $faq['answer'] }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach
        </div>
    </div>
</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const faqList = document.getElementById('faq-list');

    if (!faqList) return;

    const items = [...faqList.querySelectorAll('.faq-item')];
    const closeButton = document.getElementById('close-all');

    let activeIndex = null;


    const setState = (item, open) => {

        const button = item.querySelector('.faq-button');
        const answer = item.querySelector('.faq-answer');
        const number = item.querySelector('.faq-number');
        const question = item.querySelector('.faq-question');
        const icon = item.querySelector('.faq-icon');
        const svg = icon.querySelector('svg');

        button.setAttribute('aria-expanded', String(open));

        answer.classList.toggle('grid-rows-[1fr]', open);
        answer.classList.toggle('grid-rows-[0fr]', !open);

        answer.classList.toggle('opacity-100', open);
        answer.classList.toggle('opacity-0', !open);

        number.classList.toggle('text-gray-950', open);
        number.classList.toggle('text-gray-400', !open);

        question.classList.toggle('text-gray-950', open);
        question.classList.toggle('text-gray-800', !open);

        icon.classList.toggle('border-gray-950', open);
        icon.classList.toggle('border-gray-300', !open);

        icon.classList.toggle('bg-gray-950', open);
        icon.classList.toggle('text-white', open);
        icon.classList.toggle('text-gray-700', !open);

        svg.classList.toggle('rotate-45', open);
    };


    const closeAll = () => {

        items.forEach(item => setState(item, false));

        activeIndex = null;

        closeButton?.classList.add('hidden');
    };


    const openFaq = index => {

        items.forEach((item, itemIndex) => {
            setState(item, itemIndex === index);
        });

        activeIndex = index;

        closeButton?.classList.remove('hidden');
    };


    items.forEach((item, index) => {

        const button = item.querySelector('.faq-button');

        button.addEventListener('click', () => {

            if (activeIndex === index) {
                closeAll();
                return;
            }

            openFaq(index);
        });

    });


    closeButton?.addEventListener('click', closeAll);

});
</script>

@endsection
