<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categorey()
    {
        return $this->belongsTo(Categorey::class,'categoreys_id');

    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
