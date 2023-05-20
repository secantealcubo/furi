<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Enums\PermissionTypes;
use App\Enums\RolesEnum;
use App\Models\Modulo;
use App\Models\ModuloPermiso;

class RolesAndPermissionsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Reset cached roles and permissions
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    // create permissions
    Permission::create(['name' => 'crear usuarios']);
    Permission::create(['name' => 'editar usuarios']);
    Permission::create(['name' => 'eliminar usuarios']);
    Permission::create(['name' => 'ver usuarios']);
    Permission::create(['name' => 'crear roles']);
    Permission::create(['name' => 'editar roles']);
    Permission::create(['name' => 'eliminar roles']);
    Permission::create(['name' => 'ver roles']);

    Modulo::create(['nombre' => 'Usuarios','modelo'=>'App\Model\User']);
    Modulo::create(['nombre' => 'Roles','modelo'=>'App\Model\User']);

    ModuloPermiso::create(['modulo_id' =>1,'permiso_id'=>1]);
    ModuloPermiso::create(['modulo_id' =>1,'permiso_id'=>2]);
    ModuloPermiso::create(['modulo_id' =>1,'permiso_id'=>3]);
    ModuloPermiso::create(['modulo_id' =>1,'permiso_id'=>4]);
    ModuloPermiso::create(['modulo_id' =>2,'permiso_id'=>5]);
    ModuloPermiso::create(['modulo_id' =>2,'permiso_id'=>6]);
    ModuloPermiso::create(['modulo_id' =>2,'permiso_id'=>7]);
    ModuloPermiso::create(['modulo_id' =>2,'permiso_id'=>8]);


    $role = Role::create(['name' => 'administrador']);
    $role->givePermissionTo(Permission::all());
    
    Role::create(['name' => 'usuario'])->givePermissionTo(['crear usuarios', 'eliminar usuarios']);
  }
}
