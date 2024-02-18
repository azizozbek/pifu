<?php

declare(strict_types=1);

namespace BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Client;

use BitBag\OpenMarketplace\Pifu\PaymentBundle\Wordline\Api\WorldlineApi;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\ChannelInterface;

final class WorldLineClient implements WorldLineClientInterface
{
    public function __construct(
        private ClientInterface $client,
        private LoggerInterface $logger,
        private ChannelContextInterface $channelContext,
        private $requestTrialsLimit = 3
    ) {}

    public function authorize(string $clientId, string $clientSecret): array
    {
        $response = $this->doRequest(
            'POST',
            WorldlineApi::LIVE_URL . 'v1/oauth2/token',
            [
                'auth' => [$clientId, $clientSecret],
                'form_params' => ['grant_type' => 'client_credentials'],
            ]
        );

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Authorisation');
        }

        return (array) json_decode($response->getBody()->getContents(), true);
    }

    public function get(string $url, string $token): array
    {
        return $this->request('GET', $url, $token);
    }

    public function post(string $url, string $token, array $data = null, array $extraHeaders = []): array
    {
        $headers = array_merge($extraHeaders, []);

        return $this->request('POST', $url, $token, $data, $headers);
    }

    public function patch(string $url, string $token, array $data = null): array
    {
        return $this->request('PATCH', $url, $token, $data);
    }

    private function request(string $method, string $url, string $token, array $data = null, array $extraHeaders = []): array
    {
        /** @var ChannelInterface $channel */
        $channel = $this->channelContext->getChannel();
        $options = [
            'headers' => array_merge([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ], $extraHeaders),
        ];

        if ($data !== null) {
            $options['json'] = $data;
        }

        $fullUrl = WorldlineApi::LIVE_URL . $url;

        try {
            $response = $this->doRequest($method, $fullUrl, $options);
            $this->logger->debug(sprintf('%s request to "%s" called successfully', $method, $fullUrl));
        } catch (RequestException $exception) {
            /** @var ResponseInterface $response */
            $response = $exception->getResponse();
        }

        $content = (array) json_decode($response->getBody()->getContents(), true);

        if (
            (!in_array($response->getStatusCode(), [200, 204])) &&
            isset($content['debug_id'])
        ) {
            $this
                ->logger
                ->error(sprintf('%s request to "%s" failed with debug ID %s', $method, $fullUrl, (string) $content['debug_id']))
            ;
        }

        return $content;
    }

    private function doRequest(string $method, string $fullUrl, array $options): ResponseInterface
    {
        try {
            $response = $this->client->request($method, $fullUrl, $options);
        } catch (ConnectException $exception) {
            --$this->requestTrialsLimit;
            if ($this->requestTrialsLimit === 0) {
                throw new \Exception('Timeout');
            }

            return $this->doRequest($method, $fullUrl, $options);
        } catch (RequestException $exception) {
            /** @var ResponseInterface $response */
            $response = $exception->getResponse();
        }

        return $response;
    }
}
