<?php

    use Laravel\Lumen\Testing\DatabaseMigrations;

    class GenreTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_genre_has_a_name()
        {
            $genre = create('App\Genre', ['name' => 'a name']);

            $this->assertEquals('a name', $genre->fresh()->name);
        }

        /** @test */
        function a_genre_consists_of_books()
        {
            $genre = create('App\Genre');
            $book = create('App\Book', ['genre_id' => $genre->id]);

            $this->assertTrue($genre->books->contains($book));
        }

    }
