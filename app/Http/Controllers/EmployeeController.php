<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    const PATH_VIEW = 'employees.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Employee::latest('id')->paginate(5);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'        =>  'required|max:100',
            'last_name'         =>  'required|max:100',
            'email'             =>  ['required', 'string', 'max:150', Rule::unique('employees')],
            'phone'             =>  'required|max:15',
            'date_of_birth'     =>  'required',
            'hire_date'         =>  'required',
            'salary'            =>  'required',
            'is_active'         =>  ['nullable', Rule::in([0, 1])],
            'department_id'     =>  'required',
            'manager_id'        =>  'required',
            'address'           =>  'required|max:255',
            'profile_picture'   =>  'nullable|image|max:2048',
        ]);

        try {

            if ($request->hasFile('profile_picture')) {
                $data['profile_picture'] = Storage::put('employees', $request->file('profile_picture'));
            }

            Employee::query()->create($data);

            return redirect()
                ->route('employees.index')
                ->with('success', true);

        } catch (\Throwable $th) {

            if (!empty($data['profile_picture']) && Storage::exists($data['profile_picture'])) {
                Storage::delete($data['profile_picture']);
            }

            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'first_name'        =>  'required|max:100',
            'last_name'         =>  'required|max:100',
            'email'             =>  ['required', 'string', 'max:150', Rule::unique('employees')->ignore($employee->id)],
            'phone'             =>  'required|max:15',
            'date_of_birth'     =>  'required',
            'hire_date'         =>  'required',
            'salary'            =>  'required',
            'is_active'         =>  ['nullable', Rule::in([0, 1])],
            'department_id'     =>  'required',
            'manager_id'        =>  'required',
            'address'           =>  'required|max:255',
            'profile_picture'   =>  'nullable|image|max:2048',
        ]);

        try {

            $data['is_active'] ??= 0;

            if ($request->hasFile('profile_picture')) {
                $data['profile_picture'] = Storage::put('customers', $request->file('profile_picture'));
            }

            $currentPicture = $employee->profile_picture;

            $employee->update($data);

            if ($request->hasFile('profile_picture') && !empty($currentPicture) && Storage::exists($currentPicture)) {
                Storage::delete($currentPicture);
            }


            return back()->with('success', true);

        } catch (\Throwable $th) {

            if (!empty($data['profile_picture']) && Storage::exists($data['profile_picture'])) {
                Storage::delete($data['profile_picture']);
            }

            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {

            $employee->delete();

            return back()->with('success', true);

        } catch (\Throwable $th) {

            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());

        }
    }


    /**
     * Force remove the specified resource from storage.
     */
    public function forceDestroy(Employee $employee)
    {
        try {

            $employee->forceDelete();

            if (!empty($employee->profile_picture) && Storage::exists($employee->profile_picture)) {
                Storage::delete($employee->profile_picture);
            }

            return back()->with('success', true);

        } catch (\Throwable $th) {

            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
                
        }
    }
}
