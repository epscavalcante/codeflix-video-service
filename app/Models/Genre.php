<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use Uuid,
        SoftDeletes;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'is_active',
    ];

    protected $casts = [
        'id' => 'string',
        'is_active' => 'boolean',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
