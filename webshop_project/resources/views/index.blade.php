@extends('layouts.main-layout')

@section('content')
<main class="max-w-7xl m-auto pb-72">
    <div class="p-2">
        <button class="p-2 flex text-gray-700 lg:hidden" onclick="toggleDropdown('category-nav')">
            Kategórie
            <svg class="mt-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
    <div class="grid lg:grid-cols-5 grid-cols-1 h-full rounded-b-md">
        <nav id="category-nav" class="hidden lg:block row-span-1 lg:row-span-2 rounded-b-md p-2 pl-3 border border-[var(--color-light)] primary-color text-black text-lg lg:text-base">
            <div class="font-bold text-gray-700 hidden lg:block">IT Technika</div>
            <section class="flex flex-col  ml-2 text-gray-500">
                @foreach($categories as $category)
                @if($category->section == 'it')
                <a href="/catalog?tag={{ $category->id }}" class="w-full lg:w-fit p-1 lg:p-0 hover:cursor-pointer hover:text-gray-600">
                    {{ $category->name }}
                </a>
                @endif
                @endforeach
            </section>
            <div class="font-bold mt-4 text-gray-700 hidden lg:block">Domov</div>
            <section class="flex flex-col ml-2 text-gray-500">
                @foreach($categories as $category)
                @if($category->section == 'home')
                <a href="/catalog?tag={{ $category->id }}" class="w-full lg:w-fit p-1 lg:p-0 hover:cursor-pointer hover:text-gray-600">
                    {{ $category->name }}
                </a>
                @endif
                @endforeach
            </section>
            <div class="font-bold mt-4 text-gray-700 hidden lg:block">Exteriér</div>
            <section class="flex flex-col ml-2 text-gray-500">
                @foreach($categories as $category)
                @if($category->section == 'exterior')
                <a href="/catalog?tag={{ $category->id }}" class="w-full lg:w-fit p-1 lg:p-0 hover:cursor-pointer hover:text-gray-600">
                    {{ $category->name }}
                </a>
                @endif
                @endforeach
            </section>
            <div class="font-bold mt-4 text-gray-700 hidden lg:block">Iné</div>
            <section class="flex flex-col ml-2 text-gray-500">
                @foreach($categories as $category)
                @if($category->section == 'other')
                <a href="/catalog?tag={{ $category->id }}" class="w-full lg:w-fit p-1 lg:p-0 hover:cursor-pointer hover:text-gray-600">
                    {{ $category->name }}
                </a>
                @endif
                @endforeach
            </section>
        </nav>
        <article class="col-span-4 py-5 lg:px-5 lg:ml-4 rounded-b-md border border-[var(--color-light)] primary-color">
            <h2 class="text-xl font-semibold text-black ml-5 lg:ml-0">Produkty v zľave</h2>
            @if(count($discountProducts) == 0)
            <h2 class="text-xl text-center text-black mt-5">Žiadne produkty v zľave</h2>
            @else
            <div class="grid gap-10 grid-flow-col justify-start overflow-auto p-5">
                @foreach($discountProducts as $product)
                <article class="bg-white rounded-md pb-4 drop-shadow-md w-48 text-center hover:drop-shadow-xl">
                    <a href="/product/{{ $product->id }}/0">
                        <img class="object-cover object-center bg-gray-200 rounded-t-md h-48 w-48 hover:cursor-pointer" src="{{ asset($product->image_url) }}" alt="placeholder">
                    </a>
                    <h4 class="text-center font-medium p-2 truncate" title="{{ $product->name }}">{{ $product->name }}</h4>
                    <span class="mt-2 line-through">{{ $product->price }} €</span>
                    <span class="mt-2 text-red-600">{{ $product->price * ((100 - $product->discount) / 100) }} €</span>
                    <form method="POST" action="/add-to-cart">
                        @csrf
                        <input type="hidden" name="configId" value="{{ $product->conf_id }}" />
                        <input type="hidden" name="price" value="{{ $product->price }}" />
                        <input type="hidden" name="quantity" value="1" />
                        @if($product->quantity == 0)
                        <input type="submit" class="colored-button rounded-md font-semibold py-1 px-8 mt-1 mx-2 text-sm text-white bg-[var(--color-button)] hover:cursor-pointer" disabled value="Tovar vypredaný">
                        @else
                        <input type="submit" class="colored-button rounded-md font-semibold py-1 px-14 mt-1 mx-2 text-sm text-white bg-[var(--color-button)] hover:cursor-pointer" value="Do košíka">
                        @endif
                    </form>
                </article>
                @endforeach
            </div>
            @endif
        </article>
        <article class="col-span-4 py-5 lg:px-5 lg:ml-4">
            <h2 class="text-xl font-semibold ml-5 text-black lg:ml-0">Najpopulárnejšie produkty</h2>
            @if(count($ratingProducts) == 0)
            <h2 class="text-xl text-center text-black mt-5">Žiadne produkty</h2>
            @else
            <div class="grid gap-10 grid-flow-col justify-start overflow-auto p-5">
                @foreach($ratingProducts as $product)
                <article class="bg-white rounded-md pb-4 drop-shadow-md w-48 text-center hover:drop-shadow-xl">
                    <a href="/product/{{ $product->id }}/0">
                        <img class="object-cover object-center bg-gray-200 rounded-t-md h-48 w-48 hover:cursor-pointer" src="{{ asset($product->image_url) }}" alt="placeholder">
                    </a>
                    <h4 class="text-center font-medium p-2 truncate" title="{{ $product->name }}">{{ $product->name }}</h4>
                    <div class="flex justify-center gap-2 mb-2">
                        @for($index = 1; $index <= 5; $index++) @if(round($product->rating) >= $index)
                            <span class="fa fa-star text-yellow-500"></span>
                            @else
                            <span class="fa fa-star"></span>
                            @endif
                            @endfor
                    </div>
                    @if($product->discount != null)
                    <span class="mt-2 line-through">{{ $product->price }} €</span>
                    <span class="mt-2 text-red-600">{{ $product->price * ((100 - $product->discount) / 100) }} €</span>
                    @else
                    <p class="mt-2">{{ $product->price }} €</p>
                    @endif
                    <form method="POST" action="/add-to-cart">
                        @csrf
                        <input type="hidden" name="configId" value="{{ $product->conf_id }}" />
                        <input type="hidden" name="price" value="{{ $product->price }}" />
                        <input type="hidden" name="quantity" value="1" />
                        @if($product->quantity == 0)
                        <input type="submit" class="colored-button rounded-md font-semibold py-1 px-8 mt-1 mx-2 text-sm text-white bg-[var(--color-button)] hover:cursor-pointer" disabled value="Tovar vypredaný">
                        @else
                        <input type="submit" class="colored-button rounded-md font-semibold py-1 px-14 mt-1 mx-2 text-sm text-white bg-[var(--color-button)] hover:cursor-pointer" value="Do košíka">
                        @endif
                    </form>
                </article>
                @endforeach
            </div>
            @endif
        </article>
    </div>
    <article class="mt-5 p-5 rounded-md border border-[var(--color-light)] primary-color">
        <h2 class="text-xl font-semibold text-black text-center">Sponzori</h2>
        <div class="grid grid-cols-2 lg:grid-cols-5 md:grid-cols-3 gap-8 mt-5">
            <div class="bg-white p-5 rounded-md drop-shadow-md">
                <h4 class="text-center font-medium text-sm">Samsong</h4>
                <img src="https://www.freepnglogos.com/uploads/original-samsung-logo-10.png" class="max-h-20 mx-auto mt-3 rotate-180" alt="">
            </div>
            <div class="bg-white p-5 rounded-md drop-shadow-md">
                <h4 class="text-center font-medium text-sm">Googel</h4>
                <img src="https://www.freepnglogos.com/uploads/google-logo-png/google-logo-icon-png-transparent-background-osteopathy-16.png" class="max-h-20 mx-auto mt-3 rotate-180" alt="">
            </div>
            <div class="bg-white p-5 rounded-md drop-shadow-md">
                <h4 class="text-center font-medium text-sm">Macrosoft</h4>
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Microsoft_logo.svg/2048px-Microsoft_logo.svg.png" class="max-h-20 mx-auto mt-3 rotate-180" alt="">
            </div>
            <div class="bg-white p-5 rounded-md drop-shadow-md">
                <h4 class="text-center font-medium text-sm">Appele</h4>
                <img src="https://www.freepnglogos.com/uploads/apple-logo-png/apple-logo-png-dallas-shootings-don-add-are-speech-zones-used-4.png" class="max-h-20 mx-auto mt-3 rotate-180" alt="">
            </div>
            <div class="bg-white p-5 rounded-md drop-shadow-md">
                <h4 class="text-center font-medium text-sm">Tayoto</h4>
                <img src="https://www.freepnglogos.com/uploads/toyota-logo-png/toyota-logos-brands-10.png" class="max-h-20 mx-auto mt-3 rotate-180" alt="">
            </div>
        </div>
    </article>
</main>
@endsection