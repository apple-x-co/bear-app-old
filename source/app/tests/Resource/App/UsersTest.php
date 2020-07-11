<?php
declare(strict_types=1);
namespace MyVendor\MyProject\Resource\App;

use BEAR\Resource\ResourceInterface;
use Koriym\HttpConstants\ResponseHeader;
use Koriym\HttpConstants\StatusCode;
use MyVendor\MyProject\Injector;
use PHPUnit\Framework\TestCase;

final class UsersTest extends TestCase
{
    /** @var ResourceInterface */
    private $resource;

    protected function setUp(): void
    {
        $injector = Injector::getInstance('test-hal-api-app');
        $this->resource = $injector->getInstance(ResourceInterface::class);
    }

    public function testOnPost(): void
    {
        $ro = $this->resource->post('app://self/users', [
            'username' => 'bear',
            'email' => 'bear@example.com'
        ]);
        self::assertSame(StatusCode::CREATED, $ro->code);
        self::assertStringStartsWith('/users/', $ro->headers[ResponseHeader::LOCATION]);

        $json = (string)$ro;
        $href = \GuzzleHttp\json_decode($json)->_links->{'detail'}->href;
        self::assertNotEmpty($href);
    }

    /**
     * @depends testOnPost
     */
    public function testOnGet(): void
    {
        $ro = $this->resource->get('app://self/users');
        self::assertSame(StatusCode::OK, $ro->code);

        $json = (string)$ro;
        $href = \GuzzleHttp\json_decode($json)->_links->{'create'}->href;
        self::assertNotEmpty($href);
    }
}
