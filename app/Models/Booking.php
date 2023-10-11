<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public function cus_user()
{
    return $this->belongsTo(CusUser::class);
}

public function concert()
{
    return $this->belongsTo(Concert::class);
}

public function ticket()
{
    return $this->belongsTo(Ticket::class);
}

}
