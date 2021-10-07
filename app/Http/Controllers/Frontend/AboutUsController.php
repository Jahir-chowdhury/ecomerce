<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WishList;
use App\Models\Cart;
use App\Models\Category;
use App\Models\AdManager;
use App\Models\Product;
use App\Models\Orders;
use App\Models\About;
use App\Models\VendorProduct;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

use App\Models\Settings;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('get_child_category')->where('status',1)->get();
        $ads = AdManager::all();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $orders = Orders::where('user_id',auth()->user()->id ?? '')->get();
        $about = About::first();

        $setting = Settings::first();
        return view('layouts.frontend.settings.about_us',[
            'ads'=>$ads,
            'categories'=>$categories,
            'count'=>$count,
            'cart'=>$cart,
            'count1'=>$count1,
            'orders'=>$orders,
            'setting'=>$setting,
            'about'=>$about
        ]);
    }
    

    
    
    
    
    
    
}