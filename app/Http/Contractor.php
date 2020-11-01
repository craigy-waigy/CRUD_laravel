<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    public $fillable = ['name', 'phone'];
    public $timestamps = false;
}
