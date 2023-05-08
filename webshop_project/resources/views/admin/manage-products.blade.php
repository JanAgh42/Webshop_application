@extends('layouts.manage-products-layout')

@section('content')
<main class="max-w-7xl m-auto pb-20">
    <div class="grid lg:grid-cols-5 h-full rounded-b-md">
        <x-admin-navbar />

        <article class="col-span-4 py-5 lg:px-5 lg:ml-4 rounded-b-md border border-[var(--color-light)] primary-color">
            <h2 class="text-xl font-semibold text-black ml-5 lg:ml-0">Manažovanie produktov</h2>
            <div class="grid gap-10 sm:grid-cols-2 md:grid-cols-3  xl:grid-cols-4 2xl:grid-cols-5 flex flex-wrap p-5">
                @foreach($products as $product)
                <article class="bg-white w-full rounded-md pb-4 h-full drop-shadow-md w-48 text-center hover:drop-shadow-xl">
                    <img class="object-cover mx-auto object-center bg-gray-200 rounded-t-md h-48 w-48" src="{{ asset($product->images()->first()->image_url ?? 'default') }}" alt="placeholder">
                    <h4 class="text-center font-medium p-2 truncate" title="{{$product->name}}">
                        {{$product->name}}
                    </h4>

                    @foreach($product->configurations()->get() as $config)
                    <span class="font-light text-sm text-gray-400">{{$config->name}} - </span>
                    <span class="font-light text-sm text-gray-400">Na sklade: {{$config->quantity}}</span>
                    <br>
                    @endforeach
                    <!-- Buttons -->
                    <div class="buttons mt-2">
                        <a href="{{'/admin/product/modify/'.$product->id}}" class="bg-[var(--color-warning)] rounded-md px-5 font-semibold py-1 min-w-[7rem] max-w-[10rem] mx-2 mt-2 text-sm text-white">
                            Modifikovať
                        </a>
                        <button onclick="toggleConfirmationDialog('{{$product->id}}')" class="bg-[var(--color-danger)]  rounded-md font-semibold py-1 mt-2 min-w-[7rem] max-w-[10rem] mx-2 text-sm text-white">
                            <i class="fa fa-trash" aria-hidden="true"></i> Zmazať
                        </button>
                    </div>

                </article>
                @endforeach
            </div>
            <div class="text-center">
                <nav class="flex justify-center gap-4 md:gap-6 lg:gap-8 rounded-md my-4">
                    {{ $products->links() }}
                </nav>
            </div>
        </article>
    </div>



    <!-- Confirm delete dialog -->
    <article id="confirm-delete-dialog" class="hide relative z-10">
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
                        <a id="confirm-delete-link" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Áno,
                            zmazať produkt</a>
                        <a id="close-dialog-button" onclick="toggleConfirmationDialog()" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Zrušiť</a>
                    </section>
                </div>
            </div>
        </div>
    </article>

</main>
@endsection