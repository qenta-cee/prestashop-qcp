<?php
/*
    Die vorliegende Software ist Eigentum von Wirecard CEE und daher vertraulich zu behandeln.
    Jegliche Weitergabe an dritte, in welcher Form auch immer, ist unzulaessig.

    Software & Service Copyright (C) by
    Wirecard Central Eastern Europe GmbH,
    FB-Nr: FN 195599 x, http://www.wirecard.at
*/

/**
 * class holding all paymenttypes.
 */
final class Wirecard_CEE_QPay_PaymentType
{
    const SELECT = 'SELECT';
    const CCARD = 'CCARD';
    const CCARD_MOTO = 'CCARD-MOTO';
    const MAESTRO = 'MAESTRO';
    const PBX = 'PBX';
    const PSC = 'PSC';
    const EPS = 'EPS';
    const ELV = 'ELV';
    const SEPA_DD = 'SEPA-DD';
    const QUICK = 'QUICK';
    const IDL = 'IDL';
    const GIROPAY = 'GIROPAY';
    const TATRAPAY = 'TATRAPAY';
    const PAYPAL = 'PAYPAL';
    const EPAY_BG = 'EPAY_BG';
    const SOFORTUEBERWEISUNG = 'SOFORTUEBERWEISUNG';
    const C2P = 'C2P';

    const INVOICE = 'INVOICE';
    const INSTALLMENT = 'INSTALLMENT';
    const BANCONTACT_MISTERCASH = 'BANCONTACT_MISTERCASH';
    const P24 = 'PRZELEWY24';
    const MONETA = 'MONETA';
    const POLI = 'POLI';
    const EKONTO = 'EKONTO';
    const INSTANTBANK = 'INSTANTBANK';
    const TRUSTLY = 'TRUSTLY';
    const TRUSTPAY = 'TRUSTPAY';

    const MPASS = 'MPASS';
    const SKRILLDIRECT = 'SKRILLDIRECT';
    const SKRILLWALLET = 'SKRILLWALLET';

    const VOUCHER = 'VOUCHER';

    const INVOICE_INSTALLMENT_MIN_AGE = 18;

    private static $_eps_financial_institutions = Array(
        'BA-CA' => 'Bank Austria',
        'Spardat|BB' => 'Bank Burgenland',
        'ARZ|BAF' => 'Bank f&uuml; &Auml;rzte und Freie Berufe',
        'ARC|BCS' => 'Bankhaus Carl Sp&auml;ngler &amp; Co. AG',
        'Bawag|B' => 'BAWAG',
        'ARZ|VB' => 'Die &ouml;stereischischen Volksbanken',
        'Bawag|E' => 'easyBank',
        'Spardat|EBS' => 'Erste Bank und Sparkassen',
        'ARZ|GB' => 'G&auml;rtnerbank',
        'ARZ|HAA' => 'Hypo Alpe-Adria Bank AG',
        'ARZ|HI' => 'Hypo Investmentbank AG',
        'Hypo-Racon|O' => 'Hypo Ober&ouml;sterreich',
        'Hypo-Racon|S' => 'Hypo Salzburg',
        'Hypo-Racon|ST' => 'Hypo Steiermark',
        'ARZ|HTB' => 'Hypo Tirol Bank AG',
        'ARZ|IB' => 'Immo-Bank',
        'ARZ|IKB' => 'Investkredit Bank AG',
        'ARZ|NLH' => 'Niester&ouml;sterreichische Landes-Hypothekenbank AG',
        'ARZ|AB' => '&Ouml;sterreichische Apothekerbank',
        'Bawag|P' => 'PSK Bank',
        'Racon' => 'Raiffeisen Bank',
        'Bawag|S' => 'Sparda Bank',
        'ARZ|VLH' => 'Vorarlberger Landes- und Hypothekerbank AG',
    );
    private static $_idl_financial_institutions = Array(
        'ABNAMROBANK' => 'ABN AMRO Bank',
        'POSTBANK' => 'Postbank',
        'RABOBANK' => 'Rabobank',
        'SNSBANK' => 'SNS Bank',
        'ASNBANK' => 'ASN Bank',
        'REGIOBANK' => 'SNS Regio Bank',
        'TRIDOSBANK' => 'Tridos Bank',
        'VANLANSCHOT' => 'Van Lanschot Bank',
    );

    private $_name;

    public function __construct($name)
    {
        $this->_name = $name;
    }

    public function hasFinancialInstitutions()
    {
        if ($this->_name == self::EPS ||
            $this->_name == self::IDL
        ) {
            return true;
        }

        return false;
    }

    public function getFinancialInstitutions()
    {
        switch ($this->_name) {
            case self::EPS:
                return self::$_eps_financial_institutions;
                break;
            case self::IDL:
                return self::$_idl_financial_institutions;
                break;
            default:
                return null;
                break;
        }
    }

    public function __toString()
    {
        return $this->_name;
    }
}