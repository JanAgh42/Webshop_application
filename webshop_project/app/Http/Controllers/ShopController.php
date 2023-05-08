<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductConfiguration;
use App\Models\ProductImage;
use App\Models\ProductReview;
use App\Models\Color;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Category;
use App\Models\CartItem;
use App\Models\CustomerData;
use App\Models\Order;

class ShopController extends Controller
{
    public function filterProducts(Request $request)
    {
        $tag = $request->query('tag');
        $search = $request->query('search');
        $category = '';

        if (is_null($tag) && !is_null($search)) {
            if($request->has('filter')) {
                $prods = Product::where('name', 'LIKE', '%'.$search.'%');
                $prods = $this->joinProductsConfigData($prods);
                $prods = $this->joinPhotos($prods);
                $prods = $this->applyFilterOrder($request, $prods)
                ->select('products.id', 'name', 'quantity', 'stockConfigs.price as price', 'stockConfigs.id as conf_id', 'discount', 'image_url')
                ->paginate(9);
            } else {
                $prods = Product::where('name', 'LIKE', '%' . $search . '%');
                $prods = $this->joinProductsConfigData($prods);
                $prods = $this->joinPhotos($prods)
                ->select('products.id', 'name', 'quantity', 'stockConfigs.price as price', 'stockConfigs.id as conf_id', 'discount', 'image_url')
                ->paginate(9);
            }
            $prods->appends(array('search' => $search));
        } elseif (!is_null($tag) && is_null($search)) {
            $category = Category::where('id', $tag)->get('name');

            if($request->has('filter')) {
                $prods = Product::where('category_id', 'LIKE', '%'.$tag.'%');
                $prods = $this->joinProductsConfigData($prods);
                $prods = $this->joinPhotos($prods);
                $prods = $this->applyFilterOrder($request, $prods)
                ->select('products.id', 'name', 'quantity', 'stockConfigs.price as price', 'stockConfigs.id as conf_id', 'discount', 'image_url')
                ->paginate(9);
            } else {
                $prods = Product::where("category_id", $tag);
                $prods = $this->joinProductsConfigData($prods);
                $prods = $this->joinPhotos($prods)
                ->select('products.id', 'name', 'quantity', 'stockConfigs.price as price', 'stockConfigs.id as conf_id', 'discount', 'image_url')
                ->paginate(9);
            }
            $prods->appends(array('tag' => $tag));
        } else {
            $prods = collect([]);
        }
        
        $filterColors = Color::all();
        $filterBrands = Brand::all();

        return view('product-catalog', [
            'products' => $prods,
            'colors' => $filterColors,
            'brands' => $filterBrands,
            'tag' => $tag,
            'search' => $search,
            'category' => $category
        ]);
    }

    private function applyFilterOrder(Request $request, $prods) {
        $color = $request->collect('color');
        $brand = $request->collect('brand');
        $maxPrice = $request->query('price');
        $order = $request->query('order');
        
        if($color->count() != 0){
            $prods = $prods->whereIn('color_id', $color);
        }
        if($brand->count() != 0){
            $prods = $prods->whereIn('brand_id', $brand);
        }
        if(!is_null($order) && $order != 'no'){
            if($order == 'exp') {
                $prods = $prods->orderBy('stockConfigs.price', 'desc');
            }
            elseif($order == 'cheap') {
                $prods = $prods->orderBy('stockConfigs.price', 'asc');
            }
            elseif($order == 'sold') {
                $soldStats = OrderItem::selectRaw('product_id, SUM(quantity) as c')->groupBy('product_id');
                $prods = $prods->leftJoinSub($soldStats, 'order_it', function ($join) {
                    $join->on('products.id', '=', 'order_it.product_id');
                })->orderByRaw('c DESC NULLS LAST');

            }
        }
        $prods = $prods->where('stockConfigs.price', '<=', $maxPrice);

        return $prods;
    }

    public function mainPageInfo() {
        $discountProducts = Product::where('discount', '!=', null);
        $discountProducts = $this->joinProductsConfigData($discountProducts);
        $discountProducts = $this->joinPhotos($discountProducts)
            ->orderBy('discount', 'desc')
            ->take(10)
            ->get(['products.id as id', 'name', 'quantity', 'stockConfigs.price as price', 'stockConfigs.id as conf_id', 'discount', 'image_url']);

        $ratingProducts = Product::leftJoin('product_reviews', 'products.id', '=', 'product_reviews.product_id');
        $ratingProducts = $this->joinProductsConfigData($ratingProducts);
        $ratingProducts = $this->joinPhotos($ratingProducts)
            ->select('products.id', 'name', 'quantity', 'stockConfigs.price as price', 'stockConfigs.id as conf_id', 'discount', 'image_url')
            ->selectRaw('((sum(rating) OVER (PARTITION BY products.id)) / (count(product_reviews.id) OVER (PARTITION BY products.id)))::decimal as rating')
            ->orderByRaw('rating DESC NULLS LAST')
            ->distinct()
            ->take(10)
            ->get(['products.id as id', 'name', 'quantity', 'price', 'conf_id', 'discount', 'rating', 'image_url']);
        
        $categories = Category::all();

        return view('index', [
            'discountProducts' => $discountProducts,
            'ratingProducts' => $ratingProducts,
            'categories' => $categories
        ]);
    }

