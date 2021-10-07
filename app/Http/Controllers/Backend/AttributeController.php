<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Vendor;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = auth()->user();
        $attributes = Attribute::latest()->with('get_product')->get();
        $products = Product::select('id','product_name')->get();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();

        return view('layouts.backend.attribute.attribute_list',[
            'data'=>$data,
            'products'=>$products,
            'attributes'=>$attributes,
            'validVendor'=>$validVendor
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'size' => 'required',
            'sale_price' => 'required',
            'pur_price' => 'required',
            'qty' => 'required'

        ]);

        if ($validator->fails()) {
            Alert::warning('Opps!', 'Field Required');
            return redirect()->back();
        }else{
            $val = Attribute::where('product_id',$request->product_id)->first();
            if ($val) {
                Alert::warning('Opps!', 'Product attribute already uploaded.');
                return redirect()->back();
            }else{

                $datas = $request->all();
                foreach ($datas['size'] as $key => $value) {
                    
                    Attribute::create([
                        'product_id'=>$datas['product_id'],
                        'size'=>$datas['size'][$key],
                        'sale_price'=>$datas['sale_price'][$key],
                        'pur_price'=>$datas['pur_price'][$key],
                        'promo_price'=>$datas['promo_price'][$key],
                        'qty'=>$datas['qty'][$key],
                        'stock'=>$datas['qty'][$key]
                    ]);
                }
        
                toast('Attribute Upload successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                return redirect()->back();
            }
        }
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'size' => 'required',
            'sale_price' => 'required',
            'pur_price' => 'required',
            'qty' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg'=>'error'
            ],500);
        }else{
            $data = Attribute::where('id',$request->id)->first();
            $cal = $request->discount*$request->sale_price;
            $price = $request->sale_price-($cal/100);

            if ($request->discount != $data->discount){
            
                if($cal/100<=$request->sale_price){
                    $data->update([
                        'size'=>$request->size,
                        'sale_price'=> $price,
                        'pur_price'=> $request->pur_price,
                        'promo_price'=> $data->sale_price,
                        'discount'=> $request->discount,
                        'qty'=> $request->qty,
                        'stock'=>$data->stock + $request->qty,
                    ]);
                    return response()->json([
                        'msg'=>'success'
                    ],200);
                }
            }else{
                $data->update([
                    'size'=>$request->size,
                    'sale_price'=> $request->sale_price,
                    'pur_price'=> $request->pur_price,
                    'promo_price'=> $request->promo_price,
                    'qty'=> $request->qty,
                    'stock'=>$data->stock + $request->qty,
                ]);
                return response()->json([
                    'msg'=>'success'
                ],200);
            }
        }
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
