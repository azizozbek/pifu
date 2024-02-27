<?php

declare(strict_types=1);

namespace BitBag\OpenMarketplace\Pifu\PaymentBundle\Mollie\Entity;

use BitBag\OpenMarketplace\Component\Product\Entity\ProductInterface;
use BitBag\OpenMarketplace\Component\Product\Model\ProductTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Product as BaseProduct;
use SyliusMolliePlugin\Entity\ProductInterface as MollieProductInterface;
use SyliusMolliePlugin\Entity\ProductTrait as MollieProductTrait;

class Product extends BaseProduct implements ProductInterface, MollieProductInterface
{
    use ProductTrait;
    use MollieProductTrait;
    /**
     * @ORM\ManyToOne(targetEntity="SyliusMolliePlugin\Entity\ProductType")
     * @ORM\JoinColumn(name="product_type_id", fieldName="productType", onDelete="SET NULL")
     */
    protected $productType;

}
