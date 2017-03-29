<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function users(){
        return $this->belongsToMany(User::class);
    }

    public  function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->diffForHumans();
    }
}
