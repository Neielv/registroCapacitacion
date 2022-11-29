<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Rol1= Role::create(['name'=>'Admin']);
        $Rol2= Role::create(['name'=>'Vendedor']);
        $Per1= Permission::create(['name'=>'dashboard'])->syncRoles( $Rol1,$Rol2);
        $Per2= Permission::create(['name'=>'ciudades'])->assignRole($Rol2);

    }
}
