<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        $employees = Employee::all();

        return response()->json(['employees' => EmployeeResource::collection($employees)]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'phone_no' => 'required|string',
            'address' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'job' => 'required|string',
        ]);

        $employee = Employee::create($validated);

        return response()->json([
            'message' => 'Successfully Created!',
            'employee' => new EmployeeResource($employee),
        ]);
    }

    public function show($id) {
        $employee = Employee::findOrFail($id);

        return response()->json(['employee' => new EmployeeResource($employee)]);
    }

    public function update(Request $request, $id) {
        $employee = Employee::find($id);
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email,'. $employee->id,
            'phone_no' => 'required|string',
            'address' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'job' => 'required|string',
        ]);

        $employee->update($validated);

        return response()->json([
            'message' => 'Sucessfully Updated!',
            'employee' => new EmployeeResource($employee),
        ]);

    }

    public function destroy($id) {
        $employee = Employee::find($id);
        $employee->delete();

        return response()->json([
            'message' => 'Employee Deleted!',
        ]);
    }
}
