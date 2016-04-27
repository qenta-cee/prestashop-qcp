<?php
/*
    Die vorliegende Software ist Eigentum von Wirecard CEE und daher vertraulich zu behandeln.
    Jegliche Weitergabe an dritte, in welcher Form auch immer, ist unzulaessig.

    Software & Service Copyright (C) by
    Wirecard Central Eastern Europe GmbH,
    FB-Nr: FN 195599 x, http://www.wirecard.at
*/

/**
 * container class for Addresses used for initiation.
 * @see Wirecard_CEE_QPay_ConsumerData
 * Used for shipping and billing consumerData
 */
final class Wirecard_CEE_QPay_Address 
{
    const TYPE_SHIPPING = 'Shipping';
    const TYPE_BILLING = 'Billing';
    
    private static $PREFIX = 'consumer';
    private static $FIRSTNAME = 'Firstname';
    private static $LASTNAME = 'Lastname';
    private static $ADDRESS1 = 'Address1';
    private static $ADDRESS2 = 'Address2';
    private static $CITY = 'City';
    private static $COUNTRY = 'Country';
    private static $STATE = 'State';
    private static $ZIP_CODE = 'ZipCode';
    private static $PHONE = 'Phone';
    private static $FAX = 'Fax';
    
    private $_addressType;
    private $_addressData;
    
    public function __construct($addressType) {
        $this->_addressType = $addressType;
        return $this;
    }
    
    public function setFirstname($firstname)
    {
        $this->_setField(self::$FIRSTNAME, $firstname);
        return $this;
    }
    
    public function setLastname($lastname)
    {
        $this->_setField(self::$LASTNAME, $lastname);
        return $this;
    }
    
    public function setAddress1($address1)
    {
        $this->_setField(self::$ADDRESS1, $address1);
        return $this;
    }
    
    public function setAddress2($address2)
    {
        $this->_setField(self::$ADDRESS2, $address2);
        return $this;
    }
    
    public function setCity($city)
    {
        $this->_setField(self::$CITY, $city);
        return $this;
    }
    
    public function setCountry($country)
    {
        $this->_setField(self::$COUNTRY, $country);
        return $this;
    }
    
    public function setState($state)
    {
        $this->_setField(self::$STATE, $state);
        return $this;
    }
    
    public function setZipCode($zipCode)
    {
        $this->_setField(self::$ZIP_CODE, $zipCode);
        return $this;
    }
    
    public function setPhone($phone)
    {
        $this->_setField(self::$PHONE, $phone);
        return $this;
    }
    
    public function setFax($fax)
    {
        $this->_setField(self::$FAX, $fax);
        return $this;
    }
    
    private function _setField($name, $value)
    {
        //e.g. consumerBillingFirstname
        $this->_addressData[self::$PREFIX . $this->_addressType . $name] = strval($value);
    }
    
    public function getData()
    {
        return $this->_addressData;
    }
}