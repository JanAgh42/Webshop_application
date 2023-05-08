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
                    <h1 class="text-3xl font-bold mt-3 pr-10">Editovať objednávku</h1>
                </div>
                <form class="w-full max-w-lg">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">
                                Dodacia adresa
                            </label>
                            <input class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" id="address" type="text" placeholder="Prievozska, Bratislava">
                            <!-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> -->
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="buttons w-full flex">
                        <button onclick="toggleConfirmationDialog()" class="bg-[var(--color-danger)]  rounded-md font-semibold p-2 mt-2 min-w-[7rem] max-w-[10rem] mx-2 text-sm text-white">
                            <i class="fa fa-trash" aria-hidden="true"></i> Zmazať objednávku
                        </button>
                        <button disabled class="bg-[var(--color-warning)] disabled:bg-gray-300 rounded-md font-semibold py-1 min-w-[7rem] max-w-[10rem] mx-2 mt-2 text-sm text-white">
                            Modifikovať
                        </button>


                    </div>
                </form>



        </article>


    </div>

</main>
@endsection