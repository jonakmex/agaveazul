<?php
namespace App\Service;
use App\Config;

class ConfigService{
    public static function mailEnabled(){
        $config = Config::where('key','mail.send')->first();
        return $config && $config->value == '1';
    }
}