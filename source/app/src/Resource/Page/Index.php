<?php
namespace MyVendor\MyProject\Resource\Page;

use AppCore\Application\User\UserApplicationService;
use BEAR\Resource\ResourceObject;

class Index extends ResourceObject
{
    /** @var UserApplicationService */
    private $userApplicationService;

    /**
     * Index constructor.
     *
     * @param UserApplicationService $userApplicationService
     */
    public function __construct(UserApplicationService $userApplicationService)
    {
        $this->userApplicationService = $userApplicationService;
    }

    public function onGet(string $name = 'BEAR.Sunday') : ResourceObject
    {
        $this->body = [
            'greeting' => 'Hello ' . $name
        ];

        return $this;
    }
}
