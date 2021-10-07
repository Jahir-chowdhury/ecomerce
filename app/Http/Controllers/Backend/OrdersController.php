<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Settings;
use App\Models\VendorProduct;
use App\Models\OrderDetails;
use App\Models\Vendor;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use PDF;
use Alert;
use Carbon\Carbon;

class OrdersController extends Controller
{
    public function order_by_product(Request $request)
    {
        $details = OrderDetails::where('order_id',$request->id)->with('get_product')->get();
        return view('layouts.backend.sales.order_by_product',[
            'details'=>$details
        ]);
    }
    
    public function order_by_vendor_product(Request $request)
    {
        $details = OrderDetails::where('order_id',$request->id)
        ->whereNotNull('vendor_product_id')
        ->with('get_vendor_product')->get();
        return view('layouts.backend.vendor.sales.order_by_vendor_product',[
            'details'=>$details
        ]);
    }
    
    public function delete_single_order($id)
    {
        OrderDetails::find($id)->delete();
        toast('Order deleted successfull.','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        
        return redirect()->back();
    }
    
    
    public function refundView(Request $request)
    {
        $data = auth()->user();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        $odr = OrderDetails::whereNotNull('product_id')->where('status',1)->where('refund',1)->selectRaw('distinct(order_id)')->with('get_orders')->get();
        $sales = OrderDetails::whereNotNull('product_id')->where('status',0)->where('refund',1)->selectRaw('distinct(order_id)')->with('get_orders','get_product')->get();
        $details = OrderDetails::with('get_product')->get();
        return view('layouts.backend.sales.sales_refund',[
            'data'=>$data,
            'sales'=>$sales,
            'odr'=>$odr,
            'details'=>$details,
            'validVendor'=>$validVendor
        ]);
    }
    
    
    public function vendor_sales_refund()
    {
        $data = auth()->user();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        $odr = OrderDetails::whereNotNull('vendor_product_id')->where('status',1)->where('refund',1)->where('vendor_id',auth()->user()->id)->with('get_orders')->get();
        $sales = OrderDetails::whereNotNull('vendor_product_id')->where('refund',1)->where('vendor_id',auth()->user()->id)->with('get_orders','get_vendor_product')->get();
        $details = OrderDetails::whereNotNull('vendor_product_id')->where('vendor_id',auth()->user()->id)->with('get_vendor_product')->get();
        $qty = $details->count();
        return view('layouts.backend.vendor.sales.vendor_sales_refund',[
            'data'=>$data,
            'sales'=>$sales,
            'odr'=>$odr,
            'details'=>$details,
            'validVendor'=>$validVendor,
            'qty'=>$qty
        ]);
    }

    
    public function refunded(Request $request)
    {
        $oders = OrderDetails::where('order_id',$request->id)->with('get_product','get_orders')->get();
        $ord = Orders::where('id',$request->id)->first();
        $collection = $ord->get_order_details->contains('vendor_product_id', '');
        $collection1 = $ord->get_order_details->contains('product_id', '');
        if ($collection && $collection1) {
            foreach($oders as $order){
                $data = Attribute::where('product_id',$order->product_id)->first();
                Attribute::where('product_id',$order->product_id)->update([
                    'qty'=>$data->qty+$order->qty
                ]);
                $order->delete();
            }
            // Orders::where('id',$request->id)->delete();
            return response()->json([
                'mag'=>'success'
            ],200);
        }else{
            foreach($oders as $order){
                $data = Attribute::where('product_id',$order->product_id)->first();
                Attribute::where('product_id',$order->product_id)->update([
                    'qty'=>$data->qty+$order->qty
                ]);
                $order->delete();
            }
            Orders::where('id',$request->id)->delete();
            return response()->json([
                'mag'=>'success'
            ],200);
        }
        
    }
    
    public function vendor_refunded(Request $request)
    {
        $oders = OrderDetails::where('order_id',$request->id)->with('get_vendor_product','get_orders')->get();
        $ord = Orders::where('id',$request->id)->first();
        $collection = $ord->get_order_details->contains('vendor_product_id', '');
        $collection1 = $ord->get_order_details->contains('product_id', '');
        if ($collection && $collection1) {
            foreach($oders as $order){
                $data = ProductAttribute::where('vendor_product_id',$order->vendor_product_id)->first();
                ProductAttribute::where('vendor_product_id',$order->vendor_product_id)->update([
                    'qty'=>$data->qty+$order->qty
                ]);
                $order->delete();
            }
            // Orders::where('id',$request->id)->delete();
            return response()->json([
                'mag'=>'success'
            ],200);
        }else{
            foreach($oders as $order){
                $data = ProductAttribute::where('vendor_product_id',$order->vendor_product_id)->first();
                ProductAttribute::where('vendor_product_id',$order->vendor_product_id)->update([
                    'qty'=>$data->qty+$order->qty
                ]);
                $order->delete();
            }
            Orders::where('id',$request->id)->delete();
            return response()->json([
                'mag'=>'success'
            ],200);
        }
        
        
    }

    
    public function invoice(Request $request)
    {
        $data = auth()->user();
        $setting = Settings::first();
        $datas = Orders::where('id',$request->id)->with(
            'get_order_details',
            'get_order_details.get_product',
            'get_order_details.get_vendor_product'
            )->first();

 
        $pdf = PDF::loadView('layouts.backend.invoice.order_invoice',[
            'data'=>$data,
            'datas'=>$datas,
            'setting'=>$setting
        ]);
        
        // return view('layouts.backend.invoice.order_invoice',[
        //     'data'=>$data,
        //         'datas'=>$datas,
        //         'setting'=>$setting
        // ]);
        return $pdf->stream('invoice.pdf');
        
    }
    

    public function sales_history()
    {
        $data = auth()->user();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        $sales = OrderDetails::whereNotNull('product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_product')->get();
        $order_status = OrderDetails::whereNull('product_id')->distinct('order_id')->get();
        $orders = Orders::latest()->with('get_order_details')->get();
        $odr = OrderDetails::whereNotNull('product_id')->where('status',0)->selectRaw('distinct(order_id)')->with('get_orders')->get();
        $refunds = OrderDetails::whereNotNull('product_id')->where('refund',1)->selectRaw('distinct(order_id)')->with('get_orders')->get();
        $details = OrderDetails::whereNotNull('product_id')->with('get_product')->get();
        $qty = $details->count();
        return view('layouts.backend.sales.sales_history',[
            'data'=>$data,
            'sales'=>$sales,
            'odr'=>$odr,
            'orders'=>$orders,
            'refunds'=>$refunds,
            'order_status'=>$order_status,
            'details'=>$details,
            'validVendor'=>$validVendor,
            'qty'=>$qty
            
        ]);
    }
    
    public function sales_history_pdf(Request $request)
    {
        if($request->val != null){
            if ($request->val == 'daily') {
                $sales = OrderDetails::latest()->where('created_at','>=',Carbon::today())->whereNotNull('product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_product')->get();
            }elseif($request->val == 'weekly'){
                $sales = OrderDetails::latest()->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])->whereNotNull('product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_product')->get();
    
            }elseif($request->val == 'monthly'){
                $sales = OrderDetails::latest()->whereBetween('created_at', [Carbon::now()->subMonth()->format("Y-m-d H:i:s"), Carbon::now()])->whereNotNull('product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_product')->get();
    
            }elseif($request->val == 'yearly'){
                $sales = OrderDetails::latest()->whereBetween('created_at', [Carbon::now()->subYear()->format("Y-m-d H:i:s"), Carbon::now()])->whereNotNull('product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_product')->get();
    
            }
            
            $data = auth()->user();
            $details = OrderDetails::whereNotNull('product_id')->where('status',1)->with('get_product')->get();
            
            $pdf = PDF::loadView('layouts.backend.sales.pdf_sales_history',[
                'data'=>$data,
                'sales'=>$sales,
                'details'=>$details
            ]);
            return $pdf->setPaper('a4', 'landscape')->stream('sales_history.pdf');
        }else{
            return redirect()->back();
        }
    }
    
    
    public function vendor_sales_history_pdf(Request $request)
    {
         if ($request->val == 'daily') {
            $sales = OrderDetails::latest()->where('created_at','>=',Carbon::today())->whereNotNull('vendor_product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_vendor_product')->get();
        }elseif($request->val == 'weekly'){
            $sales = OrderDetails::latest()->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])->whereNotNull('vendor_product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_vendor_product')->get();

        }elseif($request->val == 'monthly'){
            $sales = OrderDetails::latest()->whereBetween('created_at', [Carbon::now()->subMonth()->format("Y-m-d H:i:s"), Carbon::now()])->whereNotNull('vendor_product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_vendor_product')->get();

        }elseif($request->val == 'yearly'){
            $sales = OrderDetails::latest()->whereBetween('created_at', [Carbon::now()->subYear()->format("Y-m-d H:i:s"), Carbon::now()])->whereNotNull('vendor_product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_vendor_product')->get();

        }
        
        $data = auth()->user();
        $details = OrderDetails::whereNotNull('vendor_product_id')->where('status',1)->with('get_vendor_product','get_orders')->get();
        
        $pdf = PDF::loadView('layouts.backend.vendor.sales.pdf_vendor_sales',[
            'data'=>$data,
            'sales'=>$sales,
            'details'=>$details
        ]);
        
        // return view('layouts.backend.vendor.sales.pdf_vendor_sales',[
        //     'data'=>$data,
        //     'sales'=>$sales,
        //     'details'=>$details
        // ]);
        return $pdf->setPaper('a4', 'landscape')->stream('vendor_sales.pdf');
    }
    

    public function vendor_sales_history()
    {
        $data = auth()->user();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        $sales = OrderDetails::whereNotNull('vendor_product_id')->where('vendor_id',auth()->user()->id)->with('get_orders','get_vendor_product')->get();
        $order_status = OrderDetails::whereNull('vendor_product_id')->selectRaw('distinct(order_id)')->get();
        $orders = Orders::latest()->with('get_order_details')->get();
        $odr = OrderDetails::whereNotNull('vendor_product_id')->where('status',0)->where('vendor_id',auth()->user()->id)->with('get_orders')->get();
        $refunds = OrderDetails::whereNotNull('vendor_product_id')->where('refund',1)->selectRaw('distinct(order_id)')->with('get_orders')->get();
        $details = OrderDetails::whereNotNull('vendor_product_id')->with('get_vendor_product')->get();
        $qty = $details->count();
        return view('layouts.backend.vendor.sales.sales-history',[
            'data'=>$data,
            'sales'=>$sales,
            'odr'=>$odr,
            'orders'=>$orders,
            'refunds'=>$refunds,
            'order_status'=>$order_status,
            'details'=>$details,
            'validVendor'=>$validVendor,
            'qty'=>$qty
            
        ]);
    }


    public function delivery(Request $request)
    {
        $order = Orders::where('id',$request->id)->first();
        
        // $collection = $order->get_order_details->contains('vendor_product_id', '');
        // $collection1 = $order->get_order_details->contains('product_id', '');
        // $collection2 = $order->get_order_details->contains('status', '1');
        
        $order->update([
            'status'=>'delivered'
        ]);
        OrderDetails::where('order_id',$order->id)->update(['status'=>1]);
        
        return response()->json([
            'msg'=>'success'
        ],200);
    }

    // public function adminDelivery($request,$order)
    // {
        
    //     $order_details = OrderDetails::whereNotNull('product_id')->where('order_id',$order->id)->update([
    //         'status'=>1
    //     ]);
    //     Alert::warning('Warning!','This order has vendor product.Order not delivered now.');

    //     return response()->json([
    //         'msg'=>'success'
    //     ]);
    // }

    // public function vendorDelivery($request,$order)
    // {
    //     $order_details = OrderDetails::whereNotNull('vendor_product_id')->where('order_id',$order->id)->update([
    //         'status'=>1
    //     ]);
    //     Alert::warning('Warning!','This order has admin product.Order not delivered now.');

    //     return response()->json([
    //         'msg'=>'success'
    //     ]);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function order_payment(Request $request)
    {
        $order = Orders::where('id',$request->id)->first();
        
        $order->update([
            'admin_pay'=>'Paid'
        ]);
        
        return response()->json([
            'msg'=>'success'
        ],200);
    }
}
