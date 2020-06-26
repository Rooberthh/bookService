<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Genre extends Model
    {
        protected $fillable = [
            'name', 'color'
        ];

        public function books() {
            return $this->hasMany(Book::class);
        }
    }
