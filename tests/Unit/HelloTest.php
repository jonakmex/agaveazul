<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Entities\Cuenta;

class HelloTest extends TestCase
{
    public function test_should_create_cuenta_object()
    {
        $cuenta = new Cuenta();
        $this->assertnotNull($cuenta);
    }

    public function test_should_start_balance(){
        $cuenta = new Cuenta();
        $this->assertEquals($cuenta->getSaldo(),0);
    }

    public function test_should_increment_balance(){
        $cuenta = new Cuenta();
        $cuenta->addBalance(30);
        $this->assertEquals($cuenta->getSaldo(),30);
    }
}
