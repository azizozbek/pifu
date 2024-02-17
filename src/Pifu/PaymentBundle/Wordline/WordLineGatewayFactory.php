<?php
namespace BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline;

use BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Action\AuthorizeAction;
use BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Action\CancelAction;
use BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Action\ConvertPaymentAction;
use BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Action\CaptureAction;
use BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Action\NotifyAction;
use BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Action\RefundAction;
use BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Action\StatusAction;
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
            'pifu.action.capture' => new CaptureAction(),
            'pifu.action.authorize' => new AuthorizeAction(),
            'pifu.action.refund' => new RefundAction(),
            'pifu.action.cancel' => new CancelAction(),
            'pifu.action.notify' => new NotifyAction(),
            'pifu.action.status' => new StatusAction(),
            'pifu.action.convert_payment' => new ConvertPaymentAction(),
        ]);

        $config['payum.api'] = function (ArrayObject $config) {
            return new WorldlineToken($config['token']);
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
