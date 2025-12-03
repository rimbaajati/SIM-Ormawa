<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder {
  public function run(): void {
    $roles = ['manager', 'user'];

    foreach ($roles as $role){
      Role::firstOrCreate(['name' => $role]);
    }
  }
}