<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cache permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Daftar Permissions
        $permissions = [
            'manage-categories',
            'create-products',
            'edit-own-products',
            'edit-any-products',
            'delete-own-products',
            'delete-any-products',
            'manage-own-store',
            'process-orders',
            'approve-sellers',
            'manage-payouts',
            'moderate-reviews',
            'manage-users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Assign ke Role

        // Super Admin (Semua Hak Akses)
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin Platform
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo([
            'manage-categories', 'edit-any-products', 'delete-any-products',
            'approve-sellers', 'manage-payouts', 'moderate-reviews', 'manage-users'
        ]);

        // Seller / Merchant
        $seller = Role::firstOrCreate(['name' => 'seller']);
        $seller->givePermissionTo([
            'manage-own-store', 'create-products', 'edit-own-products',
            'delete-own-products', 'process-orders'
        ]);

        // Customer / Buyer (Default registrasi publik)
        Role::firstOrCreate(['name' => 'customer']);
    }
}
