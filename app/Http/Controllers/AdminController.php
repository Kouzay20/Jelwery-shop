<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Models\Admin;


class AdminController extends Controller
{
    public function adminindex()
    {
        return view ('admin.adminindex');
    }

    public function adminlogin()
    {
        return view('admin.adminlogin');
    }

    public function checkLogin(Request $request)
    {
      
        $admin = Admin::where('adminID','=',$request->adminID)->first();
       
        if($admin){
            if($admin->adminpassword == $request->adminPass){
                $request->session()->put('adminID',$admin->adminID);
                $request->session()->put('adminname ',$admin->adminname);
                $request->session()->put('adminPhoto',$admin->adminPhoto);
                return redirect('admin/adminindex');
            }else{
                return back()->with('fail','Password input invalid');
            }

        }else{
            return back()->with('fail','admin is not existed');
        }
    }

    public function logout(){
        if(Session::has('adminID'))
        Session::pull('adminID');
        if(Session::has('adminname'))
        Session::pull('adminname');
        if(Session::has('adminPhoto'))
        Session::pull('adminPhoto');

        return redirect('admin/adminlogin');
    }


     /*Admin manage*/
    public function adminShow(){
        {
            $data= Admin::all();
            return view('admin.adminlist',compact('data'));
        }
        
    }

    public function adminadd(){
        $admin = Admin::get();
        return view('admin.adminadd',compact('admin'));
    }
    // public function adminadd(Request $request)
    // {
    //     $ad = new Admin();
    //     $ad -> adminID = $request->id;
    //     $ad -> adminname = $request->name;
    //     $ad -> adminpassword  = Hash::make($request->password);

    //     $ad -> adminPhoto = $request->photo;
    //     $cus->save();
    //     return redirect('admin/adminlogin');

    // }


    public function save(Request $request)
    {
        $ad= new Admin();
        $ad->adminID = $request->adminID;
        $ad->adminname = $request ->adminname;
        $ad->adminpassword = $request->adminpassword;
        $ad->adminPhoto = $request->adminPhoto;
        
        $ad->save();
        return redirect()->back()->with('success','added successfully');
    }
    
    public function admindelete($aid)
    {
        Admin::where('adminID','=',$aid)->delete();
        return redirect()->back()->with('success','Product deleted successfully!');
    }

    public function EditAdmin($aid)
    {
        $data = Admin::where('adminID', '=', $aid)->first();
        // $category = Category::get();
        return view('admin.adminedit', compact('data'));
    }

    public function adminupdate(Request $request)
    {
        Admin::where('adminID', '=', $request->id)->update([
            'adminname' =>$request->name,
            'adminpassword' => $request->password,
            'adminPhoto' => $request->photo,
            
            // 'productdetail' => $request->details,
            // 'catID' => $request->category
        ]);
        return redirect()->back()->with('success','Admin updated successfully!');
    }
    
}
