<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userS)
    {
        $this->userService = $userS;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  
        return view('admin.users.index');
    }

    public function fetchData(){
        $users = $this->userService->getWithPaginate();
        return response()->json([
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all()->groupBy('group');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
    

        if ($this->userService->store($request)) {
            return redirect()->route('users.index')->with(['message-success' => 'Thêm dữ liệu thành công']);
        } else {
            return redirect()->route('users.index');
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
      
        $user = User::findOrFail($id)->load('roles');
        $roles = Role::all()->groupBy('group');;
        return view('admin.users.edit', compact('user', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($this->userService->update($request,$id)) {
            return redirect()->route('users.index')->with(['message-success' => 'Cập nhật dữ liệu thành công']);
        } else {
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function searchUsers(Request $request)
    {

        $query = $request['query'];
  
        // Thực hiện truy vấn tìm kiếm người dùng theo $query

        $users = User::where('email', 'like', '%' . $query . '%')->get();

        return response()->json($users);
    }

    //Khóa người dùng
    public function lockOnUser(Request $request){
   
        if($this->userService->lockOnUser($request)){
            return response()->json('http://127.0.0.1:8000/admin/users');
        }else{
            return response()->json(['mess' => 'có lỗi xảy ra']);
        }
      
        
    }


}
