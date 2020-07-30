<?php

declare(strict_types=1);

namespace AppCore\UseCase\User\Delete;

final class UserDeleteRequest
{
    private $id;

    /**
     * UserDeleteRequest constructor.
     *
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}
