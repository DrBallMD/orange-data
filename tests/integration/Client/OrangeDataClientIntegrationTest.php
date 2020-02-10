<?php declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Tests\Client;

use Exception;
use GuzzleHttp\Client;
use OrangeData\Client\OrangeDataClient;
use OrangeData\Client\OrangeDataClientInterface;
use OrangeData\Structure\CheckClose;
use OrangeData\Structure\Content;
use OrangeData\Structure\Order;
use OrangeData\Structure\Payment;
use OrangeData\Structure\Position;
use PHPUnit\Framework\TestCase;
use function file_get_contents;
use function uniqid;

class OrangeDataClientIntegrationTest extends TestCase
{

    /**
     * @var OrangeDataClientInterface
     */
    private $client;

    protected function setUp(): void
    {
        $signKey = file_get_contents(__DIR__ . '/../../private_key_test.xml');
        $sslkey = __DIR__ . '/../../client.key';
        $sslcert = __DIR__ . '/../../client.crt';
        $cainfo = __DIR__ . '/../../cacert.pem';

        $this->client = new OrangeDataClient(
            new Client([
                'base_uri' => 'https://apip.orangedata.ru:2443',
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
        return new Order(uniqid('', true), $inn, $inn, $this->createContent(), 'Main');
    }

    private function createContent(): Content
    {
        $payments = [
            new Payment(1, 50.0)
        ];
        $positions = [
            new Position( 5, 10.0, Position::VAT_NO, 'Тестовый товар',
                Position::PAYMENT_METHOD_FULL,
                Position::PAYMENT_SUBJECT_SERVICE)
        ];
        $checkClose = new CheckClose(CheckClose::TAX_USN, $payments);

        return new Content(Content::TYPE_IN, '+79991234567', $positions, $checkClose);
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
        $r = $this->client->createOrder($order);
        $this->assertEquals($statusCode, $r->statusCode());
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
        $this->assertEquals($statusCode, $r->statusCode());
    }
}
