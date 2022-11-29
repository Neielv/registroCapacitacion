<?php

namespace Database\Seeders;

use App\Models\Ciudad;
use App\Models\TipoDocumento;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            
            RoleSeed::class,   
            UserSeed::class,
            InitDataBaseSpeed::class,
        ]);
       
    }
}
