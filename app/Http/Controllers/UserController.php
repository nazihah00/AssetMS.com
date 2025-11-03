<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserRoleModel;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function list()
    {
        $getRecord = User::with(['role'])
                    ->where ('is_delete',0)
                    ->paginate(10);
        return view('auth.userlist', compact('getRecord'));
    }

    public function edit($id): View
    {
        $getRecord = User::findOrFail(base64_decode($id)); // Cari user, kalau tak jumpa → 404
        $getUserRole = UserRoleModel::all();
        return view('auth.edituser', compact('getRecord','getUserRole'));
    }

    public function update(Request $request, $id): RedirectResponse
    {

        $request->validate([
            'name' => 'required',
            'staff_num' => 'required|unique:users,staff_num,'.$id.',id',
            'department' => 'required',
            'phone_num' => 'required',
            'branch' => 'required',
            'user_role_id'=> 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'password' => 'nullable|min:8', // optional update password
        ]);
        
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->staff_num = $request->staff_num;
        $user->department = $request->department;
        $user->phone_num = $request->phone_num;
        $user->branch = $request->branch;
        $user ->user_role_id = $request->user_role_id;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('auth.userlist')->with('success', 'User updated successfully.');
    }

    public function delete($id):RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->is_delete = 1; 
        $user->save();
        
        return redirect() -> route('auth.userlist') ->with('success','User deleted sucessfully');
    }

}
