<?php

namespace Erdaldemirci\Larasquarev;


use GuzzleHttp\Client;

class FoursquareClient extends Client
{

    /**
     * The default Foursquare API url
     *
     * @var string
     */
    protected $apiUrl = 'https://api.foursquare.com/v2/';

    /**
     * Your Client Id
     *
     * @var string
     */
    protected $clientId;

    /**
     * Your Client Secret
     *
     * @var string
     */
    protected $clientSecret;

    /**
     * A date that represents the "version" of the API
     * if no version is passed the latest version will be used
     * @see https://developer.foursquare.com/overview/versioning
     *
     * @var string
     */
    protected $version;

    public function __construct($clientId, $clientSecret, $apiUrl = null, $version = null)
    {

        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->version = date('Ymd');

        if ($apiUrl)
            $this->apiUrl = $apiUrl;

        if (!is_null($version))
            $this->version = $version;


        parent::__construct();
    }


    public function consume($endpoint, $body = [])
    {

        $uri = $this->getUri($endpoint, $body);

        $response = $this->get($uri)->getBody()->getContents();

        return json_decode($response);

    }


    private function getUri($endpoint, $body)
    {
        $params = array_merge($body, $this->getAuth());

        $paramsJoined = [];

        foreach ($params as $param => $value) {
            $paramsJoined[] = "$param=$value";
        }
        $query = implode('&', $paramsJoined);

        return $this->apiUrl . '/' . $endpoint . '?' . $query;
    }

    private function getAuth()
    {
        return [
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'v'             => $this->version
        ];
    }


}