<?php
// src/Models/Edition.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edition extends Model {
    protected $table = 'editions';
    protected $fillable = ['name_pt', 'name_en', 'release_date', 'card_count'];
    public $timestamps = false; // Desativa timestamps
}
