@extends('layouts.main-layout')

@section('content')
@php
if($product->discount == null) {
$price = $configs[$configIndex]->price;
}
else {
$price = $configs[$configIndex]->price * ((100 - $product->discount) / 100);
}
@endphp

<main class="max-w-7xl mx-auto pb-72 mt-10 pt-5 sm:px-5">
    <div class="primary-color p-4 rounded-t-md border border-[var(--color-light)]">
        <h2 class="text-sm font-medium">Produkt / {{ $product->name }}</h2>
    </div>
    <div class="secondary-color sm:p-5 pt-5 rounded-b-md">
        <h1 class="font-semibold text-2xl text-center mb-5 block min-[900px]:hidden">{{ $product->name }}</h1>
        <article class="grid grid-cols-1 min-[750px]:grid-cols-2">
            <div class="p-5">
                @if($product->images()->count() == 0)
                <p class="min-[500px]:text-xl whitespace-nowrap truncate overflow-hidden text-md text-center">Žiadne fotografie</p>
                @else
                <img src=" {{ asset($product->images()->first()->image_url) }}" id="product_image" class="object-contain object-center h-80 m-auto" alt="product">
                @endif
                <div class="flex justify-center gap-2 mt-3 font-bold">
                    @foreach($product->images()->get() as $image)
                    <span id="dot-{{ $loop->index }}" class="h-3 w-3 rounded-full bg-slate-400 {{ $loop->index == 0 ? 'bg-slate-500' : '' }} hover:cursor-pointer" onclick="changeImage('{{ asset($image->image_url) }}', '{{ $loop->index }}', '{{ $product->images()->count() }}')"></span>
                    @endforeach
                </div>
            </div>
            <section class="flex flex-col justify-between p-5">
                <h1 class="font-semibold text-2xl min-[1200px]:text-3xl hidden min-[900px]:block">{{ $product->name }}</h1>
                <p class="mt-5">{{ $product->description }}</p>
                <div class="grid grid-cols-3 min-[1200px]:grid-cols-4 gap-4 mt-5">
                    <h4 class="col-span-3 min-[1200px]:col-span-4 font-medium">Konfigurácie</h4>
                    @foreach ($configs as $config)
                    @if($loop->index == $configIndex)
                    <a class="block flex items-center justify-center p-3 min-[750px]:p-1 lg:p-3 bg-gray-300 rounded-md text-center text-sm font-medium" href="{{ route('get_product', ['id' => $id, 'conf' => $loop->index]) }}">
                        {{ $config->name }}
                    </a>
                    @else
                    <a class="block flex items-center justify-center p-3 min-[750px]:p-1 lg:p-3 bg-gray-200 rounded-md text-center text-sm font-medium hover:bg-gray-300" href="{{ route('get_product', ['id' => $id, 'conf' => $loop->index]) }}">
                        {{ $config->name }}
                    </a>
                    @endif
                    @endforeach
                </div>
                <div class="flex flex-col mt-8">
                    @if($product->discount != null)
                    <div class="max-[750px]:text-center">
                        <span class="text-3xl font-semibold mr-5 line-through">{{ $configs[$configIndex]->price }} €</span>
                        <span class="text-3xl font-semibold text-red-600">{{ $price }} €</span>
                    </div>
                    @else
                    <div class="text-3xl font-semibold mt-8 max-[750px]:text-center">{{ $price }} €</div>
                    @endif
                    @if($configs[$configIndex]->quantity == 0)
                    <span class="block text-lg font-semibold text-red-600 mt-3 max-[750px]:text-center">Vypredané</span>
                    @else
                    <span class="block text-lg font-semibold text-green-600 mt-3 max-[750px]:text-center">Skladom {{ $configs[$configIndex]->quantity }}ks</span>
                    @endif
                </div>
                <form class="flex items-center flex-col lg:flex-row justify-between h-10 font-medium mb-10 mt-4" method="POST" action="/add-to-cart">
                    @csrf
                    <input type="hidden" name="configId" value="{{ $configs[$configIndex]->id }}" />
                    <input type="hidden" name="price" value="{{ $price }}" />
                    <div class="font-medium">
                        Počet:
                        <span class="rounded-l-md ml-5 px-3 text-white leftright-button select-none hover:cursor-pointer" onclick="decreaseAmount()">-</span><input type="number" value="1" class="border w-10 text-center font-medium focus:outline-none" id="product-detail-amount" name="quantity" readonly><span class="rounded-r-lg px-3 text-white leftright-button select-none hover:cursor-pointer" onclick="increaseAmount('{{ $configs[$configIndex]->quantity }}')">+</span>
                    </div>
                    @if($configs[$configIndex]->quantity == 0)
                    <input type="submit" class="rounded-md py-2 mt-5 font-semibold px-10 text-md text-white bg-[var(--disabled-button)]" disabled value="Tovar vypredaný">
                    @else
                    <input type="submit" class="rounded-md py-2 mt-5 font-semibold px-20 text-md text-white colored-button bg-[var(--color-button)] hover:cursor-pointer" value="Do košíka">
                    @endif
                </form>
            </section>
        </article>
        <article class="grid grid-cols-1 min-[900px]:grid-cols-5 gap-x-4 mt-10">
            <section class="col-span-1 min-[900px]:col-span-3 p-5 rounded-md primary-color">
                <h2 class="font-semibold text-xl">Viac informácií</h2>
                <ul class="mt-3">
                    @foreach($configs[$configIndex]->description as $desc)
                    <li>
                        <span>{{ $desc }}</span>
                    </li>
                    @endforeach
                </ul>
            </section>
            <section class="grid grid-cols-2 col-span-1 min-[900px]:col-span-2 p-5">
                <div class="min-[640px]:ml-28 min-[900px]:ml-0">
                    <h2 class="font-semibold text-5xl text-center">{{ round($rating, 2) }}</h2>
                    <div class="flex justify-center gap-2 mt-2">
                        @for($index = 1; $index <= 5; $index++) @if($index <=$rating) <span class="fa fa-star text-yellow-500"></span>
                            @else
                            <span class="fa fa-star"></span>
                            @endif
                            @endfor
                    </div>
                    <p class="text-center text-xs mt-2">Hodnotilo {{ $reviewsCount }} zákazníkov</p>
                </div>
                <div class="flex flex-col justify-evenly row-span-2 min-[640px]:mr-28 min-[900px]:mr-0">
                    <div class="text-center">
                        5<span class="fa fa-star text-yellow-500"></span>
                        <p class="inline">{{ $ratingStats[4] }}x</p>
                    </div>
                    <div class="text-center">
                        4<span class="fa fa-star text-yellow-500"></span>
                        <p class="inline">{{ $ratingStats[3] }}x</p>
                    </div>
                    <div class="text-center">
                        3<span class="fa fa-star text-yellow-500"></span>
                        <p class="inline">{{ $ratingStats[2] }}x</p>
                    </div>
                    <div class="text-center">
                        2<span class="fa fa-star text-yellow-500"></span>
                        <p class="inline">{{ $ratingStats[1] }}x</p>
                    </div>
                    <div class="text-center">
                        1<span class="fa fa-star text-yellow-500"></span>
                        <p class="inline">{{ $ratingStats[0] }}x</p>
                    </div>
                </div>
                <div class="min-[640px]:ml-28 min-[900px]:ml-0 max-[900px]:mt-5">
                    <h4 class="font-medium text-2xl text-center">{{ $soldNum }}</h4>
                    <p class="text-center text-xs">predaných kusov</p>
                </div>
            </section>
        </article>
        <article class="mt-10">
            <h1 class="font-bold text-2xl pl-5 sm:pl-0">Recenzie</h1>
            <div class="grid grid-cols-5 mt-5 lg:max-h-96 rounded-md primary-color">
                <section class="py-5 sm:px-5 order-2 col-span-5 lg:order-1 lg:col-span-3 rounded-md overflow-auto max-h-96 border border-[var(--color-light)]">
                    @if(count($reviews) == 0)
                    <p class="min-[500px]:text-xl whitespace-nowrap truncate overflow-hidden text-md text-center">Žiadne recenzie</p>
                    @endif
                    @foreach ($reviews as $review)
                    <div class="relative grid grid-cols-1 gap-4 p-4 mb-4 bg-white shadow-lg">
                        <div class="flex gap-2 flex-col w-full">
                            <div class="flex flex-row justify-between">
                                <p class="min-[500px]:text-xl whitespace-nowrap truncate overflow-hidden text-md">{{ $review->username }}</p>
                                <div class="flex justify-center gap-2 mt-2">
                                    @for($index = 1; $index <= 5; $index++) @if($index <=$review->rating)
                                        <span class="fa fa-star text-yellow-500"></span>
                                        @else
                                        <span class="fa fa-star"></span>
                                        @endif
                                        @endfor
                                </div>
                            </div>
                            <p class="text-gray-400 text-xs min-[500px]:text-sm">{{ $review->created_at }}</p>
                        </div>
                        <p class="-mt-3 text-gray-500 max-[500px]:text-xs">{{ $review->content }}</p>
                    </div>
                    @endforeach
                </section>
                <iframe name="reloader" class="hidden"></iframe>
                <form class="flex flex-col order-1 col-span-5 lg:order-2 lg:col-span-2 p-4 h-56 lg:h-96" action="/review" method="POST">
                    @csrf
                    <div class="flex justify-between">
                        <div class="flex justify-center gap-2 mt-2">
                            <input name="stars" type="radio" id="rating-1" value="1" onclick="starRating(1)" class="hidden" required />
                            <label for="rating-1"><span id="label-1" class="fa fa-star hover:cursor-pointer"></span></label>
                            <input name="stars" type="radio" id="rating-2" value="2" onclick="starRating(2)" class="hidden" />
                            <label for="rating-2"><span id="label-2" class="fa fa-star hover:cursor-pointer"></span></label>
                            <input name="stars" type="radio" id="rating-3" value="3" onclick="starRating(3)" class="hidden" />
                            <label for="rating-3"><span id="label-3" class="fa fa-star hover:cursor-pointer"></span></label>
                            <input name="stars" type="radio" id="rating-4" value="4" onclick="starRating(4)" class="hidden" />
                            <label for="rating-4"><span id="label-4" class="fa fa-star hover:cursor-pointer"></span></label>
                            <input name="stars" type="radio" id="rating-5" value="5" onclick="starRating(5)" class="hidden" />
                            <label for="rating-5"><span id="label-5" class="fa fa-star hover:cursor-pointer"></span></label>
                        </div>
                        <input type="submit" class="px-4 py-2 rounded-md text-white text-sm bg-[var(--color-button)] colored-button hover:cursor-pointer" value="Zdieľať recenziu">
                    </div>
                    <input type="hidden" name="postId" id="post_id" value="{{ $id }}">
                    <div class="w-full h-full bg-white rounded-lg border mx-auto mt-3">
                        <textarea placeholder="Napíšte vlastnú recenziu (nepovinné)..." class="w-full bg-gray-100 rounded leading-normal resize-none h-full py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" name="comment"></textarea>
                    </div>
                </form>
            </div>
        </article>
    </div>
</main>
@endsection