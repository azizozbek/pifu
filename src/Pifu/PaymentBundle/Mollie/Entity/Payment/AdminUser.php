<?php


declare(strict_types=1);

namespace BitBag\OpenMarketplace\Pifu\PaymentBundle\Mollie\Entity\Payment;

use Sylius\Component\Core\Model\AdminUser as BaseAdminUser;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherAwareInterface;

class AdminUser extends BaseAdminUser implements PasswordHasherAwareInterface
{
    public function getPasswordHasherName(): ?string
    {
        return $this->encoderName;
    }
}
