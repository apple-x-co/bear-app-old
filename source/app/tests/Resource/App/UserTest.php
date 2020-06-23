<?php
declare(strict_types=1);
namespace MyVendor\MyProject\Resource\App;

use BEAR\Package\AppInjector;
use BEAR\Resource\ResourceInterface;
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

    public function testOnGet() : void
    {
        $ro = $this->resource->get('app://self/user', [
            'id' => 1
        ]);
        $this->assertSame(StatusCode::OK, $ro->code);
    }

    public function testOnDelete() : void
    {
        $ro = $this->resource->delete('app://self/user', [
            'id' => 1
        ]);
        $this->assertSame(StatusCode::NO_CONTENT, $ro->code);
    }
}
