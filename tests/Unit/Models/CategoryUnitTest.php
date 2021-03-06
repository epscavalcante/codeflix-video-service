<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Traits\Uuid;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tests\TestCase;
use Tests\Utils\Traits\AssertTraits;

class CategoryUnitTest extends TestCase
{
    use AssertTraits;

    public function testIfUseDefaultTraits()
    {
        $traits = [
            Uuid::class,
            Filterable::class,
            SoftDeletes::class
        ];

        $this->assertTraitsUse($traits, Category::class);
    }
}
