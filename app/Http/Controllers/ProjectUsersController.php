<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectUsers;
use App\Projects;
use Exception;
use PhpParser\Node\Expr\FuncCall;

class ProjectUsersController extends Controller
{
    public function store()
    {
        $userData = request()->all();


        $projectId = $userData['projects_id'];
        $userId = $userData['user_id'];

        $userHasProject = ProjectUsers::all()->where('projects_id', $projectId)->where('user_id', $userId)->count();

        if ($userHasProject > 0) {
            return response()
                ->json(['info' => 'User already exists on Project']);
        } else {

            ProjectUsers::create($userData);

            return response()->json(['info' => 'User Added To Project']);
        }
    }

    public function destroy($userId)
    {
        $userData = request()->all();
        $projectId = $userData['projects_id'];

        $userHasProject = ProjectUsers::all()->where('projects_id', $projectId)->where('user_id', $userId)->count();


        if ($userHasProject > 0) {
            try {
                ProjectUsers::where('user_id', $userId)->where('projects_id', $projectId)->delete($userId);
                return response()->json(['info' => 'User Removed from Project']);
            } catch (Exception $e) {
                return response()->json(['info' => $e->getMessage()]);
            }
        } else {
            return response()->json(['info' => 'User Does not Exist in this Project']);
        }
    }

    public function update($projectId)
    {
        $userIds = request('userIds');
        
        Projects::findOrFail($projectId)->users()->sync($userIds);
        return response()->json(['info' => 'Users In Project Successfully Updated']);
    }

    public function edit($projectId)
    {
        $usersInDept = Projects::find($projectId)->department->users;

        $userNameId = [];

        //Dynamincally create an associative array
        foreach ($usersInDept as $user) {
            $userNameId[] = ['username' => $user->name, 'userId' => $user->id];
        }
        return $userNameId;
    }
}
