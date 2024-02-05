<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\CreateRolesRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy('group');
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRolesRequest $request)
    {
        try {
            $createData = $request->all();
     
            // Tạo mới vai trò
            $role = Role::create($createData);

            // Gắn quyền cho vai trò nếu tồn tại khóa 'permission_ids'
            if (isset($createData['permission_ids']) && $createData['permission_ids'] != null) {
                $role->permissions()->attach($createData['permission_ids']);
            }
            // Chuyển hướng về trang tạo mới vai trò với thông báo thành công
            return redirect()->route('roles.create')->with(['message-success' => 'Thêm thành công']);
        } catch (\Exception $e) {
            // Xử lý nếu có lỗi
            $errorMessage = $e->getMessage();
    
            // Chuyển hướng về trang tạo mới vai trò với thông báo lỗi
            return redirect()->route('roles.create')->with(['message-error' => $errorMessage]);
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
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::all()->groupBy('group');

        return view('admin.roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $role = Role::findOrFail($id);

            $dataUpdate = $request->all();
        
            $role->update($dataUpdate);

            // Gắn quyền cho vai trò nếu tồn tại khóa 'permission_ids'
            if (isset($dataUpdate['permission_ids']) && $dataUpdate['permission_ids'] != null) {
                $role->permissions()->sync($dataUpdate['permission_ids']);
            }
            // Chuyển hướng về trang tạo mới vai trò với thông báo thành công
            return redirect()->route('roles.index')->with(['roles-success' => 'Thêm thành công']);
        } catch (\Exception $e) {
            // Xử lý nếu có lỗi
            $errorMessage = $e->getMessage();
            
            // Chuyển hướng về trang tạo mới vai trò với thông báo lỗi
            return redirect()->route('roles.edit')->with(['roles-error' => $errorMessage]);
        }
       

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('roles.index')->with(['roles-success' => 'Thêm thành công']);
    }
}
