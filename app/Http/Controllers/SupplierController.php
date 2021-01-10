<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Supplier;
use Carbon\Carbon;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Supplier::all();
        return $employees;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'email' => 'required|unique:suppliers',
            'phone' => 'required|unique:suppliers|min:5|max:15',
        ]);

        if ($request->image) {
            $position = strpos($request->image, ';');  // ; er ager string full ta nibe.
            $string = substr($request->image, 0, $position); // ager line a joto ta charecter paise oi charecter ta nibe
            $extension = explode('/', $string)[1]; // '/' er por theke extionsion ta nibe.
            $image_name = time().".".$extension;
            $img = Image::make($request->image)->resize(250,200);
            $upload_path = 'backend/suppliers_photo/';
            $image_url = $upload_path.$image_name;
            $img->save($image_url);

            Supplier::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $image_url,
                'shop_name' => $request->shop_name,
                'created_at' => Carbon::now()
            ]);
        } else {
            Supplier::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shop_name' => $request->shop_name,
                'created_at' => Carbon::now()
            ]);
        }
        return "Employee inserted successfully.";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::where('id', $id)->get()->first();
        return response()->json($supplier);
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
        $request->validate([
            'name' => 'required|min:2|max:255',
            'email' => 'required|unique:suppliers,email,' .$id,
            'phone' => 'required|unique:suppliers,phone,' .$id,
        ]);

        if ($request->new_image) {
            $position = strpos($request->new_image, ';');  // ; er ager string full ta nibe.
            $string = substr($request->new_image, 0, $position); // ager line a joto ta charecter paise oi charecter ta nibe
            $extension = explode('/', $string)[1]; // '/' er por theke extionsion ta nibe.
            $image_name = time().".".$extension;
            $img = Image::make($request->new_image)->resize(250,200);
            $upload_path = 'backend/suppliers_photo/';
            $image_url = $upload_path.$image_name;
            if (Supplier::find($id)->image) {
                $unlink_location = 'public/'.Supplier::find($id)->image;
                unlink(base_path($unlink_location));
            }
            $img->save($image_url);

            Supplier::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $image_url,
                'shop_name' => $request->shop_name,
                'created_at' => Carbon::now()            ]);
        } else {
            Supplier::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shop_name' => $request->shop_name,
                'created_at' => Carbon::now()

            ]);
        }
        return "Supplier updated successfully.";        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Supplier::where('id', $id)->get()->first();
        $image = $employee->image;
        if ($image) {
            Supplier::find($id)->delete();
            unlink($image);
        } else {
            Supplier::find($id)->delete();
        }
        return "Supplier deleted successfully.";
    }
}
