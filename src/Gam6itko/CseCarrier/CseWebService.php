<?php
namespace Gam6itko\CseCarrier;

use Gam6itko\CseCarrier\Type\Element;
use Gam6itko\CseCarrier\Type\Row;

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
     * @param bool $testMode
     * @internal param string $wsdlUrl
     */
    public function __construct($login, $password, $testMode = false)
    {
        $this->login = $login;
        $this->password = $password;

        $wsdlUrl = $testMode ? $this->getWsdlTest() : $this->getWsdlProd();

        $this->soapClient = new \SoapClient($wsdlUrl, [
            'trace'    => $testMode,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
            'classmap' => [
                'Element' => Element::class,
                'Row'     => Row::class
            ]]);
    }

    protected function getWsdlTest()
    {
        return 'http://lk-test.cse.ru/1c/ws/web1c.1cws?wsdl';
    }

    protected function getWsdlProd()
    {
        return 'http://web.cse.ru/1c/ws/Web1C.1cws?wsdl';
    }

    /**
     * @param Element $parameters
     * @return Element|false
     * @throws \SoapFault
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
     * @throws \SoapFault
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
     * @throws \SoapFault
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
     * @throws \SoapFault
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

    /**
     * @param $name
     * @param Element $parameters
     * @return Element
     * @throws \SoapFault
     */
    public function report($name, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'name'       => $name,
            'parameters' => $parameters
        ]);
    }

    /**
     * @param $language
     * @param $company
     * @param $number
     * @param $clientNumber
     * @param $orderData
     * @param $office
     * @return Element
     * @throws \SoapFault
     */
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

    /**
     * @param Element $data
     * @param Element $parameters
     * @return Element
     * @throws \SoapFault
     */
    public function calc(Element $data, Element $parameters = null)
    {
        $arr = ['data' => $data];
        if ($parameters) {
            $arr['parameters'] = $parameters;
        }

        return $this->doRequest(ucfirst(__FUNCTION__), $arr);
    }

    /**
     * @param Element $documents
     * @param Element $parameters
     * @return Element
     * @throws \SoapFault
     */
    public function getFormsForDocuments(Element $documents, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'documents'  => $documents,
            'parameters' => $parameters
        ]);
    }

    /**
     * @param Element $data
     * @param Element $parameters
     * @return Element
     * @throws \SoapFault
     */
    public function getDocuments(Element $data, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'data'       => $data,
            'parameters' => $parameters
        ]);
    }

    /**
     * @param Element $data
     * @param Element $parameters
     * @return Element
     * @throws \SoapFault
     */
    public function updateClientProducts(Element $data, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'data'       => $data,
            'parameters' => $parameters
        ]);
    }

    /**
     * @param Element $data
     * @param Element $parameters
     * @return Element
     * @throws \SoapFault
     */
    public function createGMH(Element $data, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'data'       => $data,
            'parameters' => $parameters
        ]);
    }

    /**
     * @param Element $data
     * @param Element $parameters
     * @return Element
     * @throws \SoapFault
     */
    public function deleteGMH(Element $data, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'data'       => $data,
            'parameters' => $parameters
        ]);
    }

    /**
     * @param Element $data
     * @param Element $parameters
     * @return Element
     * @throws \SoapFault
     */
    public function updateDocument(Element $data, Element $parameters)
    {
        return $this->doRequest(ucfirst(__FUNCTION__), [
            'data'       => $data,
            'parameters' => $parameters
        ]);
    }

    /**
     * @param $methodName
     * @param $array
     * @return Element
     * @throws \SoapFault
     */
    private function doRequest($methodName, $array)
    {
        // workaround - server not accept nil fields like <ns1:Properties xsi:nil="true"/>
        foreach ($array as &$a) {
            if (is_a($a, Element::class)) {
                /** @var Element $a */
                $a = $a->toArray();
            }
        }

        $soapRequest = $this->completeRequest($array);
        $soapResult = $this->soapClient->__soapCall($methodName, [$soapRequest]);
        return $soapResult->return;
    }

    /**
     * @param $array
     * @return array
     */
    private function completeRequest($array)
    {
        return array_merge([
            'login'    => $this->login,
            'password' => $this->password,
        ], $array);
    }

}