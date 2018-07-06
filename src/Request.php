<?php  namespace Baseify;

use \GuzzleHttp\Client as HttpRequest;
use \GuzzleHttp\TransferStats;

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
    protected $output;


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
    * contructor
    *
    */
    public function __construct($path, $options = [])
    {
        $this->path = $path;

        $this->options = $options;

        $this->setHttpResponse();

        if ($this->httpResponse->getStatusCode() !== 200)
        {
            throw new \Exception('Http Status Code: '.$this->httpResponse->getStatusCode());
        }
        else
        {
            $this->output = json_decode($this->httpResponse->getBody(),1);

            $this->throwAnError();
        }
    }


    /**
    * setHttpResponse
    *
    */
    protected function setHttpResponse()
    {
        $this->httpResponse = (new HttpRequest())->request('GET', $this->path, [
            'query' => $this->options,
            'allow_redirects' => true,
            'on_stats' => function (TransferStats $stats) use (&$url) {
                $url = $stats->getEffectiveUri();
            }
        ]);

        $this->effectiveUri = $url;
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
                throw new \Exception($this->output['status'].': '.$this->output['error_message']);
            }

            if (isset($this->output['status']) && in_array($this->output['status'], $this->statusErrors))
            {
                throw new \Exception($this->output['status']);
            }

            return true;
        }

        throw new \Exception('Output format is not correct.');
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
