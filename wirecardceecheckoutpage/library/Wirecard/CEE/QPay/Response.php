<?php
/*
    Die vorliegende Software ist Eigentum von Wirecard CEE und daher vertraulich zu behandeln.
    Jegliche Weitergabe an dritte, in welcher Form auch immer, ist unzulaessig.

    Software & Service Copyright (C) by
    Wirecard Central Eastern Europe GmbH,
    FB-Nr: FN 195599 x, http://www.wirecard.at
*/

require_once 'Exception.php';

/**
 * Response validation class.
 */
final class Wirecard_CEE_QPay_Response
{
    private $_responseData;
    private $_fingerprintOrder = Array();
    private $_fingerprintString;
    private $_secret;

    private static $SECRET = 'secret';

    const STATE_SUCCESS = 'SUCCESS';
    const STATE_CANCEL  = 'CANCEL';
    const STATE_FAILURE = 'FAILURE';
	const STATE_PENDING = 'PENDING';

    /**
     * instantiates an Wirecard_CEE_QPay Response object.
     * @param array $postData - the posted data which has do be validated.
     * @param type $secret - QPay secret for responsefingerprint calculation
     * @return Wirecard_CEE_QPay_Response
     */
    public function __construct(Array $postData, $secret)
    {
        if(count($postData) == 0)
        {
            throw new Wirecard_CEE_QPay_Exception('The request is not a valid POST request.');
        }

        $this->_responseData = $postData;
        $this->_secret       = $secret;
        return $this;
    }

    /**
     * validate the given Response
     * @return Wirecard_CEE_QPay_Response
     */
    public function validateResponse()
    {
        switch($this->paymentState)
        {
            case self::STATE_SUCCESS:
                if($this->_validateSuccessResponse())
                {
                    return self::STATE_SUCCESS;
                }
                else
                {
                    trigger_error('Validation not successful and no exception occured.');
                }
                break;
            case self::STATE_CANCEL:
                return self::STATE_CANCEL;
                break;
            case self::STATE_FAILURE:
                return self::STATE_FAILURE;
                break;
            case self::STATE_PENDING:
                return self::STATE_PENDING;
                break;
            default:
                throw new Wirecard_CEE_QPay_Exception('Unexpected paymentState: ' . $this->paymentState);
                break;
        }
        return $this;
    }

    /**
     * @return bool
     */
    private function _validateSuccessResponse()
    {
        $this->_getResponseFingerprintOrder();
        $this->_calculateFingerprint();
        if($this->_compateFingerprints())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    private function _getResponseFingerprintOrder()
    {
        if($this->responseFingerprintOrder)
        {
            $fingerprintOrderArray = explode(',', $this->responseFingerprintOrder);
        }
        else
        {
            throw new Wirecard_CEE_QPay_Exception('ResponseFingerprintOrder has not been returned.');
        }
        $this->_fingerprintOrder = $fingerprintOrderArray;
        return $fingerprintOrderArray;
    }

    private function _calculateFingerprint()
    {
        $fingerprintOrder = $this->_fingerprintOrder;
        $fingerprintSeed = '';
        foreach($fingerprintOrder AS $param)
        {
            $fingerprintSeed .= $this->_prepareValueForFingerprint($this->$param);
        }
        $this->_fingerprintString = hash_hmac('sha512', $fingerprintSeed, $this->__get(self::$SECRET));
    }

    private function _compateFingerprints()
    {
        if($this->responseFingerprint != $this->_fingerprintString)
        {
            $this->_responseData['paymentState'] = self::STATE_FAILURE;
            throw new Wirecard_CEE_QPay_Exception('Fingerprint missmatch. Fingerprints are not equal.');
        }
        return true;
    }

    /**
     * check if magic quotes gpc or magic quotes runtime are enabled
     * @return bool
     */
    private function _magicQuotesUsed()
    {
        if(get_magic_quotes_gpc() || get_magic_quotes_runtime())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    private function _prepareValueForFingerprint($value)
    {
        if($this->_magicQuotesUsed())
        {
            return stripslashes($value);
        }
        else
        {
            return $value;
        }
    }

    public function __get($name)
    {
        if($name == self::$SECRET)
        {
            return $this->_secret;
        }
        else if(array_key_exists($name, $this->_responseData))
        {
            return $this->_responseData[$name];
        }
        else
        {
            return false;
        }
    }

    public static function generateConfirmResponse($message = null, $inCommentTag = false)
    {
        if($message == null)
        {
            $returnValue = '<QPAY-CONFIRMATION-RESPONSE result="OK" />';
        }
        else
        {
            $returnValue = '<QPAY-CONFIRMATION-RESPONSE result="NOK" message="' . $message . '" />';
        }
        if($inCommentTag)
        {
            $returnValue = '<!--'.$returnValue.'-->';
        }
        return $returnValue;
    }

}