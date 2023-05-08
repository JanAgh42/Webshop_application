@extends('layouts.main-layout')

@php
$sum = 0;
@endphp

@section('content')
<main class="max-w-7xl m-auto mt-10 pb-72 pt-5 sm:px-5 text-gray-600">
    <nav class="primary-color p-4 rounded-t-md border border-[var(--color-light)">
        <ul class="flex justify-center items-center text-sm text-gray-600 font-semibold md:text-md">
            <li class="flex mx-5 md:mx-10">
                <a href="#" class="border-b-2 border-gray-600">Košík</a>
                <svg class="ml-2 mt-px h-5 w-5 rotate-[270deg]" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
            </li>
            <li class="hidden min-[500px]:flex min-[500px]:mx-5 md:mx-10">
                <a class="pointer-events-none">Doprava a platba</a>
                <svg class="ml-2 align-top h-5 w-5 text-gray-400 rotate-[270deg]" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
            </li>
            <li class="hidden min-[500px]:block min-[500px]:mx-5 md:mx-10">
                <a class="pointer-events-none">Dodacie údaje</a>
            </li>
        </ul>
    </nav>
    <div class="bg-white">
        <section class="w-11/12 min-[500px]:w-3/4 mx-20 flex flex-col py-4 md:py-10 mx-auto h-96 text-gray-500 font-medium text-base">
            @if($cartItems->count() == 0)
            <h1 class="text-lg md:text-xl text-center md:text-left md:ml-4 pb-4">Košík je prázdny</h1>
            @else
            <h1 class="text-lg md:text-xl text-center md:text-left md:ml-4 pb-4">Skontrolujte Váš nákup</h1>
            @endif
            <div class="px-1 min-[400px]:px-5 h-96 overflow-auto">
                @foreach($cartItems as $item)
                @php $sum = $sum + $item->price*$item->selectedQuantity; @endphp
                <article class="relative my-5 border-t-2 border-[(--color-leftright-button-hover)] border-solid">
                    <div class="flex flex-col md:flex-row">
                        <img class="object-cover object-center w-20 md:w-32 lg:w-40 h-20 md:h-32 lg:h-40 mr-5 bg-gray-200" src="{{ asset($item->image_url); }}" alt="placeholder">
                        <div>
                            <h4 class="md:pt-4 text-lg uppercase">{{ $item->name }}, <span class="text-sm lowercase">{{ $item->conf_name }}</span></h4>
                            <div>{{ $item->price*$item->selectedQuantity }} €</div>
                            
                            <form class="md:absolute md:bottom-0 mt-2 flex items-center" method="POST" action="/edit-cart-item">
                                @csrf
                                <div class="font-medium">
                                    Počet:
                                    <span class="rounded-l-md ml-5 px-3 text-white leftright-button select-none hover:cursor-pointer" onclick="decreaseAmount()">-</span><input type="number" name="itemNumber" value="{{ $item->selectedQuantity }}" class="w-10 text-center font-medium focus:outline-none" id="product-detail-amount" readonly><span class="rounded-r-lg px-3 text-white leftright-button select-none hover:cursor-pointer" onclick="increaseAmount('{{ $item->maxQuantity + $item->selectedQuantity }}')">+</span>
                                </div>
                                <input type="hidden" name="itemId" value="{{ $item->id }}"/>
                                <input type="submit" class="block rounded-md py-1 ml-5 px-5 font-semibold text-sm text-white colored-button bg-[var(--color-button)] hover:cursor-pointer" value="Uložiť">
                            </form>
                        </div>
                    </div>
                    <form method="POST" action="/delete-cart-item">
                        @csrf
                        <input type="hidden" name="itemId" value="{{ $item->id }}"/>
                        <button type="submit" class="absolute top-0 right-0"><span class="hover:cursor-pointer material-symbols-outlined border-b-2 border-x-2 border-[(--color-leftright-button-hover)] border-solid">delete</span></button>
                    </form>
                </article>
                @endforeach
            </div>
        </section>
    </div>
    <div class="w-11/12 min-[500px]:w-3/4 flex flex-col min-[600px]:flex-row items-center min-[600px]:justify-end mx-auto mt-2 min-[600px]:mt-10">
        <p class="mb-2 min-[600px]:mb-0 min-[600px]:mr-20 flex items-center font-bold text-gray-600">Celková cena: <span class="ml-2">{{ $sum }}</span>€</p>
        <form method="POST" action="/payment">
            @csrf
            <input type="hidden" name="price" value="{{ $sum }}">
            <input type="submit" class="hover:cursor-pointer colored-button bg-[var(--color-button)] rounded-md py-2 font-semibold px-10 text-sm text-white" value="Zvoliť spôsob dopravy">
        </form>
    </div>
</main>
@endsection
