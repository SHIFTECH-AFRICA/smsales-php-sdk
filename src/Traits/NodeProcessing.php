<?php


namespace SMSALES\Traits;


use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . config('smsales.smsales_token')
        ];

        // check if cache is active
        if (Cache::has('smsales_access_token')) {
            return Cache::get('smsales_access_token');
        } else {
            $response = json_decode(Http::withHeaders($options)
                ->baseUrl(config('smsales.url.endpoint'))
                ->timeout(config('smsales.timeout'))
                ->connectTimeout(config('smsales.connect_timeout'))
                ->retry(3)
                ->get(
                    config('smsales.url.smsales.token')
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
     * process the request here
     * @param string $requestUrl
     * @param string $method
     * @param array $data
     * @return PromiseInterface|Exception|Response
     */
    public function processRequest(string $requestUrl, string $method = 'POST', array $data = []): PromiseInterface|Exception|Response
    {
        try {
            if ($method == 'POST') {
                $response = Http::acceptJson()
                    ->baseUrl(config('smsales.url.endpoint'))
                    ->withToken($this->getToken())
                    ->timeout(config('smsales.timeout'))
                    ->connectTimeout(config('smsales.connect_timeout'))
                    ->retry(3)
                    ->post(
                        $requestUrl,
                        $data
                    );
            } else {
                $response = Http::acceptJson()
                    ->baseUrl(config('smsales.url.endpoint'))
                    ->withToken($this->getToken())
                    ->timeout(config('smsales.timeout'))
                    ->connectTimeout(config('smsales.connect_timeout'))
                    ->retry(3)
                    ->get(
                        $requestUrl,
                        $data
                    );
            }

            return $response;
        } catch (Exception  $connectionException) {
            Log::critical($method . ' Smsales Sdk Client Connection Exception' . $connectionException->getMessage());
            return $connectionException;
        }
    }
}
