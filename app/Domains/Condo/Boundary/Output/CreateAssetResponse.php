<?php
namespace App\Domains\Condo\Boundary\Output;

use App\Domains\Condo\Boundary\DataStructure\AssetDS;
use App\Domains\Shared\Boundary\Response;

class CreateAssetResponse extends Response {
    public AssetDS $assetDS;
}