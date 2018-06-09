<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '456999184:AAFrZCS6-Wgq-TCtQ6HsHS6qggtqq6-9G1s/bot',
        '546189168:AAG7TO51hvqgzNzURRDKm8Q2rqGgTSw_Mfk/bot'
    ];
}
