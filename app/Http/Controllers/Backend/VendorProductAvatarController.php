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
use App\Models\VendorProductAvatar;
use Image;
use Illuminate\Support\Facades\Validator;

class VendorProductAvatarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = VendorProductAvatar::select('vendor_product_id')->get();
        
        return response()->json([
            'data'=>$data,
        ],200);
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


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'vendor_product_name' => 'required',
            'front' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors'=> $validator->messages()->all()
            ]);
        }elseif($request->file('front') != null && $request->file('back') == null &&
        $request->file('left') == null && $request->file('right') == null
        ){
            $image = $request->file('front');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('front'));
            $upload_path = public_path()."/images/";

            if($new_name){
                $data = VendorProductAvatar::create([
                    'vendor_product_id'=>$request->vendor_product_name,
                    'front'=>$new_name,
                    'back'=>'',
                    'left'=>'',
                    'right'=>'',
                    'slug'=>$new_name
                ]);
                if($data){
                    $img->save($upload_path.$new_name);

                    toast('Product image upload successfully','success')
                    ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }
        }elseif($request->file('front') != null && $request->file('back') != null &&
        $request->file('left') != null && $request->file('right') != null
        ){

            $image = $request->file('front');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('front'));
            $upload_path = public_path()."/images/";

            $image2 = $request->file('back');
            $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
            $img2 = Image::make($request->file('back'));
            $upload_path2 = public_path()."/images/";

            $image3 = $request->file('left');
            $new_name3 = rand() . '.' . $image3->getClientOriginalExtension();
            $img3 = Image::make($request->file('left'));
            $upload_path3 = public_path()."/images/";

            $image4 = $request->file('right');
            $new_name4 = rand() . '.' . $image4->getClientOriginalExtension();
            $img4 = Image::make($request->file('right'));
            $upload_path4 = public_path()."/images/";

            if($new_name){
                $data = VendorProductAvatar::create([
                    'vendor_product_id'=>$request->vendor_product_name,
                    'front'=>$new_name,
                    'back'=>$new_name2,
                    'left'=>$new_name3,
                    'right'=>$new_name4,
                    'slug'=>$new_name
                ]);
                if($data){
                    $img->save($upload_path.$new_name);
                    $img2->save($upload_path2.$new_name2);
                    $img3->save($upload_path3.$new_name3);
                    $img4->save($upload_path4.$new_name4);

                    toast('Product image upload successfully','success')
                    ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }
        }
    }


    public function showAvatar($slug)
    {
        $data = auth()->user();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        $product = VendorProduct::where('slug',$slug)->first();
        $images = VendorProductAvatar::where('vendor_product_id',$product->id)->with('get_vendor_product')->get();
        return view('layouts.backend.vendor.productAvatar',[
            'data'=>$data,
            'images'=>$images,
            'validVendor'=>$validVendor
        ]);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {

        $data = VendorProductAvatar::where('slug',$request->slug)->first();

        if($request->file('front') != null && $request->file('back') != null &&
            $request->file('left') != null && $request->file('right') != null
        ){

            $image = $request->file('front');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('front'));
            $upload_path = public_path()."/images/";

            $image2 = $request->file('back');
            $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
            $img2 = Image::make($request->file('back'));
            $upload_path2 = public_path()."/images/";

            $image3 = $request->file('left');
            $new_name3 = rand() . '.' . $image3->getClientOriginalExtension();
            $img3 = Image::make($request->file('left'));
            $upload_path3 = public_path()."/images/";

            $image4 = $request->file('right');
            $new_name4 = rand() . '.' . $image4->getClientOriginalExtension();
            $img4 = Image::make($request->file('right'));
            $upload_path4 = public_path()."/images/";

            \File::delete(public_path('images/' . $data->front));
            \File::delete(public_path('images/' . $data->back));
            \File::delete(public_path('images/' . $data->left));
            \File::delete(public_path('images/' . $data->right));

            if($new_name && $new_name2 && $new_name3 && $new_name4)
            {
                $data = VendorProductAvatar::where('slug',$request->slug)->update([
                    'front'=>$new_name,
                    'back'=>$new_name2,
                    'left'=>$new_name3,
                    'right'=>$new_name4,
                    'slug'=>$new_name
                ]);
                if($data){
                    $img->save($upload_path.$new_name);
                    $img2->save($upload_path2.$new_name2);
                    $img3->save($upload_path3.$new_name3);
                    $img4->save($upload_path4.$new_name4);

                    toast('Product image update successfully','success')
                    ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }

        }elseif($request->file('front') != null && $request->file('back') == null &&
        $request->file('left') == null && $request->file('right') == null){
            $image = $request->file('front');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('front'));
            $upload_path = public_path()."/images/";

            \File::delete(public_path('images/' . $data->front));

            if($new_name)
            {
                $data = VendorProductAvatar::where('slug',$request->slug)->update([
                    'front'=>$new_name,
                    'slug'=>$new_name
                ]);
                if($data){
                    $img->save($upload_path.$new_name);

                    toast('Product image update successfully','success')
                    ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }
        }else{
            Alert::error('Opps...', 'Please fillup all field');
            return response()->json([
                'message'=>'success'
            ],200);
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
        $data = VendorProductAvatar::where('slug',$slug)->first();
        $data->delete();
        \File::delete(public_path('images/' . $data->avatar));

        toast('Product Image Delete Successfully','success')
        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return redirect()->back();
    }
}
