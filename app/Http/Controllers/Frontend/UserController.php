<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WishList;
use App\Models\Cart;
use App\User;
use App\Models\Settings;
use App\Models\Category;
use App\Models\AdManager;
use App\Models\Product;
use App\Models\Orders;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        $count = WishList::select('id')->where('user_id',auth()->user()->id??'')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id??'')->count();
        $cart = Cart::where('user_id',auth()->user()->id ?? '')->get();
        $sales = OrderDetails::selectRaw('distinct(order_id)')
        ->where('user_id',auth()->user()->id ?? '')
        ->with('get_orders','get_product','get_vendor_product')->get();
        $setting = Settings::first();
        $details = OrderDetails::where('user_id',auth()->user()->id ?? '')->with('get_product','get_product.get_product_avatars','get_vendor_product','get_vendor_product.get_vendor_product_avatar')->get();
        return view('layouts.frontend.profile.user_profile',[
            'ads'=>$ads,
            'categories'=>$categories,
            'count'=>$count,
            'count1'=>$count1,
            'cart'=>$cart,
            'sales'=>$sales,
            'setting'=>$setting,
            'details'=>$details
        ]);
    }

    public function logout(Request $request)
    {
        if(Auth::check()){
            Auth::logout();
            $request->session()->flush();
            toast('Logout successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

            return redirect()->route('home');
        }
        
    }
    
    
    public function refund(Request $request)
    {
        Orders::where('id',$request->id)->update(['status'=>'refund']);
        OrderDetails::where('order_id',$request->id)->update(['refund'=>1]);
        return response()->json([
            'mag'=>'success'
        ],200);
    }

   public function previewByOrder(Request $request){
        $details = OrderDetails::where('order_id',$request->id)->with('get_product')->get();
        return view('layouts.frontend.profile.view_product_by_order',[
            'details'=>$details
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
