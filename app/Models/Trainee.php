<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    use HasFactory;
    protected $table = 'trainees';

    // public function login()
    // {
    //     return $this->hasOne(Login::class);
    // }
}
