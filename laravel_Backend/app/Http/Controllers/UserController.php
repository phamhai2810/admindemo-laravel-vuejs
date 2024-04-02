<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Contracts\Service\Attribute\Required;

class UserController extends Controller
{

    public function index()
    {
        $users = User::join('departments', 'users.department_id', '=', 'departments.id')
            ->join('users_status', 'users.status_id', '=', 'users_status.id')
            ->select('users.*', 'departments.name as departments', 'users_status.name as status')
            ->paginate();

        return response()->json($users);
    }
    
    public function show($id)
    {
        return User::findOrFail($id);
    }
    

    public function create()
    {
        $users_status = DB::table("users_status")
            ->select(
                "id as value",
                "name as label"
            )->get();
        $departments = DB::table("departments")
            ->select(
                "id as value",
                "name as label"
            )->get();

        return response()->json([
            "users_status" => $users_status,
            "departments" => $departments,
        ]);
    }

    //validation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'status_id' => 'required',
            'username' => 'required|unique:users,username',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'department_id' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ], [
            "status_id.required" => 'Vui lòng nhập tình trạng',

            "username.required" => 'Vui lòng nhập tên tài khoản',
            "username.unique" => 'Tên tài khoản đã tồn tại',

            "name.required" => 'Vui lòng nhập họ và tên',
            "name.max" => 'Ký tự tối đa là 255',

            "email.required" => 'Vui lòng nhập email',
            "email.email" => 'Email không hợp lệ',

            "department_id.required" => 'Vui lòng nhập phòng ban',
            "password.required" => 'Vui lòng nhập mật khẩu',
            "password.confirmed" => 'Mật khẩu và xác nhận mật khẩu không chính xác',

            'password_confirmation' => 'Vui lòng xác nhận mật khẩu',
        ]);

        //Eloquent ORM để add dữ liệu vào database từ request được nhập vào - cách 1
        // User::create([
        //     'status_id' => $request['status_id'],
        //     'username' => $request['username'],
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'department_id' => $request['department_id'],
        //     'password' => Hash::make($request['password']),
        // ]);

        //Add tất cả dữ liệu trừ password_confirmation vào database từ request được nhập vào - cách 2
        $user = $request->except(["password", "password_confirmation"]);
        $user["password"] = Hash::make($request["password"]);
        User::create($user);
    }

    public function edit($id)
    {
        $users = User::find($id);

        $users_status = DB::table("users_status")
            ->select(
                "id as value",
                "name as label"
            )->get();

        $departments = DB::table("departments")
            ->select(
                "id as value",
                "name as label"
            )->get();

        return response()->json([
            'users' => $users,
            "users_status" => $users_status,
            "departments" => $departments,
        ]);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status_id' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'name' => 'required|max:255',
            'email' => 'required|email',
            'department_id' => 'required',
        ], [
            "status_id.required" => 'Vui lòng nhập tình trạng',

            "username.required" => 'Vui lòng nhập tên tài khoản',
            "username.unique" => 'Tên tài khoản đã tồn tại',

            "name.required" => 'Vui lòng nhập họ và tên',
            "name.max" => 'Ký tự tối đa là 255',

            "email.required" => 'Vui lòng nhập email',
            "email.email" => 'Email không hợp lệ',

            "department_id.required" => 'Vui lòng nhập phòng ban',
        ]);

        User::find($id)->update([
            "status_id" => $request["status_id"],
            "username" => $request["username"],
            "name" => $request["name"],
            "email" => $request["email"],
            "department_id" => $request["department_id"]
        ]);

        if ($request["change_password"] == true) {
            $validated = $request->validate([
                "password" => 'required|confirmed',
            ], [
                "password.required" => 'Vui lòng nhập mật khẩu',
                "password.confirmed" => 'Mật khẩu và xác nhận mật khẩu không chính xác',

                "password_confirmation" => 'Vui lòng xác nhận mật khẩu',
            ]);

            User::find($id)->update([
                "password" => Hash::make($request["password"]),
                "change_password_at" => NOW()
            ]);
        }
    }

    public function destroy($id)
    {
        User::find($id)->delete();
    }
}
