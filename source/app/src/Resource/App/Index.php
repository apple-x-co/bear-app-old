<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Resource\App;

use BEAR\Resource\ResourceObject;

class Index extends ResourceObject
{
    /** @var array{overview: string, issue: string, _links: string} */
    public $body = [
        'overview' => 'This is the BEAR.App REST API',
        'issue' => 'https://github.com/apple-x-co/BEAR.App/issues',
        '_links' => [
            'self' => ['href' => '/'],
            'curies' => [
                'href' => 'rels/{rel}.html',
                'name' => 'app',
                'templated' => true,
            ],
            'app:user' => [
                'href' => '/users/{id}',
                'title' => 'The user item',
                'templated' => true,
            ],
            'app:users' => [
                'href' => '/users',
                'title' => 'The user list',
            ],
        ],
    ];

    public function onGet(): ResourceObject
    {
        return $this;
    }
}
