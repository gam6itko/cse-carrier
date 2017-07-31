<?php
namespace Gam6itko\CseCarrier\Enum;

final class ReferenceData
{
    /**  allows to get a list of currencies that is used in other functions called by the web service */
    const Currencies = 'Currencies';
    const TypesOfGeographicObjects = 'TypesOfGeographicObjects';
    const TypesOfCargo = 'TypesOfCargo';
    /** The function allows to get delivery types that are used in other functions called by the web service.  */
    const DeliveryType = 'DeliveryType';
    /** The function allows to get a list of geographic objects that are used in other functions called by the web service.  */
    const Geography = 'Geography';
    /** The function allows to get a list of measurement units that are used in other functions called by the web service.  */
    const UnitsOfMeasurement = 'UnitsOfMeasurement';
    /** The function allows to get a list of measurement units that are used in other functions called by the web service */
    const BaseUnitsOfMeasurement = 'BaseUnitsOfMeasurement';
    /** The function allows to get a list of error codes that are used in other functions called by the web service.  */
    const ErrorCodes = 'ErrorCodes';
    /** The function allows to get a list of client's contact persons that are used in other functions called by the web service. */
    const Contacts = 'Contacts';
    /** The function allows to get a list of cargoes descriptions that are used in other functions called by the web service.  */
    const CargoDescriptions = 'CargoDescriptions';
    /** The function allows to get a list of client's goods batches that are used in other functions called by the web service.  */
    const PartiesOfItems = 'PartiesOfItems';
    /** The function allows to get possible payers (sender, recipient, third party) that are used in other functions called by the web service.  */
    const Payers = 'Payers';
    /** The function allows to get a list of client's departments that are used in other functions called by the web service */
    const Departments = 'Departments';
    /** The function allows to get a list of client's projects that are used in other functions called by the web service */
    const Projects = 'Projects';
    /** The function allows to get serial numbers' list of client goods that are used in other functions called by the web service.  */
    const SerialNumbersOfItems = 'SerialNumbersOfItems';
    /** The function allows to get a list of all available states returned by function Tracking .  */
    const CargoStates = 'CargoStates';
    /** The function allows to get a list of delivery methods that are used in other functions called by the web service */
    const ShippingMethods = 'ShippingMethods';
    /** The function allows to get a list of available payment methods (cash payment, cashless payment, etc.) that are used in other functions called by the web service */
    const PaymentMethods = 'PaymentMethods';
    /** The function allows to get urgency types that are used in other functions called by the web service.  */
    const Urgencies = 'Urgencies';
    /** The function allows to get a list of VAT rates that are used in other functions called by the web service.  */
    const VATRates = 'VATRates';
    /** The function allows to get available houses types (house, building, etc) that are used in other functions called by the web service.  */
    const TypesOfHouses = 'TypesOfHouses';
    /** The function allows to get a list of available contact information types (address, phone number, website, etc) that are used in other functions called by the web service.  */
    const TypesOfContactInformation = 'TypesOfContactInformation';
    const SubTypesOfContactInformation = 'SubTypesOfContactInformation';
    /** The function allows to get available rooms types (flat, office) that are used in other functions called by the web service.  */
    const TypesOfPremises = 'TypesOfPremises';
    /** The function allows to get available house numbering types (block, building, etc) that are used in other functions called by the web service.  */
    const TypesOfBuildings = 'TypesOfBuildings';
    /** The function allows to get a list of client goods (Internet shop) that are used in other functions called by the web service.  */
    const Items = 'Items';
    /** The function allows to get a list of client goods (Internet shop) that are used in other functions called by the web service. Every item contains detail information about goods.  */
    const ItemsInStock = 'ItemsInStock';
    /** The function allows to get a list of rendered services that are used in other functions called by the web service */
    const Services = 'Services';
    /** The function allows to get a list of warehouses that are used in other functions called by the web service.  */
    const Repository = 'Repository';
    /** The function allows to get a list of client's goods characteristics that are used in other functions called by the web service.  */
    const CharacteristicsOfItems = 'CharacteristicsOfItems';
    const NumberTypes = 'NumberTypes';
}