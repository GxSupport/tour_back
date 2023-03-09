<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    protected $fillable = ['name_ru','name_uz','name_en','is_active'];
    public function scopeSearch($query, array $filter)
    {
        if(isset($filter['search']) && !is_null($filter['search'])){
            $search = $filter['search'];
            $query->where('name_ru','like',"%$search%")
                ->orWhere('name_uz','like',"%$search%")
                ->orWhere('name_en','like',"%$search%");
        }
        return $query;
    }
}
