<?php  namespace Baseify;

use GuzzleHttp\Client as HttpRequest;
use GuzzleHttp\TransferStats;
use GuzzleHttp\Exception\RequestException;
use Exception;

class Request
{

    /**
    * $path
    *
    * @var string
    */
    protected $path;


    /**
    * $options
    *
    * @var array
    */
    protected $options = [];


    /**
    * $httpResponse
    *
    * @see \GuzzleHttp\Client
    */
    protected $httpResponse;


    /**
    * $output
    *
    */
    protected $output = [];


    /**
    * $effectiveUri
    *
    */
    protected $effectiveUri;


    /**
    * $statusErrors
    *
    */
    protected $statusErrors = [
        'OVER_QUERY_LIMIT', 'REQUEST_DENIED', 'INVALID_REQUEST', 'UNKNOWN_ERROR', 'ZERO_RESULTS'
    ];


    /**
    * $forcePath
    *
    */
    public $forcePath = '';


    /**
    * contructor
    *
    */
    public function __construct($options = [])
    {
        $this->options = $options;
    }


    /**
    * send
    *
    */
    public function send($uri, $options = [])
    {
        $options = array_merge($options, $this->options);

        $return = $this->setHttpResponse($uri, $options);

        if ($return==false)
        {
            throw new Exception('Http Response failure');
        }

        if ($this->httpResponse->getStatusCode() !== 200)
        {
            throw new Exception('Http Status Code: '.$this->httpResponse->getStatusCode());
        }
        else
        {
            $this->output = json_decode($this->httpResponse->getBody(),1);

            $this->throwAnError();
        }

        return $this;
    }


    /**
    * setHttpResponse
    *
    */
    protected function setHttpResponse($uri, $options)
    {
        try
        {
            $path = ($this->forcePath != '') ? $this->forcePath : $uri;

            $this->httpResponse = (new HttpRequest())->request('GET', $path, [
                'query' => $options,
                'allow_redirects' => true,
                'http_errors' => false,
                'on_stats' => function (TransferStats $stats) use (&$url) {
                    $url = $stats->getEffectiveUri();
                }
            ]);

            $this->effectiveUri = $url;

            return true;
        }
        catch (RequestException $e)
        {
             return false;
        }
    }


    /**
    * getEffectiveUri
    *
    */
    public function getEffectiveUri()
    {
        return $this->effectiveUri;
    }


    /**
    * throwAnError
    *
    */
    protected function throwAnError()
    {
        if (is_array($this->output))
        {
            if (isset($this->output['status']) && isset($this->output['error_message']))
            {
                throw new Exception($this->output['status'].': '.$this->output['error_message']);
            }

            if (isset($this->output['status']) && in_array($this->output['status'], $this->statusErrors))
            {
                throw new Exception($this->output['status']);
            }

            return true;
        }

        throw new Exception('Output format must be JSON response.');
    }


    /**
    * output
    *
    */
    public function output()
    {
        return $this->output;
    }

}
