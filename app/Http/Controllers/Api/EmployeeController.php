<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        DB::beginTransaction();

        try {
            $employee = Employee::create($validated);
            DB::commit();

            return response()->json([
                'message' => 'Successfully Created!',
                'employee' => new EmployeeResource($employee),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
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

        DB::beginTransaction();

        try {
            $employee->update($validated);
            DB::commit();

            return response()->json([
                'message' => 'Sucessfully Updated!',
                'employee' => new EmployeeResource($employee),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }


    }

    public function destroy($id) {
        $employee = Employee::find($id);

        DB::beginTransaction();

        try {
            $employee->delete();
            DB::commit();

            return response()->json([
                'message' => 'Employee Deleted!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }

    }
}
