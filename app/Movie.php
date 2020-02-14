<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $casts = [
        "rented" => "boolean"
    ];

    protected $fillable = [
        "title", "year", "director", "poster", "synopsis", "rented", "category_id", "trailer"
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
?>