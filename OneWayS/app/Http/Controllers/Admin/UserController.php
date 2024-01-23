<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private $user;
    private $role;

    public function __construct(User $u, Role $role)
    {
        $this->user = $u;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Role::with('customUsers')->get();

        var_dump($users);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->role->all()->groupBy('group');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $dataRequest = $request->all();

            $dataRequest['password'] = Hash::make($request->password);

            if (isset($createData['image']) && $createData['image'] != null) {
                $dataRequest['avatar'] = $this->user->saveImage($request);
            }

            $user = $this->user->create($dataRequest);
            $user->roles()->attach($dataRequest['role_id']);

            return to_route('users.index')->with(['message-success', 'Thêm dữ liệu thành công']);
        } catch (\Exception $e) {
            // Xử lý nếu có lỗi
            $errorMessage = $e->getMessage();
            var_dump($errorMessage);
            die;
            // Chuyển hướng về trang tạo mới vai trò với thông báo lỗi
            return redirect()->route('users.create')->with(['message-error' => $errorMessage]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
