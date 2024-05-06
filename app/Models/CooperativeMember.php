<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CooperativeMember extends Model
{
    use HasFactory;

    public function education()
    {
        return $this->belongsTo(Education::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }
}
