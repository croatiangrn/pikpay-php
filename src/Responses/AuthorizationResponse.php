<?php

namespace croatiangrn\PikPay\Responses;

/**
 * PikPay AuthorizationResponse.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class AuthorizationResponse extends Response
{
    public function isSuccessfull()
    {
        return $this->httpResponse->getStatusCode() == 201;
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
