<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $casts = [
        'metadata' => 'array'
    ];
    public function author (){
        return $this->belongsTo(User::class,'user_id');
    }
}
