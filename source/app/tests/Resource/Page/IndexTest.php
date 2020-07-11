<?php
namespace MyVendor\MyProject\Resource\Page;

use BEAR\Package\AppInjector;
use BEAR\Resource\ResourceInterface;
use MyVendor\MyProject\Injector;
use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    /**
     * @var ResourceInterface
     */
    private $resource;

    protected function setUp() : void
    {
        $injector = Injector::getInstance('test-app');
        $this->resource = $injector->getInstance(ResourceInterface::class);
    }

    public function testOnGet()
    {
        $ro = $this->resource->get('page://self/index', ['name' => 'BEAR.Sunday']);
        self::assertSame(200, $ro->code);
        self::assertSame('Hello BEAR.Sunday', $ro->body['greeting']);
    }
}
