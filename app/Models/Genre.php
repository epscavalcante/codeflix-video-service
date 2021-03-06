<?php

namespace App\Models;

use App\Models\Pivot\CategoryGenre;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use Uuid, SoftDeletes;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $perPage = 10;

    protected $fillable = [
        'name',
        'is_active',
    ];

    protected $casts = [
        'id' => 'string',
        'is_active' => 'boolean',
    ];

    protected $with = [
        'categories'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class)
            ->using(CategoryGenre::class);
    }
}
