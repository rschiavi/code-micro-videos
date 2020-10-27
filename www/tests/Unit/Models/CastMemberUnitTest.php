<?php

namespace Tests\Unit\Models;

use App\Models\CastMember;
use PHPUnit\Framework\TestCase;

use ReflectionClass;

class CastMemberUnitTest extends TestCase
{
    private $castMember;

    protected function setUp(): void
    {
        parent::setUp();
        $this->castMember = new CastMember();
    }

    public function testIfUseTraits()
    {
        $traits = [
            \Illuminate\Database\Eloquent\SoftDeletes::class,
            \App\Models\Traits\Uuid::class
        ];
        $castMemberTraits = array_keys(class_uses(CastMember::class));
        $this->assertEquals($traits, $castMemberTraits);
    }

    public function testDatesAttribute()
    {
        $dates = ['created_at', 'updated_at', 'deleted_at'];
        $this->assertEqualsCanonicalizing($dates, $this->castMember->getDates());
    }

    public function testFillableAttribute()
    {
        $fillable = ['name', 'type'];
        $this->assertEquals($fillable, $this->castMember->getFillable());
    }

    public function testCastsAttribute()
    {
        $casts = ['type' => 'integer'];
        $this->assertEquals($casts, $this->castMember->getCasts());
    }

    public function testKeyTypeAttributeIsString()
    {
        $keyType = 'string';
        $this->assertEquals($keyType, $this->castMember->getKeyType());
    }

    public function testIncrementingAttribute()
    {
        $this->assertFalse($this->castMember->getIncrementing());
    }

    public function testConstants()
    {
        $reflectionClass = new ReflectionClass(CastMember::class);
        $constants = $reflectionClass->getConstants();
        $this->assertArrayHasKey('TYPE_DIRECTOR', $constants);
        $this->assertArrayHasKey('TYPE_ACTOR', $constants);
    }
}
