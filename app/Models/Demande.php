<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
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
		'date_depart',
		'date_retour',
		'fichier',
		'message',
		'statut',
		'valid_par',
    ];
   

    public function user()
    {
        return $this->belongsTo(User::class, 'name');
    }
    
}
