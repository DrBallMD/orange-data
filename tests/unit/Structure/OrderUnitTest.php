<?php declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Tests\Structure;

use OrangeData\Structure\CheckClose;
use OrangeData\Structure\Content;
use OrangeData\Structure\Order;
use OrangeData\Structure\Payment;
use OrangeData\Structure\Position;
use PHPUnit\Framework\TestCase;
use function uniqid;

class OrderUnitTest extends TestCase
{
    public function testSerialize(): void
    {
        $encoded = json_encode(new Order(uniqid('', true), '1234567890', '1234567890', $this->createContent()), JSON_PRESERVE_ZERO_FRACTION);
        $this->assertJson($encoded);
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
}
