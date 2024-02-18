<?php

declare(strict_types=1);

namespace BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Api;

use Sylius\Component\Core\Model\PaymentInterface;

interface CreateOrderApiInterface
{
    public function create(PaymentInterface $payment): array;
}
