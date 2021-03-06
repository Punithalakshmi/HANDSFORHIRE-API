<?php
namespace Braintree;

include APPPATH.'third_party/Braintree/Xml/Generator.php';
include APPPATH.'third_party/Braintree/Xml/Parser.php';


/**
 * Braintree Xml parser and generator
 * PHP version 5
 * superclass for Braintree XML parsing and generation
 *
 * @copyright  2015 Braintree, a division of PayPal, Inc.
 */
class Xml
{
    /**
     * @ignore
     */
    protected function  __construct()
    {

    }

    /**
     *
     * @param string $xml
     * @return array
     */
    public static function buildArrayFromXml($xml)
    {
        return Xml\Parser::arrayFromXml($xml);
    }

    /**
     *
     * @param array $array
     * @return string
     */
    public static function buildXmlFromArray($array)
    {
        return Xml\Generator::arrayToXml($array);
    }
}
class_alias('Braintree\Xml', 'Braintree_Xml');
