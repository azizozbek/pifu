<?php

declare(strict_types=1);

namespace BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Api;

final class WorldlineApi
{

    public const LIVE_URL = 'https://payment.direct.worldline-solutions.com/v2/MERCHANT_ID/hostedcheckouts';
    public const TEST_URL = 'https://payment.preprod.direct.worldline-solutions.com/v2/MERCHANT_ID/hostedcheckouts';

    public function __construct(
        private string $api_key,
        private string $api_secret,
        private string $merchant_id
    ){}

    public function getApiKey(): string
    {
        return $this->api_key;
    }

    public function getApiSecret(): string
    {
        return $this->api_secret;
    }

    public function getMerchantId(): string
    {
        return $this->merchant_id;
    }
}
