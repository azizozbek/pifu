<?php
declare(strict_types=1);
namespace BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline;

use BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Api\Api;
use BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Api\WorldlineApi;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\GatewayFactory;

class WordLineGatewayFactory extends GatewayFactory
{
    /**
     * {@inheritDoc}
     */
    protected function populateConfig(ArrayObject $config)
    {
        $config->defaults([
            'pifu.factory_name' => 'worldline_payment',
            'pifu.factory_title' => 'worldline',
        ]);

        $config['payum.api'] = function (ArrayObject $config) {
            return new WorldlineApi($config['api_key'], $config['api_secret'], $config['merchant_id']);
        };


        if (false == $config['pifu.api']) {
            $config['pifu.default_options'] = array(
                'sandbox' => true,
            );
            $config->defaults($config['pifu.default_options']);
            $config['pifu.required_options'] = [];

            $config['pifu.api'] = function (ArrayObject $config) {
                $config->validateNotEmpty($config['pifu.required_options']);

                return new Api((array) $config, $config['payum.http_client'], $config['httplug.message_factory']);
            };
        }
    }
}