    private function joinProductsConfigData($query) {
        $largestStockData = ProductConfiguration::selectRaw('product_id, MAX(quantity) as max')->groupBy('product_id');
        $largestStockConfigs = ProductConfiguration::selectRaw('DISTINCT ON(product_id) product_configs.product_id, id, quantity, product_configs.price')
        ->joinSub($largestStockData, 'stockData', function ($join) {
            $join->on('product_configs.product_id', '=', 'stockData.product_id')
            ->on('product_configs.quantity', '=', 'stockData.max');
        });
        
        $query = $query->leftJoinSub($largestStockConfigs, 'stockConfigs', function ($join) {
            $join->on('products.id', '=', 'stockConfigs.product_id');
        });
        return $query;
    }

    private function joinPhotos($query) {
        $itemsPhotos = ProductImage::selectRaw('DISTINCT ON(product_id) product_id, image_url');
        $query = $query->leftJoinSub($itemsPhotos, 'photos', function($join) {
            $join->on('products.id', '=', 'photos.product_id');
        });
        return $query;
    }

    public function getChosenProduct($id, $conf)
    {
        $product = Product::find($id);
        $configs = ProductConfiguration::where('product_id', $product->id)->orderBy('price', 'desc')->get();
        $reviews = ProductReview::where('product_id', $id)->orderBy('created_at', 'desc')->get();
        $soldNum = OrderItem::selectRaw('product_id, SUM(quantity) as c')
            ->where('product_id', $id)->groupBy('product_id')->get();
        $reviewsCount = count($reviews);

        $rating = array_sum(array_column($reviews->toArray(), 'rating')) / ($reviewsCount == 0 ? 1 : $reviewsCount);

        $ratingStats = [0, 0, 0, 0, 0];

        foreach ($reviews as $review) {
            $ratingStats[$review->rating - 1]++;
        }

        foreach ($configs as $config) {
            $config->description = preg_split("/\r\n|[\r\n]/", $config->description);
        }

        return view('product-detail', [
            'id' => $id,
            'configIndex' => $conf,
            'product' => $product,
            'configs' => $configs,
            'reviews' => $reviews,
            'reviewsCount' => $reviewsCount,
            'rating' => $rating,
            'ratingStats' => $ratingStats,
            'soldNum' => $soldNum[0]->c ?? 0
        ]);
    }

    public function getProfileInfo()
    {
        $userDataId = auth()->user()->customer_data_id;

        if ($userDataId != null) {
            $userInfo = CustomerData::find($userDataId);
        } else {
            $userInfo = null;
        }

        return view('profile', [
            'userInfo' => $userInfo
        ]);
    }

    public function postReview(Request $request)
    {
        $productReview = new ProductReview();

        $productReview->id = Str::uuid();
        $productReview->product_id = $request->postId;
        $productReview->username = auth()->user() != null ? auth()->user()->username : 'Anonym';
        $productReview->rating = $request->stars;
        $productReview->content = $request->comment;

        $productReview->save();

        return redirect()->back();
    }

    public function getReviewsForProduct($productId)
    {
        return ProductReview::where('product_id', 'like', '%'.$productId.'%')->get();
    }

    public function addToCart(Request $request)
    {
        $userId = auth()->user() != null ?  auth()->user()->id : null;

        if (!session()->has('cartItemIds')) {
            session()->put('cartItemIds', []);
        }

        $cartItems = CartItem::where('config_id', '=', $request->configId)->get(['id', 'quantity']);
        $sessionCartItems = session()->get('cartItemIds');

        foreach ($cartItems as $cartItem) {
            $sessionIdIndex = array_search($cartItem->id, $sessionCartItems);
            
            if ($sessionIdIndex !== false) {
                $cartItem->quantity = $cartItem->quantity + $request->quantity;
                $cartItem->save();
                $this->updateConfig($request->configId, $request->quantity);

                return redirect()->back();
            }
        }

        $item = new CartItem();

        $item->id = Str::uuid();
        $item->quantity = $request->quantity;
        $item->price = $request->price;
        $item->config_id = $request->configId;
        $item->customer_id = $userId;
        $item->save();

        session()->push('cartItemIds', $item->id);

        $this->updateConfig($request->configId, $request->quantity);

        return redirect()->back();
    }

