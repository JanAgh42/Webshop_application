@extends('layouts.main-layout')

@section('content')
<main id="profile-main" class="max-w-7xl m-auto pb-60">
    <div class="max-w-4xl mx-auto flex flex-col p-4 mt-4 rounded-md shadow-md text-black bg-white">
        <h1 class="text-3xl ml-2 text-center sm:text-left">Môj profil</h1>
        <form method="POST" action="/edit-profile" class="grid grid-cols-1 sm:grid-cols-5 lg:grid-cols-4 sm:px-6 pt-6 pb-4 w-full">
            @csrf
            <div class="col-span-1 sm:col-span-2 lg:col-span-1 text-center p-5">
                <h1 class="font-semibold">{{ $userInfo != null ? $userInfo->firstname.' '.$userInfo->lastname : 'Meno Priezvisko'}}</h1>
                <h3 class="text-sm">{{ Auth::user()->username }}</h3>
                <div class="mt-5 sm:mt-12">
                    <p>{{ Auth::user()->email }}</p>
                    <p class="mt-1">{{ $userInfo != null ? $userInfo->phone_number : 'Phone number'}}</p>
                    <div class="flex mt-10 justify-center" id="profile-controls">
                        <input type="submit" value="Uložiť" id="profile-save" class="py-2 px-5 text-sm mx-2 rounded-md font-semibold text-white colored-button bg-[var(--color-button)] hover:cursor-pointer">
                    </div>
                </div>
            </div>
            <div class="col-span-1 sm:col-span-3 max-h-72 overflow-auto">
                <div class="p-5 sm:ml-10">
                    <h4 class="font-semibold">Doručovacia adresa</h4>
                    <div class="flex flex-col mt-4 max-w-md">
                        <label for="profile-city" class="text-sm">Mesto</label>
                        <input type="text" name="city" id="profile-city" placeholder="Mesto" class="px-2 text-gray-500
                        placeholder-gray-500 focus:outline-none border-b bg-white truncate disabled:placeholder-gray-400 disabled:text-gray-400" value="{{ $userInfo != null ? $userInfo->city : '' }}" required>
                    </div>
                    <div class="flex flex-col mt-2 max-w-md">
                        <label for="profile-address" class="text-sm">Ulica a číslo domu</label>
                        <input type="text" name="address" id="profile-address" placeholder="Ulica a číslo domu" class="px-2 text-gray-500
                        placeholder-gray-500 focus:outline-none border-b bg-white truncate disabled:placeholder-gray-400 disabled:text-gray-400" value="{{ $userInfo != null ? $userInfo->address : '' }}" required>
                    </div>
                    <div class="flex flex-col mt-2 max-w-md">
                        <label for="profile-zipcode" class="text-sm">PSČ</label>
                        <input type="text" name="zipcode" id="profile-zipcode" placeholder="PSČ" class="px-2 text-gray-500
                        placeholder-gray-500 focus:outline-none border-b bg-white truncate disabled:placeholder-gray-400 disabled:text-gray-400" value="{{ $userInfo != null ? $userInfo->zipcode : '' }}" required>
                    </div>
                    <div class="flex flex-col mt-2 max-w-md">
                        <label for="profile-country" class="text-sm">Krajina</label>
                        <input type="text" name="country" id="profile-country" placeholder="Krajina" class="px-2 text-gray-500
                        placeholder-gray-500 focus:outline-none border-b bg-white truncate disabled:placeholder-gray-400 disabled:text-gray-400" value="{{ $userInfo != null ? $userInfo->country : '' }}" required>
                    </div>
                </div>
                <div class="p-5 sm:ml-10">
                    <h4 class="font-semibold">Osobné údaje</h4>
                    <div class="flex flex-col mt-4 max-w-md">
                        <label for="profile-firstname" class="text-sm">Meno</label>
                        <input type="text" name="firstname" id="profile-firstname" placeholder="Meno" class="px-2 text-gray-500 placeholder-gray-500 focus:outline-none border-b bg-white truncate disabled:placeholder-gray-400 disabled:text-gray-400" value="{{ $userInfo != null ? $userInfo->firstname : '' }}" required>
                    </div>
                    <div class="flex flex-col mt-4 max-w-md">
                        <label for="profile-lastname" class="text-sm">Priezvisko</label>
                        <input type="text" name="lastname" id="profile-lastname" placeholder="Priezvisko" class="px-2 text-gray-500 placeholder-gray-500 focus:outline-none border-b bg-white truncate disabled:placeholder-gray-400 disabled:text-gray-400" value="{{ $userInfo != null ? $userInfo->lastname : '' }}" required>
                    </div>
                    <div class="flex flex-col mt-2 max-w-md">
                        <label for="profile-phone" class="text-sm">Telefónne číslo</label>
                        <input type="text" name="phone_number" id="profile-phone" placeholder="Telefónne číslo" value="{{ $userInfo != null ? $userInfo->phone_number : '' }}" class="px-2 text-gray-500
                        placeholder-gray-500 focus:outline-none border-b bg-white truncate disabled:placeholder-gray-400 disabled:text-gray-400" required>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection