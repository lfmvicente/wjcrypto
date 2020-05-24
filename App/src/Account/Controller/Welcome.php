<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Model\WelcomeMessageControllerHandler;
use Wjcrypto\Account\Api\AccountSessionControllerValidation;
use Wjcrypto\Holder\Model\ResourceModel\HolderResource;
use Wjcrypto\Logger\Model\Logger;

class Welcome extends AccountSessionControllerValidation
{

    private $welcomeMessageControllerHandler;

    public function __construct(
        WelcomeMessageControllerHandler $welcomeMessageControllerHandler,
        HolderResource $holderResource,
        Logger $logger
    ){
        $this->welcomeMessageControllerHandler = $welcomeMessageControllerHandler;
        parent::__construct($holderResource, $logger);
    }

    public function execute(SimpleRouter $router)
    {
        if ($this->validateUserLogin() === true) {
            $router::response()->json([
               'msg' => $this->welcomeMessageControllerHandler->execute()
            ]);
        } else {
            $router::response()->redirect('/Html/index.html');
        }
    }
}
