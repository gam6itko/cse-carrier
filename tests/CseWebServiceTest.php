<?php

use Gam6itko\CseCarrier\CseWebService;
use Gam6itko\CseCarrier\Enum\ReferenceData;
use Gam6itko\CseCarrier\Structure\Element;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class CseWebServiceTest extends TestCase
{
    /**
     * @var \Gam6itko\CseCarrier\CseWebService
     */
    protected $cseWebService;

    /**
     * CseWebServiceTest constructor.
     */
    public function __construct()
    {
        $this->cseWebService = new CseWebService('test', '2016');
    }

    public function testGetReferenceDataCurrencies()
    {
        $parameters = (new Element())
            ->setKey('Parameters')
            ->setList([
                new Element('Reference', ReferenceData::Currencies, 'string')
            ]);

        $result = $this->cseWebService->getReferenceData($parameters);

        $this->assertNotFalse($result);
        var_dump($result);
    }
}