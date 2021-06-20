<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index')->with('productlist',product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imagename = "unknown";
        $current_date_time = Carbon::now()->timestamp;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $imagename = $current_date_time.".".$file->getClientOriginalExtension();

            if($file->move('upload', $imagename)){
                echo "Succes";
            }else{
                echo "Error Uploading image";
            }
        }else{
            echo "File not found!";
        }
        product::insert([
            'pname'=>$request->pname,
            'brand'=>$request->brand,
            'pimage'=>$imagename
        ]);

        echo "Product Inserted Sucessfully";
        return redirect('/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        return view('product.show')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        return view('product.edit')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        $product = product::find($product['id']);
        $product->pname = $request->pname;
        $product->brand = $request->brand;
        $product->save();
        echo "Product Updated Sucessfully";
        return redirect('/product');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $product->delete();
        $path = "upload/".$product['pimage'];
        echo storage_path();
        // if(Storage::exists('$path')){
        //     Storage::delete('$path');
        // }else{
        //     dd('File does not exists.');
        // }
        //return redirect('/product');
    }
}
