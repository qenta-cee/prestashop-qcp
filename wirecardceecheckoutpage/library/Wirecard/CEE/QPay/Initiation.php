<?php
/*
    Die vorliegende Software ist Eigentum von Wirecard CEE und daher vertraulich zu behandeln.
    Jegliche Weitergabe an dritte, in welcher Form auch immer, ist unzulaessig.

    Software & Service Copyright (C) by
    Wirecard Central Eastern Europe GmbH,
    FB-Nr: FN 195599 x, http://www.wirecard.at
*/

if(!class_exists('Zend_Http_Client', false))
{
    require_once 'Zend/Http/Client.php';
}

require_once 'Exception.php';

require_once 'ConsumerData.php';

require_once 'PaymentType.php';

/**
 * QPay Initiation class.
 */
final class Wirecard_CEE_QPay_Initiation
{  
    private $_requestData;
    private $_secret;
    private $_fingerprintOrder = Array();
    private $_fingerprintOrderString;
    private $_fingerprintString;
    private $_httpClient;
   
    private static $LIBRARY_NAME = 'QPayClientLibrary';
    private static $LIBRARY_VERSION = '1.0.0';
    private static $INITIATION_URL = 'https://checkout.wirecard.com/page/init-server.php';
    
    //qpay Params
    private static $CUSTOMER_ID = 'customerId';
    private static $SECRET = 'secret';
    private static $AMOUNT = 'amount';
    private static $CURRENCY = 'currency';
    private static $PAYMENT_TYPE = 'paymentType';
    private static $LANGUAGE = 'language';
    private static $ORDER_DESCRIPTION = 'orderDescription';
    private static $SUCCESS_URL = 'successUrl';
    private static $CANCEL_URL = 'cancelUrl';
    private static $FAILURE_URL = 'failureUrl';
    private static $SERVICE_URL = 'serviceUrl';
	private static $PENDING_URL = 'pendingUrl';
    private static $SHOP_ID = 'shopId';
    private static $FINANCIAL_INSTITUTION = 'financialInstitution';
    private static $DISPLAY_TEXT = 'displayText';
    private static $CONFIRM_URL = 'confirmUrl';
    private static $IMAGE_URL = 'imageUrl';
    private static $WINDOW_NAME = 'windowName';
    private static $DUPLICATE_REQUEST_CHECK = 'duplicateRequestCheck';
    private static $CUSTOMER_STATEMENT = 'customerStatement';
    private static $ORDER_REFERENCE = 'orderReference';
    private static $AUTO_DEPOSIT = 'autoDeposit';
    private static $MAX_RETRIES = 'maxRetries';
    private static $ORDER_NUMBER = 'orderNumber';
    private static $CONFIRM_MAIL = 'confirmMail';
    private static $CONSUMER_USER_AGENT = 'consumerUserAgent';
    private static $CONSUMER_IP_ADDRESS = 'consumerIpAddress';
    private static $REQUEST_FINGERPRINT = 'requestFingerprint';
    private static $REQUEST_FINGERPRINT_ORDER = 'requestFingerprintOrder';
    private static $PLUGIN_VERSION = 'pluginVersion';
    private static $CONSUMER_MERCHANT_CRM_ID = 'consumerMerchantCrmId';
    
    /**
     * creates an instance of {@link Wirecard_CEE_QPay_Initiation}
     * 
     * @param type $customerId
     * @param type $secret
     * @param type $amount
     * @param type $currency
     * @param type $paymentType
     * @param type $language
     * @param type $orderDescription
     * @param type $successUrl
     * @param type $cancelUrl
     * @param type $failureUrl
     * @param type $serviceUrl
     * @param type $consumerUserAgent
     * @param type $consumerIpAddress
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function __construct($customerId, $secret, $amount, 
                                $currency, $paymentType, $language, 
                                $orderDescription, $successUrl, $cancelUrl, 
                                $failureUrl, $serviceUrl, $consumerUserAgent,
                                $consumerIpAddress, $consumerMerchantCrmId)
    {
        $this->_secret = $secret;
        $this->_fingerprintOrder[] = self::$SECRET;
        $this->__set(self::$CUSTOMER_ID, $customerId);
        $this->__set(self::$AMOUNT, $amount);
        $this->__set(self::$CURRENCY, $currency);
        $this->__set(self::$PAYMENT_TYPE, $paymentType);
        $this->__set(self::$LANGUAGE, $language);
        $this->__set(self::$ORDER_DESCRIPTION, $orderDescription);
        $this->__set(self::$SUCCESS_URL, $successUrl);
        $this->__set(self::$CANCEL_URL, $cancelUrl);
        $this->__set(self::$FAILURE_URL, $failureUrl);
        $this->__set(self::$SERVICE_URL, $serviceUrl);
        $this->__set(self::$CONSUMER_USER_AGENT, $consumerUserAgent);
        $this->__set(self::$CONSUMER_IP_ADDRESS, $consumerIpAddress);
        $this->__set(self::$CONSUMER_MERCHANT_CRM_ID, $consumerMerchantCrmId);
        return $this;
    }

	/**
	 * sets the qpay parameter pendingUrl
	 * @param type $pendingUrl
	 * @return Wirecard_CEE_QPay_Initiation
	 */
	public function setPendingUrl($pendingUrl)
	{
		$this->__set(self::$PENDING_URL, $pendingUrl);
		return $this;
	}

