<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'libelle',
		'description',
		'created_by',
		'user_id',
    ];
    
    	public function users()
    {
        return $this->hasMany(User::class);
    }
    
    
}
