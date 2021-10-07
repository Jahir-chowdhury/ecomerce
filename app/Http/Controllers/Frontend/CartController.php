<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WishList;
use App\Models\Cart;
use App\Models\Category;
use App\Models\AdManager;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use App\Models\Orders;
use App\Models\VendorProduct;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

use App\Models\Settings;

class CartController extends Controller
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

        $setting = Settings::first();
        return view('layouts.frontend.cart.cart_list',[
            'ads'=>$ads,
            'categories'=>$categories,
            'count'=>$count,
            'cart'=>$cart,
            'count1'=>$count1,
            'orders'=>$orders,
            'setting'=>$setting,
        ]);
    }

    public function billing_index()
    {
        $categories = Category::with('get_child_category')->where('status',1)->get();
        $ads = AdManager::all();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('qty')->where('user_id',auth()->user()->id ?? '')->sum('qty');
        $orders = Orders::where('user_id',auth()->user()->id ?? '')->get();
        $setting = Settings::first();
        return view('layouts.frontend.cart.billing_address',[
            'ads'=>$ads,
            'categories'=>$categories,
            'count'=>$count,
            'cart'=>$cart,
            'count1'=>$count1,
            'orders'=>$orders,
            'setting'=>$setting
        ]);
    }

    function update_by_shipping(Request $request){
        $carts = Cart::where('user_id',auth()->user()->id ?? '')->with('get_product','get_vendor_product')->get();
        foreach ($carts as $key => $cart) {
            if ($cart->get_vendor_product !=null) {
                if ($request->val == "outdoor") {
                    if ($cart->qty <= 3) {
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>1*$cart->get_vendor_product->outdoor_charge
                        ]);
                    }elseif($cart->qty > 3 && $cart->qty <=6){
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>2*$cart->get_vendor_product->outdoor_charge
                        ]);
                    }elseif($cart->qty >6 && $cart->qty <=9){
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>3*$cart->get_vendor_product->outdoor_charge
                        ]);
                    }elseif($cart->qty >9 && $cart->qty <=10){
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>4*$cart->get_vendor_product->outdoor_charge
                        ]);
                    }
                }elseif($request->val == "indoor"){
                    if ($cart->qty <= 3) {
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>1*$cart->get_vendor_product->indoor_charge
                        ]);
                    }elseif($cart->qty > 3 && $cart->qty <=6){
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>2*$cart->get_vendor_product->indoor_charge
                        ]);
                    }elseif($cart->qty >6 && $cart->qty <=9){
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>3*$cart->get_vendor_product->indoor_charge
                        ]);
                    }elseif($cart->qty >9 && $cart->qty <=10){
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>4*$cart->get_vendor_product->indoor_charge
                        ]);
                    }
                }
            }else{
                if ($request->val == "outdoor") {
                    if ($cart->qty <= 3) {
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>1*$cart->get_product->outdoor_charge
                        ]);
                    }elseif($cart->qty > 3 && $cart->qty <=6){
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>2*$cart->get_product->outdoor_charge
                        ]);
                    }elseif($cart->qty >6 && $cart->qty <=9){
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>3*$cart->get_product->outdoor_charge
                        ]);
                    }elseif($cart->qty >9 && $cart->qty <=10){
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>4*$cart->get_product->outdoor_charge
                        ]);
                    }
                }elseif($request->val == "indoor"){
                    if ($cart->qty <= 3) {
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>1*$cart->get_product->indoor_charge
                        ]);
                    }elseif($cart->qty > 3 && $cart->qty <=6){
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>2*$cart->get_product->indoor_charge
                        ]);
                    }elseif($cart->qty >6 && $cart->qty <=9){
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>3*$cart->get_product->indoor_charge
                        ]);
                    }elseif($cart->qty >9 && $cart->qty <=10){
                        $cart->update([
                            'shipp_des'=>$request->val,
                            'delivery_charge'=>4*$cart->get_product->indoor_charge
                        ]);
                    }
                }
            }
            
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            if ($request->data == 'vendor_product_id') {
                $attr = ProductAttribute::where('vendor_product_id',$request->id)->first();
                $ven_product = VendorProduct::where('id',$request->id)->with('get_vendor_product_avatar','get_vendor')->first();
                
                $wish = Cart::where([
                    'vendor_product_id'=>$ven_product->id,
                    'user_id'=>auth()->user()->id
                ])->first();

                if ($wish) {
                    return response()->json([
                        'errors'=> 'error'
                    ],422);
                }elseif(!$wish){
                    if ($attr->qty >0) {
                        $data = Cart::create([
                            'vendor_product_id'=> $ven_product->id,
                            'user_id'=> auth()->user()->id,
                            'vendor_id'=> $ven_product->get_vendor->user_id,
                            'size'=>$request->size ?? $attr->size,
                            'qty'=>$request->qty ?? 1,
                            'total'=>$attr->sale_price*($request->qty ?? 1),
                            'profit'=>($attr->sale_price*($request->qty ?? 1))-($attr->pur_price*($request->qty ?? 1)),
                            'ven_profit'=>$ven_product->admin_percent*($request->qty ?? 1)
                        ]);

                        if ($data) {
                            WishList::where('vendor_product_id',$request->id)->delete();
                            $count = WishList::select('id')->where('user_id',Auth::user()->id ?? '')->count();
                            $count1 = Cart::select('id')->where('user_id',Auth::user()->id ?? '')->count();

                            return response()->json([
                                'count'=>$count,
                                'count1'=>$count1
                            ],200);
                        }
                    }else{
                        return response()->json([
                            'stockOut'=>'stock out'
                        ],404);
                    }
                }
            }else{

                $product = Product::where('id',$request->id)->with('get_product_avatars')->first();
                $attr = Attribute::where('product_id',$request->id)->first();
                $wish = Cart::where([
                    'product_id'=>$product->id,
                    'user_id'=>auth()->user()->id

                ])->first();
    
                if ($wish) {
                    return response()->json([
                        'errors'=> 'error'
                    ],422);
                }elseif(!$wish){
                    if ($attr->qty > 0) {
                        $data = Cart::create([
                            'product_id'=> $product->id,
                            'user_id'=> auth()->user()->id,
                            'size'=>$request->size ?? $attr->size,
                            'qty'=>$request->qty ?? 1,
                            'total'=>$attr->sale_price*($request->qty ?? 1),
                            'profit'=>($attr->sale_price*($request->qty ?? 1))-($attr->pur_price*($request->qty ?? 1)),
                        ]);

                        if ($data) {
                            WishList::where('product_id',$request->id)->delete();
                            $count = WishList::select('id')->where('user_id',Auth::user()->id ?? '')->count();
                            $count1 = Cart::select('id')->where('user_id',Auth::user()->id ?? '')->count();

                            return response()->json([
                                'count'=>$count,
                                'count1'=>$count1
                            ],200);
                        }
                    }else{
                        return response()->json([
                            'stockOut'=>'stock out'
                        ],404);
                    }
                }
            }
        }else{
            return response()->json([
                'guest'=>'guest'
            ],500);
        }

    }

    public function get_shipp_des(){
        $data = Cart::where('user_id',auth()->user()->id ?? '')->select('shipp_des')->first();
        
        return response()->json([
            'data'=>$data
        ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if ($request->qty >10) {
            Alert::warning('Opps!',"you can't buy as a same product up to quantity 10.");
            return response()->json([
                'msg'=>'warning'
            ]);
        }else{
            $cart = Cart::where('id',$request->id)->first();
            if ($cart->product_id != null) {
                $product = Attribute::where('product_id',$cart->product_id)->where('size',$cart->size)->first();
                if ($request->qty <= $product->qty) {
                    Cart::where('id',$request->id)->update([
                        'qty'=>$request->qty,
                        'total'=>$product->sale_price*($request->qty),
                        'profit'=>($product->sale_price*($request->qty))-($product->pur_price*($request->qty)),
                    ]);

                    $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
                    if ($request->qty == 4 || $request->qty == 5 || $request->qty == 6) {
                        Alert::warning('warning','If your cart product quantity up to 3 as a same product.You have to pay two times delivery charge.');
                    }elseif($request->qty >7 || $request->qty == 8 || $request->qty == 9){
                        Alert::warning('warning','If your cart product quantity up to 6 as a same product.You have to pay three times delivery charge.');
                    }elseif($request->qty == 10){
                        Alert::warning('warning','If your cart product quantity up to 9 as a same product.You have to pay four times delivery charge.');
                    }
                    return response()->json([
                        'cart'=>$cart
                    ]);
                }else{
                    Alert::warning('warning','Stock Out');

                }
            }else{
                
                $attr = ProductAttribute::where('vendor_product_id',$cart->vendor_product_id)->where('size',$cart->size)->first();
                $ven_product = VendorProduct::where('id',$cart->vendor_product_id)->first();
                if($request->qty <= $attr ? $attr->qty : 0 ){
                    Cart::where('id',$request->id)->update([
                        'qty'=>$request->qty,
                        'total'=>$request->qty*$attr->sale_price,
                        'ven_profit'=>$request->qty*$ven_product->admin_percent
                    ]);
                    $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
                    if ($request->qty == 4 || $request->qty == 5 || $request->qty == 6) {
                        Alert::warning('warning','If your cart product quantity up to 3 as a same product.You have to pay two times delivery charge.');
                    }elseif($request->qty >7 || $request->qty == 8 || $request->qty == 9){
                        Alert::warning('warning','If your cart product quantity up to 6 as a same product.You have to pay three times delivery charge.');
                    }elseif($request->qty == 10){
                        Alert::warning('warning','If your cart product quantity up to 9 as a same product.You have to pay four times delivery charge.');
                    }
                    return response()->json([
                        'cart'=>$cart
                    ]);
                }else{
                    Alert::warning('warning','Stock Out');

                }
            }

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Cart::find($request->id)->delete();
        $cart = Cart::where('user_id',auth()->user()->id ?? '')->get();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        toast('Product remove successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

        return response()->json([
            'cart'=>$cart,
            'count1'=>$count1
        ]);
    }
}
