<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $fillable = ['phone','first_name','last_name','comment','is_active'];
}
