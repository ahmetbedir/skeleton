<?php

namespace App\Models;

use Ahmetbedir\Skeleton\Core\Model;

class User extends Model
{

    /**
     * $table değişkeni yazılmadığı durumlarda
     * tekil olarak tanımlanan class(user) adını
     * çoğul(users) olarak veritabanına otomatik olarak bağlanacak.
     */
    protected $table = 'users';
}
