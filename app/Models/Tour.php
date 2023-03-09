<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tour extends Model
{
    protected $table = 'tours';
    protected $appends = ['sale_price'];

    public function scopePopular($query)
    {
        return $query->where('is_popular',1);
    }
    public function scopeSale($query)
    {
        $query->whereNotNull('sale');
    }
    public function images():BelongsToMany
    {
        return $this->belongsToMany(Images::class,'tour_images','tours_id','images_id');
    }
    protected function getSalePriceAttribute(): float|int|null
    {
        if(!is_null($this->original['sale']))
        {
            $this->attributes['sale_price'] = $this->original['price']*$this->original['sale']/100;
        }else{
            $this->attributes['sale_price'] = null;
        }
        return $this->attributes['sale_price'];
    }
    public function scopeFilter($query, array $filter)
    {
        if(isset($filter['country_id']) && !is_null($filter['country_id']))
        {
            $query->where('country_id',$filter['country_id']);
        }
        return $query;
    }

}
