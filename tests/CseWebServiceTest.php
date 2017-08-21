<?php

use Gam6itko\CseCarrier\CseWebService;
use Gam6itko\CseCarrier\Enum\ReferenceData;
use Gam6itko\CseCarrier\Type\Element;
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

        $this->cseWebService = new CseWebService('test', '2016', true);
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

    public function testCalc()
    {
        $data = (new Element('Destinations'))
            ->setList([
                (new Element('Destination'))
                    ->setFields([
                        new Element('SenderGeography', 'cf862f56-442d-11dc-9497-0015170f8c09'),
                        new Element('RecipientGeography', 'cf862f56-442d-11dc-9497-0015170f8c09'),
//                    new Element('Urgency', ''),
                        new Element('TypeOfCargo', '4aab1fc6-fc2b-473a-8728-58bcd4ff79ba'),
                        new Element('Weight', 1, 'float'), //kg
                        new Element('Qty', 1, 'int'),
                        new Element('VolumeWeight', 1, 'float'),
                        new Element('Volume', 1, 'float'),
//                    new Element('deliverytype', ''),
                    ])
            ]);

        $parameters = (new Element('Parameters'))
            ->setList([
                new Element('ipaddress', '10.0.0.1'),
            ]);

        $result = $this->cseWebService->calc($data, $parameters);
        $this->assertNotFalse($result);
    }

    public function testOrder()
    {
        $data = (new Element('Documents'))
            ->setList([
                (new Element('Order'))
                    ->setFields([
                        new Element('ClientNumber', '123'),
                        new Element('AgentNumber', ''),
                        new Element('ContactPerson', ''),
                        new Element('Department', ''),
                        new Element('Project', ''),
                        new Element('TakeDate', (new \DateTime())->format(DATE_ATOM)),
                        new Element('TakeTime', '10 - 12'),
                        new Element('TakeAtOffice', ''),
                        new Element('DeliveryDate', (new \DateTime('monday next week'))->format(DATE_ATOM)),
                        new Element('DeliveryTime', ''),
                        new Element('Comment', 'common comment text, nothing special'),
                        new Element('Sender', 'SenderName'),
                        new Element('SenderOfficial', 'SenderOfficial'),
                        new Element('SenderGeography', 'cf862f56-442d-11dc-9497-0015170f8c09'),
                        new Element('SenderAddress', 'Moscow'),
                        new Element('SenderPhone', '123-45-67'),
                        new Element('SenderEMail', 'gam6itko@gmail.com'),
                        new Element('SenderInfo', 'common sender info, nothing special'),
                        new Element('Recipient', 'RecipientName'),
                        new Element('RecipientOfficial', 'RecipientContactFullName'),
                        new Element('RecipientGeography', 'cf862f77-442d-11dc-9497-0015170f8c09'),
                        new Element('RecipientAddress', 'Moscow'),
                        new Element('RecipientPhone', '765-43-21'),
                        new Element('RecipientEMail', 'recipient@gmail.com'),
                        new Element('RecipientInfo', 'common recipient info, nothing special'),
                        new Element('Repository', ''),
                        new Element('Urgency', '18c4f207-458b-11dc-9497-0015170f8c09'),
                        new Element('Payer', '2'),
                        new Element('PaymentMethod', '0'),
                        new Element('ShippingMethod', ''),
                        new Element('TypeOfCargo', '4aab1fc6-fc2b-473a-8728-58bcd4ff79ba'),
                        new Element('WithReturn', ''),
                        new Element('Weight', 2, 'float'),
                        new Element('Height', ''),
                        new Element('Length', ''),
                        new Element('Width', ''),
                        new Element('CargoDescription', 'cargo description'),
                        new Element('CargoPackageQty', 2, 'int'),
                        new Element('InsuranceRate', ''),
                        new Element('InsuranceRateCurrency', ''),
                        new Element('DeclaredValueRate', ''),
                        new Element('DeclaredValueRateCurrency', ''),
                        new Element('ValueForCustomsPurposes', ''),
                        new Element('ValueForCustomsPurposesCurrency', ''),
                        new Element('COD', ''),
                        new Element('CODPayer', ''),
                        new Element('CODDescription', ''),
                        new Element('CODCurrency', ''),
                        new Element('SenderShippingCost', ''),
                        new Element('ItemsProcessingAction', 'incoming'),
                        new Element('ReplyEMail', ''),
                        new Element('ReplySMSPhone', ''),
                    ])
                    ->setTables([
                        (new Element('ItemData'))
                            ->setFields([
                                new Element('Item', 'article-M055001011W'),
                                new Element('Qty', 1, 'int'),
                                new Element('Price', 500, 'float'),
                                new Element('VATRate', '0'),
                            ]),
                        (new Element('CargoPackages'))
                            ->setList([
                                new Element('PackageID', 'M055001011'),
                                new Element('PackageQty', 1, 'int'),
                                new Element('Width', 10, 'float'),
                                new Element('Height', 10, 'float'),
                                new Element('Weight', 10, 'float'),
                            ])
                    ])
            ]);

        $parameters = (new Element('Parameters'))
            ->setList([
                new Element('DocumentType', 'Order'),
                new Element('StoreDependsOnDestination', true, 'boolean'),
            ]);

        $result = $this->cseWebService->saveDocuments($data, $parameters);
        $this->assertNotFalse($result);
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