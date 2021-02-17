<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Image;
use Carbon\Carbon;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Product::all();
        $products = DB::table('products')
            ->join('categories','products.category_id','categories.id')
            ->join('suppliers','products.supplier_id', 'suppliers.id')
            ->select('categories.category_name','suppliers.name','products.*')
            ->orderBy('products.id', 'DESC')
            ->get();

        return response()->json($products);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());
        $request->validate([
            'category_id' => 'required',
            'product_name' => 'required|min:2|max:100|unique:products',
            'buying_price' => 'required',
            'supplier_id' => 'required',
        ]);

        if ($request->image) {
            $position = strpos($request->image, ';');  // ; er ager string full ta nibe.
            $string = substr($request->image, 0, $position); // ager line a joto ta charecter paise oi charecter ta nibe
            $extension = explode('/', $string)[1]; // '/' er por theke extionsion ta nibe.
            $image_name = time().".".$extension;
            $img = Image::make($request->image)->resize(250,200);
            $upload_path = 'backend/product_photo/';
            $image_url = $upload_path.$image_name;
            $img->save($image_url);

            Product::insert([
                'category_id' => $request->category_id,
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'root' => $request->root,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'supplier_id' => $request->supplier_id,
                'buying_date' => $request->buying_date,
                'image' => $image_url,
                'product_quantity' => $request->product_quantity,
                'created_at' => Carbon::now()
            ]);
        } else {
            Product::insert([
                'category_id' => $request->category_id,
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'root' => $request->root,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'supplier_id' => $request->supplier_id,
                'buying_date' => $request->buying_date,
                'product_quantity' => $request->product_quantity,
                'created_at' => Carbon::now()
            ]);
        }
        return "Product inserted successfully.";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Product::where('id', $id)->get()->first());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->buying_price;
        $request->validate([
            'category_id' => 'required',
            'product_name' => 'required|min:2|max:100|unique:products,product_name,' .$id,
            'buying_price' => 'required',
            'supplier_id' => 'required',
        ]);
        // return $request->all();
        if ($request->new_image) {
            $position = strpos($request->new_image, ';');  // ; er ager string full ta nibe.
            $string = substr($request->new_image, 0, $position); // ager line a joto ta charecter paise oi charecter ta nibe
            $extension = explode('/', $string)[1]; // '/' er por theke extionsion ta nibe.
            $image_name = time().".".$extension;
            $img = Image::make($request->new_image)->resize(250,200);
            $upload_path = 'backend/product_photo/';
            $image_url = $upload_path.$image_name;
            if (Product::find($id)->image) {
                $unlink_location = 'public/'.Product::find($id)->image;
                unlink(base_path($unlink_location));
            }
            $img->save($image_url);

            Product::find($id)->update([
                'category_id' => $request->category_id,
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'root' => $request->root,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'supplier_id' => $request->supplier_id,
                'buying_date' => $request->buying_date,
                'image' => $image_url,
                'product_quantity' => $request->product_quantity,
                'created_at' => Carbon::now()          
            ]);
        } else {
            Product::find($id)->update([
                'category_id' => $request->category_id,
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'root' => $request->root,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'supplier_id' => $request->supplier_id,
                'buying_date' => $request->buying_date,
                'product_quantity' => $request->product_quantity,
                'created_at' => Carbon::now()

            ]);
        }
        return "Product updated successfully.";  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
