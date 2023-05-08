@extends('layouts.main-layout')

@section('content')
<main class="max-w-7xl m-auto pb-60 min-[600px]:pb-64 bg-[var(--color-body)">
    <div class="bg-white p-5 min-[900px]:p-10">
        <h1 class="text-xl sm:text-3xl mb-2">
            Ďakujeme za Váš nákup
        </h1>
        <p class="text-gray-500">
            Váš nákup sme úspešne zaznamenali a práve ho spracúvame.
        </p>
    </div>
    <div class="w-11/12 min-[500px]:w-3/4 flex flex-col-reverse min-[600px]:flex-row items-center min-[600px]:justify-end mx-auto mt-4 min-[600px]:mt-5">
        <a href="/" class="bg-[var(--color-button)] rounded-md py-2 font-semibold px-10 text-sm text-white hover:bg-[var(--color-button-hover)]">
            Návrat na hlavnú stránku
        </a>
    </div>
</main>
@endsection
