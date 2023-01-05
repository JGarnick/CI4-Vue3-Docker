<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CORS implements FilterInterface
{
    protected $headers = [
        'Access-Control-Allow-Headers' => 'Origin, X-API-KEY, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Headers, Authorization, observe, enctype, Content-Length, X-Csrf-Token',
        'Access-Control-Allow-Methods' => 'GET, PUT, POST, DELETE, PATCH, OPTIONS',
        'Access-Control-Allow-Credentials' => 'true'
    ];

    protected $allowed_domains = [
        "*"
    ];

    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $request_service = service("request");
        // get origins
        if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
            $origin = $_SERVER['HTTP_ORIGIN'];
        } else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
            $origin = $_SERVER['HTTP_REFERER'];
        } else {
            $origin = $_SERVER['REMOTE_ADDR'];
        }

        if(in_array("*", $this->allowed_domains)){
            return $request_service;
        }
        else if (in_array($origin, $this->allowed_domains)) {
            return $request_service;
        }

        die("no access");
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $response_service = service("response");
        // get origins
        if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
            $origin = $_SERVER['HTTP_ORIGIN'];
        } else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
            $origin = $_SERVER['HTTP_REFERER'];
        } else {
            $origin = $_SERVER['REMOTE_ADDR'];
        }
        
        if(in_array("*", $this->allowed_domains)){
            $response_service->setheader('Access-Control-Allow-Origin', "*");
        }
        else if (in_array($origin, $this->allowed_domains)) {
            $response_service->setheader('Access-Control-Allow-Origin', $origin, true);
        }

        foreach($this->headers AS $header => $value){
            $response_service->setheader($header, $value);
        }

        return $response_service;
    }
}