	/**
     * sets the qpay parameter shopId
     * @param type $shopId
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function setShopId($shopId)
    {
        $this->__set(self::$SHOP_ID, $shopId);
        return $this;
    }
    
    /**
     * sets the qpay parameter financialInstitution
     * @param type $financialInstitution
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function setFinancialInstitution($financialInstitution)
    {
        $this->__set(self::$FINANCIAL_INSTITUTION, $financialInstitution);
        return $this;
    }
    
    /**
     * sets the qpay parameter displaytext
     * @param type $displayText
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function setDisplayText($displayText)
    {
        $this->__set(self::$DISPLAY_TEXT, $displayText);
        return $this;
    }
    
    /**
     * sets the qpay parameter confirmUrl
     * @param type $confirmUrl
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function setConfirmUrl($confirmUrl)
    {
        $this->__set(self::$CONFIRM_URL, $confirmUrl);
        return $this;
    }
    
    /**
     * sets the qpay parameter imageUrl
     * @param type $imageUrl
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function setImageUrl($imageUrl)
    {
        $this->__set(self::$IMAGE_URL, $imageUrl);
        return $this;
    }
    
    /**
     * sets the qpay parameter windowName
     * @param type $windowName
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function setWindowName($windowName)
    {
        $this->_requestData[self::$WINDOW_NAME] = $windowName;
        return $this;
    }
    
    /**
     * sets the qpay parameter duplicateRequestCheck
     * @param type $duplicateRequestCheck
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function setDuplicateRequestCheck($duplicateRequestCheck)
    {
        if($duplicateRequestCheck == true)
        {
            $this->__set(self::$DUPLICATE_REQUEST_CHECK, 'yes');
        }
        return $this;
    }
    
    /**
     * seths the qpay paramter customerStatement
     * @param type $customerStatement
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function setCustomerStatement($customerStatement)
    {
        $this->__set(self::$CUSTOMER_STATEMENT, $customerStatement);
        return $this;
    }
    
    /**
     * sets the qpay parameter orderReference
     * @param type $orderReference
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function setOrderReference($orderReference)
    {
        $this->__set(self::$ORDER_REFERENCE, $orderReference);
        return $this;
    }
    
    /**
     * sets the qpay paramter autoDeposit
     * @param type $autoDeposit
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function setAutoDeposit($autoDeposit)
    {
        if($autoDeposit == true)
        {
            $this->__set(self::$AUTO_DEPOSIT, 'yes');
        }
        return $this;
    }
    
    /**
     * sets the qpay parameter maxRetries
     * @param type $maxRetries
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function setMaxRetries($maxRetries)
    {
        $maxRetries = intval($maxRetries);
        if($maxRetries>=0)
        {
            $this->__set(self::$MAX_RETRIES, $maxRetries);
        }
        return $this;
    }
    
    /**
     * sets the qpay parameter orderNumber
     * @param type $orderNumber
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function setOrderNumber($orderNumber)
    {
        $this->__set(self::$ORDER_NUMBER, $orderNumber);
        return $this;
    }
    
    /**
     * sets the qpay parameter confirmMail
     * @param type $confirmMail
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function setConfirmMail($confirmMail)
    {
        $this->__set(self::$CONFIRM_MAIL, $confirmMail);
        return $this;
    }
    
    /**
     * Getter for QPAY Client Library Versionstring
     * @access private
     * @return String
     */
    private function _getQPayClientVersionString()
    {
        return self::$LIBRARY_NAME . ' ' . self::$LIBRARY_VERSION;
    }
    
