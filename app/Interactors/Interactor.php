<?php

use Interactors\DS\Request\Request;

namespace App\Interactors;

use App\Interactors\Ports\Input;

interface Interactor
{
    public function execute(Input $input);
}