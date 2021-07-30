<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function profileImage(){
        //return ($this->image) ? '/storage' . $this->image : '/storage/default-avatar.jpg';
        $rutaImagen = ($this->image) ? $this->image : 'default-avatar.jpg';
        return '/storage/' . $rutaImagen;
    }
    public function followers(){
        return $this->belongsToMany(User::class);
    }
}
