<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Vendor;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    // public function searchUser(Request $request)
    // {
    //     $search = $request->get('name');
    //     $data = auth()->user();
    //     $search_user = User::where('name','LIKE','%'.$search.'%')->get();
    //     if ($search_user) {
    //         return response()->json([
    //             'search_user'=>$search_user,
    //         ],200);
    //     }
    //     return view('layouts.backend.user.role_list',[
    //         'search_user'=>$search_user,
    //         'data'=>$data,
    //     ]);
       
    // }

    public function create()
    {
        $users = User::select('id','name','role','status')->get();
        $data = auth()->user();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        return view('layouts.backend.user.role_list',[
            'users'=>$users,
            'data'=>$data,
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
        User::where('name',$request->name)->update(['role'=>$request->role]);
        return redirect()->back();
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


    public function update(Request $request)
    {
        User::where('name',$request->editName)->update(['role'=>$request->editRole]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $role = 'user';
        $data = User::find($id);
        $data->role = $role;
        $data->save();
        return redirect()->back();
    }
}
