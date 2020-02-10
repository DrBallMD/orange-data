<?php declare(strict_types=1);


namespace OrangeData\Client;


use phpseclib\Crypt\RSA;
use function base64_encode;

class Sign implements SignInterface
{
    /**
     * @var string
     */
    private $data;

    /**
     * @var string
     */
    private $signKey;

    public function __construct(string $data, string $signKey)
    {
        $this->data = $data;
        $this->signKey = $signKey;
    }

    public function toString(): string
    {
        $rsa = new RSA();
        $rsa->setPrivateKey($this->signKey);
        $rsa->setPrivateKeyFormat(RSA::PRIVATE_FORMAT_XML);
        $rsa->setHash('sha256');
        $rsa->setMGFHash('sha256');
        $rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);

        return base64_encode($rsa->sign($this->data));
    }
}