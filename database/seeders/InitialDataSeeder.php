<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\HardwareItem;
use App\Models\License;
use Illuminate\Support\Facades\Hash;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Création des 3 profils / rôles
        $admin = User::updateOrCreate(
            ['email' => 'admin@novasys.stock'],
            [
                'name' => 'Admin Principal',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'department' => 'Direction IT'
            ]
        );

        $distributor = User::updateOrCreate(
            ['email' => 'distributeur@novasys.stock'],
            [
                'name' => 'Gestionnaire Stock',
                'password' => Hash::make('password'),
                'role' => 'distributor',
                'department' => 'Logistique IT'
            ]
        );

        $employee = User::updateOrCreate(
            ['email' => 'employe@novasys.stock'],
            [
                'name' => 'Employé Test',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'department' => 'Comptabilité'
            ]
        );

        // 2. Catégories de matériel et de licences
        $catPc = Category::firstOrCreate(['name' => 'PC Portable', 'type' => 'hardware']);
        $catEcran = Category::firstOrCreate(['name' => 'Écran Externe', 'type' => 'hardware']);
        $catLicenceIde = Category::firstOrCreate(['name' => 'Licence IDE / Dev', 'type' => 'license']);
        $catLicenceBureautique = Category::firstOrCreate(['name' => 'Licence Office', 'type' => 'license']);

        // 3. Matériels de test
        HardwareItem::firstOrCreate(
            ['serial_number' => 'HP-ELITE-820-001'],
            [
                'category_id' => $catPc->id,
                'name' => 'HP EliteBook 820',
                'status' => 'disponible',
                'location' => 'Stock Principal Abidjan',
                'purchase_date' => now()->subMonths(3)
            ]
        );

        HardwareItem::firstOrCreate(
            ['serial_number' => 'DELL-P2419H-002'],
            [
                'category_id' => $catEcran->id,
                'name' => 'Moniteur Dell 24"',
                'status' => 'disponible',
                'location' => 'Bureau A2',
                'purchase_date' => now()->subMonths(1)
            ]
        );

        // 4. Licences de test
        License::firstOrCreate(
            ['name' => 'JetBrains All Products Pack'],
            [
                'category_id' => $catLicenceIde->id,
                'license_key' => 'XXXX-YYYY-ZZZZ-1234',
                'total_seats' => 5,
                'used_seats' => 0,
                'expiration_date' => now()->addYear()
            ]
        );

        License::firstOrCreate(
            ['name' => 'Microsoft 365 Business Extra'],
            [
                'category_id' => $catLicenceBureautique->id,
                'license_key' => 'MS365-KEY-8901-5678',
                'total_seats' => 20,
                'used_seats' => 0,
                'expiration_date' => now()->addYear()
            ]
        );
    }
}