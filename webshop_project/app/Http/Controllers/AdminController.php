<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\ProductConfiguration;
use Illuminate\Support\Str;
use App\Models\Order;

use Illuminate\Http\Request;
use Throwable;

class AdminController extends Controller
{
    function addBrand(Request $request){
        $brand = new Brand();

        $brand->id = Str::uuid();
        $brand->name = $request->name;
        $brand->save();
        
        return redirect()->to("/admin/add-parameters")->with('success');
    }

    function addCategory(Request $request){
        $category = new Category();

        $category->id = Str::uuid();
        $category->name = $request->name;
        $category->section = $request->section;
        $category->save();

        return redirect()->to("/admin/add-parameters")->with('success');
    }

    function addColor(Request $request){
        $color = new Color();
        
        $color->id = Str::uuid();
        $color->name = $request->name;
        $color->value = $request->value;
        $color->save();

        return redirect()->to("/admin/add-parameters")->with('success');
    }

    function addProduct(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'color_id' => 'required'
        ]);

        $product = new Product();
        
        $product->id = Str::uuid();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->color_id = $request->color_id;
        $product->discount = $request->discount;
        $product->save();

        session()->put('last_product_id', $product->id);
        return redirect()->back()->with('success');
    }

    function addProductImage(Request $request){
        if(session()->get('last_product_id') == NULL){
            return redirect()->back()->with('failed');
        }
        $file = $request->file('image');
        $newName = "";
        if($file != NULL){
            $newName = $file->store('photos/products', 'public');
            $image = new ProductImage();

            $image->id = Str::uuid();
            $image->image_url = $newName;
            $image->product_id = session()->get('last_product_id');
            $image->save();
        }
        
       
        
        return redirect()->back()->with('success');
    }

    function deleteProductImage($imageId){
        $image = ProductImage::find($imageId);

        if($image != NULL){
            $image->delete();
        }

        return redirect()->back()->with('success');
    }

    function addProductConfiguration(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        if(session()->get('last_product_id') == NULL){
            return redirect()->back()->with('failed');
        }

        $config = new ProductConfiguration();

        $config->id = Str::uuid();
        $config->name = $request->input('name');
        $config->description = $request->input('description');
        $config->price = $request->input('price');
        $config->quantity = $request->input('quantity');
        $config->product_id = session()->get('last_product_id');
        $config->save();
        
        return redirect()->back()->with('success');
    }

    function deleteProductConfiguration($configurationId){
        $config = ProductConfiguration::find($configurationId);

        if($config != NULL){
            $config->delete();
        }

        return redirect()->back()->with('success');
    }

    private function loadDropdowns() {
        $categories = Category::all();
        $colors = Color::all();
        $brands = Brand::all();
        
        return  [
            'categories' => $categories,
            'colors' => $colors,
            'brands' => $brands,
        ];
    }

    public function showAddProductPage() {
        $dropdowns = $this->loadDropdowns();
        $configurations = ProductConfiguration::where('product_id', session()->get('last_product_id'))->get();
        $images = ProductImage::where('product_id', session()->get('last_product_id'))->get();
        $product = Product::find(session()->get('last_product_id'));
        $data = [
            'categories' => $dropdowns['categories'],
            'colors' => $dropdowns['colors'],
            'brands' => $dropdowns['brands'],
            'configurations' => $configurations,
            'images' => $images,
            'product' => $product
        ];

        return view('admin.add-product', $data);
    }

    public function showEditProductPage($productId)
    {
        $dropdowns = $this->loadDropdowns();
        session()->put('last_product_id', $productId);
        $configurations = ProductConfiguration::where('product_id', $productId)->get();
        $images = ProductImage::where('product_id',$productId)->get();
        $product = Product::find($productId);
        
        $data = [
            'categories' => $dropdowns['categories'],
            'colors' => $dropdowns['colors'],
            'brands' => $dropdowns['brands'],
            'configurations' => $configurations,
            'images' => $images,
            'product' => $product
        ];

        return view('admin.modify-product', $data);
    }

    function showManageProductsPage(){
        $products = Product::paginate(10);
        $data = [
            'products' => $products
        ];
        return view('admin.manage-products', $data);
    }

    function deleteProduct($productId){
        try{
            $product = Product::find($productId);
            $configs = ProductConfiguration::where('product_id', $productId);
            $images = ProductImage::where('product_id', $productId);

            if($configs != NULL){
                $configs->delete();
            }

            if($images != NULL){
                $images->delete();
            }

            if($product != NULL){
                $product->delete();
            }
        }catch (Throwable $e) {}

        return redirect()->back()->with('success');
    }

    function updateProduct(Request $request){
        $product = Product::find($request->input('product_id'));

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'color_id' => 'required'
        ]);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');
        $product->color_id = $request->input('color_id');
        $product->discount = $request->input('discount');
        $product->save();

        return redirect()->back()->with('success');
    }

    function showOrdersPage(){
        $orders = Order::all();

        $data = [
            'orders' => $orders
        ];


         return view('admin.orders', $data);
    }

    function showOrderDetailPage($orderId){
        $order = Order::find($orderId);
        $data = [
            'order' => $order
        ];  
        return view("admin.order-detail", $data);
    }

    function clearSession() {
        session()->forget('last_product_id');

        return redirect()->to('/admin/manage-products');
    }
}
