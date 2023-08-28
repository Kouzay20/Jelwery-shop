<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Product;
Use App\Models\Category;
use PhpParser\Node\Stmt\Return_;
use App\Models\Customer;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{


   /*Customer*/
    public function customerhomepage()
    {
        $data = Product::select('products.*', 'categories.catName')
        -> join('categories', 'products.catID', '=', 'categories.catID')->get();
        return view('customers.customerhomepage',compact('data'));
    }

    public function products()
    {
        $data = Product::select('products.*', 'categories.catName')
        -> join('categories', 'products.catID', '=', 'categories.catID')->get();
        return view('customers.products',compact('data'));
    }

    public function contact()
    {
        $data = Product::select('products.*', 'categories.catName')
        -> join('categories', 'products.catID', '=', 'categories.catID')->get();
        return view('customers.contact',compact('data'));

    }

    public function productsdetail()
    {
        $data = Product::select('products.*', 'categories.catName')
        -> join('categories', 'products.catID', '=', 'categories.catID')->get();
        return view('customers.productsdetail',compact('data'));
    }

    public function checkout()
    {
        $data = Product::select('products.*', 'categories.catName')
        -> join('categories', 'products.catID', '=', 'categories.catID')->get();
        return view('customers.checkout',compact('data'));

    }


    /*Admin*/

    /*Product managge*/
    public function productsAdmin()
    {
        $data = Product::select('products.*', 'categories.catName')
        -> join('categories', 'products.catID', '=', 'categories.catID')->get();
        return view('admin.productlist',compact('data'));
    }

    public function productsAdd(){
        $category = Category::get();
        return view('admin.productadd',compact('category'));
    }

    public function save(request $request)
    {
        $pro = new Product();
        $pro->proID = $request ->id;
        $pro->productname = $request->name;
        $pro->productprice = $request->price;
        $pro->productimage = $request->image;
        $pro->productdetail =$request->details;
        $pro->catID= $request ->category;
        $pro->save();
        return redirect()->back()->with('success','added successfully');
    }

    public function productedit($id)
    {
        $data = Product::where('proID', '=', $id)->first();
        $category = Category::get();
        return view('admin.productedit', compact('data','category'));
    }

    public function update(Request $request)
    {
        Product::where('proID', '=', $request->id)->update([
            'productname' => $request->name,
            'productprice' => $request->price,
            'productimage' => $request->image,
            'productdetail' => $request->details,
            'catID' => $request->category
        ]);
        return redirect()->back()->with('success','Product updated successfully!');
    }

    public function delete($id)
    {
        Product::where('proID','=',$id)->delete();
        return redirect()->back()->with('success','Product deleted successfully!');
    }




    /*Customer manage*/
    public function Customershow()
    {
        $data = Customer::all();
        return view('admin.customerlist',compact('data'));
    }

    public function customersave(request $request)
    {
        $cus = new Customer();
        $cus->customerEmail = $request ->id;
        $cus->customerName = $request->name;
        $cus->customerAddress = $request->address;
        $cus->customerPhone = $request->phone;
        $cus->customerPhoto = $request->photo;
        // $cus->productdetail =$request->details;
        // $cus->catID= $request ->category;
        $cus->save();
        return redirect()->back()->with('success','added successfully');
    }

    public function customerdelete($cid)
    {
        Customer::where('customerEmail','=',$cid)->delete();
        return redirect()->back()->with('success','Product deleted successfully!');
    }

    public function EditCustomer($cid)
    {
        $data = Customer::where('customerEmail', '=', $cid)->first();
        // $category = Category::get();
        return view('admin.customeredit', compact('data'));
    }

    public function customerupdate(Request $request)
    {
        Customer::where('customerEmail', '=', $request->id)->update([
            'customerName' => $request->name,
            'customerAddress' => $request->address,
            'customerPhone' => $request->phone,
            'customerPhoto' => $request->photo,
        ]);
        return redirect()->back()->with('success','Customer updated successfully!');
    }






}

