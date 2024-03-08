<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            ['name'=>'create-user','display_name'=>'Thêm người dùng','group'=>'User'],
            ['name'=>'update-user','display_name'=>'Sửa thông tin người dùng','group'=>'User'],
            ['name'=>'delete-user','display_name'=>'Xóa người dùng','group'=>'User'],
            ['name'=>'show-user','display_name'=>'Xem người dùng','group'=>'User'],

            ['name'=>'create-role','display_name'=>'Thêm vai trò','group'=>'Role'],
            ['name'=>'update-role','display_name'=>'Sửa vai trò','group'=>'Role'],
            ['name'=>'delete-role','display_name'=>'Xóa vai trò','group'=>'Role'],
            ['name'=>'show-role','display_name'=>'Xem vai trò','group'=>'Role'],

            ['name'=>'create-product','display_name'=>'Thêm sản phẩm','group'=>'Product'],
            ['name'=>'update-product','display_name'=>'Sửa sản phẩm','group'=>'Product'],
            ['name'=>'delete-product','display_name'=>'Xóa sản phẩm','group'=>'Product'],
            ['name'=>'show-product','display_name'=>'Xem sản phẩm','group'=>'Product'],

            ['name'=>'create-category','display_name'=>'Thêm danh mục','group'=>'Category'],
            ['name'=>'update-category','display_name'=>'Sửa danh mục','group'=>'Category'],
            ['name'=>'delete-category','display_name'=>'Xóa danh mục','group'=>'Category'],
            ['name'=>'show-category','display_name'=>'Xem danh mục','group'=>'Category'],
           
            ['name'=>'create-coupon','display_name'=>'Thêm mã giảm giá','group'=>'Coupon'],
            ['name'=>'update-coupon','display_name'=>'Sửa mã giảm giá','group'=>'Coupon'],
            ['name'=>'delete-coupon','display_name'=>'Xóa mã giảm giá','group'=>'Coupon'],
            ['name'=>'show-coupon','display_name'=>'Xem mã giảm giá','group'=>'Coupon'],

        ];

        foreach($permissions as $item){
            Permission::updateOrCreate($item);
        }


        $roles = [
            ['name'=>'manager','display_name'=>'Manager','group'=>'system'],
            ['name'=>'admin','display_name'=>'Admin','group'=>'system'],
            ['name'=>'customer','display_name'=>'Customer','group'=>'system'],
            ['name'=>'employee','display_name'=>'Employee','group'=>'system'],
        ];

       
        foreach ($roles as $role) {
            $createdRole = Role::updateOrCreate($role);
    
            // Nếu vai trò hiện tại là "admin", gán tất cả các quyền cho nó
            if ($createdRole->name === 'admin') {
                $permissions = Permission::all();
                $createdRole->syncPermissions($permissions);
            }
        }

    }
    
}
