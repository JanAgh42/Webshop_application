@extends('layouts.add-products-layout')

@section('content')
<main class="max-w-7xl m-auto pb-20">
    <div class="grid lg:grid-cols-5 h-full rounded-b-md">
        <x-admin-navbar />

        <article class="col-span-5 mx-auto sm:col-span-4 w-full py-5 lg:px-5 lg:ml-4 rounded-b-md border border-[var(--color-light)] primary-color">

            <section class="formular-container mx-auto bg-white fit-content w-fit p-10 m-5">
                <div class="title-container mb-8">
                    <h1 class="text-3xl font-bold">Pridať parametre</h1>
                </div>
                <div class="w-full max-w-lg flex flex-wrap -mx-3 mb-6">
                    <form method="POST" action="/admin/brand/add" class="w-full flex flex-wrap">
                        @csrf
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-name">
                                Názov značky
                            </label>
                            <input name="name" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" id="product-name" type="text" placeholder="Samsung">
                        </div>
                        <div class="w-1/2"></div>
                        <div class="w-1/2 px-3 mb-6 md:mb-0">
                            <input class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline text-white text-center font-bold hover:cursor-pointer" id="product-name" type="submit" value="Uložiť značku">
                        </div>
                    </form>
                    <form method="POST" action="/admin/category/add" class="w-full flex flex-wrap">
                    @csrf
                        <div class="flex w-full mt-10">
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-count">
                                    Oblasť kategórie
                                </label>
                                <select name="section" id="lang" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none">
                                    <option value="it">IT Technika</option>
                                    <option value="home">Domov</option>
                                    <option value="exterior">Exteriér</option>
                                    <option value="other">Iné</option>
                                </select>
                            </div>

                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-price">
                                    Názov kategórie
                                </label>
                                <input name="name" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" id="product-price" type="text" placeholder="Mobilné zariadenia">
                            </div>
                        </div>
                        <div class="w-1/2"></div>
                        <div class="w-1/2 px-3 mb-6 md:mb-0">
                            <input class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline text-white text-center font-bold hover:cursor-pointer" id="product-name" type="submit" value="Uložiť kategóriu">
                        </div>
                    </form>
                    <form method="POST" action="/admin/color/add" class="w-full flex flex-wrap">
                    @csrf
                        <div class="flex w-full mt-10">
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-count">
                                    Názov farby
                                </label>
                                <input name="name" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" id="product-count" type="text" placeholder="modrá">
                            </div>

                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-price">
                                    Hexadecimálna hodnota
                                </label>
                                <input name="value" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" id="product-price" type="text" placeholder="#42af9c" maxlength="7">
                            </div>
                        </div>
                        <div class="w-1/2"></div>
                        <div class="w-1/2 px-3 mb-6 md:mb-0">
                            <input class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline text-white text-center font-bold hover:cursor-pointer" id="product-name" type="submit" value="Uložiť farbu">
                        </div>
                    </form>
                </div>
            </section>
        </article>
    </div>
</main>
@endsection