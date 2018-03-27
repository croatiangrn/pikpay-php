<?php

namespace croatiangrn\PikPay\Responses;
use rnd\web\Controller;
use SimpleXMLElement;

/**
 * PikPay PurchaseResponse.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class PurchaseResponse extends Response
{
    public function isSuccessfull()
    {
        $xml = $this->httpResponse->getBody()->getContents();
        /** @var SimpleXMLElement $parsed_xml */
        $parsed_xml = simplexml_load_string($xml);

        if (property_exists($parsed_xml, 'acs-url')) {
            $this->validate3D($parsed_xml);
        }

        return $this->httpResponse->getStatusCode() == 201;
    }

    /**
     * @param SimpleXMLElement $parsed_xml
     */
    protected function validate3D(SimpleXMLElement $parsed_xml) {
        $url_key = 'acs-url';
        $url_key = $parsed_xml->$url_key;

        $pareq = $parsed_xml->pareq;
        $authenticity_token = 'authenticity-token';
        $authenticity_token = $parsed_xml->$authenticity_token;

        $controller = new Controller();
        echo $controller->renderPartial('../../post_form.php', ['url_key' => $url_key, 'pareq' => $pareq, 'authenticity_token' => $authenticity_token]);
    }

    public function transactionId()
    {
        return (int) preg_replace("/[^0-9]/", "", $this->location());
    }

    public function location()
    {
        return $this->httpResponse->getHeaderLine('location');
    }
}
