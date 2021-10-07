<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\VendorProduct;
use App\Models\Vendor;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\SingleVendor;
use Image;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class VendorProductController extends Controller
{
    
    public function index()
    {
        $data = auth()->user();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        $vendors = Vendor::where('user_id',auth()->user()->id??'')->with('get_single_vendor')->get();
        $single_ven = Vendor::where('multi_vendor',1)->get();
        $vendor_products = VendorProduct::where('vendor_id',$validVendor->id ?? '')->with('get_vendor','get_vendor_product_avatar')->get();
        return view('layouts.backend.vendor.vendor_product_list',[
            'data'=>$data,
            'vendors'=>$vendors,
            'single_ven'=>$single_ven,
            'vendor_products'=>$vendor_products,
            'validVendor'=>$validVendor
        ]);
    }

   public function vendor_table_search(Request $request)
    {
        if ($request->search == 'daily') {
            $sales = OrderDetails::latest()->where('created_at','>=',Carbon::today())->whereNotNull('vendor_product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_vendor_product')->get();
        }elseif($request->search == 'weekly'){
            $sales = OrderDetails::latest()->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])->whereNotNull('vendor_product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_vendor_product')->get();

        }elseif($request->search == 'monthly'){
            $sales = OrderDetails::latest()->whereBetween('created_at', [Carbon::now()->subMonth()->format("Y-m-d H:i:s"), Carbon::now()])->whereNotNull('vendor_product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_vendor_product')->get();

        }elseif($request->search == 'yearly'){
            $sales = OrderDetails::latest()->whereBetween('created_at', [Carbon::now()->subYear()->format("Y-m-d H:i:s"), Carbon::now()])->whereNotNull('vendor_product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_vendor_product')->get();

        }

        $data = auth()->user();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        $order_status = OrderDetails::whereNull('vendor_product_id')->distinct('order_id')->first();
        $count = Orders::where('delivery_status','Processing')->count();
        $count_refund = Orders::where('delivery_status','refund')->count();
        $refunds = OrderDetails::whereNotNull('vendor_product_id')->where('status',1)->where('refund',1)->selectRaw('distinct(order_id)')->with('get_orders')->get();
        $odr = OrderDetails::whereNotNull('vendor_product_id')->where('status',0)->selectRaw('distinct(order_id)')->with('get_orders')->get();
        $details = OrderDetails::where('order_id',$request->id)->with('get_vendor_product')->get();
        return view('layouts.backend.vendor.sales.sales-history',[
            'data'=>$data,
            'sales'=>$sales,
            'count'=>$count,
            'count_refund'=>$count_refund,
            'order_status'=>$order_status,
            'odr'=>$odr,
            'refunds'=>$refunds,
            'details'=>$details,
            'validVendor'=>$validVendor
        ]);
    }


    public function vendor_sales_refund()
    {
        $data = auth()->user();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        $count = Orders::where('delivery_status','pending')->count();
        $sales = OrderDetails::latest()->whereNotNull('vendor_product_id')->with('get_orders','get_vendor_product')->get();
        return view('layouts.backend.vendor.sales.vendor_sales_refund',[
            'data'=>$data,
            'sales'=>$sales,
            'count'=>$count,
            'validVendor'=>$validVendor
        ]);
    }
    

    public function store(Request $request)
    {
        // $cal = $request->discount*$request->sale_price;
        // $price = $cal/100;
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|unique:"vendor_products"',
            'product_code' => 'required',
            'admin_percent' => 'required'
        ]);

        if ($validator->fails()) {
            if ($validator->messages()->all()[0] == "The product name has already been taken.") {
                Alert::warning('Opps!','Product name already taken.');
                return redirect()->back();
            }else{
                Alert::warning('Opps!','Please fillup all field.');
                return redirect()->back();
            }
        }else{

            VendorProduct::create([
                'single_vendor_id'=>$request->single_vendor_id,
                'vendor_id'=>$request->vendor_id,
                'product_name'=>$request->product_name,
                'slug'=> Str::slug($request->product_name),
                'product_code'=>$request->product_code,
                'color'=>$request->color,
                'admin_percent'=>$request->admin_percent,
                'indoor_charge'=>$request->indoor_charge,
                'outdoor_charge'=>$request->outdoor_charge,
                'position'=>'vendor',
                'description'=>$request->description
            ]);

            toast('Product Upload successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

            return redirect()->back();
        }

    }


    public function show($id)
    {

    }

    
    public function edit($slug)
    {
        $data = auth()->user();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        $vendors = Vendor::select('id','user_id','brand_name')->get();
        $single_vendors = SingleVendor::select('id','user_id','brand_name')->get();
        $product = VendorProduct::where('slug',$slug)->with('get_vendor','get_single_vendor')->first();
        return view('layouts.backend.vendor.vendor_product_edit',[
            'data'=>$data,
            'product'=>$product,
            'vendors'=>$vendors,
            'single_vendors'=>$single_vendors,
            'validVendor'=>$validVendor
        ]);
    }

    
    public function update(Request $request, $slug)
    {
        VendorProduct::where('product_name',$slug)->update([
            'single_vendor_id'=>$request->single_vendor_id,
            'vendor_id'=>$request->vendor_id,
            'product_name'=>$request->product_name,
            'slug'=> Str::slug($request->product_name),
            'product_code'=>$request->product_code,
            'color'=>$request->color,
            'admin_percent'=>$request->admin_percent,
            'description'=>$request->description,
            'indoor_charge'=>$request->indoor_charge,
            'outdoor_charge'=>$request->outdoor_charge,
        ]);

        toast('Product Update successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

        return redirect()->route('vendor.products');
    }

    
    public function destroy($id)
    {
        //
    }
}
