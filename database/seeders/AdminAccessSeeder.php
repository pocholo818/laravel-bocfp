<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class AdminAccessSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // install perms table


        DB::table('users_has_permissions')->truncate();
        DB::table('users_has_roles')->truncate();
        DB::table('users_roles_has_permissions')->truncate();
        DB::table('users_permissions')->delete();
        DB::table('users_roles')->delete();

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // dashboard
        // Permission::create(['name' => 'backoffice.index', 'description' => "Dashboard", 'module' => "dashboard", 'module_name' => "Dashboard", 'guard_name' => "admin"]);
        
        // Administrator
        Permission::create(['name' => 'backoffice.admin.index', 'description' => "View Administrator Accounts", 'module' => "admin", 'module_name' => "Administrator", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.admin.show', 'description' => "Administrator Profile", 'module' => "admin", 'module_name' => "Administrator", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.admin.create', 'description' => "Creating Administrator Account", 'module' => "admin", 'module_name' => "Administrator", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.admin.edit', 'description' => "Editing Administrator Account", 'module' => "admin", 'module_name' => "Administrator", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.admin.reset_password', 'description' => "Resetting Administrator Password", 'module' => "admin", 'module_name' => "Administrator", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.admin.update_status', 'description' => "Activating/Deactivating Administrator Account", 'module' => "admin", 'module_name' => "Administrator", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.admin.export', 'description' => "PDF/Excel Export", 'module' => "admin", 'module_name' => "Administrator", 'guard_name' => "admin"]);

        // User Roles
        Permission::create(['name' => 'backoffice.user_role.index', 'description' => "View Users", 'module' => "role", 'module_name' => "User Roles", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.user_role.create', 'description' => "Creating User Roles", 'module' => "role", 'module_name' => "User Roles", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.user_role.edit', 'description' => "Editing User Roles", 'module' => "role", 'module_name' => "User Roles", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.user_role.update_status', 'description' => "Activation/Deactivation of User Roles", 'module' => "role", 'module_name' => "User Roles", 'guard_name' => "admin"]);

        //Access Control
        Permission::create(['name' => 'backoffice.access_control.index', 'description' => "View Access Controls", 'module' => "access_control", 'module_name' => "Access Control", 'guard_name' => "admin"]);

        // CMS
        // Permission::create(['name' => 'backoffice.cms.faq.index', 'description' => "View FAQ", 'module' => "faq", 'module_name' => "FAQ", 'guard_name' => "admin"]);
        // Permission::create(['name' => 'backoffice.cms.faq.create', 'description' => "Creating FAQ", 'module' => "faq", 'module_name' => "FAQ", 'guard_name' => "admin"]);
        // Permission::create(['name' => 'backoffice.cms.faq.edit', 'description' => "Editing FAQ", 'module' => "faq", 'module_name' => "FAQ", 'guard_name' => "admin"]);
        // Permission::create(['name' => 'backoffice.cms.faq.update_status', 'description' => "Activating/Deactivating FAQ Status", 'module' => "faq", 'module_name' => "FAQ", 'guard_name' => "admin"]);
        // Permission::create(['name' => 'backoffice.cms.faq.show', 'description' => "FAQ details", 'module' => "faq", 'module_name' => "FAQ", 'guard_name' => "admin"]);

        // Roles
        Role::create(['name' => 'Super Admin', 'guard_name' => "admin", "reg_type" => "admin"])
            ->givePermissionTo(Permission::all());
        
        Role::create(['name' => 'Staff', 'guard_name' => "admin", "reg_type" => "staff"]);
        Role::create(['name' => 'Assistant', 'guard_name' => "admin", "reg_type" => "assistant"]);

        $this->call(SyncDTIAccessRoleSeeder::class);

    }
}
