<?php

    namespace App\Http\Controllers;

    use App\Genre;

    class GenreController extends Controller
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
            return Genre::all();
        }
    }
