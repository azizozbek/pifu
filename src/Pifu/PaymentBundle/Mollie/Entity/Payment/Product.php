<?php


declare(strict_types=1);

namespace BitBag\OpenMarketplace\Pifu\PaymentBundle\Mollie\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use SyliusMolliePlugin\Entity\ProductInterface;
use BitBag\OpenMarketplace\Component\Product\Model\ProductTrait;
use Sylius\Component\Core\Model\Product as BaseProduct;

class Product extends BaseProduct implements ProductInterface
{
    use ProductTrait;
    /**
     * @ORM\ManyToOne(targetEntity="SyliusMolliePlugin\Entity\ProductType")
     * @ORM\JoinColumn(name="product_type_id", fieldName="productType", onDelete="SET NULL")
     */
    protected $productType;
}
