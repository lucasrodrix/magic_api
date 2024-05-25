<?php
// src/Models/Card.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model {
    protected $table = 'cards';
    protected $fillable = [
        'name_pt', 'name_en', 'color', 'type', 'artist', 'rarity',
        'image_url', 'description', 'price', 'stock_quantity', 'edition_id'
    ];
    public $timestamps = false; // Desativa timestamps

    public function edition() {
        return $this->belongsTo('App\Models\Edition', 'edition_id');
    }
}
