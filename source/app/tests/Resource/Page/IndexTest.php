<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Resource\Page;

use BEAR\Resource\ResourceInterface;
use MyVendor\MyProject\Injector;
use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     * @var ResourceInterface
     */
    private $resource;

    protected function setUp(): void
    {
        $injector = Injector::getInstance('test-app');
        $this->resource = $injector->getInstance(ResourceInterface::class);
    }

    public function testOnGet(): void
    {
        $ro = $this->resource->get('page://self/index', ['name' => 'BEAR.Sunday']);
        self::assertSame(200, $ro->code);
        self::assertSame('Hello BEAR.Sunday', $ro->body['greeting']);
    }
}
