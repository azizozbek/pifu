<?php

declare(strict_types=1);

namespace BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Api;

use BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Client\WorldLineClientInterface;
use Sylius\Bundle\PayumBundle\Model\GatewayConfigInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\PaymentInterface;
use Sylius\Component\Core\Model\PaymentMethodInterface;
use Webmozart\Assert\Assert;

final class CreateOrderApi implements CreateOrderApiInterface
{
    public function __construct(
        private readonly WorldLineClientInterface $client,
    )
    {}

    public function create(PaymentInterface $payment): array
    {
        /** @var OrderInterface $order */
        $order = $payment->getOrder();

        /** @var PaymentMethodInterface $paymentMethod */
        $paymentMethod = $payment->getMethod();

        /** @var GatewayConfigInterface $gatewayConfig */
        $gatewayConfig = $paymentMethod->getGatewayConfig();


        $config = $gatewayConfig->getConfig();

        Assert::keyExists($config, 'merchant_id');

        return ['status' => 'CREATED'];
        //return $this->client->post('v2/checkout/orders', 'token', [], []);
    }
}
