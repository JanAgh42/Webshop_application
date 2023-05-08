@extends('layouts.main-layout')

@section('content')
<main class="max-w-7xl m-auto pb-60">
    <div class="max-w-sm mx-auto flex flex-col items-center justify-center px-2 mt-4">
        <div class="bg-white px-6 pt-6 pb-4 rounded-md shadow-md text-black w-full">
            <h1 class="mb-8 text-3xl text-center">Registrácia</h1>
            <form action="/register" method="POST">
                @csrf
                <input type="text" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" name="username" id="r_username" placeholder="Prezývka" />
                @if($errors->has('username'))
                    <span>{{$errors->first('username')}}</span>
                @endif
                <input type="email" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" name="email" id="r_email" placeholder="Email" />
                @if($errors->has('email'))
                    <span>{{$errors->first('email')}}</span>
                @endif
                <input type="password" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" name="password" id="r_password" placeholder="Heslo" />
                @if($errors->has('password'))
                    <span>{{$errors->first('password')}}</span>
                @endif
               
                <input type="submit" class="block w-full colored-button bg-[var(--color-button)] p-2 mt-10 font-bold text-white rounded-md hover:cursor-pointer" id="r_submit" value="Vytvoriť účet">
            </form>
            <div class="text-center text-sm text-gray-500 mt-5">
                Registráciou potvrdzujem, že som sa oboznámil so zásadami ochrany osobných údajov.
            </div>
        </div>
    </div>
</main>
@endsection