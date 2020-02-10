<?php

declare(strict_types=1);


namespace OrangeData\Sign;

use OrangeData\Body\BodyInterface;
use phpseclib\Crypt\RSA;
use function base64_encode;

class Base64EncodedRsa256 implements SignInterface
{
    /**
     * @var BodyInterface
     */
    private $body;

    /**
     * @var string
     */
    private $signKey;

    public function __construct(BodyInterface $body, string $signKey)
    {
        $this->body = $body;
        $this->signKey = $signKey;
    }

    public function asString(): string
    {
        $rsa = new RSA();
        $rsa->setPrivateKey($this->signKey);
        $rsa->setPrivateKeyFormat(RSA::PRIVATE_FORMAT_XML);
        $rsa->setHash('sha256');
        $rsa->setMGFHash('sha256');
        $rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);

        return base64_encode($rsa->sign($this->body->asString()));
    }
}
