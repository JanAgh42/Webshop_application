@extends('layouts.main-layout')

@section('content')
<main class="max-w-7xl m-auto mt-10 pb-72 pt-5 sm:px-5 text-gray-500">
    <nav class="primary-color p-4 rounded-t-md border border-[var(--color-light)">
        <ul class="flex justify-center items-center text-sm text-gray-600 font-semibold md:text-md">
            <li class="hidden min-[500px]:flex min-[500px]:mx-5 md:mx-10">
                <a href="/cart" class="font-bold text-[var(--color-button)]">Košík</a>
                <svg class="align-top ml-2 h-5 w-5 border border-gray-500 rounded-full border-2" viewBox="0 0 20 20">
                    <path fill="#6b7280" fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
            </li>
            <li class="flex mx-5 md:mx-10">
                <a href="#" class="border-b-2 border-gray-500">Doprava a platba</a>
                <svg class="ml-2 mt-px h-5 w-5 rotate-[270deg]" viewBox="0 0 20 20">
                    <path fill="#6b7280" fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
            </li>
            <li class="hidden min-[500px]:block min-[500px]:mx-5 md:mx-10">
                <a class="pointer-events-none">Dodacie údaje</a>
            </li>
        </ul>
    </nav>
    <form method="POST" action="/payment-delivery">
    @csrf
        <div class="bg-white py-5 min-[900px]:py-10">
            <div class="w-11/12 min-[900px]:w-3/4 flex flex-col md:flex-row justify-center items-center mx-auto">
                <fieldset class="w-full relative flex justify-start md:justify-center md:border-r-2 min-[950px]:border-2 border-[(--color-leftright-button-hover)] border-solid mx-2">
                    <legend class="md:absolute min-[900px]:-mt-5 font-semibold text-md min-[900px]:text-xl bg-white py-2 md:px-4">Výber dopravy</legend>
                    <div class="flex flex-col pb-4 md:p-10 text-sm md:text-md">
                        <div class="flex items-center mb-2 md:mb-6">
                            @if($orderData && ($orderData->delivery_type == 'delivery' || $orderData->delivery_type == 'post'))
                            <input type="radio" name="shipment" id="pickup" value="pickup" class="h-5 w-5">
                            @else
                            <input type="radio" name="shipment" id="pickup" value="pickup" class="h-5 w-5" checked>
                            @endif
                            <label for="pickup" class="ml-2">Osobný odber</label>
                        </div>
                        <div class="flex items-center mb-2 md:mb-6">
                            @if($orderData && ($orderData->delivery_type == 'delivery'))
                            <input type="radio" name="shipment" id="delivery" value="delivery" class="h-5 w-5" checked>
                            @else
                            <input type="radio" name="shipment" id="delivery" value="delivery" class="h-5 w-5">
                            @endif
                            <label for="delivery" class="ml-2">Doručenie na adresu</label>
                        </div>
                        <div class="flex items-center">
                            @if($orderData && ($orderData->delivery_type == 'post'))
                            <input type="radio" name="shipment" id="post" value="post" class="h-5 w-5" checked>
                            @else
                            <input type="radio" name="shipment" id="post" value="post" class="h-5 w-5">
                            @endif
                            <label for="post" class="ml-2">Balík na poštu</label>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="w-full relative flex justify-start md:justify-center min-[950px]:border-2 border-[(--color-leftright-button-hover)] border-solid mx-2">
                    <legend class="md:absolute min-[900px]:-mt-5 font-semibold text-md min-[900px]:text-xl bg-white py-2 md:px-4">Výber spôsobu platby</legend>
                    <div class="flex flex-col pb-4 md:p-10 text-sm md:text-md">
                        <div class="flex items-center mb-2 md:mb-6">
                            @if($orderData && ($orderData->payment_type == 'online'))
                            <input type="radio" name="payment" id="online" value="online" class="h-5 w-5" checked>
                            @else
                            <input type="radio" name="payment" id="online" value="online" class="h-5 w-5">
                            @endif
                            <label for="online" class="ml-2">Kartou online</label>
                        </div>
                        <div class="flex items-center mb-2 md:mb-6">
                            @if($orderData && ($orderData->payment_type == 'online' || $orderData->payment_type == 'transfer'))
                            <input type="radio" name="payment" id="offline" value="offline" class="h-5 w-5">
                            @else
                            <input type="radio" name="payment" id="offline" value="offline" class="h-5 w-5" checked>
                            @endif
                            <label for="offline" class="ml-2">V hotovosti/kartou pri doručení</label>
                        </div>
                        <div class="flex items-center">
                            @if($orderData && ($orderData->payment_type == 'transfer'))
                            <input type="radio" name="payment" id="transfer" value="transfer" class="h-5 w-5" checked>
                            @else
                            <input type="radio" name="payment" id="transfer" value="transfer" class="h-5 w-5">
                            @endif
                            <label for="transfer" class="ml-2">Bankovým prevodom</label>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="w-11/12 min-[500px]:w-3/4 flex flex-col-reverse min-[600px]:flex-row items-center min-[600px]:justify-end mx-auto mt-4 min-[600px]:mt-5">
            <a href="/cart" class="hover:cursor-pointer leftright-button rounded-md py-2 font-semibold px-10 text-sm text-white my-2 min-[600px]:my-0 min-[600px]:mr-5">
                Späť
            </a>
            <input type="submit" value="Vyplniť dodacie údaje" class="bg-[var(--color-button)] hover:cursor-pointer colored-button rounded-md py-2 font-semibold px-10 text-sm text-white"/>
        </div>
    </form>
</main>
@endsection
