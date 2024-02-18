<?php

declare(strict_types=1);

namespace BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Action;

use Payum\Core\Action\ActionInterface;
use Payum\Core\Request\GetStatusInterface;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\Exception\RequestNotSupportedException;
use Sylius\Component\Core\Model\PaymentInterface;

class StatusAction implements ActionInterface
{
    public const STATUS_NEW = 'new';
    public const STATUS_CAPTURED = 'CAPTURED';
    public const STATUS_CREATED = 'CREATED';
    public const STATUS_COMPLETED = 'COMPLETED';
    public const STATUS_PROCESSING = 'PROCESSING';

    /**
     * {@inheritDoc}
     *
     * @param GetStatusInterface $request
     */
    public function execute($request)
    {
        RequestNotSupportedException::assertSupports($this, $request);

        /** @var PaymentInterface $payment */
        $payment = $request->getFirstModel();

        if ($payment->getState() === self::STATUS_CREATED || $payment->getState() === self::STATUS_NEW) {
            $request->markNew();

            return;
        }

        if ($payment->getState() === self::STATUS_CAPTURED) {
            $request->markPending();

            return;
        }

        if ($payment->getState() === self::STATUS_COMPLETED) {
            $request->markCaptured();

            return;
        }

        $request->markFailed();
    }

    /**
     * {@inheritDoc}
     */
    public function supports($request)
    {
        return
            $request instanceof GetStatusInterface &&
            $request->getModel() instanceof \ArrayAccess
        ;
    }
}
