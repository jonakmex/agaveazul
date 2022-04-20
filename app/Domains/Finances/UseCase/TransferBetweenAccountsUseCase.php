<?php
namespace App\Domains\Finances\UseCase;

use App\Domains\Finances\Boundary\Output\TransferBetweenAccountsResponse;
use App\Domains\Shared\Boundary\Request;
use App\Domains\Shared\UseCase\UseCase;

class TransferBetweenAccountsUseCase implements UseCase {

    public function execute(Request $request, $callback)
    {
        $request->sourceAccount->setBalance($request->sourceAccount->getBalance() - $request->amount);
        $request->targetAccount->setBalance($request->targetAccount->getBalance() + $request->amount);
        $response = new TransferBetweenAccountsResponse();
        $response->success = true;
        $callback($response);
    }

}