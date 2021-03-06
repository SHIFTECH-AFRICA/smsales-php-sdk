<?php


namespace SMSALES\Traits;


use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\ArrayShape;

trait NodeProcessing
{
    /**
     * generate the access token here which will be
     * a bearer token for using in authorizing all
     * the API's
     * @return mixed
     */
    private function getToken(): mixed
    {
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . config('smsales.smsales_token')
            ]
        ];

        // check if cache is active
        if (Cache::has('smsales_access_token')) {
            return Cache::get('smsales_access_token');
        } else {
            $response = json_decode($this->processRequest(
                config('smsales.url.smsales.token'),
                'GET',
                $options,
                true
            ));

            return $this->cacheAccessToken($response);
        }
    }

    /**
     * ---------------------------
     * cache access token here
     * @param object $response
     * @return mixed
     * --------------------------
     */
    private function cacheAccessToken(object $response): mixed
    {
        return Cache::remember('smsales_access_token', now()->addSeconds($response->data->Expires - 5), function () use ($response) {
            return $response->data->Token;
        });
    }

    /**
     * ---------------------
     * set request options
     * ---------------------
     * @param array $data
     * @return array[]
     */
    #[ArrayShape(['headers' => "string[]", 'json' => "array"])]
    private function setRequestOptions(array $data): array
    {
        return [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getToken()
            ],
            'json' => $data,
        ];
    }

    /**
     * ---------------------------------
     * process the request
     * @param string $requestUrl
     * @param string $method
     * @param array $data
     * @param bool $token
     * @return Exception|string|GuzzleException
     * ---------------------------------
     */
    public function processRequest(string $requestUrl, string $method = 'POST', array $data = [], bool $token = false): Exception|string|GuzzleException
    {
        try {
            // define the guzzle client
            $client = new Client([
                'base_uri' => $this->baseUri,
                'timeout' => config('smsales.timeout'),
                'connect_timeout' => config('smsales.connect_timeout'),
                'protocols' => ['http', 'https'],
            ]);

            // make the request
            if ($token) {
                $response = $client->request($method, $requestUrl, $data);
            } else {
                $response = $client->request($method, $requestUrl, $this->setRequestOptions($data));
            }


            return ($response->getBody()->getContents());
        } catch (ClientException $clientException) {
            $exception = $clientException->getResponse()->getBody()->getContents();
            Log::critical('client-exception' . $clientException->getMessage());
            return $exception;
        } catch (ServerException $serverException) {
            $exception = $serverException->getResponse()->getBody()->getContents();
            Log::critical('server-exception' . $serverException->getMessage());
            return $exception;
        } catch (GuzzleException $guzzleException) {
            Log::critical('guzzle-exception' . $guzzleException->getMessage());
            return $guzzleException;
        }
    }
}
