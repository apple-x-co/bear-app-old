<?php

declare(strict_types=1);

namespace App\ViewModel;

use JsonSerializable;

class UserGetViewModel implements JsonSerializable
{
    /** @var int */
    private $id;

    /** @var string */
    private $user_name;

    /** @var string */
    private $email;

    /**
     * UserGetViewModel constructor.
     *
     * @param int    $id
     * @param string $user_name
     * @param string $email
     */
    public function __construct(int $id, string $user_name, string $email)
    {
        $this->id = $id;
        $this->user_name = $user_name;
        $this->email = $email;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'username' => $this->user_name,
            'email' => $this->email
        ];
    }
}
