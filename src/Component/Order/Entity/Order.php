<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\OpenMarketplace\Component\Order\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Order as BaseOrder;
use SyliusMolliePlugin\Entity\AbandonedEmailOrderTrait;
use SyliusMolliePlugin\Entity\MollieSubscriptionInterface;
use SyliusMolliePlugin\Entity\RecurringOrderTrait;
use SyliusMolliePlugin\Entity\OrderInterface as SyliueOrderInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_order")
 */
class Order extends BaseOrder implements OrderInterface, SyliueOrderInterface
{
    use OrderTrait;
    use AbandonedEmailOrderTrait;
    use RecurringOrderTrait;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="abandoned_email")
     */
    protected $abandonedEmail = false;

    /**
     * @var ?int
     * @ORM\Column(type="integer", name="recurring_sequence_index", nullable=true)
     */
    protected $recurringSequenceIndex;

    /**
     * @var MollieSubscriptionInterface|null
     * @ORM\ManyToOne(targetEntity="SyliusMolliePlugin\Entity\MollieSubscription")
     * @ORM\JoinColumn(name="subscription_id", fieldName="subscription", onDelete="RESTRICT")
     */
    protected $subscription = null;

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
