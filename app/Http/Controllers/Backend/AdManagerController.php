<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Vendor;
use App\Models\AdManager;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Image;

class AdManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = AdManager::all();
        $data = auth()->user();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        return view('layouts.backend.ad.adManager',[
            'data'=>$data,
            'ads'=>$ads,
            'validVendor'=>$validVendor
        ]);
    }
    public function get_ads()
    {
        $ads = AdManager::all();
        $position = AdManager::select('id','position')->get();
        $data = auth()->user();
        return response()->json([
            'data'=>$data,
            'ads'=>$ads,
            'position'=>$position
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'position' => 'required',
            'avatar' => 'required'

        ]);

        
        if ($validator->fails()) {
            return response()->json([
                'errors'=> $validator->messages()->all()
            ]);
        }else{
            $position = AdManager::where('position',$request->position)->first();

            if($position){
                return response()->json([
                    'match'=> $position
                ]);
            }else{
                if($request->position == "top"){
                    $image = $request->file('avatar');
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $img = Image::make($request->file('avatar'));
                    $upload_path = public_path()."/images/";
    
                    if($new_name){
                        $data = AdManager::create([
                            'avatar'=>$new_name,
                            'position'=>$request->position,
                            'slug'=>$new_name,
                            'link'=>$request->link
                        ]);
                        if($data){
                            $img->save($upload_path.$new_name);
    
                            toast('Ads upload successfully','success')
                            ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                            return response()->json([
                                'message'=>'success'
                            ]);
                        }
                    }else{
    
    
                    }
                }elseif($request->position == "popup"){
                    $image = $request->file('avatar');
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $img = Image::make($request->file('avatar'));
                    $upload_path = public_path()."/images/";
    
                    if($new_name){
                        $data = AdManager::create([
                            'avatar'=>$new_name,
                            'position'=>$request->position,
                            'slug'=>$new_name,
                            'link'=>$request->link
                        ]);
                        if($data){
                            $img->save($upload_path.$new_name);
    
                            toast('Ads upload successfully','success')
                            ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                            return response()->json([
                                'message'=>'success'
                            ]);
                        }
                    }else{
    
    
                    }
                }else{
                    $image = $request->file('avatar');
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $img = Image::make($request->file('avatar'));
                    $upload_path = public_path()."/images/";
    
                    if($new_name){
                        $data = AdManager::create([
                            'avatar'=>$new_name,
                            'position'=>$request->position,
                            'slug'=>$new_name,
                            'link'=>$request->link
                        ]);
                        if($data){
                            $img->save($upload_path.$new_name);
    
                            toast('Ads upload successfully','success')
                            ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                            return response()->json([
                                'status'=>200
                            ]);
                        }
                    }else{
    
    
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

        $ad = AdManager::where('slug',$request->slug)->first();
        
        if($request->file('avatar') != null)
        {
            if($request->position == "top"){
                $image = $request->file('avatar');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $img = Image::make($request->file('avatar'));
                $upload_path = public_path()."/images/";
                \File::delete(public_path('images/' . $ad->avatar));
                if($new_name){
                    $data = $ad->update([
                        'avatar'=>$new_name,
                        'slug'=>$new_name
                    ]);
                    if($data){
                        $img->save($upload_path.$new_name);

                        toast('Ads update successfully','success')
                        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                        return response()->json([
                            'message'=>'success'
                        ],200);
                    }
                }else{


                }
            }elseif($request->position == "popup"){
                $image = $request->file('avatar');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $img = Image::make($request->file('avatar'));
                $upload_path = public_path()."/images/";
                \File::delete(public_path('images/' . $ad->avatar));
                if($new_name){
                    $data = $ad->update([
                        'avatar'=>$new_name,
                        'slug'=>$new_name
                    ]);
                    if($data){
                        $img->save($upload_path.$new_name);

                        toast('Ads update successfully','success')
                        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                        return response()->json([
                            'message'=>'success'
                        ],200);
                    }
                }else{


                }
            }else{
                $image = $request->file('avatar');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $img = Image::make($request->file('avatar'));
                $upload_path = public_path()."/images/";
                \File::delete(public_path('images/' . $ad->avatar));
                if($new_name){
                    $data = $ad->update([
                        'avatar'=>$new_name,
                        'slug'=>$new_name
                    ]);
                    if($data){
                        $img->save($upload_path.$new_name);

                        toast('Ads update successfully','success')
                        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                        return response()->json([
                            'message'=>'success'
                        ],200);
                    }
                }else{


                }
            }

        }elseif($request->file('avatar') == null)
        {
            if($request->position == "top"){
                
                $data = $ad->update([
                    'link'=>$request->link
                ]);
                if($data){

                    toast('Ads update successfully','success')
                    ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }elseif($request->position == "popup"){
                $data = $ad->update([
                    'link'=>$request->link
                ]);
                if($data){

                    toast('Ads update successfully','success')
                    ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }else{
                $data = $ad->update([
                    'link'=>$request->link
                ]);
                if($data){

                    toast('Ads update successfully','success')
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
    public function destroy($id)
    {
        $id = AdManager::find($id);
        \File::delete(public_path('images/' . $id->avatar));
        $id->delete();

        toast('Ads delete successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

        return redirect()->back();
    }
}
