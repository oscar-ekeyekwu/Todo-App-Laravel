<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->authorizeResource(Status::class, 'status');
    }
    public function index()
    {
        $statuses = \App\Status::all();
        return view('admin.status.view', compact('statuses'));
    }

    public function store()
    {

        $attr = request()->all();
        
        if ($attr['active'] == 'yes') {
            $attr['active'] = 1;
        } else {
            $attr['active'] = 0;
        }

        Status::create($attr);
        return response()->json(['info' => 'Status Created Successfully']);
    }

    public function edit($statusId)
    {
        $status = Status::findOrFail($statusId);
        return response()->json([
            'name' => $status['name'],
            'bgColor' => $status['bgColor'],
            'textColor' => $status['textColor'],
            'active' => $status['active']
        ]);
    }

    public function update($statusId)
    {
        $attr = request()->all();
        if ($attr['active'] == 'yes') {
            $attr['active'] = 1;
        } else {
            $attr['active'] = 0;
        }
        Status::findOrFail($statusId)->update($attr);

        return response()->json(['info' => 'Status Updated Successfully']);
    }

    public function destroy($statusId)
    {
        Status::findOrFail($statusId)->delete($statusId);
        return response()->json(['info' => 'Status Deleted Successfully']);
    }
}
