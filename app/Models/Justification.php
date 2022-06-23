<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Justification extends Model
{
    use HasFactory;
    	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
        
        'user_id',
		'created_by',
		'type_demande',
		'fichier',
		'message',
		'statut',
    ];
   

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
