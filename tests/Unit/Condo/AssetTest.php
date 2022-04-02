<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Domains\Condo\Entities\Asset;

class AssetTest extends TestCase
{
  public function test_should_create_asset(){
    $asset = new Asset();
    $this->assertTrue(is_a($asset, "App\Domains\Condo\Entities\Asset"));
  }

  public function test_should_set_type(){
    $asset = new Asset;
    $asset->setType("AUTOMOVIL");
    $this->assertEquals("AUTOMOVIL",$asset->getType());
  }

  public function test_should_set_description(){
    $asset = new Asset;
    $asset->setDescription("FORD MUSTANG 68 Café claro YJL-89-08");
    $this->assertEquals("FORD MUSTANG 68 Café claro YJL-89-08", $asset->getDescription());
  }

  public function test_should_set_unitid(){
    $asset = new Asset;
    $asset->setUnitId(2);
    $this->assertEquals(2,$asset->getUnitId());
  }
}