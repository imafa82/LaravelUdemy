<?php

use Illuminate\Database\Seeder;
use App\Models\Photo;
use App\Models\Album;
class SeedPhotoTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $albums = Album::get();
         foreach ($albums as $album){
             factory(App\Models\Photo::class, 200)->create(
                 ['album_id'=>$album->id]
             );
         }

    }
}
