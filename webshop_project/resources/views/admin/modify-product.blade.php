@extends('layouts.add-products-layout')

@section('content')
<main class="max-w-7xl m-auto pb-20">
  <div class="grid lg:grid-cols-5 h-full rounded-b-md">
    <x-admin-navbar />

    <!-- Formular -->
    <article class="col-span-4 py-5 lg:px-5 lg:ml-4 rounded-b-md border border-[var(--color-light)] primary-color">

      <section class="formular-container mx-auto bg-white fit-content w-fit p-10 m-5">
        <div class="title-container mb-8">
          <a href="/admin/manage-products" class=""><i class="fa fa-arrow-left" aria-hidden="true"></i>
            Späť</a>
          <h1 class="text-3xl font-bold mt-3">Modifikovať produkt</h1>
        </div>
        <form action="/admin/product/update" method="POST" class="w-full max-w-lg">
          @csrf
          <input type="hidden" value="{{$product->id}}" name="product_id">
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-name">
                Názov produktu
              </label>
              <input name="name" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" id="product-name" type="text" placeholder="iPhone 5" value="{{$product->name}}">
              @if($errors->has('name'))
              <span>{{$errors->first('name')}}</span>
              @endif
            </div>
            <!-- <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-count">
                                Na sklade(ks)
                            </label>
                            <input class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" id="product-count" type="number" placeholder="5" value="5">
                        </div> -->

            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-price">
                Cena za ks
              </label>
              <input name="price" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" id="product-price" type="number" placeholder="950.00" value="{{$product->price}}">
              @if($errors->has('price'))
              <span>{{$errors->first('price')}}</span>
              @endif
            </div>

            <div class="w-full md:w-1/2 px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-count">
                Kategória
              </label>
              <select name="category_id" id="lang" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" required>
                @foreach($categories as $category)
                @if($category->id == $product->category_id)
                <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
                @endforeach
              </select>
            </div>
            <div class="w-full md:w-1/2 px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-count">
                Farba
              </label>
              <select name="color_id" id="lang" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" required>
                @foreach($colors as $color)
                @if($color->id == $product->color_id)
                <option selected value="{{ $color->id }}">{{ $color->name }}</option>
                @else
                <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endif
                @endforeach
              </select>
            </div>
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-count">
                Značka
              </label>
              <select name="brand_id" id="lang" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" required>
                @foreach($brands as $brand)
                @if($brand->id == $product->brand_id)
                <option selected value="{{ $brand->id }}">{{ $brand->name }}</option>
                @else
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endif
                @endforeach
              </select>
            </div>

            <div class="w-full px-3 mb-6 md:mb-0 flex content-center max-[500px]:flex-col">
              <div class="w-full flex flex-row items-center max-[500px]:mb-3">
                <input type="checkbox" class="inline-block" id="product-is-in-discount" onclick="discountEditable()" />
                <label class="uppercase text-gray-700 text-xs font-bold ml-3" for="product-is-in-discount">
                  Produkt v zľave
                </label>
              </div>
              <div class="w-full">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-discount">
                  Výška zľavy (%)
                </label>
                <input name="discount" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" id="product-discount" type="number" placeholder="42.5" oninput="detectInvalidValues()" disabled value="{{$product->discount}}">
                @if($errors->has('discount'))
                <span>{{$errors->first('discount')}}</span>
                @endif
              </div>
            </div>
          </div>

          <div class="w-full md:w-full mb-10">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-description">
              Popis
            </label>
            <textarea name="description" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" id="product-description" placeholder="Tento produkt ma 256GB pamate...">{{$product->description}}
            </textarea>
          </div>

          <section class="text-center mt-10">
            <input type="submit" value="Uložiť zmeny" class="inline-flex px-5 justify-center rounded-md bg-green-700  py-3 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">
            <!-- <i class="fa my-1 mr-2 fa-floppy-o" aria-hidden="true"></i>
                        <p class="mt-auto mt-3">Uložiť zmeny</p> -->
            <!-- </a> -->
          </section>
        </form>

        <!-- Images -->
        @if($product)
        <section class="images mb-10">
          <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-0">Obrázky - {{$product->name}}</p>
          <ul class="list-disc ml-0">
            @foreach($images as $image)
            <li class="mt-1 w-full">
              <div class="image-component bg-gray-200 pl-2 runded">
                <img src="{{asset($image->image_url)}}" class="object-contain object-center h-28 m-auto" alt="">
                <a href="{{'/admin/product/image/delete/'.$image->id}}" class="ml-2"><i class="fa fa-times"></i></a>
              </div>
            </li>
            @endforeach
          </ul>

          <form action="/admin/product/image/add" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" id="add-image" text="Pridat obrázok" class="mt-5">

            <input type="submit" class="shadow w-full mt-5 bg-gray-500 hover:bg-gray-400
          focus:shadow-outline focus:outline-none text-white text-center font-bold py-2 px-4 rounded">
          </form>
        </section>

        <!-- Configurations -->
        <section class="configuration mb-5">
          <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Konfigurácie - {{$product->name}}</p>
          <ul class="list-disc ml-0">
            @foreach($configurations as $config)
            <li class="mt-1 w-full">
              <div class="configuration-component bg-gray-200 pl-2 rounded">
                <p class="inline-block">{{$config->name}}</p>
                <!-- <button onclick="toggleDialog()"><i class="fa fa-pencil ml-2" aria-hidden="true"></i></button> -->
                <a href="{{'/admin/product/configuration/delete/'. $config->id}}" class="ml-2"><i class="fa fa-times"></i></a>
              </div>
            </li>
            @endforeach
          </ul>

          <button id="add-configuration-button" onclick="toggleDialog()" class="shadow w-full mt-5 mx-auto bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white text-center font-bold py-2 px-4 rounded" type="button">
            Pridat konfiguráciu
          </button>
        </section>

        @if(count($configurations) > 0 && count($images) > 0)
        <form action="/admin/clear-session" method="POST" class="text-center">
          @csrf
          <input type="submit" value="Uložiť zmeny a prepnúť" class="colored-button p-3 bg-[var(--color-button)] hover:cursor-pointer bg-green-700 rounded-md text-white shadow-sm text-sm font-semibold" />
        </form>
        @endif

        @endif


      </section>


    </article>




  </div>

  <!-- Add configuration dialog -->
  <div id="add-configuration-dialog" class="hide relative z-10" aria-labelledby="modal-title" role="hidden" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
          <form action="/admin/product/configuration/add" method="POST" class="w-full max-w-lg">
            @csrf
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="sm:flex sm:items-start">

                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                  <!-- Title -->
                  <h3 class="text-xl mb-5 font-semibold leading-6 text-gray-900" id="modal-title">Pridať novú
                    konfiguráciu</h3>
                  <!-- Content -->
                  <div class="mt-2">


                    <div class="flex flex-wrap -mx-3 mb-6">
                      <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="configuration-name">
                          Názov konfigurácie
                        </label>
                        <input name="name" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" id="configuration-name" type="text" placeholder="256GB">

                      </div>

                      <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="configuration-product-count">
                          Na sklade(ks)
                        </label>
                        <input name="quantity" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" id="configuration-product-count" type="number" placeholder="5">
                      </div>

                      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="configuration-price">
                          Cena za ks
                        </label>
                        <input name="price" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" id="configuration-price" type="number" placeholder="950.00">
                      </div>

                      <div class="w-full md:w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="configuration-description">
                          Popis (každú vlastnosť na nový riadok)
                        </label>
                        <textarea name="description" class="block border border-grey-light w-full p-2 rounded-md focus:outline-none" id="configuration-description" type="number" placeholder="Farba: zelená&#10;Veľkosť: XXL&#10;..." rows="4"></textarea>
                      </div>

                    </div>


                  </div>
                </div>
              </div>
            </div>

            <!-- Bottom bar -->
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
              <input type="submit" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">
              <!-- Pridať
              konfiguráciu</button> -->
              <button id="close-dialog-button" onclick="toggleDialog()" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>

</main>
@endsection