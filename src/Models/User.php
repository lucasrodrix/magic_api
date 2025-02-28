<?php
// src/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'users';
    protected $fillable = ['username', 'password'];
    protected $hidden = ['password'];
}
