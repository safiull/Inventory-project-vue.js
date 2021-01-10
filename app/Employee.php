<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'email', 'salary', 'address', 'nid', 'joining_date', 'image', 'description',
    ];
}
