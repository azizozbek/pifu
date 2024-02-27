<?php

declare(strict_types=1);

namespace BitBag\OpenMarketplace\Pifu\PaymentBundle\Mollie\Entity;

use Doctrine\ORM\Mapping as ORM;

trait RecurringProductVariantTrait
{
    /**
     * @var bool
     * @ORM\Column(type="boolean", name="recurring", nullable="false", options={"default":0})
     */
    private bool $recurring = false;

    /**
     * @var ?int
     * @ORM\Column(type="integer", name="recurring_times", nullable="true")
     */
    private ?int $times = null;

    /**
     * @var ?string
     * @ORM\Column(type="string", name="recurring_interval", nullable="true")
     */
    private ?string $interval = null;

    public function isRecurring(): bool
    {
        return $this->recurring;
    }

    public function setRecurring(bool $recurring): void
    {
        $this->recurring = $recurring;
    }

    public function getTimes(): ?int
    {
        return $this->times;
    }

    public function setTimes(?int $times): void
    {
        $this->times = $times;
    }

    public function getInterval(): ?string
    {
        return $this->interval;
    }

    public function setInterval(?string $interval): void
    {
        $this->interval = $interval;
    }
}
