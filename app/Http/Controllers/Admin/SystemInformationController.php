<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemInformation;
use Image;
use Auth;
use DB;
class SystemInformationController extends Controller
{

    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }


    public function index(){

        if (is_null($this->user) || !$this->user->can('systemInformationView')) {
            //abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
               }

               try{
               \LogActivity::addToLog('View System Information.');


        $systemInformation = SystemInformation::all();
        return view('admin.systemInformation.index',compact('systemInformation'));

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }


    }



    public function store(Request $request){

        if (is_null($this->user) || !$this->user->can('systemInformationAdd')) {
            //abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
               }

               try{
                DB::beginTransaction();
               \LogActivity::addToLog('System  Info Update.');

        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'url' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|string',
            'logo' => 'required',
            'icon' => 'required',
        ]);


        $time_dy = time().date("Ymd");


        $systemInformation =  new SystemInformation();
        $systemInformation->system_name = $request->name;
        $systemInformation->system_email = $request->email;
        $systemInformation->system_address = $request->address;
        $systemInformation->system_url = $request->url;
        $systemInformation->system_admin_url = $request->admin_url;
        $systemInformation->system_phone = $request->phone;
         if ($request->hasfile('logo')) {


            $productImage = $request->file('logo');
            $imageName = $time_dy.$productImage->getClientOriginalName();
            $directory = 'public/uploads/';
            $imageUrl = $directory.$imageName;

            $img=Image::make($productImage)->resize(187,32);
            $img->save($imageUrl);

             $systemInformation->system_logo =  'public/uploads/'.$imageName;

        }
        if ($request->hasfile('icon')) {


            $productImage = $request->file('icon');
            $imageName = $time_dy.$productImage->getClientOriginalName();
            $directory = 'public/uploads/';
            $imageUrl = $directory.$imageName;

            $img=Image::make($productImage)->resize(50,50);
            $img->save($imageUrl);

             $systemInformation->system_icon =  'public/uploads/'.$imageName;

        }
        $systemInformation->save();

        DB::commit();
    return redirect()->back()->with('success','Added Succesfully');


} catch (\Exception $e) {
    DB::rollBack();
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}

    }


    public function update(Request $request,$id){

        if (is_null($this->user) || !$this->user->can('systemInformationUpdate')) {
            //abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
               }

               try{
                DB::beginTransaction();
               \LogActivity::addToLog('System  Info Update.');

        $time_dy = time().date("Ymd");


        $systemInformation = SystemInformation::find($id);
        $systemInformation->system_name = $request->name;
        $systemInformation->system_email = $request->email;
        $systemInformation->system_address = $request->address;
        $systemInformation->system_phone = $request->phone;
        $systemInformation->system_url = $request->url;
        $systemInformation->system_admin_url = $request->admin_url;
         if ($request->hasfile('logo')) {


            $productImage = $request->file('logo');
            $imageName = $time_dy.$productImage->getClientOriginalName();
            $directory = 'public/uploads/';
            $imageUrl = $directory.$imageName;

            $img=Image::make($productImage)->resize(187,32);
            $img->save($imageUrl);

             $systemInformation->system_logo =  'public/uploads/'.$imageName;

        }
        if ($request->hasfile('icon')) {


            $productImage = $request->file('icon');
            $imageName = $time_dy.$productImage->getClientOriginalName();
            $directory = 'public/uploads/';
            $imageUrl = $directory.$imageName;

            $img=Image::make($productImage)->resize(50,50);
            $img->save($imageUrl);

             $systemInformation->system_icon =  'public/uploads/'.$imageName;

        }
        $systemInformation->save();

        DB::commit();
    return redirect()->back()->with('success','Updated Succesfully');

} catch (\Exception $e) {
    DB::rollBack();
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}


    }
}
