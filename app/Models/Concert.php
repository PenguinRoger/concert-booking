<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $total_tickets_available
 */

 class Concert extends Model
 {
     use HasFactory;
     protected $fillable = [
         'name', 'description', 'date', 'location', 'price', 'image'
     ];

     public function tickets() {
         return $this->hasMany(Ticket::class);
     }
 }


