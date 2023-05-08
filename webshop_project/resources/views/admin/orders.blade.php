@extends('layouts.manage-products-layout')

@section('content')
<main class="max-w-7xl m-auto pb-20 ">
    <div class="grid lg:grid-cols-5 h-full rounded-b-md">
        <x-admin-navbar />

        <article class="col-span-4 py-5 lg:px-5 lg:ml-4 rounded-b-md border border-[var(--color-light)] primary-color">
            <h2 class="text-xl font-semibold text-black ml-5 lg:ml-0">Objednávky</h2>
            <div class="flex flex-col mt-5">
            
            @foreach($orders as $order)
                <section class="bg-white p-5 w-full rounded mt-3">
                    <h2 class="font-bold">ID objednávky: {{$order->id}}</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3">
                        <div class="text-sm text-gray-500">
                            <p class="mr-3"><b>Produkty</b>: 
                            @foreach($order->orderItems()->take(5)->get() as $orderItem)
                            {{$orderItem->product()->first()->name}} {{$orderItem->config()->first()->name}}
                            @endforeach
                            </p>
                            <p class="mr-3"><b>Celková suma</b>: {{$order->price}}</p>
                        </div>
                        
                        
                        <div class="text-sm text-gray-500">
                            <p class=""><b>Objednal</b>: {{$order->customerData()->get()->first()->firstname}} {{$order->customerData()->get()->first()->lastname}}</p>
                            <p class=""><b>Adresa</b>: {{$order->customerData()->get()->first()->address}}, {{$order->customerData()->get()->first()->city}}, {{$order->customerData()->get()->first()->zipcode}}
                        ,{{$order->customerData()->get()->first()->country}}</p>
                        </div>
                

                        <div class="ml-auto mr-5 mt-3">
                            <a href="/admin/order/detail/{{$order->id}}" class=" drop-shadow-md bg-[var(--color-button)] text-white hover:bg-blue-500 p-2 px-4 rounded mr-2 text-center"><i class="fa fa-info icon-button" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </section>

                @endforeach

            </div>

        </article>
    </div>



    <!-- Confirm delete dialog -->
    <article id="confirm-delete-dialog" class="hide relative z-10" aria-labelledby="modal-title" role="hidden" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">

                            <section class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <!-- Title -->
                                <h3 class="text-xl mb-5 font-semibold leading-6 text-gray-900" id="modal-title">
                                    Potvrdenie zmazania produktu</h3>
                                <!-- Content -->
                                <div class="mt-2">
                                    <p>Naozaj chcete zmazať tento produkt? Táto akcia je nezvratná.</p>

                                </div>
                            </section>
                        </div>
                    </div>

                    <!-- Bottom bar -->
                    <section class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Áno,
                            zmazať produkt</button>
                        <button id="close-dialog-button" onclick="toggleConfirmationDialog()" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Zrušiť</button>
                    </section>
                </div>
            </div>
        </div>
    </article>

</main>
@endsection