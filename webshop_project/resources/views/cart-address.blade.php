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
            <li class="hidden min-[500px]:flex min-[500px]:mx-5 md:mx-10">
                <a href="/payment" class="font-bold text-[var(--color-button)]">Doprava a platba</a>
                <svg class="ml-2 align-top h-5 w-5 text-gray-400 border border-gray-500 rounded-full border-2" viewBox="0 0 20 20">
                    <path fill="#6b7280" fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
            </li>
            <li class="mx-5 md:mx-10">
                <a href="#" class="border-b-2 border-gray-600">Dodacie údaje</a>
            </li>
        </ul>
    </nav>
    <form method="POST" action="/set-address">
        @csrf
        <div class="bg-white py-5 min-[900px]:py-10">
            <div class="text-gray-700 w-11/12 min-[900px]:w-3/4 flex flex-col md:flex-row justify-center items-center min-[950px]:gap-4 mx-auto">
                <fieldset class="w-11/12 min-[450px]:w-8/12 mx-auto md:w-full relative flex justify-start md:justify-center md:border-r-2 min-[950px]:border-2 border-[(--color-leftright-button-hover)] border-solid mx-2">
                    <legend class="md:absolute min-[900px]:-mt-5 font-semibold text-md min-[900px]:text-xl bg-white py-2 md:px-4">Osobné údaje</legend>
                    <div class="w-full flex flex-col pb-4 md:p-10 text-sm md:text-md">
                        <div class="flex flex-col-reverse mb-2 md:mb-4">
                            <input type="text" name="name" id="name" class="h-8 w-full px-2 text-gray-500
                            placeholder-gray-500 focus:outline-none border-b bg-white truncate disabled:placeholder-gray-400 disabled:text-gray-400" value="{{ $userData != null ? $userData->firstname : '' }}" required>
                            <label for="name" class="mb-1">Meno</label>
                        </div>
                        <div class="flex flex-col-reverse mb-2 md:mb-4">
                            <input type="text" name="surname" id="surname" class="h-8 w-full px-2 text-gray-500
                            placeholder-gray-500 focus:outline-none border-b bg-white truncate disabled:placeholder-gray-400 disabled:text-gray-400" value="{{ $userData != null ? $userData->lastname : '' }}" required>
                            <label for="surname" class="mb-1">Priezvisko</label>
                        </div>
                        <div class="flex flex-col-reverse">
                            <input type="text" name="phone_number" id="phone" class="h-8 w-full px-2 text-gray-500
                            placeholder-gray-500 focus:outline-none border-b bg-white truncate disabled:placeholder-gray-400 disabled:text-gray-400" value="{{ $userData != null ? $userData->phone_number : '' }}" required>
                            <label for="email" class="mb-1">Telefónne číslo</label>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="w-11/12 min-[450px]:w-8/12 mx-auto md:w-full relative flex justify-start md:justify-center min-[950px]:border-2 border-[(--color-leftright-button-hover)] border-solid mx-2">
                    <legend class="md:absolute min-[900px]:-mt-5 font-semibold text-md min-[900px]:text-xl bg-white py-2 md:px-4">Adresa</legend>
                    <div class="w-full flex flex-col pb-4 md:p-10 text-sm md:text-md">
                        <div class="flex flex-col-reverse mb-2 md:mb-4">
                            <input type="text" name="street" id="street" class="h-8 w-full px-2 text-gray-500
                            placeholder-gray-500 focus:outline-none border-b bg-white truncate disabled:placeholder-gray-400 disabled:text-gray-400" value="{{ $userData != null ? $userData->address : '' }}" required>
                            <label for="street" class="mb-1">Ulica a číslo domu</label>
                        </div>
                        <div class="flex flex-col-reverse mb-2 md:mb-4">
                            <input type="text" name="city" id="city" class="h-8 w-full px-2 text-gray-500
                            placeholder-gray-500 focus:outline-none border-b bg-white truncate disabled:placeholder-gray-400 disabled:text-gray-400" value="{{ $userData != null ? $userData->city : '' }}" required>
                            <label for="city" class="mb-1">Mesto</label>
                        </div>
                        <div class="flex flex-col-reverse">
                            <input type="text" name="post_number" id="post-number" class="h-8 w-full px-2 text-gray-500
                            placeholder-gray-500 focus:outline-none border-b bg-white truncate disabled:placeholder-gray-400 disabled:text-gray-400" value="{{ $userData != null ? $userData->zipcode : '' }}" required>
                            <label for="post-number" class="mb-1">PSČ</label>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="w-11/12 min-[500px]:w-3/4 flex flex-col-reverse min-[600px]:flex-row items-center min-[600px]:justify-end mx-auto mt-4 min-[600px]:mt-5">
            <a href="/payment" class="leftright-button rounded-md py-2 font-semibold px-10 text-sm text-white my-2 min-[600px]:my-0 min-[600px]:mr-5">
                Späť
            </a>
            <input type="hidden" name="userDataId" value="{{ $userData != null ? $userData->id : null }}" />
            <input type="submit" value="Objednať" class="bg-[var(--color-button)] hover:cursor-pointer colored-button rounded-md py-2 font-semibold px-10 text-sm text-white" />
        </div>
    </form>
</main>
@endsection