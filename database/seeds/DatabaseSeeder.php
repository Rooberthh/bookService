<?php

    use App\Genre;
    use Illuminate\Database\Seeder;
use App\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'SelfImprovement',
                'color' => '#3c40c6'
            ],
            [
                'name' => 'Meditation',
                'color' => '#f53b57'
            ],
            [
                'name' => 'Religion',
                'color' => '#05c46b'
            ],
            [
                'name' => 'TheXEffect',
                'color' => '#1e272e'
            ],
        ])->each(function ($genre) {
            factory(Genre::class)->create([
                'name' => $genre['name'],
                'color' => $genre['color'],
            ]);
        });

        factory('App\Book', 20)->states('from_existing_genres')->create();
    }
}
