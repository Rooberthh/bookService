<?php

    namespace App\Http\Controllers;

    use App\Book;
    use Illuminate\Http\Request;
    use Illuminate\Validation\Rule;

    class BookController extends Controller
    {
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            //
        }

        public function index()
        {
            return Book::orderBy('created_at', 'desc')->get();
        }

        public function update(Request $request, $id)
        {
            $this->validate($request, [
                'title' => 'required',
                'genre_id' => [
                    'required',
                    Rule::exists('genres', 'id')
                ],
                'review' => ['required'],
                'rating' => ['required', 'min:1', 'max:5'],
            ]);

            $book = Book::find($id);

            $book->update([
                'title' => $request->get('title'),
                'genre_id' => $request->get('genre_id'),
                'review' => $request->get('review'),
                'rating' => $request->get('rating')
            ]);

            return response($book, 200);
        }

        public function store(Request $request)
        {
            $this->validate($request, [
                'title' => 'required',
                'genre_id' => [
                    'required',
                    Rule::exists('genres', 'id')
                ],
                'review' => 'required|min:1|max:5',
                'rating' => 'required',
            ]);

            $image = null;
            if($request->file('image_path') != null){
                if($request->file('image_path')->isValid()) {
                    $image = $request->file('image_path')->store('books', 'public');
                }
            }

            $book = Book::create([
                'title' => $request->get('title'),
                'genre_id' => $request->get('genre_id'),
                'review' => $request->get('review'),
                'rating' => $request->get('rating'),
                'image_path' => $image
            ]);

            return response($book, 200);
        }

        public function destroy($id)
        {
            $book = Book::find($id);
            $book->delete();

            return response('Book have been deleted', 200);
        }
    }
