<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
* @property int $owner_id
* @property string $name
* @property string $phone_number
*/
class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
