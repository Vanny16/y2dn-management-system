<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'usern_name',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'phone',
        'gender',
        'location',
        'about_me',
        'user_role',
    ];
}
