<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Newsletter_subscriber;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\About;


use Rap2hpoutre\FastExcel\FastExcel;

class AboutUsController extends Controller
{
    public function index(){
        $about = About::first();
        $validVendor = Vendor::where('user_id',auth()->user()->id??'')->first();
        $subscribers = Newsletter_subscriber::all();
        $data = auth()->user();
        return view('layouts.backend.settings.about_us',[
            'data'=>$data,
            'subscribers'=>$subscribers,
            'validVendor'=>$validVendor,
            'about'=>$about
        ]);
    }
    
    
    public function store(Request $request){
        $aboutId = About::select('id')->first();
        
        if($aboutId == null){
            About::create([
                'description'=>$request->description
            ]);
            
        }else{
            
            About::where('id',$request->id)->update([
                'description'=>$request->description
            ]);
                
        }
        
        toast('Changes saved successfully','success')
                ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return redirect()->back();
        
    }







    public function updateSubscriberStatus($id, $status){
        Newsletter_subscriber::where('id',$id)->update(['status'=>$status]);

        return redirect()->back()->with('success','Subscriber status has been updated');
    }

    public function deleteSubscriber($id){
        Newsletter_subscriber::where('id',$id)->delete();

        return redirect()->back()->with('success','Subscriber has been deleted');
    }

    public function exportSubscriber(){
        $subscribersData = Newsletter_subscriber::select('id','email','created_at')->where('status',1)->orderBy('id','Desc')->get();
        $subscribersData = json_decode(json_encode($subscribersData),true);

        return (new FastExcel($subscribersData))->download('file.xlsx');


        // return Excel::store('subscribers'.rand(),function($excel) use($subscribersData){
        //     $excel->sheet('mySheet',function($sheet) use($subscribersData){
        //         $sheet->fromArray($subscribersData);
        //     });
        // })->download('xlsx');
    }


}
