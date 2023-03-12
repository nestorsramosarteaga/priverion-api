<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\V1\EmployeeResource;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        return EmployeeResource::collection(Employee::latest()->get());
    }

    public function store(StoreEmployeeRequest $request)
    {
        $fields = $request->all();

        try {
            $employee = new Employee($fields);
            $employee->save();

            return response()->json([
                'message'=>'Employee Created Successfully!!',
                'data' => new EmployeeResource($employee)
            ]);
        
        } catch (\Exception $e){
            return response()->json([
                'message'=>'Something went wrong while creating an employee!',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $fields = $request->all();

        try {
            $employee->update($fields);

            return response()->json([
                'message'=>'Employee Updated Successfully!!',
                'data' => new EmployeeResource($employee)
            ]);

        } catch (\Exception $e){
            return response()->json([
                'message'=>'Something went wrong while updating an employee!',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Employee $employee)
    {
        if($employee->delete()) {
            return response()->json([
                'message' => 'The employee was deleted successfully'
            ], 204);
        }
        return response()->json([
            'message' => 'Not Found'
        ], 404);
    }
}
