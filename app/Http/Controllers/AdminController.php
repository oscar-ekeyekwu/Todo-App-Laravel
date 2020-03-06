<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Repositories\DepartmentsRepositoryInterface;
use App\Repositories\AdminsRepositoryInterface;
use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    protected $departments;
    protected $users;

    public function __construct(AdminsRepositoryInterface $users, DepartmentsRepositoryInterface $departments)
    {

        $this->departments = $departments;
        $this->users = $users;
    }

    public function index()
    {
        $users = $this->users->allUsers();
        return view('admin.show', compact('users'));
    }

    public function edit($userId)
    {
        $user = $this->users->getUser($userId);
        $userType = \App\UsersType::all();
        $departments = $this->departments->all_departments();
        return view('admin.editUser', compact(['user', 'userType', 'departments']));
    }

    public function destroy($userId)
    {
        $this->users->destroy($userId);
        return response()->json(['success' => 'User Deleted Successfully']);
    }

    public function create()
    {
        $userType = \App\UsersType::all();
        return view('admin.register', compact('userType'));
    }

    public function store()
    {

        $attr = request()->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'max:255'],
            'userTypeId' => ['required'],
            'password' => ['required', 'min:6', 'confirmed']
        ]);
        try {
            User::create([
                'name' => $attr['name'],
                'email' => $attr['email'],
                'user_type_id' => $attr['userTypeId'],
                'password' => Hash::make($attr['password'])
            ]);
        } catch (\Exception $sqle) {
            return back()->with('error', 'User Not Created due to ' . $sqle);
        }
        return redirect('/admins')->with('status', 'User Created Successfully');
    }

    public function update($userId)
    {
        $attr = request()->all();
        $this->users->updateUser($userId, $attr);

        return redirect('/admins')->with('success', 'User Record Updated Successfully');
    }
}
