<?php

declare(strict_types=1);

namespace AppCore\Application\User\Delete;

final class UserDeleteInputData
{
    private $id;

    /**
     * UserDeleteInputData constructor.
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
