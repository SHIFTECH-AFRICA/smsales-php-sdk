<?php


namespace SMSALES\API;


use Exception;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Response;
use SMSALES\Traits\NodeProcessing;
use SMSALES\Traits\NodeResponse;

class Trigger
{
    use NodeProcessing, NodeResponse;

    /**
     * @var Repository|Application|mixed
     */
    private $baseUri;

    /**
     * -----------------------------
     * create class instance here
     * -----------------------------
     */
    public function __construct()
    {
        $this->baseUri = config('smsales.url.endpoint');
    }

    /**
     * -------------------------------
     * get latest sent sms
     * database from the api
     * -------------------------------
     * @return mixed
     */
    public function index()
    {
        try {
            return json_decode($this->processRequest(
                config('smsales.url.smsales.sms'),
                'GET',
            ));
        } catch (Exception $exception) {
            return $this->errorResponse(
                $exception->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * -------------------------------
     * Initiate bulk sms
     * express transactions
     * -------------------------------
     * @param array $options
     * @return mixed
     */
    public function send(array $options)
    {
        try {
            return json_decode($this->processRequest(
                config('smsales.url.smsales.send'),
                'POST',
                $options
            ));
        } catch (Exception $exception) {
            return $this->errorResponse(
                $exception->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
