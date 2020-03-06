<?php

namespace App\Http\Controllers;

use App\Departments;
use App\Repositories\DepartmentsRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    protected $departments;

    public function __construct(DepartmentsRepositoryInterface $departments)
    {
        $this->middleware('auth');
        $this->departments = $departments;
        $this->authorizeResource(Departments::class, 'departments');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = $this->departments->all_departments();

        return view('admin.departments.show', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $dept_details = request()->validate([
            'dept_name' => ['required', 'min:3'],
            'dept_code' => ['required', 'max:3']
        ]);

        try {
            $this->departments->store($dept_details);
        } catch (\Exception $e) {
            return redirect('/admin')->with('error', 'Department Not Created ' . $e);
        }

        return redirect('/departments')->with('success', 'Department Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function edit($dept_id)
    {
        $department = $this->departments->get_department($dept_id);
        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function update($dept_id)
    {
        $dept_attributes = request(['dept_name', 'dept_code']);
        $this->departments->updateDepartment($dept_id, $dept_attributes);
        return redirect('admin.departments')->with('success', 'Department successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function destroy($department_id)
    {
        $this->departments->destroy($department_id);
        return response()->json(['success' => 'Department Deleted Successfully']);
    }
}
