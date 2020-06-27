<?php
declare(strict_types=1);
namespace MyVendor\MyProject\Resource\App;

use BEAR\Package\AppInjector;
use BEAR\Resource\ResourceInterface;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\StatusCode;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    /** @var ResourceInterface */
    private $resource;

    protected function setUp() : void
    {
        $this->resource = (new AppInjector('MyVendor\MyProject', 'test-hal-api-app'))->getInstance(ResourceInterface::class);
    }

    public function testOnGet() : ResourceObject
    {
        $ro = $this->resource->post('app://self/users', [
            'username' => 'bear',
            'email' => 'bear@example.com'
        ]);

        $ro = $this->resource->get('app://self/user', [
            'id' => $ro->body['id']
        ]);
        $this->assertSame(StatusCode::OK, $ro->code);

        return $ro;
    }

    /**
     * @param ResourceObject $ro
     *
     * @depends testOnGet
     */
    public function testOnDelete(ResourceObject $ro) : void
    {
        $ro = $this->resource->delete('app://self/user', [
            'id' => $ro->body['id']
        ]);
        $this->assertSame(StatusCode::NO_CONTENT, $ro->code);
    }
}
