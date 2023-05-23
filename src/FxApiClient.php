<?php

namespace FxApi\FxApi;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

/**
 * Exposes the FxAPI library to client code.
 */
class FxApiClient
{
    const BASE_URL = 'https://api.fxapi.com/v1/';
    const REQUEST_TIMEOUT_DEFAULT = 15; // seconds

    protected Client $httpClient;

    public function __construct(public string $apiKey, ?array $settings = [])
    {
        $guzzle_opts = [
            'http_errors' => false,
            'headers' => $this->buildHeaders($apiKey),
            'timeout' => $settings['timeout'] ?? self::REQUEST_TIMEOUT_DEFAULT
        ];
        if (isset($settings['guzzle_opts'])) {
            $guzzle_opts = array_merge($guzzle_opts, $settings['guzzle_opts']);
        }
        $this->httpClient = new Client($guzzle_opts);
    }

    /**
     * @throws FxApiException
     */
    private function call(string $endpoint, ?array $query = [])
    {
        $url = self::BASE_URL . $endpoint;

        try {
            $response = $this->httpClient->request('GET', $url, [
                'query' => $query
            ]);
        } catch (GuzzleException $e) {
            throw new FxApiException($e->getMessage());
        } catch (Exception $e) {
            throw new FxApiException($e->getMessage());
        }

        return json_decode($response->getBody(), true);
    }

    /**
     * @throws FxApiException
     */
    public function status()
    {
        return $this->call('status');
    }

    /**
     * @throws FxApiException
     */
    public function currencies(?array $query = [])
    {
        return $this->call('currencies', $query);
    }

    /**
     * @throws FxApiException
     */
    public function latest(?array $query = [])
    {
        return $this->call('latest', $query);
    }

    /**
     * @throws FxApiException
     */
    public function historical($query)
    {
        return $this->call('historical', $query);
    }

    /**
     * @throws FxApiException
     */
    public function convert($query)
    {
        return $this->call('convert', $query);
    }

    /**
     * @throws FxApiException
     */
    public function range($query)
    {
        return $this->call('range', $query);
    }

    /**
     * Build headers for API request.
     * @return array Headers for API request.
     */
    private function buildHeaders($apiKey)
    {
        return [
            'user-agent' => 'FxApi/PHP/0.1',
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'apikey' => $apiKey,
        ];
    }
}
