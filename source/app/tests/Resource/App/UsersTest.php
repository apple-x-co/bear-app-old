<?php
declare(strict_types=1);
namespace MyVendor\MyProject\Resource\App;

use BEAR\Package\AppInjector;
use BEAR\Resource\ResourceInterface;
use Koriym\HttpConstants\ResponseHeader;
use Koriym\HttpConstants\StatusCode;
use PHPUnit\Framework\TestCase;

final class UsersTest extends TestCase
{
    /** @var ResourceInterface */
    private $resource;

    protected function setUp() : void
    {
        $this->resource = (new AppInjector('MyVendor\MyProject', 'test-hal-api-app'))->getInstance(ResourceInterface::class);
    }

    public function testOnGet() : void
    {
        $ro = $this->resource->get('app://self/users');
        $this->assertSame(StatusCode::OK, $ro->code);
    }

    public function testOnPost() : void
    {
        $ro = $this->resource->post('app://self/users', [
            'username' => 'bear',
            'email' => 'bear@example.com'
        ]);
        $this->assertSame(StatusCode::CREATED, $ro->code);
        $this->assertStringStartsWith('/users/', $ro->headers[ResponseHeader::LOCATION]);
    }
}