<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Orders;
use App\Models\Vendor;
use App\Models\VendorProduct;
use App\Models\SingleVendor;
use App\Models\OrderDetails;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $data = auth()->user();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        $order = OrderDetails::whereNotNull('product_id')->where('status',0)->distinct('order_id')->count();
        $ven_new_order = OrderDetails::whereNotNull('vendor_product_id')->where('status',0)->distinct('order_id')->where('vendor_id',auth()->user()->id)->count();
        $admin_profit = OrderDetails::whereNotNull('vendor_product_id')->get();
        $profit = OrderDetails::whereNotNull('product_id')->get();
        $ven_profit = OrderDetails::whereNotNull('vendor_product_id')->where('vendor_id',auth()->user()->id)->get();
        $vendors = OrderDetails::whereNotNull('vendor_product_id')->with('get_vendor_product')->get();
        $vendor_orders = OrderDetails::whereNotNull('vendor_product_id')->get();
        $user = User::all()->count();
        $users = User::all();
        $all_vendor = Vendor::all();
        return view('layouts.backend.dashboard',[
            'data'=>$data,
            'order'=>$order,
            'validVendor'=>$validVendor,
            'admin_profit'=>$admin_profit->sum('admin_profit'),
            'user'=>$user,
            'profit'=>$profit->sum('profit'),
            'vendors'=>$vendors,
            'ven_new_order'=>$ven_new_order,
            'ven_profit'=>$ven_profit->sum('ven_profit'),
            'vendor_orders'=>$vendor_orders,
            'users'=>$users,
            'all_vendor'=>$all_vendor
        ]);
    }

    public function user_list()
    {
       $users = User::all();
       $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
       $data = auth()->user();
       return view('layouts.backend.user.user_list',[
           'users'=>$users,
           'data'=>$data,
           'validVendor'=>$validVendor
       ]);
    }
    public function vendor_list()
    {
       $users = User::all();
       $validVendor = Vendor::where('user_id',auth()->user()->id??'')->with('get_single_vendor')->first();
       $vendor_product = VendorProduct::with('get_vendor','get_single_vendor')->get();
       $data = auth()->user();
       $single_vendors = SingleVendor::all();
       return view('layouts.backend.user.vendor_list',[
           'users'=>$users,
           'data'=>$data,
           'validVendor'=>$validVendor,
           'vendor_product'=>$vendor_product,
           'single_vendors'=>$single_vendors
       ]);
    }
    
     public function vendor_wise_product(Request $request)
    {
        if($request->data == 'vendor_id'){
           $vendor = Vendor::where('user_id',$request->id)->first();
           $vendor_product = VendorProduct::where($request->data,$vendor->id)->get();
           return view('layouts.backend.user.vendor_wise_product',[
               'vendor_product'=>$vendor_product
           ]);
        }elseif($request->data == 'single_vendor_id'){
           $vendor_product = VendorProduct::where($request->data,$request->id)->get();
           return view('layouts.backend.user.vendor_wise_product',[
               'vendor_product'=>$vendor_product
           ]);
        }
    }
    
    public function vendor_wise_single(Request $request)
    {
       $vendor = Vendor::where('user_id',$request->id)->first();
       $single_vendors = SingleVendor::where('vendor_id',$vendor->id)->get();
      return view('layouts.backend.user.vendor_wise_single_vendor',[
          'single_vendors'=>$single_vendors
      ]);
    }
    
    
}
