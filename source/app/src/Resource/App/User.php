<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Resource\App;

use AppCore\Application\User\Delete\UserDeleteInputData;
use AppCore\Application\User\Delete\UserDeleteUseCase;
use AppCore\Application\User\Get\UserGetInputData;
use AppCore\Application\User\Get\UserGetUseCase;
use AppCore\InterfaceAdapter\Presenter\User\UserGetViewModel;
use BEAR\Resource\Annotation\JsonSchema;
use BEAR\Resource\Annotation\Link;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\StatusCode;

use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class User extends ResourceObject
{
    /** @var UserGetUseCase */
    private $userGetUseCase;

    /** @var UserDeleteUseCase */
    private $userDeleteUseCase;

    public function __construct(UserGetUseCase $userGetUseCase, UserDeleteUseCase $userDeleteUseCase)
    {
        $this->userGetUseCase = $userGetUseCase;
        $this->userDeleteUseCase = $userDeleteUseCase;
    }

    /**
     * @return $this|ResourceObject
     *
     * @JsonSchema(schema="user.json")
     * @Link(rel="delete", href="/users/{id}", method="delete")
     */
    public function onGet(int $id): ResourceObject
    {
        $output = $this->userGetUseCase->handle(
            new UserGetInputData($id)
        );

        $this->body = json_decode(json_encode(new UserGetViewModel($output)), true);

        return $this;
    }

    public function onDelete(int $id): ResourceObject
    {
        $this->userDeleteUseCase->handle(
            new UserDeleteInputData($id)
        );

        $this->code = StatusCode::NO_CONTENT;

        return $this;
    }
}
