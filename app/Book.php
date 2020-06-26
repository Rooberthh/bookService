<?php

    namespace App;

    use Illuminate\Auth\Authenticatable;
    use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
    use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
    use Illuminate\Database\Eloquent\Model;
    use Laravel\Lumen\Auth\Authorizable;

    class Book extends Model
    {
        protected $fillable = [
            'title',
            'review',
            'rating',
            'image_path',
            'genre_id'
        ];

        public function genre() {
            return $this->belongsTo(Genre::class);
        }

        /**
         * @param $image
         * @return string
         */
        public function getImagePathAttribute($image)
        {
            return $image ? url($image) : null;
        }
    }
