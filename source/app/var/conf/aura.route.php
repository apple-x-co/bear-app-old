<?php
declare(strict_types=1);

/* @var \Aura\Router\Map $map */
$map->route('/user', '/users/{id}')->tokens(['id' => '\d+']);