    /**
     * sets the qpay parameter pluginVersion
     * @param type $shopName
     * @param type $shopVersion
     * @param type $pluginName
     * @param type $pluginVersion
     * @param array $libraries
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function setPluginVersion($shopName, $shopVersion , $pluginName, $pluginVersion, Array $libraries)
    {
        $libraryString = $this->_getQPayClientVersionString();
        foreach($libraries AS $libName => $libVersion)
        {
            $libraryString .= ',' . strval($libName) . ' ' . strval($libVersion);
        }
        $version = base64_encode(strval($shopName) . ';' . strval($shopVersion) . ';' . $libraryString . ';' . strval($pluginName) . ';' . strval($pluginVersion));
        $this->__set(self::$PLUGIN_VERSION, $version);
        return $this;
    }

    /**
     * setter for the consumer merchant crm id
     * @param $userEmail
     * @return $this
     */
    public function createConsumerMerchantCrmId($userEmail)
    {
        $this->__set(self::$CONSUMER_MERCHANT_CRM_ID, md5($userEmail));
        return $this;
    }

    /**
     * adds given consumerData to qpay request
     * @param Wirecard_CEE_QPay_ConsumerData $consumerData
     * @return Wirecard_CEE_QPay_Initiation 
     */
    public function addConsumerData(Wirecard_CEE_QPay_ConsumerData $consumerData)
    {
        foreach($consumerData->getData() AS $key => $value)
        {
            $this->__set($key, $value);
        }
        return $this;
    }
    
    /**
     * private getter for the Zend_Http_client
     * if not set yet it will be instantiated
     * @param array $config Configuration key-value pairs.
     * @access private
     * @return Zend_Http_Client 
     */
    private function _getZendHttpClient($config)
    {
        if($this->_httpClient == null)
        {
            $this->_httpClient = new Zend_Http_Client(self::$INITIATION_URL, $config);
        }
        else
        {
            $this->_httpClient->resetParameters(true);
            $this->_httpClient->setUri(self::$INITIATION_URL);
        }
        return $this->_httpClient;
    }
    
    /**
     * initiates an qpay request.
     * @param array $config Configuration key-value pairs.
     * @return string redirectUrl
     */
    public function initiate($config = null)
    {
        $this->_getZendHttpClient($config);
        $this->_calculateFingerprint();
        $this->_addFingerprintFields();
        try
        {
            $response = $this->_sendRequest();
        }
        catch (Zend_Http_Client_Exception $e)
        {
            throw new Wirecard_CEE_QPay_Exception($e->getMessage(), $e->getCode(), $e);
        }
        return $this->_proceedResponse($response);
        
    }
    
    /**
     * processes the response of the qpay initiation
     * @return type 
     */
    private function _proceedResponse($responseObject)
    {
        $responseBody = $responseObject->getBody();
        $response = explode('=', $responseBody);

        if($response[0] == 'redirectUrl')
        {
            return urldecode($response[1]);
        }
        else if($response[0] == 'message')
        {
            throw new Wirecard_CEE_QPay_Exception(urldecode($response[1]));
        }
        else
        {
            throw new Wirecard_CEE_QPay_Exception('Invalid response from QPay');
        }
    }
    
    private function _calculateFingerprint()
    {
        $fingerprintOrder = $this->_fingerprintOrder;
        $fingerprintSeed = '';
        $fingerprintFields = Array();
        foreach($fingerprintOrder AS $param)
        {
            $fingerprintSeed .= $this->_getField($param);
            $this->_addParamToFingerprintOrderString($param);
        }
        $this->_addParamToFingerprintOrderString(self::$REQUEST_FINGERPRINT_ORDER);
        $fingerprintSeed .= $this->_fingerprintOrderString;
        $this->_fingerprintString = hash_hmac('sha512', $fingerprintSeed, $this->_getField(self::$SECRET));
    }
    
    private function _addFingerprintFields()
    {
        $this->_requestData[self::$REQUEST_FINGERPRINT] = $this->_fingerprintString;
        $this->_requestData[self::$REQUEST_FINGERPRINT_ORDER] = $this->_fingerprintOrderString;
    }
    
    private function _addParamToFingerprintOrderString($name)
    {
        if($this->_fingerprintOrderString == '')
        {
            $this->_fingerprintOrderString = $name;
        }
        else 
        {
            $this->_fingerprintOrderString .= ','.$name;
        }
    }
    
    private function _sendRequest()
    {
        $httpClient = $this->_httpClient;
        $httpClient->setParameterPost($this->_requestData);
        return $httpClient->request(Zend_Http_Client::POST);
    }

    public function __set($name, $value) 
    {
        $this->_requestData[strval($name)] = strval($value);
        $this->_fingerprintOrder[] = strval($name);
    }
    
    private function _getField($name) 
    {
        if($name == self::$SECRET)
        {
            return $this->_secret;
        }
        else if(array_key_exists($name, $this->_requestData))
        {
            return $this->_requestData[$name];
        }
        else
        {
            trigger_error('Implementation went terribly wrong!');
        }
    }
}