    public function getCartProducts()
    {
        $itemsPhotos = ProductImage::selectRaw('DISTINCT ON(product_id) product_id, image_url');
        $cartItems = CartItem::join('product_configs', 'product_configs.id', '=', 'shopping_cart_items.config_id')
        ->join('products', 'products.id', '=', 'product_configs.product_id')
        ->leftJoinSub($itemsPhotos, 'photos', function ($join) {
            $join->on('products.id', '=', 'photos.product_id');
        });

        if (session()->has('cartItemIds')) {
            $cartItems = $cartItems->whereIn('shopping_cart_items.id', session()->get('cartItemIds'));
        } elseif(auth()->user() != null) {
            $cartItems = $cartItems->where('shopping_cart_items.customer_id', auth()->user()->id);
        } else {
            return view('cart-products', [
                'cartItems' => collect([])
            ]);
        }
        
        $cartItems = $cartItems->distinct()->select(['shopping_cart_items.id as id', 'image_url', 'shopping_cart_items.price', 'products.name', 'product_configs.name as conf_name', 'shopping_cart_items.quantity as selectedQuantity', 'product_configs.quantity as maxQuantity'])->get();

        if (!session()->has('cartItemIds')) {
            session()->put('cartItemIds', []);

            foreach ($cartItems as $item) {
                session()->push('cartItemIds', $item->id);
            }
        }

        return view('cart-products', [
            'cartItems' => $cartItems
        ]);
    }

    public function editProfile(Request $request)
    {
        $user = Customer::find(auth()->user()->id);

        if ($user->customer_data_id == null) {
            $data = new CustomerData();
            $data->id = Str::uuid();
        } else {
            $data = CustomerData::find($user->customer_data_id);
        }

        $data->firstname = $request->firstname;
        $data->lastname = $request->lastname;
        $data->phone_number = $request->phone_number;
        $data->address = $request->address;
        $data->zipcode = $request->zipcode;
        $data->country = $request->country;
        $data->city = $request->city;

        $data->save();

        if ($user->customer_data_id == null) {
            $user->customer_data_id = $data->id;
            $user->save();
        }

        return redirect()->back();
    }

    private function updateConfig($configId, $quantity) {
        $config = ProductConfiguration::find($configId);

        $config->quantity = $config->quantity - $quantity;
        $config->save();
    }

    public function editCartItem(Request $request)
    {
        $newQuantity = $request->itemNumber;
        $cartItemId = $request->itemId;
        $cartItem = CartItem::find($cartItemId);

        $config = ProductConfiguration::find($cartItem->config_id);
        $config->quantity = $config->quantity + $cartItem->quantity - $newQuantity;
        $config->save();

        $cartItem->quantity = $newQuantity;
        $cartItem->save();

        return redirect()->back();
    }

    public function deleteCartItem(Request $request)
    {
        $cartItemId = $request->itemId;
        $cartItem = CartItem::find($cartItemId);

        $config = ProductConfiguration::find($cartItem->config_id);
        $config->quantity = $config->quantity + $cartItem->quantity;
        $config->save();

        $cartItem->delete();

        $sessionCartItems = session()->get('cartItemIds');
        $sessionIdIndex = array_search($cartItemId, $sessionCartItems);

        if($sessionIdIndex !== false){
            unset($sessionCartItems[$sessionIdIndex]);
            $sessionCartItems = array_values($sessionCartItems);
            session()->put('cartItemIds', $sessionCartItems);
        }

        return redirect()->back();
    }

    public function goToPayment(Request $request) {
        if($request->isMethod('POST')){
            if (!session()->has('orderId')) {
                $order = new Order();
                $order->id = Str::uuid();
                $order->price = $request->price;
                $order->save();

                session()->put('orderId', $order->id);
            } else {
                $order = Order::find(session()->get('orderId'));
                $order->price = $request->price;
                $order->save();
            }
        }

        $order = Order::find(session()->get('orderId'));

        if (is_null($order->payment_type)) {
            $order = false;
        }

        return view('cart-payment', [
            'orderData' => $order
        ]);
    }

    public function paymentDelivery(Request $request) {
        $order = Order::find(session()->get('orderId'));

        $order->payment_type = $request->payment;
        $order->delivery_type = $request->shipment;
        $order->save();

        $userDataId = auth()->user() != null ? auth()->user()->customer_data_id : null;

        if ($userDataId == null) {
            $userData = null;
        } else {
            $userData = CustomerData::find($userDataId);
        }

        return view('cart-address', [
            'userData' => $userData
        ]);
    }

    public function setAddress(Request $request) {
        $customerId = $request->userDataId;

        if ($customerId == null) {
            $customerData = new CustomerData();

            $customerData->id = Str::uuid();
            $customerData->firstname = $request->name;
            $customerData->lastname = $request->surname;
            $customerData->phone_number = $request->phone_number;
            $customerData->address = $request->street;
            $customerData->zipcode = $request->post_number;
            $customerData->city = $request->city;
            $customerData->save();
        } else {
            $customerData = CustomerData::find($customerId);
        }

        $order = Order::find(session()->get('orderId'));

        $order->customer_data_id = $customerData->id;
        $order->save();

        $cartItems = CartItem::whereIn('id', session()->get('cartItemIds'))->get();

        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $productId = ProductConfiguration::find($item->config_id)->get('product_id');

            $orderItem->id = Str::uuid();
            $orderItem->order_id = $order->id;
            $orderItem->quantity = $item->quantity;
            $orderItem->config_id = $item->config_id;
            $orderItem->product_id = $productId[0]->product_id;
            $orderItem->save();
        }

        session()->forget('cartItemIds');
        session()->forget('orderId');
        $cartItems->each->delete();

        return view('cart-confirmation');
    }
}
