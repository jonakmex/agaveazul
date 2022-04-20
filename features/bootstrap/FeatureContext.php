<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use App\Domains\Finances\Entities\Account;
use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    protected $accountA;
    protected $accountB;

    private $requestFactory;
    private $useCaseFactory;
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->requestFactory = new RequestFactoryMock;
        $this->useCaseFactory = new UseCaseFactoryMock;
    }

    /**
     * @Given An Account A with balance of :arg1
     */
    public function anAccountAWithBalanceOf($arg1)
    {
        $this->accountA = new Account;
        $this->accountA->setBalance(100);
    }

    /**
     * @Given An existing target account B with balance of :arg1
     */
    public function anExistingTargetAccountBWithBalanceOf($arg1)
    {
        $this->accountB = new Account;
        $this->accountB->setBalance(0);
    }

    /**
     * @When Tesorero transfers :amount from account A to account B
     */
    public function tesoreroTransfersFromAccountAToAccountB($amount)
    {
        $transferRequest = $this->requestFactory->make("App\Domains\Finances\Boundary\Input\TransferRequest",["sourceAccount"=>$this->accountA,"targetAccount"=>$this->accountB,"amount"=>$amount]);
        $useCase = $this->useCaseFactory->make("TransferBetweenAccountsUseCase");
        
        \PHPUnit\Framework\Assert::assertNotNull($transferRequest);
        \PHPUnit\Framework\Assert::assertNotNull($useCase);

        $useCase->execute($transferRequest,function ($response){
            \PHPUnit\Framework\Assert::assertTrue($response->success);
        });
    }

    /**
     * @Then Account A has a balance of :finalAmount
     */
    public function accountAHasABalanceOf($finalAmount)
    {
        \PHPUnit\Framework\Assert::assertEquals($finalAmount,$this->accountA->getBalance());
        
    }

    /**
     * @Then Account B has a balance of :finalAmount
     */
    public function accountBHasABalanceOf($finalAmount)
    {
        \PHPUnit\Framework\Assert::assertEquals($finalAmount,$this->accountB->getBalance());
    }


    /**
     * @Then An error occurs saying :arg1
     */
    public function anErrorOccursSaying($arg1)
    {
        throw new PendingException();
    }
}
