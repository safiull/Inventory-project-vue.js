<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salary;
use Carbon\Carbon;
use DB;

class SalaryController extends Controller
{
    public function salaryPaid(Request $request, $id)
    {
    	// return $request->salary;
    	$request->validate([
            'salary_month' => 'required',
        ]);

        $present_month = $request->salary_month;
        if (Salary::where('employee_id', $id)->where('salary_month', $present_month)->first()) {
        	return response()->json("Salary already given");
        } else {
        	Salary::insert([
	            'employee_id' => $id,
	            'amount' => $request->salary,
	            'salary_date' => date('d/m/y'),
	            'salary_month' => $present_month,
	            'salary_year' => date('Y'),
	            'created_at' => Carbon::now()
	        ]);
        }

        
        return "Salary given successfully.";
    }

    public function allSalary()
    {
    	return Salary::select('salary_month')->groupBy('salary_month')->get();
    }

    public function viewSalary($month)
    {	
    	return DB::table('salaries')
    		->join('employees', 'salaries.employee_id', 'employees.id')
    		->select('employees.name', 'salaries.*')
    		->where('salary_month', $month)
    		->get();
    }
}
