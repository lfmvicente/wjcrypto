<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Api;

use Wjcrypto\Holder\Model\ResourceModel\HolderResource;
use Wjcrypto\Logger\Model\Logger;

abstract class AccountSessionControllerValidation
{
    private $holderResource;
    protected $logger;

    public function __construct(HolderResource $holderResource, Logger $logger)
    {
        $this->holderResource = $holderResource;
        $this->logger = $logger;
    }

    public function validateUserLogin()
    {
        $this->logger->log('Page Access', [$_SERVER['REQUEST_URI']]);
        if (isset($_SESSION) &&
            isset($_SESSION['id']) &&
            isset($_SESSION['username']) &&
            isset($_SESSION['password'])) {

            $holder = $this->holderResource->getById($_SESSION['id']);

            if ($holder->getPassword() === $_SESSION['password'] && $holder->getUsername() === $_SESSION['username']) {
                return true;
            }
        }
        return false;
    }
}
