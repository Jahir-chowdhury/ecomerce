<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor;
use App\Models\SingleVendor;
use App\Models\VendorProduct;
use Image;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    
    public function vendor_index()
    {
        $data = auth()->user();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        $vendors = Vendor::all();
        $count = Vendor::where('status',0)->count();

        return view('layouts.backend.vendor.vendor_list',[
            'data'=>$data,
            'validVendor'=>$validVendor,
            'vendors'=>$vendors,
            'count'=>$count
        ]);
    }
    public function approve(Request $request)
    {
        Vendor::where('id',$request->id)->update(['status'=>1]);
        $vendors = Vendor::latest()->get();
        toast('Vendor approve successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return response()->json([
            'message'=>'success'
        ]);
    }
    public function disable(Request $request)
    {
        Vendor::where('id',$request->id)->update(['status'=>0]);
        toast('Vendor disable successfully','success')
        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return response()->json([
            'message'=>'success'
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
            'brand_name' => 'required|unique:"vendors"'
        ]);

        if ($validator->fails()) {
            Alert::warning('Opps!','Brand name already taken.');
            return response()->json([
                'msg'=>'match'
            ],200);
        }else{
            $match = Vendor::where('user_id',auth()->user()->id ?? '')->first();
            if ($match) {
                Alert::warning('Opps!','You are already vendor.');
                return response()->json([
                    'msg'=>'match'
                ],200);
            }else{

                $image = $request->file('vendor_logo');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $img = Image::make($request->file('vendor_logo'));
                $upload_path1 = public_path()."/images/";
    
                if($new_name){
                    $data = Vendor::create([
                        'user_id'=>auth()->user()->id,
                        'brand_name'=>$request->brand_name,
                        'logo'=>$new_name,
                        'slug'=>$request->brand_name,
                        'multi_vendor'=>$request->status,
                    ]);
                    if($data){
                        $img->save($upload_path1.$new_name);
    
                        toast('Vendor Create successfully','success')
                        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                        return response()->json([
                            'message'=>'success'
                        ],200);
                    }
                }
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
        
        if ($request->logo != '') {
            $image = $request->file('logo');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('logo'));
            $upload_path1 = public_path()."/images/";

            $exist = Vendor::where('slug',$request->slug)->first();
            \File::delete(public_path('images/' . $exist->logo));

            $data = Vendor::where('slug',$request->slug)->update([
                'brand_name'=>$request->brand_name,
                'multi_vendor'=>$request->multi_vendor,
                'logo'=>$new_name,
                'slug'=>$request->brand_name,
            ]);
            if($data){
                $img->save($upload_path1.$new_name);

                toast('Vendor Updated successfully','success')
                ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                return response()->json([
                    'message'=>'success'
                ],200);
            }
        }else{
            $data = Vendor::where('slug',$request->slug)->update([
                'brand_name'=>$request->brand_name,
                'multi_vendor'=>$request->multi_vendor,
                'slug'=>$request->brand_name,
            ]);
            if($data){
                toast('Vendor Updated successfully','success')
                ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                return response()->json([
                    'message'=>'success'
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
    public function destroy($slug)
    {
        $id = Vendor::where('slug',$slug)->first();
        $id->delete();
        toast('Vendor Delete successfully','success')
        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return redirect()->back();
    }
}
