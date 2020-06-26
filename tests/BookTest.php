<?php

    use Illuminate\Http\UploadedFile;
    use Illuminate\Support\Facades\Storage;
    use Laravel\Lumen\Testing\DatabaseMigrations;

class BookTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_user_can_fetch_books()
    {
        create('App\Book', [], 10);

        $this->json('get', 'api/books')->assertResponseStatus(200);
    }

    /** @test */
    function a_user_can_add_a_new_book()
    {
        $book = make('App\Book');

        $this->json('post', 'api/books', $book->toArray())
            ->assertResponseStatus(200);

        $this->seeInDatabase('books', $book->toArray());
    }

    /** @test */
    function a_user_can_add_image_to_a_book()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');
        $book = make('App\Book');

        $response = $this->call('POST', '/api/books', $book->toArray(), [], ['image_path' => $file], []);

        $this->assertEquals(url('books/'.$file->hashName()), $response->getOriginalContent()->image_path);
        Storage::disk('public')->assertExists('books/' . $file->hashName());
    }

    /** @test */
    function a_book_can_be_updated()
    {
        $book = create('App\Book');

        $this->json('patch', "/api/books/{$book->id}", [
            'title' => 'is changed',
            'review' => $book->review,
            'genre_id' => $book->genre->id,
            'rating' => $book->rating
        ])->assertResponseStatus(200);

        $this->assertEquals('is changed',  $book->fresh()->title);
    }

    /** @test */
    function a_book_has_an_title()
    {
        $book = create('App\Book', ['title' => 'a title']);

        $this->assertEquals('a title', $book->fresh()->title);
    }

    /** @test */
    function a_book_has_a_rating()
    {
        $book = create('App\Book', ['rating' => 5]);

        $this->assertEquals(5, $book->fresh()->rating);
    }

    /** @test */
    function a_book_has_a_review()
    {
        $book = create('App\Book', ['review' => 'a review']);

        $this->assertEquals('a review', $book->fresh()->review);
    }
}
