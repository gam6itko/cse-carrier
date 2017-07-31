<?php

use Gam6itko\CseCarrier\CseWebService;
use Gam6itko\CseCarrier\Enum\ReferenceData;
use Gam6itko\CseCarrier\Structure\Element;
use PHPUnit\Framework\TestCase;

class CseWebServiceTest extends TestCase
{
    protected $referenceFields = [
        ReferenceData::BaseUnitsOfMeasurement   => [],
        ReferenceData::Currencies               => ['FullName', 'IsFolder', 'Parent', 'Level', 'Default'],
        ReferenceData::TypesOfGeographicObjects => ['Country', 'Town'],
        ReferenceData::DeliveryType             => ['Information', 'Default'],
        ReferenceData::TypesOfGeographicObjects => ['Country', 'Town'],
        ReferenceData::TypesOfCargo             => ['Default'],
        ReferenceData::DeliveryType             => ['Information', 'Default'],
        ReferenceData::Geography                => ['Default', 'Parent', 'IsFolder', 'Level', 'Settlement', 'State', 'Type', 'KLADR', 'ID', 'AltCode', 'FIAS', 'PrimaryState', 'HaveDependentObjects', 'HaveDependentSubwayStations'],
        ReferenceData::UnitsOfMeasurement       => [],
    ];


    /**
     * @var \Gam6itko\CseCarrier\CseWebService
     */
    protected $cseWebService;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->cseWebService = new CseWebService('test', '2016', 'http://lk-test.cse.ru/1c/ws/web1c.1cws?wsdl');
    }

    public function testGetReferenceData()
    {
        foreach ($this->referenceFields as $referenceName => $requireFields) {
            printf("getReferenceData:%s" . PHP_EOL, $referenceName);
            ob_flush();

            $parameters = $this->buildReferenceRequest($referenceName);

            $result = $this->cseWebService->getReferenceData($parameters);
//            var_dump($result);
            $this->assertNotFalse($result);

            $this->assertEquals(strtolower($referenceName), strtolower($result->getKey()));
            $this->assertNotEmpty($result->getList());
            $this->assertNotEmpty($result->getList()[0]);

            /** @var Element $firstListElement */
            $firstListElement = $result->getList()[0];
            $this->assertTrue(is_a($firstListElement, Element::class));

            if ($requireFields) {
                $this->assertNotEmpty($firstListElement->getFields());
                foreach ($requireFields as $f) {
                    $this->assertTrue($firstListElement->hasField($f));
                }
            }
        }
    }

    private function buildReferenceRequest($referenceName)
    {
        $method = "buildReferenceRequest$referenceName";
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        return (new Element())
            ->setKey('Parameters')
            ->setList([
                new Element('Reference', $referenceName, 'string')
            ]);
    }

    private function buildReferenceRequestGeography()
    {
        return (new Element())
            ->setKey('Parameters')
            ->setList([
                new Element('Reference', ReferenceData::Geography, 'string'),
                new Element('Search', 'Россия', 'string'),
                new Element('InGroup', '', 'string'),
            ]);
    }
}