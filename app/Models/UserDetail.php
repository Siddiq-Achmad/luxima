<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserDetail extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn ($avatar) => asset('/storage/images/avatars/' . $avatar),
        );
    }
}
