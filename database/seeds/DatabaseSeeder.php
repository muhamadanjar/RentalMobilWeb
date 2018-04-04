<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        App\Role::insert([
            ['name' => 'superadmin'],
            ['name' => 'admin'],
            ['name' => 'driver'],
            ['name' => 'customer'],
        ]);
    
        // Basic permissions data
        App\Permission::insert([
            ['name' => 'access.backend'],
            ['name' => 'access.user'],
            ['name' => 'create.user'],
            ['name' => 'edit.user'],
            ['name' => 'delete.user'],
            ['name' => 'create.article'],
            ['name' => 'edit.article'],
            ['name' => 'delete.article'],
            ['name' => 'create.dokumen'],
            ['name' => 'edit.dokumen'],
            ['name' => 'delete.dokumen'],
            ['name' => 'create.informasi'],
            ['name' => 'edit.informasi'],
            ['name' => 'delete.informasi'],
            ['name' => 'access.transaksi'],
        ]);
    
        // Add a permission to a role
        $superadmin = App\Role::where('name', 'superadmin')->first();
        $superadmin->addPermission('access.backend');
        $superadmin->addPermission('access.user');
        $superadmin->addPermission('create.user');
        $superadmin->addPermission('edit.user');    
        $superadmin->addPermission('delete.user');

        $superadmin->addPermission('create.mobil');
        $superadmin->addPermission('edit.mobil');    
        $superadmin->addPermission('delete.mobil');
        $superadmin->addPermission('access.transaksi');

        $admin = App\Role::where('name', 'admin')->first();
        $admin->addPermission('access.backend');
        $admin->addPermission('access.transaksi');

        // ... Add other role permission if necessary
    
        // Create a user, and give roles
        $user = App\User::create([
            'username' => 'superadmin',
            'email' => 'superadmin@example.com',
            'name' => 'Super Admin',
            'password' => bcrypt('password'),
            'isactived' => 1,
            'isverified' => 1,
        ]);
    
        $user->assignRole('superadmin');

        $operator = App\User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'name' => 'Administrator',
            'password' => bcrypt('password'),
            'isactived' => 1,
            'isverified' => 1,
        ]);
        $user->assignRole('admin');
    }
}
