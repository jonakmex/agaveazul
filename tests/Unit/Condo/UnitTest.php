<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Domains\Condo\Entities\Unit;

class UnitTest extends TestCase
{
    public function test_should_create_unit()
    {
        $unit = new Unit();
        $this->assertTrue(true);
    }

    public function test_should_set_description(){
        $unit = new Unit;
        $unit->setDescription("Test 1");
        $this->assertEquals($unit->getDescription(),"Test 1");
    }

}
