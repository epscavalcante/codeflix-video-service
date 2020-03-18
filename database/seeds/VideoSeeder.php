<?php

use App\Models\Genre;
use App\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->removeDirectory();

        Model::reguard();

        factory(Video::class, 40)->make()
            ->each(function ($video) {

                Video::create(

                    array_merge(
                        $video->toArray(),
                        $this->makeRelations()
                    )

                );
            });

        Model::unguard();
    }

    private function removeDirectory()
    {
        $directory = Storage::getDriver()->getAdapter()->getPathPrefix();

        File::deleteDirectory($directory);
    }

    private function makeRelations()
    {
        $genresId = [];
        $categoriesId = [];

        $genres = Genre::inRandomOrder()->with('categories')->take(rand(1, 4))->get();

        foreach ($genres as $genre) {

            $genresId[] = $genre->id;

            foreach ($genre->categories as $category) {

                $categoriesId[] = $category->id;
            }
        }

        return [
            'genres' => $genresId,
            'categories' => array_unique($categoriesId),
        ];
    }
}