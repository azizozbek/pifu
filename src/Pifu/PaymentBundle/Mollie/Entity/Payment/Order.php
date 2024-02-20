<?php


declare(strict_types=1);

namespace BitBag\OpenMarketplace\Pifu\PaymentBundle\Mollie\Entity\Payment;

use BitBag\OpenMarketplace\Component\Order\Entity\OrderTrait;
use SyliusMolliePlugin\Entity\AbandonedEmailOrderTrait;
use SyliusMolliePlugin\Entity\ProductVariantInterface;
use SyliusMolliePlugin\Entity\RecurringOrderTrait;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\Order as BaseOrder;
use Sylius\Component\Core\Model\OrderItemInterface;
use BitBag\OpenMarketplace\Component\Order\Entity\OrderInterface;

class Order extends BaseOrder implements OrderInterface
{
    use OrderTrait;
    use AbandonedEmailOrderTrait;

    use RecurringOrderTrait;

    public function getRecurringItems(): Collection
    {
        return $this
            ->items
            ->filter(function (OrderItemInterface $orderItem) {
                $variant = $orderItem->getVariant();

                return $variant !== null
                    && true === $variant->isRecurring();
            })
        ;
    }

    public function getNonRecurringItems(): Collection
    {
        return $this
            ->items
            ->filter(function (OrderItemInterface $orderItem) {
                $variant = $orderItem->getVariant();

                return $variant !== null
                    && false === $variant->isRecurring();
            })
        ;
    }

    public function hasRecurringContents(): bool
    {
        return 0 < $this->getRecurringItems()->count();
    }

    public function hasNonRecurringContents(): bool
    {
        return 0 < $this->getNonRecurringItems()->count();
    }
}
