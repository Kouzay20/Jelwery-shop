<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

// use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customerregister(){
        return view ('customers.customerregister');
    }

    public function customerlogin(){
        return view ('customers.customerlogin');
    }

    public function registerProcess(Request $request)
    {
        $cus = new Customer();
        $cus -> customerEmail = $request->email;
        $cus -> customerPass  = Hash::make($request->password);
        $cus -> customerName = $request->name;
        $cus -> customerAddress = $request->address;
        $cus -> customerPhone = $request->phone;
        $cus -> customerPhoto = $request->photo;
        $cus->save();
        return redirect('customers/customerlogin');

    }

    public function loginProcess(Request $request)
    {
        $cus = Customer::where('customerEmail','=',$request->email)->first();
        if($cus) {
            if(Hash::check($request->password,$cus->customerPass)) {
                $request->Session()->put('customerEmail',$cus->customerEmail);
                $request->Session()->put('customerPass',$cus->customerPass);
                $request->Session()->put('customerName',$cus->customerName);

                // $request->Session()->put('customerPhoto',$cus->customerPhoto);
                return redirect('customers/customerhomepage');
            } else {
                return back()->with('fail','Password not matches!');
            }
        } else {
            return back()->with('fail','The email is not registered');
        }
    }

    public function logout()
    {
        {

            Session::pull('customerEmail');


            Session::pull('customerName');


            Session::pull('customerPass');

            return redirect('customers/customerhomepage');
        }
    }
}
