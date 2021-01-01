<?php

namespace Coinbase\Wallet\Authentication;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApiKeyAuthentication implements Authentication
{
    private $apiKey;
    private $apiSecret;
    private $passphrase;

    public function __construct($apiKey, $apiSecret, $passphrase)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->passphrase = $passphrase;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }
    public function getPassphrase()
    {
        return $this->passphrase;
    }

    public function setPassphrase($passphrase)
    {
        $this->passphrase = $passphrase;
    }

    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    public function setApiSecret($apiSecret)
    {
        $this->apiSecret = $apiSecret;
    }

    public function getRequestHeaders($method, $path, $body)
    {
        $timestamp = $this->getTimestamp();
//        $signature = $this->getHash('sha256', $timestamp.$method.$path.$body, $this->apiSecret);
        $signature = $this->signature($path, $body, $timestamp, $method);
        return [
            'CB-ACCESS-KEY'       => $this->apiKey,
            'CB-ACCESS-SIGN'      => $signature,
            'CB-ACCESS-TIMESTAMP' => $timestamp,
            'CB-ACCESS-PASSPHRASE' => $this->passphrase,
        ];
    }

    public function signature($request_path='', $body='', $timestamp=false, $method='GET') {
        $body = is_array($body) ? json_encode($body) : $body;
        $timestamp = $timestamp ? $timestamp : time();

        $what = $timestamp.$method.$request_path.$body;

        return base64_encode(hash_hmac("sha256", $what, base64_decode($this->apiSecret), true));
    }

    public function createRefreshRequest($baseUrl)
    {
    }

    public function handleRefreshResponse(RequestInterface $request, ResponseInterface $response)
    {
    }

    public function createRevokeRequest($baseUrl)
    {
    }

    public function handleRevokeResponse(RequestInterface $request, ResponseInterface $response)
    {
    }

    // protected

    protected function getTimestamp()
    {
        return time();
    }

    protected function getHash($algo, $data, $key)
    {
        return hash_hmac($algo, $data, $key);
    }
}
