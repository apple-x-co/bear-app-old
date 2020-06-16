<?php
declare(strict_types=1);
namespace MyVendor\MyProject\Resource\App;

use AppCore\Application\User\UserApplicationService;
use AppCore\Application\User\UserCreateCommand;
use AppCore\Domain\Model\Email;
use AppCore\Domain\Model\User\UserName;
use AppCore\Domain\Model\User\UserQueryInterface;
use BEAR\RepositoryModule\Annotation\Purge;
use BEAR\Resource\Annotation\JsonSchema;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;
use Koriym\HttpConstants\StatusCode;
use Ray\AuraSqlModule\Annotation\Transactional;

/**
 * Class Users
 */
class Users extends ResourceObject
{
    /** @var UserApplicationService */
    private $userApplicationService;

    /**
     * Users constructor.
     *
     * @param UserApplicationService $userApplicationService
     */
    public function __construct(UserApplicationService $userApplicationService)
    {
        $this->userApplicationService = $userApplicationService;
    }

    /**
     * @return $this|ResourceObject
     *
     * @JsonSchema(schema="users.json")
     */
    public function onGet() : ResourceObject
    {
//        $users = $this->userQuery->all();
        $users = $this->userQuery->find();

        $array = [];
        foreach ($users as $user) {
            $array[] = [
                'id' => $user->getId()->val(),
                'username' => $user->getUserName()->val(),
                'email' => $user->getEmail()->val()
            ];
        }

        $this->body = ['users' => $array];

        return $this;
    }

    /**
     * @param string $username
     * @param string $email
     *
     * @return $this|ResourceObject
     *
     * @JsonSchema(schema="user.json", params="users.json")
     * @Transactional()
     * @Purge(uri="app://self/users")
     */
    public function onPost(
        string $username,
        string $email
    ) : ResourceObject {
        $user = $this->userApplicationService->create(
            new UserCreateCommand(
                $username,
                $email
            )
        );

        $this->code = StatusCode::CREATED;
        $this->headers[ResponseHeader::LOCATION] = '/users/' . $user->getId();

        return $this;
    }
}
