<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubChildCategory;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductAvatar;
use App\Models\Orders;
use App\Models\Vendor;
use App\Models\OrderDetails;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = auth()->user();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        $categories = Category::latest()->get();
        $childs = ChildCategory::latest()->get();
        $sub_childs = SubChildCategory::latest()->get();
        $attributes = Attribute::latest()->get();
        $brands = Brand::latest()->get();
        $products = Product::with('get_product_avatars','get_attribute')->orderBy('id', 'DESC')->get();
        return view('layouts.backend.product.product_list',[
            'data'=>$data,
            'categories'=>$categories,
            'childs'=>$childs,
            'sub_childs'=>$sub_childs,
            'brands'=>$brands,
            'products'=>$products,
            'attributes'=>$attributes,
            'validVendor'=>$validVendor
        ]);
    }

    

    public function table_search(Request $request)
    {
        if ($request->search == 'daily') {
            $sales = OrderDetails::latest()->where('created_at','>=',Carbon::today())->whereNotNull('product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_product')->get();
        }elseif($request->search == 'weekly'){
            $sales = OrderDetails::latest()->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])->whereNotNull('product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_product')->get();

        }elseif($request->search == 'monthly'){
            $sales = OrderDetails::latest()->whereBetween('created_at', [Carbon::now()->subMonth()->format("Y-m-d H:i:s"), Carbon::now()])->whereNotNull('product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_product')->get();

        }elseif($request->search == 'yearly'){
            $sales = OrderDetails::latest()->whereBetween('created_at', [Carbon::now()->subYear()->format("Y-m-d H:i:s"), Carbon::now()])->whereNotNull('product_id')->selectRaw('distinct(order_id)')->with('get_orders','get_product')->get();
        }

        $data = auth()->user();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        $order_status = OrderDetails::whereNull('product_id')->distinct('order_id')->first();
        $count = Orders::where('delivery_status','Processing')->count();
        $count_refund = Orders::where('delivery_status','refund')->count();
        $refunds = OrderDetails::whereNotNull('product_id')->where('status',1)->where('refund',1)->selectRaw('distinct(order_id)')->with('get_orders')->get();
        $odr = OrderDetails::whereNotNull('product_id')->where('status',0)->selectRaw('distinct(order_id)')->with('get_orders')->get();
        $details = OrderDetails::where('order_id',$request->id)->with('get_product')->get();
        return view('layouts.backend.sales.sales_history',[
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required',
            'category_id' => 'required',
            'child_category_id' => 'required',
            'sub_child_category_id' => 'required',
            'product_name' => 'required|unique:"products"',
            'product_code' => 'required'
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
            Product::create([
                'brand_id'=>$request->brand_id,
                'category_id'=>$request->category_id,
                'child_category_id'=>$request->child_category_id,
                'sub_child_category_id'=>$request->sub_child_category_id,
                'product_name'=>$request->product_name,
                'slug'=> Str::slug($request->product_name),
                'product_code'=>$request->product_code,
                'color'=>$request->color,
                'description'=>$request->description,
                'position'=>$request->position
            ]);

            // toast('Product Upload successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

            return response()->json([
                'msg'=>'success'    
            ],200);
        }
    }

    
    public function product_status(Request $request)
    {
        $data = Product::where('id',$request->id)->first();
        if ($data->status == 0) {
           $data->update([
               'status'=>1
           ]);
            toast('Product active successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

            return redirect()->back();
        }elseif($data->status == 1){
            $data->update([
                'status'=>0
            ]);
            toast('Product deactive successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

            return redirect()->back();
        }

    }

    
    public function edit($slug)
    {
        // $data = auth()->user();
        // $product = Product::where('slug',$slug)->with([
        //     'get_brand',
        //     'get_category',
        //     'get_child_category',
        //     'get_child_child_category',
        //     'get_attribute_value_id_by_color',
        //     'get_attribute_value_id_by_size'
        // ])->first();
        // $brands = Brand::select('id','brand_name')->get();
        // $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        // $sub_child_categories = SubChildCategory::select('id','sub_child_name')->get();
        // // $attribute_values = AttributeValue::select('id','attribute_id','value')->with('get_attribute')->get();
        // return view('layouts.backend.product.product_edit',[
        //     'data'=>$data,
        //     'product'=>$product,
        //     'brands'=>$brands,
        //     'sub_child_categories'=>$sub_child_categories,
        //     'attribute_values'=>$attribute_values,
        //     'validVendor'=>$validVendor
        // ]);

        $data = auth()->user();
        $product = Product::where('slug',$slug)->with([
            'get_brand',
            'get_category',
            'get_child_category',
            'get_child_child_category',
        ])->first();
        $brands = Brand::select('id','brand_name')->get();
        $sub_child_categories = SubChildCategory::select('id','sub_child_name')->get();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();

        return view('layouts.backend.product.product_edit',[
            'data'=>$data,
            'product'=>$product,
            'brands'=>$brands,
            'sub_child_categories'=>$sub_child_categories,
            'validVendor'=>$validVendor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $data = Product::where('slug',$slug)->first();

        $data->update([
            'brand_id'=>$request->brand_id,
            'category_id'=>$request->category_id,
            'child_category_id'=>$request->child_category_id,
            'sub_child_category_id'=>$request->sub_child_category_id,
            'product_name'=>$request->product_name,
            'slug'=> Str::slug($request->product_name),
            'product_code'=>$request->product_code,
            'color'=>$request->color,
            'e_money'=>$request->e_money,
            'indoor_charge'=>$request->indoor_charge,
            'outdoor_charge'=>$request->outdoor_charge,
            'description'=>$request->description,
            'position'=>$request->position
        ]);
        toast('Product Updated successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

        return redirect()->route('products');
        
    }

    public function flash_update(Request $request)
    {
        $flash_status = Product::where('flash_status',1)->first();
        if ($request->flash_timing != null && !$flash_status) {
            Product::where('position','flash sale')->update([
                'flash_timing'=>$request->flash_timing,
                'flash_status'=>1
            ]);
            toast('Product flash sale timing running successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

            return response()->json([
                'msg'=>'success'
            ]);
        }elseif($request->flash_timing != null && $flash_status){
            Product::where('position','flash sale')
                ->whereNull('flash_timing')
                ->whereNull('flash_status')
                ->update([
                'flash_timing'=>$request->flash_timing,
                'flash_status'=>0
            ]);
            Alert::warning('Warning','Product already in flash sale.Try again later.');
            return response()->json([
                'msg'=>'success'
            ]);
        }else{
            Product::where([
                'position'=>'flash sale',
                'flash_status'=>1,
            ])->update([
                'flash_timing'=>null,
                'flash_status'=>null,
                'position'=>null
            ]);

            Product::where([
                'position'=>'flash sale',
                'flash_status'=>0,
            ])->update([
                'flash_status'=>1
            ]);

            return response()->json([
                'msg'=>'success'
            ]);
        }

    }

    public function destroy($id)
    {
        Product::find($id)->delete();

        toast('Product deleted successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

        return redirect()->back();
    }

    public function add_to_flash(Request $request)
    {
        Product::where('id',$request->val)->update([
            'position'=>'flash sale'
        ]);

        return response()->json([
            'msg'=>'success'
        ],200);
    }
}
