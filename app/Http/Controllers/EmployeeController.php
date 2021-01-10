<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Employee;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
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
            'name' => 'required|max:255',
            'email' => 'required|unique:employees',
            'joining_date' => 'required',
        ]);

        if ($request->image) {
            $position = strpos($request->image, ';');  // ; er ager string full ta nibe.
            $string = substr($request->image, 0, $position); // ager line a joto ta charecter paise oi charecter ta nibe
            $extension = explode('/', $string)[1]; // '/' er por theke extionsion ta nibe.
            $image_name = time().".".$extension;
            $img = Image::make($request->image)->resize(250,200);
            $upload_path = 'backend/employees_photo/';
            $image_url = $upload_path.$image_name;
            $img->save($image_url);

            Employee::insert([
                'name' => $request->name,
                'email' => $request->email,
                'salary' => $request->salary,
                'address' => $request->address,
                'nid' => $request->nid,
                'joining_date' => $request->joining_date,
                'image' => $image_url,
                'description' => $request->description,
                'created_at' => Carbon::now()
            ]);
        } else {
            Employee::insert([
                'name' => $request->name,
                'email' => $request->email,
                'salary' => $request->salary,
                'address' => $request->address,
                'nid' => $request->nid,
                'joining_date' => $request->joining_date,
                'description' => $request->description,
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
        return response()->json(Employee::where('id', $id)->get()->first());
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
            'name' => 'required|max:255',
            'email' => 'required|unique:employees,email,' .$id,
            'joining_date' => 'required',
        ]);

        if ($request->new_image) {
            $position = strpos($request->new_image, ';');  // ; er ager string full ta nibe.
            $string = substr($request->new_image, 0, $position); // ager line a joto ta charecter paise oi charecter ta nibe
            $extension = explode('/', $string)[1]; // '/' er por theke extionsion ta nibe.
            $image_name = time().".".$extension;
            $img = Image::make($request->new_image)->resize(250,200);
            $upload_path = 'backend/employees_photo/';
            $image_url = $upload_path.$image_name;
            if (Employee::find($id)->image) {
                $unlink_location = 'public/'.Employee::find($id)->image;
                unlink(base_path($unlink_location));
            }
            $img->save($image_url);

            Employee::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'salary' => $request->salary,
                'address' => $request->address,
                'nid' => $request->nid,
                'joining_date' => $request->joining_date,
                'image' => $image_url,
                'description' => $request->description,
                'created_at' => Carbon::now()
            ]);
        } else {
            Employee::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'salary' => $request->salary,
                'address' => $request->address,
                'nid' => $request->nid,
                'joining_date' => $request->joining_date,
                'description' => $request->description,
                'created_at' => Carbon::now()
            ]);
        }
        return "Employee updated successfully.";

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $employee = Employee::where('id', $id)->get()->first();
        $image = $employee->image;
        if ($image) {
            Employee::find($id)->delete();
            unlink($image);
        } else {
            Employee::find($id)->delete();
        }
        return "Employee deleted successfully.";
    }
}
