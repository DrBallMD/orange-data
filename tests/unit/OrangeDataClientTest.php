<?php declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Tests\unit;

use DateTimeImmutable;
use Exception;
use GuzzleHttp\Client;
use OrangeData\Client\OrangeDataClient;
use OrangeData\Client\OrangeDataClientInterface;
use OrangeData\Client\OrangeDataClientInterface as Enum;
use OrangeData\Model\Order;
use OrangeData\Model\Payment;
use OrangeData\Model\Position;
use PHPUnit\Framework\TestCase;

class OrangeDataClientTest extends TestCase
{

    /**
     * @var OrangeDataClientInterface
     */
    private $client;

    protected function setUp(): void
    {
        $signKey = __DIR__.'/../private_key_test.xml';
        $sslkey = __DIR__.'/../client.key';
        $sslcert = __DIR__.'/../client.crt';
        $cainfo = __DIR__.'/../cacert.pem';

        $this->client = new OrangeDataClient(
            new Client([
                'curl' => [
                    CURLOPT_SSLKEY => $sslkey,
                    CURLOPT_SSLCERT => $sslcert,
                    CURLOPT_CAINFO => $cainfo,
                    CURLOPT_RETURNTRANSFER => 1,
                ],
            ]),
            $signKey
        );
    }

    private function createOrder(string $inn): Order
    {
        return (new Order($inn, 'Main', Enum::TYPE_IN, '+79991234567', Enum::TAX_USN))
            ->addPosition(new Position('Тестовый товар', 5, 10.0, Enum::VAT_NO, Enum::PAYMENT_METHOD_FULL,
                Enum::PAYMENT_SUBJECT_SERVICE))
            ->addPayment(new Payment(1, 50.0));
    }

    public function orderProvider(): array
    {
        return [
            'order_in_created' => [
                $this->createOrder('1234567890'),
                201,
            ],
            'order_in_bad' => [
                $this->createOrder('1234517890'),
                400,
            ],
        ];
    }

    public function statusProvider(): array
    {
        return [
            'status_exist' => [
                '1234567890',
                '12345678990',
                200,
            ],
            'status_bad' => [
                '1234517890',
                '12345678990',
                400,
            ],
        ];
    }

    /**
     * @dataProvider orderProvider
     *
     * @param Order $order
     * @param int $statusCode
     */
    public function testCreateOrder(Order $order, int $statusCode): void
    {
        $r = $this->client->createOrder(json_encode($order, JSON_PRESERVE_ZERO_FRACTION));
        $this->assertEquals($statusCode, $r->getStatusCode());
    }

    /**
     * @dataProvider statusProvider
     *
     * @param string $inn
     * @param string $documentId
     * @param int $statusCode
     *
     * @throws Exception
     */
    public function testStatus(string $inn, string $documentId, int $statusCode): void
    {
        $r = $this->client->getStatus($inn, $documentId);
        $this->assertEquals($statusCode, $r->getStatusCode());
        $this->assertArrayHasKey('processedAt', $r->toArray());
        $processedAt = new DateTimeImmutable($r->toArray()['processedAt']);
        $this->assertNotFalse($processedAt);
    }
}
