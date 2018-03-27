<?php

namespace croatiangrn\PikPay\Requests;

use GuzzleHttp\Client as HttpClient;
use croatiangrn\PikPay\Gateway;
use croatiangrn\PikPay\Requests\Request;
use croatiangrn\PikPay\Responses\PurchaseResponse;

/**
 * PikPay PurchaseRequest.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class PurchaseRequest extends Request
{
    protected $uri;
    protected $params;
    protected $httpClient;
    protected $httpRequest;
    protected $response;

    public function __construct(HttpClient $httpClient, Gateway $gateway, array $params, $installments = null)
    {
        $this->setInstallments($params, $installments);
        parent::__construct($httpClient, $gateway, 'purchase', $this->params);
        $this->uri = '/api';
        $this->httpClient = $httpClient;
        $this->send();
    }

    public function response()
    {
        return new PurchaseResponse($this->response);
    }
}
