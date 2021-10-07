<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banar;
use App\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use App\Models\Orders;
use App\Models\OrderDetails;
use App\Models\ChildCategory;
use App\Models\SubChildCategory;
use App\Models\Product;
use App\Models\AdManager;
use App\Models\Vendor;
use App\Models\SingleVendor;
use App\Models\VendorProduct;
use App\Models\VendorProductAvatar;
use App\Models\ProductAvatar;
use App\Models\WishList;
use App\Models\Cart;
use App\Models\Settings;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

            $banars = Banar::all();
            $setting = Settings::first();
            $categories = Category::with('get_child_category')->where('status',1)->get();
            $products = Product::where('status','=',1)->with('get_brand','get_product_avatars','get_attribute','get_category')->get();
            $ads = AdManager::all();
            $vendors = Vendor::all();
            $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
            $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
            $cart = Cart::where('user_id',auth()->user()->id ?? '')->get();
            $orders = Orders::where('user_id',auth()->user()->id ?? '')->get();
            $load_products = Product::where('status','=',1)
            ->where('position',null)
            ->with('get_product_avatars')
            ->limit('6')
            ->get();
            return view('layouts.frontend.home',[
                'banars'=>$banars,
                'categories'=>$categories,
                'products'=>$products,
                'load_products'=>$load_products,
                'ads'=>$ads,
                'vendors'=>$vendors,
                'count'=>$count,
                'count1'=>$count1,
                'cart'=>$cart,
                'orders'=>$orders,
                'setting'=>$setting
            ]);


    }


    public function search(Request $request)
    {
        $product_data = Product::where('product_name','LIKE','%'.$request->val.'%')->get();
        $output = '<ul class="dropdown-searchdata">';
        foreach($product_data as $row)
        {
        $output .= '
        <li style="border-bottom:1px solid #ddd"><a href="#">'.$row->product_name.'</a></li>';
        }
        $output .= '</ul>';
        return $output;


    }

    public function load(Request $request)
    {

        $load_products = Product::latest()->limit(6+$request->val)
        ->where('position',null)
        ->with('get_product_avatars')->get();
        return view('layouts.frontend.load_product',[
            'load_products'=>$load_products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category($slug)
    {
        $catId = Product::where('product_name',$slug)->first();

        if($catId !=null){
            return $this->findCat($catId,$slug);
        }else{
            $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
            $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
            $cart = Cart::where('user_id',auth()->user()->id ?? '')->get();
            $categories = Category::with('get_child_category')->where('status',1)->get();
            $ads = AdManager::all();
            $orders = Orders::where('user_id',auth()->user()->id ?? '')->get();
            $setting = Settings::first();

            $cat = Category::where('slug',$slug)->first();
            $category = ChildCategory::where('slug',$slug)->with('get_category:id,cover')->first();
            $sub_category = SubChildCategory::where('slug',$slug)->with('get_category:id,cover')->first();

            if($cat != null){
                $products = Product::where('category_id',$cat->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                    $query->whereNotNull('product_id')->get();
                }])->get();
                $product = $cat->get_product()->with('get_brand')->selectRaw('distinct(brand_id)')->get();
                $productSize = Product::where('category_id',$cat->id)->with('get_product_avatars','get_attribute')->get();
                $attributes = Attribute::all();
            }elseif($category != null) {
                $products = Product::where('child_category_id',$category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                    $query->whereNotNull('product_id')->get();
                }])->get();
                $attributes = Attribute::all();
                $product = $category->get_product()->with('get_brand')->selectRaw('distinct(brand_id)')->get();
                $productSize = Product::where('child_category_id',$category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                    $query->whereNotNull('size')->get();
                }])->get();
            }elseif($sub_category !=null){
                $products = Product::where('sub_child_category_id',$sub_category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                    $query->whereNotNull('product_id')->get();
                }])->get();
                $product = $sub_category->get_product()->with('get_brand')->selectRaw('distinct(brand_id)')->get();
                $productSize = Product::where('sub_child_category_id',$sub_category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                    $query->whereNotNull('size')->get();
                }])->get();
                $attributes = Attribute::all();
            }

            return view('layouts.frontend.category_list',[
                'ads'=>$ads,
                'categories'=>$categories,
                'count'=>$count,
                'count1'=>$count1,
                'cart'=>$cart,
                'orders'=>$orders,
                'setting'=>$setting,
                'cat'=>$cat,
                'category'=>$category,
                'sub_category'=>$sub_category,
                'products'=>$products ?? null,
                'product'=>$product ?? null,
                'productSize'=>$productSize ?? null,
                'attributes'=>$attributes ?? null
            ]);
        }
    }

     public function findCat($catId,$slug){
         
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $cart = Cart::where('user_id',auth()->user()->id ?? '')->get();
        $categories = Category::with('get_child_category')->where('status',1)->get();
        $ads = AdManager::all();
        $orders = Orders::where('user_id',auth()->user()->id ?? '')->get();
        $setting = Settings::first();

        $cat = Category::where('id',$catId->category_id)->first();
        $category = ChildCategory::where('slug',$slug)->with('get_category:id,cover')->first();
        $sub_category = SubChildCategory::where('slug',$slug)->with('get_category:id,cover')->first();

        if($cat != null){
            $products = Product::where('category_id',$cat->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                $query->whereNotNull('product_id')->get();
            }])->get();
            $product = $cat->get_product()->with('get_brand')->selectRaw('distinct(brand_id)')->get();
            $productSize = Product::where('category_id',$cat->id)->get();
           $attributes = Attribute::all();
        }elseif($category != null) {
            $products = Product::where('child_category_id',$category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                $query->whereNotNull('product_id')->get();
            }])->get();
            $product = $category->get_product()->with('get_brand')->selectRaw('distinct(brand_id)')->get();
            $productSize = Product::where('child_category_id',$category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                $query->whereNotNull('size')->get();
            }])->get();
            $attributes = Attribute::all();
        }elseif($sub_category !=null){
            $products = Product::where('sub_child_category_id',$sub_category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                $query->whereNotNull('product_id')->get();
            }])->get();
            $product = $sub_category->get_product()->with('get_brand')->selectRaw('distinct(brand_id)')->get();
            $productSize = Product::where('sub_child_category_id',$sub_category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                $query->whereNotNull('size')->get();
            }])->get();
            $attributes = Attribute::all();
        }

        return view('layouts.frontend.category_list',[
            'ads'=>$ads,
            'categories'=>$categories,
            'count'=>$count,
            'count1'=>$count1,
            'cart'=>$cart,
            'orders'=>$orders,
            'setting'=>$setting,
            'cat'=>$cat,
            'category'=>$category,
            'sub_category'=>$sub_category,
            'products'=>$products,
            'product'=>$product,
            'productSize'=>$productSize,
            'attributes'=>$attributes ?? null
        ]);
     }

    public function productSearch(Request $request)
    {
        if ($request->data1 != null) {
            if ($request->col_name4 == null) {
                if($request->col_name == "id"){
                    $products = Product::whereHas('get_attribute', function($q) use($request){
                        $q->where($request->col_name,$request->data);
                    })->where($request->col_name1,$request->data1)
                    ->with('get_product_avatars')->get();
                }else{
                    $products = Product::where($request->col_name,$request->data)
                    ->where($request->col_name1,$request->data1)
                    ->with('get_product_avatars')->get();
                }
            }else{
                $products = Product::where($request->col_name1,$request->data1)
                ->whereHas('get_attribute', function($q) use($request){
                    $q->whereBetween('sale_price',[$request->min,$request->max,]);
                })->with('get_product_avatars')->get();
            }

            return view('layouts.frontend.product_by_category',[
                'products'=>$products
            ]);
        }elseif($request->data2 != null){
            if ($request->col_name4 == null) {
                if($request->col_name == "id"){
                    $products = Product::where($request->col_name2,$request->data2)
                    ->whereHas('get_attribute', function($q) use($request){
                        $q->where($request->col_name,$request->data);
                    })->with('get_product_avatars')->get();

                }else{
                    $products = Product::where($request->col_name,$request->data)
                    ->where($request->col_name2,$request->data2)
                    ->with('get_product_avatars')->get();
                }
            }else{
                $products = Product::where($request->col_name2,$request->data2)
                ->whereHas('get_attribute', function($q) use($request){
                    $q->whereBetween('sale_price',[$request->min,$request->max,]);
                })->with('get_product_avatars')->get();
            }

            return view('layouts.frontend.product_by_category',[
                'products'=>$products
            ]);
        }elseif($request->data3 != null){
            if ($request->col_name4 == null) {
                if($request->col_name == "id"){
                    $products = Product::where($request->col_name3,$request->data3)
                    ->whereHas('get_attribute', function($q) use($request){
                        $q->where($request->col_name,$request->data);
                    })->with('get_product_avatars')->get();
                }else{
                    $products = Product::where($request->col_name,$request->data)
                    ->where($request->col_name3,$request->data3)
                    ->with('get_product_avatars')->get();
                }
            }else{
                $products = Product::where($request->col_name3,$request->data3)
                ->whereHas('get_attribute', function($q) use($request){
                    $q->whereBetween('sale_price',[$request->min,$request->max,]);
                })->with('get_product_avatars')->get();
            }

            return view('layouts.frontend.product_by_category',[
                'products'=>$products
            ]);
        }
    }


    public function priceBysize(Request $request)
    {
        $price = Attribute::select('sale_price','promo_price')->where('product_id',$request->id)
        ->where('size',$request->val)->first();

        return response()->json([
            'price'=>$price
        ]);
    }

    public function priceByProductsize(Request $request)
    {
        $price = ProductAttribute::select('sale_price','promo_price')->where('vendor_product_id',$request->id)
        ->where('size',$request->val)->first();

        return response()->json([
            'price'=>$price
        ]);
    }



    public function show_vendor($brand)
    {
        $categories = Category::with('get_child_category')->where('status',1)->get();
        $ads = AdManager::all();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $vendor = Vendor::where('brand_name',$brand ?? '')->first();
        $orders = Orders::where('user_id',auth()->user()->id ?? '')->get();
        $setting = Settings::first();

        $single_vendor = SingleVendor::with('get_vendor')->where([
            'vendor_id'=>$vendor->id,
        ])->get();
        $products = VendorProduct::with('get_vendor','get_product_attribute')->where([
            'vendor_id'=>$vendor->id,
            'single_vendor_id'=> null
        ])->get();
        $cart = Cart::where('user_id',auth()->user()->id ?? '')->get();
        if ($vendor->multi_vendor == 0) {
            return view('layouts.frontend.vendor.vendor_list_and_product',[
                'categories'=>$categories,
                'ads'=>$ads,
                'count'=>$count,
                'count1'=>$count1,
                'cart'=>$cart,
                'products'=>$products,
                'single_vendor'=>$single_vendor,
                'orders'=>$orders,
                'setting'=>$setting
            ]);
        }else{
            return view('layouts.frontend.vendor.multi_vendor_list',[
                'categories'=>$categories,
                'ads'=>$ads,
                'count'=>$count,
                'count1'=>$count1,
                'cart'=>$cart,
                'products'=>$products,
                'single_vendor'=>$single_vendor,
                'orders'=>$orders,
                'setting'=>$setting
            ]);
        }

    }

    public function product_quick_view($slug)
    {
        $categories = Category::with('get_child_category')->where('status',1)->get();
        $ads = AdManager::all();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $orders = Orders::where('user_id',auth()->user()->id ?? '')->get();
        $product = VendorProduct::where('slug',$slug)->with('get_vendor_product_avatar','get_product_attribute')->first();
        $cart = Cart::where('user_id',auth()->user()->id ?? '')->get();
        $products = VendorProduct::with('get_vendor_product_avatar')->get();

        $setting = Settings::first();
        return view('layouts.frontend.vendor.product_quick_view',[
            'categories'=>$categories,
            'ads'=>$ads,
            'count'=>$count,
            'count1'=>$count1,
            'cart'=>$cart,
            'product'=>$product,
            'products'=>$products,
            'orders'=>$orders,
            'setting'=>$setting,
        ]);

    }

    public function quick_view($slug)
    {
        $categories = Category::with('get_child_category')->where('status',1)->get();
        $ads = AdManager::all();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $orders = Orders::where('user_id',auth()->user()->id ?? '')->get();
        $product = Product::where('slug',$slug)->with('get_product_avatars','get_brand','get_attribute')->first();
        $cart = Cart::where('user_id',auth()->user()->id ?? '')->get();
        $products = Product::with('get_brand','get_product_avatars','get_attribute')->get();
        
        $setting = Settings::first();
        return view('layouts.frontend.quick_view',[
            'categories'=>$categories,
            'ads'=>$ads,
            'count'=>$count,
            'count1'=>$count1,
            'cart'=>$cart,
            'product'=>$product,
            'products'=>$products,
            'orders'=>$orders,
            'setting'=>$setting
        ]);

    }


    public function show_vendor_products($name)
    {
        $categories = Category::with('get_child_category')->where('status',1)->get();
        $ads = AdManager::all();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $orders = Orders::where('user_id',auth()->user()->id ?? '')->get();

        $setting = Settings::first();

        $single_vendor = SingleVendor::where('brand_name',$name)->first();
        $products = VendorProduct::where([
            'vendor_id'=>$single_vendor->vendor_id,
            'single_vendor_id'=> $single_vendor->id
        ])->get();
        $cart = Cart::where('user_id',auth()->user()->id ?? '')->get();

        return view('layouts.frontend.vendor.multivendor_product',[
            'categories'=>$categories,
            'ads'=>$ads,
            'count'=>$count,
            'count1'=>$count1,
            'cart'=>$cart,
            'products'=>$products,
            'orders'=>$orders,
            'setting'=>$setting
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProductShipp(Request $request)
    {
        $carts = Cart::where('user_id',auth()->user()->id?? '')->get();
        foreach ($carts as $key => $cart) {
            if ($cart->product_id) {
                $data = Product::where('id',$cart->product_id)->update([
                    'shipp_des'=>$request->val
                ]);
            }
            if ($cart->vendor_product_id) {
                $data = VendorProduct::where('id',$cart->vendor_product_id)->update([
                    'shipp_des'=>$request->val
                ]);
            }


        }

        return response()->json([
            'msg'=>'success'
        ]);
    }


    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
