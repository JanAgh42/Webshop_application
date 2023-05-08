@extends('layouts.main-layout')

@section('content')
<main class="max-w-7xl m-auto mt-10 pb-72 pt-5 sm:px-5">
    <div class="primary-color p-4 rounded-t-md border border-[var(--color-light)">
        @if(!is_null($tag))
        <h2 class="text-sm font-medium">Vyhľadávanie / {{ $category[0]->name }}</h2>
        @else
        <h2 class="text-sm font-medium">Vyhľadávanie / {{ $search }}</h2>
        @endif
    </div>
    <div class="bg-white p-2 lg:p-10 lg:flex rounded-b-md">
        <button type="button" onclick="toggleDropdown('filter-aside')" id="product-filter-order-dropdown" class="flex m-auto gap-x-1.5 lg:hidden px-3 py-2 text-base font-semibold text-gray-500 hover:text-gray-600 hover:cursor-pointer">

            Filtrovať a zoradiť
            <svg class="mt-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill="#6b7280" fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
        </button>
        <aside id="filter-aside" class="hidden text-left lg:basis-1/4 p-5 md:px-44 lg:p-5 lg:block">
            <form action="{{ URL::current() }}" method="GET">
                @if(!is_null($tag))
                <input type="hidden" name="tag" value="{{ $tag }}">
                @else
                <input type="hidden" name="search" value="{{ $search }}">
                @endif
                <h2 class="hidden lg:block text-xl font-bold w-full h-10">Filtrovanie</h2>
                <div class="mb-5">
                    <h3 class="mb-2 font-semibold">Cena</h3>
                    <input type="range" name="price" oninput="maxPriceSlider()" id="slider-price-input" class="appearance-none" min="0" max="20000" value="10000" step="100">
                    <div class="flex">
                        <span class="mr-2">Do:</span>
                        <input type="number" oninput="maxPriceText()" id="txt-price-input" class="w-16 text-center border-b focus:outline-none" value="10000">
                        <span class="ml-2">€</span>
                    </div>
                </div>
                <div class="mb-5">
                    <h3 class="mb-2 font-semibold">Značka</h3>
                    <ul class="flex flex-row flex-wrap lg:flex-col">
                        @foreach($brands as $b)
                        <li class="flex items-center mr-5 mb-1">
                            <input type="checkbox" name="brand[]" value="{{ $b->id }}" id="brand-{{ $b->id }}" class="inline-block h-5 w-5 hover:cursor-pointer">
                            <label for="brand-{{ $b->id }}" class="ml-2 hover:cursor-pointer">{{ $b->name }}</label>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="mb-5">
                    <h3 class="mb-2 font-semibold">Farba</h3>
                    <ul class="flex flex-row flex-wrap lg:flex-col">
                        @foreach($colors as $col)
                        @php $colorValue = substr($col->value, 1) @endphp
                        @if ($colorValue == 'ffffff')
                        <li class="mr-5 mb-1">
                            <input onclick="selectColorFilter('square-{{ $colorValue }}')" value="{{ $col->id }}" type="checkbox" name="color[]" id="color-{{ $col->id }}" class="hidden">
                            <label for="color-{{ $col->id }}" class="w-fit flex items-center hover:cursor-pointer"><span id="square-{{ $colorValue }}" class="h-5 w-5 rounded-sm bg-[{{ $col->value }}] mr-2 border border-4 border-gray-300"></span>{{ $col->name }}</label>
                        </li>
                        @else
                        <li class="mr-5 mb-1">
                            <input onclick="selectColorFilter('square-{{ $colorValue }}')" value="{{ $col->id }}" type="checkbox" name="color[]" id="color-{{ $col->id }}" class="hidden">
                            <label for="color-{{ $col->id }}" class="w-fit flex items-center hover:cursor-pointer"><span id="square-{{ $colorValue }}" class="h-5 w-5 rounded-sm bg-[{{ $col->value }}] mr-2"></span>{{ $col->name }}</label>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <div class="mb-5 lg:mb-12">
                    <h3 class="mb-2 font-semibold">Zoradenie</h3>
                    <ul class="lg:hidden flex flex-row flex-wrap lg:flex-col">
                        <li class="flex items-center mr-5 mb-1">
                            <input type="radio" name="order" id="expensive" class="inline-block h-5 w-5 hover:cursor-pointer">
                            <label for="expensive" class="ml-2 hover:cursor-pointer">Najdrahšie</label>
                        </li>
                        <li class="flex items-center mr-5 mb-1">
                            <input type="radio" name="order" id="cheap" class="inline-block h-5 w-5 hover:cursor-pointer">
                            <label for="cheap" class="ml-2 hover:cursor-pointer">Najlacnejšie</label>
                        </li>
                        <li class="flex items-center mr-5 mb-1">
                            <input type="radio" name="order" id="sold" class="inline-block h-5 w-5 hover:cursor-pointer">
                            <label for="sold" class="ml-2 hover:cursor-pointer">Najpredávanejšie</label>
                        </li>
                    </ul>
                    <select name="order" id="order" class="hidden lg:block lg:border lg:border-grey-light lg:w-full lg:p-2 lg:rounded-md lg:mb-4 lg:focus:outline-none">
                        <option value="no">Bez zoradenia</option>
                        <option value="exp">Najdrahšie</option>
                        <option value="cheap">Najlacnejšie</option>
                        <option value="sold">Najpredávanejšie</option>
                    </select>
                </div>
                <div class="w-full text-center lg:text-right">
                    <input type="hidden" name="filter" value="filt">
                    <input type="submit" value="Aplikovať" class="hover:cursor-pointer bg-[#015D57] hover:bg-[#024a42] rounded-md py-2 font-semibold px-10 text-sm text-white">
                </div>
            </form>
        </aside>

        <div class="lg:basis-3/4 lg:ml-10 relative">
            @if (count($products) == 0)
            <p class="text-center text-lg mt-24">Neboli nájdené vyhovujúce záznamy</p>
            @else
            <section class="grid grid-cols-1 justify-items-center gap-y-3 md:gap-8 min-[480px]:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 min-[1200px]:grid-cols-3 p-4 min-[550px]:px-8 min-[950px]:px-20 min-[1200px]:p-8">
                @foreach($products as $prod)
                <article class="bg-white rounded-md pb-4 drop-shadow-md w-48 text-center hover:drop-shadow-xl">
                    <a href="/product/{{ $prod->id }}/0"><img class="object-cover object-center bg-gray-200 rounded-t-md h-48 w-48" src="{{ asset($prod->image_url) }}" alt="placeholder"></a>
                    <h4 class="text-center font-medium p-2 truncate" title="{{ $prod->name }}">{{ $prod->name }}</h4>
                    @if($prod->discount != null)
                    <span class="mt-2 line-through">{{ $prod->price }} €</span>
                    <span class="mt-2 text-red-600">{{ $prod->price * ((100 - $prod->discount) / 100) }} €</span>
                    @else
                    <p class="mt-2">{{ $prod->price }} €</p>
                    @endif
                    <form method="POST" action="/add-to-cart">
                        @csrf
                        <input type="hidden" name="configId" value="{{ $prod->conf_id }}" />
                        <input type="hidden" name="price" value="{{ $prod->price }}" />
                        <input type="hidden" name="quantity" value="1" />
                        @if($prod->quantity == 0)
                        <input type="submit" class="colored-button rounded-md font-semibold py-1 px-8 mt-1 mx-2 text-sm text-white bg-[var(--color-button)] hover:cursor-pointer" disabled value="Tovar vypredaný">
                        @else
                        <input type="submit" class="colored-button rounded-md font-semibold py-1 px-14 mt-1 mx-2 text-sm text-white bg-[var(--color-button)] hover:cursor-pointer" value="Do košíka">
                        @endif
                    </form>
                </article>
                @endforeach
            </section>


            <nav class="flex justify-center gap-4 md:gap-6 lg:gap-8 rounded-md my-4">
                {{ $products->links() }}
            </nav>
            @endif
        </div>
    </div>
</main>
@endsection