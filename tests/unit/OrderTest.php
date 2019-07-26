<?php declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Tests\unit;

use OrangeData\Client\OrangeDataClientInterface as Enum;
use OrangeData\Model\Order;
use OrangeData\Model\Payment;
use OrangeData\Model\Position;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{

    public function orderProvider(): array
    {
        return [
            'order_in' => [
                (new Order('1234567890', 'Main', Enum::TYPE_IN, '+79991234567', Enum::TAX_USN))
                    ->addPosition(new Position('Тестовый товар', 5, 10.0, Enum::VAT_NO, Enum::PAYMENT_METHOD_FULL,
                        Enum::PAYMENT_SUBJECT_SERVICE))
                    ->addPayment(new Payment(1, 50.0)),
            ],
        ];
    }

    /**
     * @dataProvider orderProvider
     *
     * @param Order $order
     */
    public function testSerialize(Order $order): void
    {
        $encoded = json_encode($order, JSON_PRESERVE_ZERO_FRACTION);
        $this->assertJson($encoded);
    }
}
