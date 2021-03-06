<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    public static function isCustomerExist ($email)
    {
        $customer = self::whereEmail($email)->first();

        if($customer) return $customer->id;

        return null;
    }

    public function tickets ()
    {
        return $this->belongsTo('App\Models\Ticket');
    }

}
