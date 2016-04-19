<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/23/2016
 * Time: 10:10 PM
 */

namespace Reviews\ParserBundle\Models;

use Buzz\Client\Curl;
use Buzz\Message\Request;
use Buzz\Message\Response;
use Reviews\ParserBundle\Exceptions\InvalidPage;
use Webmozart\Assert\Assert;

class WebPageGrabber
{
    /**
     * @var Curl
     */
    private $curlAdaptor = null;

    /**
     * Timeout in seconds for curl requests
     * @var int
     */
    private $curlTimeout = 20;

    /**
     * Body content that will be sent with the next request
     * @var string
     */
    private $requestContent = null;

    /**
     * @var string
     */
    private $requestMethod = null;

    /**
     * Time to wait
     * @var int
     */
    private $waitBetweenRequestsTime = 2; // seconds

    /**
     * @var string
     */
    private $url = null;

    /**
     * Time of the last request
     * @var type
     */
    static private $lastRequestTime = null;

    /**
     * Setup of the class
     * @param string $url Url to grab
     */
    public function __construct($url, $requestMethod = Request::METHOD_GET, $requestContent = null)
    {
        $this->curlAdaptor = new Curl();
        $this->curlAdaptor->setTimeout($this->curlTimeout);
        $this->curlAdaptor->setVerifyHost(false);
        $this->curlAdaptor->setVerifyPeer(false);

        $this->url = $url;
        $this->requestContent = $requestContent;
        $this->requestMethod = $requestMethod;
    }

    /**
     * Get the content of the page
     *
     * @return string
     */
    public function getPageContent()
    {
        $this->checkTimer();

        $requestObject = new Request();
        $requestObject->setResource($this->url);
        $requestObject->setMethod($this->requestMethod);
        if ($this->requestContent) {
            $requestObject->setContent($this->requestContent);
        }

        $responseObject = new Response();
        $this->curlAdaptor->send($requestObject, $responseObject);

        if ($responseObject->getStatusCode() != 200) {
            throw new InvalidPage();
        }
        return $responseObject->getContent();
    }

    /**
     * Check the timer and sleep if a pause is needed
     */
    private function checkTimer()
    {
        if (!is_null(self::$lastRequestTime) && time() - self::$lastRequestTime < 1) {
            sleep($this->waitBetweenRequestsTime);
        }

        self::$lastRequestTime = time();
    }
}