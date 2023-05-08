@extends('layouts.add-products-layout')

@section('content')
<main class="max-w-7xl m-auto pb-20">
    <div class="grid lg:grid-cols-5 h-full rounded-b-md">
        <x-admin-navbar />

        <!-- Formular -->
        <article class="col-span-4 py-5 lg:px-5 lg:ml-4 rounded-b-md border border-[var(--color-light)] primary-color">

            <section class="formular-container mx-auto bg-white fit-content w-fit p-10 m-5">
                <div class="title-container mb-8">
                    <a href="/admin/orders" class=""><i class="fa fa-arrow-left" aria-hidden="true"></i> Späť</a>

                    <h1 class="text-3xl font-bold mt-3">Detail objednávky</h1>
                    <pc class="text-md text-gray-400">č. {{$order->id}} - {{$order->created_at}}</p>
                </div>
                <section class="w-full max-w-lg">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full mb-0">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Objednávateľ
                            </p>
                        </div>
                        <hr class=" bg-black border=0 border-gray-200 w-full mb-4">

                        <div class="w-full md:w-1/2 px-3">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Meno
                            </p>
                            <p class="block border border-grey-light bg-gray-200  w-full p-2 mb-4 focus:outline-none">
                            {{$order->customerData()->get()->first()->firstname}}
                            </p>
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Priezvisko
                            </p>
                            <p class="block border border-grey-light bg-gray-200  w-full p-2 mb-4 focus:outline-none">
                            {{$order->customerData()->get()->first()->lastname}}
                            </p>
                        </div>

                        <div class="w-full px-3 mb-6 md:mb-0">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Dodacia adresa
                            </p>
                            <p class="block border w-full p-2 bg-gray-200 mb-4 focus:outline-none">
                            {{$order->customerData()->get()->first()->address}}, {{$order->customerData()->get()->first()->city}}, {{$order->customerData()->get()->first()->zipcode}}
                        ,{{$order->customerData()->get()->first()->country}}
                            </p>
                        </div>



                        <div class="w-full mt-2">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Produkty
                            </p>
                        </div>

                        <hr class=" bg-black border=0 border-gray-200 w-full mb-4">


                        <!-- Product -->
                        @foreach($order->orderItems()->get() as $orderItem)
                        <div class="produkt w-full flex flex-wrap">

                            <div class="w-full px-3 mb-6 md:mb-0">
                                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Názov produktu
                                </p>
                                <p class="block border w-full p-2 bg-gray-200 mb-4 focus:outline-none">
                                {{$orderItem->product()->first()->name}} - {{$orderItem->config()->first()->name}}
                                </p>
                            </div>

                            <div class="w-full md:w-1/2 px-3">
                                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Ks
                                </p>
                                <p class="block border border-grey-light bg-gray-200  w-full p-2 mb-4 focus:outline-none">
                                {{$orderItem->quantity}}
                                </p>
                            </div>

                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Cena za ks
                                </p>
                                <p class="block border border-grey-light bg-gray-200  w-full p-2 mb-4 focus:outline-none">
                                {{$orderItem->config()->first()->price}}
                                </p>
                            </div>

                        </div>
                        @endforeach

                        <!-- <hr class=" bg-black border=0 border-gray-200 w-full my-2"> -->


                        <div class="w-full mt-2">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Stav
                            </p>
                        </div>

                        <hr class=" bg-black border=0 border-gray-200 w-full mb-4">

                        <div class="w-full px-3 mb-6 md:mb-0">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Typ doručenia
                            </p>
                            <p class="block border border-grey-light bg-gray-200  w-full p-2 mb-4 focus:outline-none">
                                {{$order->delivery_type}}
                            </p>
                        </div>

                        <div class="w-full px-3 mb-6 md:mb-0">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Platba
                            </p>
                            <p class="block border w-full p-2 bg-gray-200 mb-4 focus:outline-none">
                              {{$order->payment_type}}
                            </p>
                        </div>

                    </div>
                </section>

            </section>
        </article>


    </div>


</main>
@endsection