<?php

namespace App\Models;

use App\Models\Village;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'districts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'code',
        'name',
        'meta',
    ];

    public function village()
    {
        return $this->hasMany(Village::class);
    }
}
