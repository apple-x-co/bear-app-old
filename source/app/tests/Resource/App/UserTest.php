<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Resource\App;

use BEAR\Resource\ResourceInterface;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\StatusCode;
use MyVendor\MyProject\Injector;
use PHPUnit\Framework\TestCase;

use function GuzzleHttp\json_decode;

final class UserTest extends TestCase
{
    /** @var ResourceInterface */
    private $resource;

    protected function setUp(): void
    {
        $injector = Injector::getInstance('test-hal-api-app');
        $this->resource = $injector->getInstance(ResourceInterface::class);
    }

    public function testOnGet(): ResourceObject
    {
        $ro = $this->resource->post('app://self/users', [
            'username' => 'bear',
            'email' => 'bear@example.com',
        ]);

        $ro = $this->resource->get('app://self/user', [
            'id' => $ro->body['id'],
        ]);
        self::assertSame(StatusCode::OK, $ro->code);

        $json = (string) $ro;
        $href = json_decode($json)->_links->{'delete'}->href;
        self::assertNotEmpty($href);

        return $ro;
    }

    /**
     * @depends testOnGet
     */
    public function testOnDelete(ResourceObject $ro): void
    {
        $ro = $this->resource->delete('app://self/user', [
            'id' => $ro->body['id'],
        ]);
        self::assertSame(StatusCode::NO_CONTENT, $ro->code);
    }
}
