<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class SeedUserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $sql = "INSERT INTO users (name, email, password, created_at) values(:name, :email, :password, :created_at)";
        for($i=0; $i<31; $i++){
            DB::statement($sql, [
                'name' => 'Massimiliano'.$i,
                'email' => $i.'nome@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => Carbon::now()
            ]);
        }
        
    }
}
