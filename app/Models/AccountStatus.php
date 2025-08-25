<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountStatus extends Model
{
    use HasFactory;

    public function accounts()
    {
        return $this->hasMany(User::class);
    }

    public function getAccountCountAttributes()
    {
        return $this->accounts->count();
    }
}
