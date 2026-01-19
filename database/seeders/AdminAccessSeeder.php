<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use App\Laravel\Models\User;

class AdminAccessSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // ignore foreign key checks
        DB::table('users_has_permissions')->truncate();
        DB::table('users_has_roles')->truncate();
        DB::table('users_roles_has_permissions')->truncate();

        DB::table('users_permissions')->truncate();
        DB::table('users_roles')->truncate();

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

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

        // Child
        Permission::create(['name' => 'backoffice.child.index', 'description' => "View Child Records", 'module' => "admin", 'module_name' => "Child", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.child.show', 'description' => "Child Profile", 'module' => "admin", 'module_name' => "Child", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.child.create', 'description' => "Creating Child Account", 'module' => "admin", 'module_name' => "Child", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.child.edit', 'description' => "Editing Child Account", 'module' => "admin", 'module_name' => "Child", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.child.update_status', 'description' => "Activating/Deactivating Child Account", 'module' => "admin", 'module_name' => "Child", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.child.export', 'description' => "PDF/Excel Export", 'module' => "admin", 'module_name' => "Child", 'guard_name' => "admin"]);

        // Guardian
        Permission::create(['name' => 'backoffice.guardian.index', 'description' => "View Guardian Records", 'module' => "admin", 'module_name' => "Guardian", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.guardian.show', 'description' => "Guardian Profile", 'module' => "admin", 'module_name' => "Guardian", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.guardian.create', 'description' => "Creating Guardian Account", 'module' => "admin", 'module_name' => "Guardian", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.guardian.edit', 'description' => "Editing Guardian Account", 'module' => "admin", 'module_name' => "Guardian", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.guardian.update_status', 'description' => "Activating/Deactivating Guardian Account", 'module' => "admin", 'module_name' => "Guardian", 'guard_name' => "admin"]);
        Permission::create(['name' => 'backoffice.guardian.export', 'description' => "PDF/Excel Export", 'module' => "admin", 'module_name' => "Guardian", 'guard_name' => "admin"]);

        // CMS
        // Permission::create(['name' => 'backoffice.cms.faq.index', 'description' => "View FAQ", 'module' => "faq", 'module_name' => "FAQ", 'guard_name' => "admin"]);
        // Permission::create(['name' => 'backoffice.cms.faq.create', 'description' => "Creating FAQ", 'module' => "faq", 'module_name' => "FAQ", 'guard_name' => "admin"]);
        // Permission::create(['name' => 'backoffice.cms.faq.edit', 'description' => "Editing FAQ", 'module' => "faq", 'module_name' => "FAQ", 'guard_name' => "admin"]);
        // Permission::create(['name' => 'backoffice.cms.faq.update_status', 'description' => "Activating/Deactivating FAQ Status", 'module' => "faq", 'module_name' => "FAQ", 'guard_name' => "admin"]);
        // Permission::create(['name' => 'backoffice.cms.faq.show', 'description' => "FAQ details", 'module' => "faq", 'module_name' => "FAQ", 'guard_name' => "admin"]);

        // Roles
        Role::create(['name' => 'SUPER ADMIN', 'guard_name' => "admin"])
            ->givePermissionTo(Permission::all());
        
        Role::create(['name' => 'STAFF', 'guard_name' => "admin"]);
        Role::create(['name' => 'ASSISTANT', 'guard_name' => "admin"]);

        // assign role to super admin
        $user = User::find(1);
        $user->role = "SUPER ADMIN";
        $user->role_id = 1;
        $user->save();
        $user->assignRole(1);
    }
}
