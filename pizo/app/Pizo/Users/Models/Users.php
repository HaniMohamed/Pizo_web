<?php
namespace App\Pizo\Users\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $hidden = [
        'password', 'remember_token',
    ];
}
