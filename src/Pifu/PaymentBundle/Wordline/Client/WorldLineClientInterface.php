<?php

declare(strict_types=1);

namespace BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Client;

interface WorldLineClientInterface
{
    /** @throws \Exception */
    public function authorize(string $clientId, string $clientSecret): array;

    public function get(string $url, string $token): array;

    public function post(string $url, string $token, array $data = null, array $extraHeaders = []): array;

    public function patch(string $url, string $token, array $data = null): array;
}
