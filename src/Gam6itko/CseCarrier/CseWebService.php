<?php

namespace Gam6itko\CseCarrier;

use Gam6itko\CseCarrier\Structure\Element;
use Gam6itko\CseCarrier\Structure\Row;

/**
 * Class CseWebService
 * @package Gam6itko\CseCarrier
 */
class CseWebService
{
    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var \SoapClient
     */
    protected $soapClient;


    /**
     * CseService constructor.
     * @param $login
     * @param $password
     * @param string $wsdlUrl
     */
    public function __construct($login, $password, $wsdlUrl = 'http://lk-test.cse.ru/1c/ws/web1c.1cws?wsdl')
    {
        $this->login = $login;
        $this->password = $password;

        $this->soapClient = new \SoapClient($wsdlUrl, [
            'classmap' => [
                'Element' => Element::class,
                'Row'     => Row::class
            ]]);
    }

    /**
     * @param Element $parameters
     * @return Element|false
     */
    public function getReferenceData(Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'parameters' => $parameters
        ]);
    }

    /**
     * @param Element $data
     * @param Element $parameters
     * @return mixed
     */
    public function saveDocuments(Element $data, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'data'       => $data,
            'parameters' => $parameters
        ]);
    }

    /**
     * @param Element $documents
     * @param Element $parameters
     * @return mixed
     */
    public function tracking(Element $documents, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'documents'  => $documents,
            'parameters' => $parameters
        ]);
    }

    /**
     * @param $type
     * @param $printFormName
     * @param $number
     * @param Element $parameters
     * @return mixed
     */
    public function printDocument($type, $printFormName, $number, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'type'          => $type,
            'printFormName' => $printFormName,
            'number'        => $number,
            'parameters'    => $parameters
        ]);
    }

    public function report($name, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'name'       => $name,
            'parameters' => $parameters
        ]);
    }

    public function saveWaybillOffice($language, $company, $number, $clientNumber, $orderData, $office)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'language'     => $language,
            'company'      => $company,
            'number'       => $number,
            'clientnumber' => $clientNumber,
            'orderdata'    => $orderData,
            'office'       => $office,
        ]);
    }

    public function calc(Element $data, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'data'       => $data,
            'parameters' => $parameters
        ]);
    }

    public function getFormsForDocuments(Element $documents, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'documents'  => $documents,
            'parameters' => $parameters
        ]);
    }

    public function getDocuments(Element $data, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'data'       => $data,
            'parameters' => $parameters
        ]);
    }

    public function updateClientProducts(Element $data, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'data'       => $data,
            'parameters' => $parameters
        ]);
    }

    public function createGMH(Element $data, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'data'       => $data,
            'parameters' => $parameters
        ]);
    }

    public function deleteGMH(Element $data, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'data'       => $data,
            'parameters' => $parameters
        ]);
    }

    public function updateDocument(Element $data, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'data'       => $data,
            'parameters' => $parameters
        ]);
    }

    private function doRequest($methodName, $array)
    {
        $soapRequest = $this->buildRequest($array);
        $soapResult = $this->soapClient->__soapCall($methodName, [$soapRequest]);

        return $this->doResponseFixes($soapResult->return);
    }

    private function buildRequest($array)
    {
        return array_merge([
            'login'    => $this->login,
            'password' => $this->password,
        ], $array);
    }

    private function doResponseFixes(Element $element)
    {
        $ensureArray = ['List', 'Fields'];
        foreach ($ensureArray as $key) {
            $list = call_user_func([$element, "get$key"]);
            if ($list) {
                if (is_a($list, Element::class)) {
                    call_user_func([$element, "set$key"], [$list]);
                }
                foreach ($list as $e) {
                    $this->doResponseFixes($e);
                }
            }
        }

        return $element;
    }
}