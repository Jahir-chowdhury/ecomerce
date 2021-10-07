<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use Image;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('layouts.backend.category.categories',[
            'data'=>$data,
            'categories'=>$categories,
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
            'cat_name' => 'required|unique:categories',
            'icon' => 'required',
            'cover' => 'required'

        ]);

        
        if ($validator->fails()) {
            return response()->json([
                'errors'=> $validator->messages()->all()
            ]);
        }else{
            $image1 = $request->file('icon');
            $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
            $img1 = Image::make($request->file('icon'));
            $upload_path1 = public_path()."/images/";
            
            $image = $request->file('cover');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('cover'));
            $upload_path = public_path()."/images/";

            if($new_name){
                $data = Category::create([
                    'cat_name'=>$request->cat_name,
                    'icon'=>$new_name1,
                    'cover'=>$new_name,
                    'slug'=>Str::slug($request->cat_name)
                ]);
                if($data){
                    $img1->save($upload_path1.$new_name1);
                    $img->save($upload_path.$new_name);
                    
                    toast('Category upload successfully','success')
                    ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                    return response()->json([
                        'message'=>'success'
                    ]);
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

   
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cat_name' => 'required'

        ]);
        
        $cat = Category::find($request->id);
        
        if ($validator->fails()) {
            return response()->json([
                'errors'=> $validator->messages()->all()
            ]);
        }elseif($request->file('cover') != $cat->cover && $request->file('icon') != $cat->icon && $request->cat_name != $cat->cat_name){

            $image1 = $request->file('icon');
            $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
            $img1 = Image::make($request->file('icon'));
            $upload_path1 = public_path()."/images/";
            \File::delete(public_path('images/' . $cat->icon));
            
            $image = $request->file('cover');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('cover'));
            $upload_path = public_path()."/images/";
            \File::delete(public_path('images/' . $cat->cover));
            
            if($new_name){
                $data = $cat->update([
                    'cat_name'=>$request->cat_name,
                    'icon'=>$new_name1,
                    'cover'=>$new_name,
                    'slug'=>Str::slug($request->cat_name)
                ]);
                if($data){
                    $img1->save($upload_path1.$new_name1);
                    $img->save($upload_path.$new_name);

                    toast('Category update successfully','success')
                    ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                    return response()->json([
                        'message'=>'success'
                    ]);
                }
            }
        }elseif($request->file('cover') != null && $request->file('icon') != null && $request->cat_name == $cat->cat_name){

            $image1 = $request->file('icon');
            $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
            $img1 = Image::make($request->file('icon'));
            $upload_path1 = public_path()."/images/";
            \File::delete(public_path('images/' . $cat->icon));
            
            $image = $request->file('cover');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('cover'));
            $upload_path = public_path()."/images/";
            \File::delete(public_path('images/' . $cat->cover));
            
            if($new_name){
                $data = $cat->update([
                    'icon'=>$new_name1,
                    'cover'=>$new_name
                ]);
                if($data){
                    $img1->save($upload_path1.$new_name1);
                    $img->save($upload_path.$new_name);

                    toast('Category update successfully','success')
                    ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                    return response()->json([
                        'message'=>'success'
                    ]);
                }
            }
        }elseif($request->file('cover') != null && $request->file('icon') == null && $request->cat_name == $cat->cat_name){

            $image = $request->file('cover');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('cover'));
            $upload_path = public_path()."/images/";
            \File::delete(public_path('images/' . $cat->cover));
            
            if($new_name){
                $data = $cat->update([
                    'cover'=>$new_name,
                    'slug'=>Str::slug($request->cat_name)
                ]);
                if($data){
                    $img->save($upload_path.$new_name);

                    toast('Category update successfully','success')
                    ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                    return response()->json([
                        'message'=>'success'
                    ]);
                }
            }
        }elseif($request->file('cover') == null && $request->file('icon') != null && $request->cat_name == $cat->cat_name){

            $image = $request->file('icon');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('icon'));
            $upload_path = public_path()."/images/";
            \File::delete(public_path('images/' . $cat->icon));
            
            if($new_name){
                $data = $cat->update([
                    'icon'=>$new_name
                ]);
                if($data){
                    $img->save($upload_path.$new_name);

                    toast('Category update successfully','success')
                    ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                    return response()->json([
                        'message'=>'success'
                    ]);
                }
            }
        }elseif($request->file('cover') == null && $request->file('icon') == null && $request->cat_name != $cat->cat_name){
            
            
            $data = $cat->update([
                'cat_name'=>$request->cat_name,
                'slug'=>Str::slug($request->cat_name)
            ]);
            

            toast('Category update successfully','success')
            ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
            return response()->json([
                'message'=>'success'
            ]);
                
         
        }
    }

    public function active(Request $request)
    {
        $category = Category::find($request->id);
        
        if($request->val == null){
            $category->explor = 1;
            $category->save();
            
            toast('Category explor successfully','success')
        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        
        }else{
            $category->status = 1;
            $category->save();
        toast('Category Active successfully','success')
        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        }
        return response()->json([
            'message'=>'success'
        ]);
    }
    public function inactive(Request $request)
    {
        $category = Category::find($request->id);
        
        if($request->val == null){
            $category->explor = 0;
            $category->save();
            
            toast('Category not explored.','success')
        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        
        }else{
            $category->status = 0;
            $category->explor = 0;
            $category->save();
        toast('Category de-active successfully','success')
        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        }
        return response()->json([
            'message'=>'success'
        ]);
    }
    public function destroy(Request $request)
    {
        $category = Category::find($request->id);
        $category->status = 0;
        $category->save();
        toast('Category delete successfully','success')
        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return response()->json([
            'message'=>'success'
        ]);
    }
}
