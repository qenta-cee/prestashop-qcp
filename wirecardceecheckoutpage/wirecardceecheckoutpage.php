<?php
/*
 * Shop System Plugins - Terms of Use
 *
 * The plugins offered are provided free of charge by Wirecard Central Eastern Europe GmbH 
 * (abbreviated to Wirecard CEE) and are explicitly not part of the Wirecard CEE range of 
 * products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public 
 * License Version 2 (GPLv2) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Wirecard CEE does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the plugins at their own risk. Wirecard CEE does not guarantee their full
 * functionality neither does Wirecard CEE assume liability for any disadvantages related to
 * the use of the plugins. Additionally, Wirecard CEE does not guarantee the full functionality
 * for customized shop systems or installed plugins of other vendors of plugins within the same
 * shop system.
 *
 * Customers are responsible for testing the plugin's functionality before starting productive
 * operation.
 *
 * By installing the plugin into the shop system the customer agrees to these terms of use.
 * Please do not use the plugin if you do not agree to these terms of use!
 */

use PrestaShop\PrestaShop\Core\Payment\PaymentOption;

if (!defined('_PS_VERSION_')) {
    exit;
}

ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . realpath(dirname(__FILE__))
    . DIRECTORY_SEPARATOR . 'library');

require_once "library/wirecardcee_autoload.php";

/**
 * Class WirecardCEECheckoutPage
 *
 * @method string l() l($key)
 */
class WirecardCEECheckoutPage extends PaymentModule
{
    const WCP_CUSTOMER_ID_DEMO = 'D200001';
    const WCP_SHOP_ID_DEMO = '';
    const WCP_SECRET_DEMO = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';
    const WCP_CUSTOMER_ID_TEST = 'D200411';
    const WCP_SHOP_ID_TEST = '';
    const WCP_SECRET_TEST = 'CHCSH7UGHVVX2P7EHDHSY4T2S4CGYK4QBE4M5YUUG2ND5BEZWNRZW5EJYVJQ';
    const WCP_CUSTOMER_ID_TEST3D = 'D200411';
    const WCP_SHOP_ID_TEST3D = '3D';
    const WCP_SECRET_TEST3D = 'DP4TMTPQQWFJW34647RM798E9A5X7E8ATP462Z4VGZK53YEJ3JWXS98B9P4F';
    const WCP_PT_DEFAULT = 0;
    const WINDOW_NAME = 'Checkout_Page_Frame';
    
    const WCP_CONFIGURATION_MODE = 'WCP_CONFIGURATION_MODE';
    const WCP_CUSTOMER_ID = 'WCP_CUSTOMER_ID';
    const WCP_SHOP_ID = 'WCP_SHOP_ID';
    const WCP_SECRET = 'WCP_SECRET';
    const WCP_DISPLAY_TEXT = 'WCP_DISPLAY_TEXT';
    const WCP_MAX_RETRIES = 'WCP_MAX_RETRIES';
    const WCP_INVOICE_MIN = 'WCP_INVOICE_MIN';
    const WCP_INVOICE_MAX = 'WCP_INVOICE_MAX';
    const WCP_INVOICE_PROVIDER = 'WCP_INVOICE_PROVIDER';
    const WCP_INVOICE_ADDRESS_EQUAL = 'WCP_INVOICE_ADDRESS_EQUAL';
    const WCP_INVOICE_BILLING_COUNTRIES = 'WCP_INVOICE_BILLING_COUNTRIES';
    const WCP_INVOICE_SHIPPING_COUNTRIES = 'WCP_INVOICE_SHIPPING_COUNTRIES';
    const WCP_INVOICE_CURRENCIES = 'WCP_INVOICE_CURRENCIES';
    const WCP_INSTALLMENT_MIN = 'WCP_INSTALLMENT_MIN';
    const WCP_INSTALLMENT_MAX = 'WCP_INSTALLMENT_MAX';
    const WCP_INSTALLMENT_PROVIDER = 'WCP_INSTALLMENT_PROVIDER';
    const WCP_INSTALLMENT_ADDRESS_EQUAL = 'WCP_INSTALLMENT_ADDRESS_EQUAL';
    const WCP_INSTALLMENT_BILLING_COUNTRIES = 'WCP_INSTALLMENT_BILLING_COUNTRIES';
    const WCP_INSTALLMENT_SHIPPING_COUNTRIES = 'WCP_INSTALLMENT_SHIPPING_COUNTRIES';
    const WCP_INSTALLMENT_CURRENCIES = 'WCP_INSTALLMENT_CURRENCIES';
    const WCP_PAYOLUTION_TERMS = 'WCP_PAYOLUTION_TERMS';
    const WCP_PAYOLUTION_MID = 'WCP_PAYOLUTION_MID';
    const WCP_TRANSACTION_ID = 'WCP_TRANSACTION_ID';
    const WCP_AUTO_DEPOSIT = 'WCP_AUTO_DEPOSIT';
    const WCP_SEND_ADDITIONAL_DATA = 'WCP_SEND_ADDITIONAL_DATA';
    const WCP_SEND_BASKET_DATA = 'WCP_SEND_BASKET_DATA';
    const WCP_USE_IFRAME = 'WCP_USE_IFRAME';
    const WCP_OS_AWAITING = 'WCP_OS_AWAITING';

    const WCP_PT_CCARD = 'WCP_PT_CCARD';
    const WCP_PT_CCARD_MOTO = 'WCP_PT_CCARD-MOTO';
    const WCP_PT_MAESTRO = 'WCP_PT_MAESTRO';
    const WCP_PT_MASTERPASS = 'WCP_PT_MASTERPASS';
    const WCP_PT_EPS = 'WCP_PT_EPS';
    const WCP_PT_IDL = 'WCP_PT_IDL';
    const WCP_PT_GIROPAY = 'WCP_PT_GIROPAY';
    const WCP_PT_TATRAPAY = 'WCP_PT_TATRAPAY';
    const WCP_PT_SOFORTUEBERWEISUNG = 'WCP_PT_SOFORTUEBERWEISUNG';
    const WCP_PT_PBX = 'WCP_PT_PBX';
    const WCP_PT_PSC = 'WCP_PT_PSC';
    const WCP_PT_QUICK = 'WCP_PT_QUICK';
    const WCP_PT_PAYPAL = 'WCP_PT_PAYPAL';
    const WCP_PT_EPAY_BG = 'WCP_PT_EPAY_BG';
    const WCP_PT_SEPA_DD = 'WCP_PT_SEPA-DD';
    const WCP_PT_TRUSTPAY = 'WCP_PT_TRUSTPAY';
    const WCP_PT_INVOICE = 'WCP_PT_INVOICE';
    const WCP_PT_INSTALLMENT = 'WCP_PT_INSTALLMENT';
    const WCP_PT_BANCONTACT_MISTERCASH = 'WCP_PT_BANCONTACT_MISTERCASH';
    const WCP_PT_P24 = 'WCP_PT_PRZELEWY24';
    const WCP_PT_MONETA = 'WCP_PT_MONETA';
    const WCP_PT_POLI = 'WCP_PT_POLI';
    const WCP_PT_EKONTO = 'WCP_PT_EKONTO';
    const WCP_PT_TRUSTLY = 'WCP_PT_TRUSTLY';
    const WCP_PT_SKRILLWALLET = 'WCP_PT_SKRILLWALLET';
    const WCP_PT_VOUCHER = 'WCP_PT_VOUCHER';

    private $html = '';
    private $myOrder;
    private $myCart;
    private $postErrors = array();
    private $config = array();
    
    public function log($text)
    {
        $log = new PrestaShopLogger();
        $log->severity = 1;
        $log->error_code = null;
        $log->message = $text;
        $log->date_add = date('Y-m-d H:i:s');
        $log->date_upd = date('Y-m-d H:i:s');

        $id_employee = null;

        if (isset(Context::getContext()->employee) && Validate::isLoadedObject(Context::getContext()->employee)) {
            $id_employee = Context::getContext()->employee->id;
        }
        if ($id_employee !== null) {
            $log->id_employee = (int)$id_employee;
        }

        $log->add();
    }

    public function __construct()
    {
        $this->config = $this->config();
        $this->name = 'wirecardceecheckoutpage';
        $this->tab = 'payments_gateways';
        $this->version = '2.1.4';
        $this->author = 'Wirecard';
        $this->controllers = array('breakoutIFrame', 'confirm', 'payment', 'paymentIFrame');
        $this->is_eu_compatible = 1;

        $this->currencies = true;
        $this->currencies_mode = 'checkbox';

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Wirecard Checkout Page');
        $this->description = $this->l('Wirecard Checkout Page payment module');
        $this->confirmUninstall = $this->l('Are you sure you want to delete these details?');
    }

    public function install()
    {
        if (!parent::install()
            || !$this->registerHook('paymentOptions')
            || !$this->registerHook('paymentReturn')
            || !$this->registerHook('actionFrontControllerSetMedia')
            || !$this->installPaymentTypes()
        ) {
            return false;
        }

        foreach ($this->getAllConfigurationParameter() as $parameter) {
            if (isset($parameter['default'])) {
                $default = $parameter['default'];
                if (is_array($default)) {
                    $default = json_encode($default);
                }
                if (!Configuration::updateGlobalValue(
                    $parameter['name'],
                    $default
                )
                ) {
                    return false;
                }
            }
        }

        // http://forge.prestashop.com/browse/PSCFV-1712
        if ($this->registerHook('displayPDFInvoice') === false) {
            return false;
        }

        if (!Configuration::get(self::WCP_OS_AWAITING)) {
            $orderState = new OrderState();
            $orderState->name = array();
            foreach (Language::getLanguages() as $language) {
                if (Tools::strtolower($language['iso_code']) == 'de') {
                    $orderState->name[$language['id_lang']] = 'Checkout Page Bezahlung ausständig';
                } else {
                    $orderState->name[$language['id_lang']] = 'Checkout Page payment awaiting';
                }
            }
            $orderState->send_email = false;
            $orderState->color = 'lightblue';
            $orderState->hidden = false;
            $orderState->delivery = false;
            $orderState->logable = true;
            $orderState->invoice = false;
            if ($orderState->add()) {
                copy(
                    dirname(__FILE__) . '/views/img/awaiting_payment.gif',
                    dirname(__FILE__) . '/../../img/os/' . (int)($orderState->id) . '.gif'
                );
            }
            Configuration::updateValue(self::WCP_OS_AWAITING, (int)($orderState->id));
        }
        return true;
    }

    public function hookActionFrontControllerSetMedia($params)
    {

        $controllerArray = array('order');
        if (in_array($this->context->controller->php_self, $controllerArray)) {
            $this->context->controller->registerStylesheet(
                'module-' . $this->name . '-style',
                'modules/' . $this->name . '/views/css/style.css',
                array(
                    'media' => 'all',
                    'priority' => 200,
                )
            );
            $this->context->controller->registerJavascript(
                'module-' . $this->name . '-script',
                'modules/' . $this->name . '/views/js/script.js',
                array(
                    'media' => 'all',
                    'priority' => 200,
                )
            );
        }
    }

    private function installPaymentTypes()
    {
        $result = true;
        foreach ($this->getPaymentTypes() as $paymentType) {
            $result = $result || !Configuration::updateValue($paymentType, self::WCP_PT_DEFAULT);
        }
        return $result;
    }

    public function uninstall()
    {
        foreach ($this->getAllConfigurationParameter() as $parameter) {
            Configuration::deleteByName($parameter['name']);
        }

        return parent::uninstall();
    }

    private function postValidation()
    {
        if (Tools::isSubmit('btnSubmit')) {
            if (!Tools::getValue(self::WCP_CUSTOMER_ID)) {
                $this->postErrors[] = $this->l('Customer ID is required.');
            }
            if (!Tools::getValue(self::WCP_SECRET)) {
                $this->postErrors[] = $this->l('Secret is required.');
            }
            if (!is_numeric(Tools::getValue(self::WCP_MAX_RETRIES))) {
                $this->postErrors[] = $this->l('Max. retries must be numeric (-1 = no restriction).');
            }
            if (Tools::getValue(self::WCP_INVOICE_MIN) && !is_numeric(Tools::getValue(self::WCP_INVOICE_MIN))) {
                $this->postErrors[] = $this->l('Invoice minimum amount must be numeric (0 or empty = no restriction).');
            }
            if (Tools::getValue(self::WCP_INVOICE_MAX) && !is_numeric(Tools::getValue(self::WCP_INVOICE_MAX))) {
                $this->postErrors[] = $this->l('Invoice maximum amount must be numeric (0 or empty = no restriction).');
            }
            if (Tools::getValue(self::WCP_INSTALLMENT_MIN) && !is_numeric(Tools::getValue(self::WCP_INSTALLMENT_MIN))) {
                $this->postErrors[] = $this->l('Installment minimum amount must be numeric (0 or empty = no restriction).');
            }
            if (Tools::getValue(self::WCP_INSTALLMENT_MAX) && !is_numeric(Tools::getValue(self::WCP_INSTALLMENT_MAX))) {
                $this->postErrors[] = $this->l('Installment maximum amount must be numeric (0 or empty = no restriction).');
            }
        }
    }

    private function postProcess()
    {
        if (Tools::isSubmit('btnSubmit')) {
            foreach ($this->getAllConfigurationParameter() as $parameter) {
                $parameter = $parameter['name'];
                if ($parameter == self::WCP_OS_AWAITING) {
                    continue;
                }
                $val = Tools::getValue($parameter);

                if (is_array($val)) {
                    $val = json_encode($val);
                }
                Configuration::updateValue($parameter, $val);
            }
        }
        $this->html .= $this->displayConfirmation($this->l('Settings updated'));
    }

    public function getContent()
    {
        $this->html = '<h2>' . $this->displayName . '</h2>';

        if (Tools::isSubmit('btnSubmit')) {
            $this->postValidation();
            if (!count($this->postErrors)) {
                $this->postProcess();
            } else {
                foreach ($this->postErrors as $err) {
                    $this->html .= $this->displayError($err);
                }
            }
        }

        $this->html .= $this->display(__FILE__, 'infos.tpl');
        $this->html .= $this->renderForm();

        return $this->html;
    }

    /**
     * return available currency iso codes
     *
     * @return array
     */
    protected function getCurrencies()
    {
        $currencies = Currency::getCurrencies();
        $ret = array();
        foreach ($currencies as $currency) {
            $ret[] = array(
                'key' => $currency['iso_code'],
                'value' => $currency['name']
            );
        }

        return $ret;
    }

    /**
     * return available country iso codes
     *
     * @return array
     */
    protected function getCountries()
    {
        $cookie = $this->context->cookie;
        $countries = Country::getCountries($cookie->id_lang);
        $ret = array();
        foreach ($countries as $country) {
            $ret[] = array(
                'key' => $country['iso_code'],
                'value' => $country['name']
            );
        }

        return $ret;
    }

    /**
     * return available usergroups iso codes
     *
     * @return array
     */
    protected function getUserGroups()
    {
        $cookie = $this->context->cookie;
        $groups = Group::getGroups($cookie->id_lang);
        $visitor_group = Configuration::get('PS_UNIDENTIFIED_GROUP');
        $guest_group = Configuration::get('PS_GUEST_GROUP');
        $cust_group = Configuration::get('PS_CUSTOMER_GROUP');
        $ret = array();
        foreach ($groups as $g) {
            // exclude standard groups
            if (in_array(
                $g['id_group'],
                array($visitor_group, $guest_group, $cust_group)
            )) {
                continue;
            }

            $ret[] = array('key' => $g['id_group'], 'value' => $g['name']);
        }

        return $ret;
    }

    protected function getProvider($which)
    {
        $ret = array(
            array(
                'key' => 'payolution',
                'value' => 'payolution'
            ),
            array(
                'key' => 'ratepay',
                'value' => 'RatePay'
            )
        );

        if ($which==self::WCP_INVOICE_PROVIDER) {
            $ret[] = array(
                'key' => 'wirecard',
                'value' => 'wirecard'
            );
        }

        return $ret;
    }

    private function config()
    {
        $radio_type = 'onoff';
        $radio_options = array(
            array(
                'id' => 'active_on',
                'value' => 1,
                'label' => $this->l('Enabled')
            ),
            array(
                'id' => 'active_off',
                'value' => 0,
                'label' => $this->l('Disabled')
            )
        );

        $paymentTypeSwitches = array();
        foreach ($this->getPaymentTypes() as $paymentType) {
            $info = $this->getPaymentTypeInfo($paymentType);
            array_push($paymentTypeSwitches, array(
                'type' => $radio_type,
                'label' => $info['title'],
                'name' => $paymentType,
                'is_bool' => true,
                'class' => 't',
                'values' => $radio_options
            ));
        }

        $fields_form_settings = array(
            'settings' => array(
                'tab' => $this->l('Settings'),
                'fields' => array(
                    array(
                        'type' => 'select',
                        'label' => $this->l('Configuration'),
                        'default' => 'production',
                        'name' => self::WCP_CONFIGURATION_MODE,
                        'options' => 'getConfigurationModes'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Customer ID'),
                        'name' => self::WCP_CUSTOMER_ID,
                        'default' => 'D200001',
                        'required' => true,
                        'class' => 'fixed-width-xl',
                        'maxchar' => 7,
                        'desc' => $this->l('Customer number you received from Wirecard (customerId, i.e. D2#####).').' <a target="_blank" href="https://guides.wirecard.at/request_parameters#customerid">'.$this->l('More information').' <i class="icon-external-link"></i></a>',
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Shop ID'),
                        'name' => self::WCP_SHOP_ID,
                        'class' => 'fixed-width-xl',
                        'maxchar' => 16,
                        'default' => '',
                        'desc' => $this->l('Shop identifier in case of more than one shop.').' <a target="_blank" href="https://guides.wirecard.at/request_parameters#shopid">'.$this->l('More information').' <i class="icon-external-link"></i></a>'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Secret'),
                        'default' => 'B8AKTPWBRMNBV455FG6M2DANE99WU2',
                        'name' => self::WCP_SECRET,
                        'class' => 'fixed-width-xxl',
                        'required' => true,
                        'desc' => $this->l('String which you received from Wirecard for signing and validating data to prove their authenticity.').' <a target="_blank" href="https://guides.wirecard.at/security:start#secret_and_fingerprint">'.$this->l('More information').' <i class="icon-external-link"></i></a>'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Text on payment page'),
                        'name' => self::WCP_DISPLAY_TEXT,
                        'class' => 'fixed-width-xl',
                        'required' => false,
                        'default' => '',
                        'desc' => $this->l('Text displayed during the payment process, i.e. "Thank you for ordering in xy-shop".').' <a target="_blank" href="https://guides.wirecard.at/request_parameters#displaytext">'.$this->l('More information').' <i class="icon-external-link"></i></a>'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Max. retries'),
                        'name' => self::WCP_MAX_RETRIES,
                        'class' => 'fixed-width-xs',
                        'default' => '-1',
                        'required' => false,
                        'desc' => $this->l('Maximum number of payment attempts regarding a certain order.').' <a target="_blank" href="https://guides.wirecard.at/request_parameters#maxretries">'.$this->l('More information').' <i class="icon-external-link"></i></a>'
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Transaction ID'),
                        'name' => self::WCP_TRANSACTION_ID,
                        'default' => 'orderNumber',
                        'options' => 'getTransactionIdOptions',
                        'desc' => $this->l('Wirecard order number: Unique number defined by Wirecard identifying the payment.') . '<br>' . $this->l('Gateway reference number: Reference number defined by the processor or acquirer.')
                    ),
                    array(
                        'type' => $radio_type,
                        'label' => $this->l('Automated deposit'),
                        'name' => self::WCP_AUTO_DEPOSIT,
                        'is_bool' => true,
                        'default' => 0,
                        'class' => 't',
                        'values' => $radio_options,
                        'desc' => $this->l('Enabling an automated deposit of payments.').' <a target="_blank" href="https://guides.wirecard.at/request_parameters#autodeposit">'.$this->l('More information').' <i class="icon-external-link"></i></a>'
                    ),
                    array(
                        'type' => $radio_type,
                        'label' => $this->l('Forward consumer data'),
                        'name' => self::WCP_SEND_ADDITIONAL_DATA,
                        'is_bool' => true,
                        'class' => 't',
                        'default' => 1,
                        'values' => $radio_options,
                        'desc' => $this->l('Forwarding shipping and billing data about your consumer to the respective financial service provider.')
                    ),
                    array(
                        'type' => $radio_type,
                        'label' => $this->l('Forward basket data'),
                        'name' => self::WCP_SEND_BASKET_DATA,
                        'is_bool' => true,
                        'class' => 't',
                        'default' => 0,
                        'values' => $radio_options,
                        'desc' => $this->l('Forwarding basket data about your consumer to the respective financial service provider.')
                    ),
                    array(
                        'type' => $radio_type,
                        'label' => $this->l('Display as iframe'),
                        'name' => self::WCP_USE_IFRAME,
                        'default' => 1,
                        'is_bool' => true,
                        'class' => 't',
                        'values' => $radio_options
                    ),
                    array(
                        'name' => self::WCP_PAYOLUTION_TERMS,
                        'label' => $this->l('payolution terms'),
                        'type' => 'onoff',
                        'default' => 0,
                        'doc' => $this->l('Consumer must accept payolution terms during the checkout process.'),
                        'docref' => 'https://guides.wirecard.at/payment_methods:invoice:payolution'
                    ),
                    array(
                        'name' => self::WCP_PAYOLUTION_MID,
                        'label' => $this->l('payolution mID'),
                        'type' => 'text',
                        'doc' => $this->l('Your payolution merchant ID, non-base64-encoded.')
                    )
                )
            ),
            'paymentmethods' => array(
                'tab' => $this->l('Payment methods'),
                'fields' => $paymentTypeSwitches
            ),
            'invoiceoptions' => array(
                'tab' => $this->l('Invoice', 'wirecardwpcbackend'),
                'fields' => array(
                    array(
                        'name' => self::WCP_INVOICE_PROVIDER,
                        'label' => $this->l('Invoice provider'),
                        'type' => 'select',
                        'group' => 'pt',
                        'default' => 'payolution',
                        'required' => true,
                        'options' => 'getProvider',
                    ),
                    array(
                        'name' => self::WCP_INVOICE_ADDRESS_EQUAL,
                        'label' => $this->l('Billing/shipping address must be identical'),
                        'type' => 'onoff',
                        'default' => 1,
                        'group' => 'pt'
                    ),
                    array(
                        'name' => self::WCP_INVOICE_BILLING_COUNTRIES,
                        'label' => $this->l('Allowed billing countries'),
                        'type' => 'select',
                        'multiple' => true,
                        'size' => 10,
                        'default' => array('AT', 'DE', 'CH'),
                        'options' => 'getCountries',
                        'group' => 'pt',
                    ),
                    array(
                        'name' => self::WCP_INVOICE_SHIPPING_COUNTRIES,
                        'label' => $this->l('Allowed shipping countries'),
                        'type' => 'select',
                        'multiple' => true,
                        'size' => 10,
                        'default' => array('AT', 'DE', 'CH'),
                        'options' => 'getCountries',
                        'group' => 'pt',
                    ),
                    array(
                        'name' => self::WCP_INVOICE_CURRENCIES,
                        'label' => $this->l('Accepted currencies'),
                        'type' => 'select',
                        'multiple' => true,
                        'default' => array('EUR'),
                        'options' => 'getCurrencies',
                        'group' => 'pt',
                    ),
                    array(
                        'name' => self::WCP_INVOICE_MIN,
                        'label' => $this->l('Minimum amount'),
                        'type' => 'text',
                        'group' => 'pt',
                        'validator' => 'numeric',
                        'default' => 10,
                        'cssclass' => 'fixed-width-md',
                        'suffix' => 'EUR'
                    ),
                    array(
                        'name' => self::WCP_INVOICE_MAX,
                        'label' => $this->l('Maximum amount'),
                        'type' => 'text',
                        'group' => 'pt',
                        'default' => 3500,
                        'validator' => 'numeric',
                        'cssclass' => 'fixed-width-md',
                        'suffix' => 'EUR'
                    )
                )
            ),
            'installmentoptions' => array(
                'tab' => $this->l('Installment'),
                'fields' => array(
                    array(
                        'name' => self::WCP_INSTALLMENT_PROVIDER,
                        'label' => $this->l('Installment provider'),
                        'type' => 'select',
                        'group' => 'pt',
                        'default' => 'payolution',
                        'required' => true,
                        'options' => 'getProvider'
                    )
                ,
                    array(
                        'name' => self::WCP_INSTALLMENT_ADDRESS_EQUAL,
                        'label' => $this->l('Billing/shipping address must be identical'),
                        'type' => 'onoff',
                        'default' => 1,
                        'group' => 'pt'
                    ),
                    array(
                        'name' => self::WCP_INSTALLMENT_BILLING_COUNTRIES,
                        'label' => $this->l('Allowed billing countries'),
                        'type' => 'select',
                        'multiple' => true,
                        'size' => 10,
                        'default' => array('AT', 'DE', 'CH'),
                        'options' => 'getCountries',
                        'group' => 'pt',
                    ),
                    array(
                        'name' => self::WCP_INSTALLMENT_SHIPPING_COUNTRIES,
                        'label' => $this->l('Allowed shipping countries'),
                        'type' => 'select',
                        'multiple' => true,
                        'size' => 10,
                        'default' => array('AT', 'DE', 'CH'),
                        'options' => 'getCountries',
                        'group' => 'pt',
                    ),
                    array(
                        'name' => self::WCP_INSTALLMENT_CURRENCIES,
                        'label' => $this->l('Accepted currencies'),
                        'type' => 'select',
                        'multiple' => true,
                        'default' => array('EUR'),
                        'options' => 'getCurrencies',
                        'group' => 'pt',
                    ),
                    array(
                        'name' => self::WCP_INSTALLMENT_MIN,
                        'label' => $this->l('Minimum amount'),
                        'type' => 'text',
                        'group' => 'pt',
                        'validator' => 'numeric',
                        'default' => 150,
                        'cssclass' => 'fixed-width-md',
                        'suffix' => 'EUR'
                    ),
                    array(
                        'name' => self::WCP_INSTALLMENT_MAX,
                        'label' => $this->l('Maximum amount'),
                        'type' => 'text',
                        'group' => 'pt',
                        'default' => 3500,
                        'validator' => 'numeric',
                        'cssclass' => 'fixed-width-md',
                        'suffix' => 'EUR'
                    )
                )
            )
        );

        return $fields_form_settings;
    }

    private function renderForm()
    {
        $radio_type = 'switch';

        $radio_options = array(
            array(
                'id' => 'active_on',
                'value' => 1,
                'label' => $this->l('Enabled')
            ),
            array(
                'id' => 'active_off',
                'value' => 0,
                'label' => $this->l('Disabled')
            )
        );

        $input_fields = array();
        $tabs = array();
        foreach ($this->config as $groupKey => $group) {
            $tabs[$groupKey] = $this->l($group['tab']);
            foreach ($group['fields'] as $f) {
                $elem = array(
                    'name' => $f['name'],
                    'label' => $this->l($f['label']),
                    'tab' => $groupKey,
                    'type' => $f['type'],
                    'required' => isset($f['required']) && $f['required']
                );

                if (isset($f['cssclass'])) {
                    $elem['class'] = $f['cssclass'];
                }

                if (isset($f['doc'])) {
                    if (is_array($f['doc'])) {
                        $elem['desc'] = '';
                        foreach ($f['doc'] as $d) {
                            if (Tools::strlen($elem['desc'])) {
                                $elem['desc'] .= '<br/>';
                            }

                            $elem['desc'] .= $d;
                        }
                    } else {
                        $elem['desc'] = $this->l($f['doc']);
                    }
                }

                if (isset($f['docref'])) {
                    $elem['desc'] = isset($elem['desc']) ? $elem['desc'] . ' ' : '';
                    $elem['desc'] .= sprintf(
                        '<a target="_blank" href="%s">%s <i class="icon-external-link"></i></a>',
                        $f['docref'],
                        $this->l('More information')
                    );
                }

                switch ($f['type']) {
                    case 'text':
                        if (!isset($elem['class'])) {
                            $elem['class'] = 'fixed-width-xl';
                        }

                        if (isset($f['maxchar'])) {
                            $elem['maxlength'] = $elem['maxchar'] = $f['maxchar'];
                        }
                        break;

                    case 'onoff':
                        $elem['type'] = $radio_type;
                        $elem['class'] = 't';
                        $elem['is_bool'] = true;
                        $elem['values'] = $radio_options;
                        break;

                    case 'select':
                        if (isset($f['multiple'])) {
                            $elem['multiple'] = $f['multiple'];
                        }

                        if (isset($f['size'])) {
                            $elem['size'] = $f['size'];
                        }

                        if (isset($f['options'])) {
                            $optfunc = $f['options'];
                            $options = array();
                            if (is_array($optfunc)) {
                                $options = $optfunc;
                            }

                            if (method_exists($this, $optfunc)) {
                                $options = $this->$optfunc($f['name']);
                            }

                            $elem['options'] = array(
                                'query' => $options,
                                'id' => 'key',
                                'name' => 'value'
                            );
                        }
                        break;

                    default:
                        break;
                }

                $input_fields[] = $elem;
            }
        }

        $fields_form_settings = array(
            'form' => array(
                'tabs' => $tabs,
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs'
                ),
                'input' => $input_fields,
                'submit' => array(
                    'title' => $this->l('Save')
                )
            ),
        );


        /** @var HelperFormCore $helper */
        $helper = new HelperForm();
        $helper->show_toolbar = false;

        /** @var LanguageCore $lang */
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get(
            'PS_BO_ALLOW_EMPLOYEE_FORM_LANG'
        ) : 0;
        $helper->id = (int)Tools::getValue('id_carrier');
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'btnSubmit';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
            'ajax_configtest_url' => $this->context->link->getAdminLink('AdminModules') . '&configure=' . $this->name
                . '&tab_module=' . $this->tab . '&module_name=' . $this->name
        );

        return $helper->generateForm(array($fields_form_settings));
    }

    private function getTransactionIdOptions()
    {
        return array(
            array('key' => 'orderNumber', 'value' => $this->l('Wirecard order number')),
            array('key' => 'gatewayReferenceNumber', 'value' => $this->l('Gateway reference number'))
        );
    }

    public function getConfigFieldsValues()
    {
        $values = array();
        foreach ($this->getAllConfigurationParameter() as $parameter) {
            $val = Configuration::get($parameter['name']);

            if (isset($parameter['multiple']) && $parameter['multiple']) {
                if (!is_array($val)) {
                    $val = Tools::strlen($val) ? (json_decode($val) != null) ? json_decode($val) : $val : array();
                }

                if (is_array($val)) {
                    $x = array();
                    foreach ($val as $v) {
                        $x[$v] = $v;
                    }
                }
                $values[$parameter['name'] . '[]'] = $val;
            } else {
                $values[$parameter['name']] = $val;
            }
        }
        return $values;
    }

    public function hookPaymentOptions($params)
    {
        if (!$this->active) {
            return false;
        }

        $customer_id = $params['cookie']->id_customer;
        $customer = new Customer($customer_id);
        $age = 0;
        if (Tools::strlen($customer->birthday) && $customer->birthday != '0000-00-00') {
        $age = (new DateTime())->diff(DateTime::createFromFormat("Y-m-d", $customer->birthday))->y;
        }
        $result = array();

        unset($this->context->cookie->qpayRedirectUrl);
        $paymentTypes = $this->getEnabledPaymentTypes($params['cart']);

        $logo = function ($payment_type) {
            return ".." . Media::getMediaPath('/modules/wirecardceecheckoutpage/views/img/payment_types/' . Tools::strtolower($payment_type) . '.png');
        };

        if ($this->context->cookie->wcpConsumerDeviceId) {
            $consumerDeviceId = $this->context->cookie->wcpConsumerDeviceId;
        } else {
            $timestamp = microtime();
            $customerId = $this->getCustomerId();
            $consumerDeviceId = md5($customerId . "_" . $timestamp);
            $this->context->cookie->wcpConsumerDeviceId = $consumerDeviceId;
            $this->context->cookie->write();
        }
        if ((Configuration::get(self::WCP_INVOICE_PROVIDER) == 'ratepay' && (bool)Configuration::get(self::WCP_PT_INVOICE)) ||
            (Configuration::get(self::WCP_INSTALLMENT_PROVIDER) == 'ratepay' && (bool)Configuration::get(self::WCP_PT_INSTALLMENT))) {
            $ratepay = '<script language="JavaScript">var di = {t:"' . $consumerDeviceId . '",v:"WDWL",l:"Checkout"};</script>';
            $ratepay .= '<script type="text/javascript" src="//d.ratepay.com/' . $consumerDeviceId . '/di.js"></script>';
            $ratepay .= '<noscript><link rel="stylesheet" type="text/css" href="//d.ratepay.com/di.css?t=' . $consumerDeviceId . '&v=WDWL&l=Checkout"></noscript>';
            $ratepay .= '<object type="application/x-shockwave-flash" data="//d.ratepay.com/WDWL/c.swf" width="0" height="0"><param name="movie" value="//d.ratepay.com/WDWL/c.swf" /><param name="flashvars" value="t=' . $consumerDeviceId . '&v=WDWL"/><param name="AllowScriptAccess" value="always"/></object>';

            echo $ratepay;
        }

        foreach ($paymentTypes as $paymentType) {
            $payment = new PaymentOption();

            $current_method = $paymentType['value'];
            $payment->setLogo($logo(Tools::strtolower($current_method)))
                ->setCallToActionText($this->l('Pay using') . ' ' . $this->l($paymentType['title']));

            $action = $this->context->link->getModuleLink(
                $this->name,
                'payment',
                array('paymentType' => $current_method),
                true
            );
            $template = "module:wirecardceecheckoutpage/views/templates/hook/methods/" . Tools::strtolower($current_method) . ".tpl";
            $payment_class = new WirecardCEE_QPay_PaymentType($current_method);

            $consent_message = sprintf(
                $this->l("I agree that the data which are necessary for the liquidation of invoice payments and which are used to complete the identity and credit check are transmitted to payolution.  My %s can be revoked at any time with future effect."),
                ((Tools::strlen(Configuration::get(self::WCP_PAYOLUTION_MID)))
                    ? '<a href="https://payment.payolution.com/payolution-payment/infoport/dataprivacyconsent?mId=' . base64_encode(Configuration::get(self::WCP_PAYOLUTION_MID)) . '" target="_blank">' . $this->l('consent') . '</a>'
                    : $this->l('consent'))
            );

            if ($this->context->smarty->templateExists($template)) {
                $this->context->smarty->assign(
                    array(
                        "action" => $action,
                        'days' => Tools::dateDays(),
                        'months' => Tools::dateMonths(),
                        'years' => Tools::dateYears(),
                        "method" => $current_method,
                        "financialInstitutions" => $payment_class->getFinancialInstitutions($current_method),
                        "min_age_message" => $this->l("You have to be 18 years or older to use this payment."),
                        "show_birthdate" => $age < 18,
                        "consent_error_message" => $this->l("Please accept the consent terms!"),
                        "consent_text" => $consent_message,
                        "submit_text" => $this->l('Pay using') . ' ' . $this->l($paymentType['title']),
                        "has_consent" => Configuration::get(self::WCP_PAYOLUTION_TERMS)
                            && (($current_method == WirecardCEE_QPay_PaymentType::INVOICE && Configuration::get(self::WCP_INVOICE_PROVIDER) == 'payolution') || ($current_method === WirecardCEE_QPay_PaymentType::INSTALLMENT && Configuration::get(self::WCP_INSTALLMENT_PROVIDER) == 'payolution'))
                    )
                );

                $payment->setBinary(true);
                $payment->setForm($this->context->smarty->fetch($template));
            } else {
                $payment->setAction($action);
            }

            $result[] = $payment;
        }

        return count($result) ? $result : false;
    }

    public function hookDisplayPaymentReturn($params)
    {
        if (!$this->active) {
            return;
        }

        $this->setOrder((int)Tools::getValue('psOrderNumber'));
        unset($this->context->cookie->qpayRedirectUrl);

        if ($this->getOrder()->hasBeenPaid() || Tools::getValue('paymentState') == WirecardCEE_QPay_ReturnFactory::STATE_SUCCESS) {
            $this->smarty->assign(array(
                'status' => 'ok'
            ));
            return $this->display(__FILE__, 'payment_return.tpl');
        }

        if (Tools::getValue('paymentState') == WirecardCEE_QPay_ReturnFactory::STATE_PENDING) {
            $this->smarty->assign(array(
                'status' => 'ok'
            ));
            return $this->display(__FILE__, 'pending.tpl');
        }

        // rebuild cart
        $oldCart = new Cart((int)$params["order"]->id_cart);
        $duplication = $oldCart->duplicate();
        if (!$duplication || !Validate::isLoadedObject($duplication['cart'])) {
            $this->errors[] = Tools::displayError('Sorry. We cannot renew your order.');
        } elseif (!$duplication['success']) {
            $this->errors[] = Tools::displayError('Some items are no longer available, and we are unable to renew your order.');
        } else {
            $this->context->cookie->id_cart = $duplication['cart']->id;
            $context = $this->context;
            $context->cart = $duplication['cart'];
            CartRule::autoAddToCart($context);
            $this->context->cookie->write();

            if (Configuration::get('PS_ORDER_PROCESS_TYPE')) {
                Tools::redirect($this->context->link->getPageLink('order-opc', true, $this->getOrder()->id_lang, null));
            }
            Tools::redirect($this->context->link->getPageLink('order', true, $this->getOrder()->id_lang, null));
        }
    }

    public function hookDisplayPDFInvoice($params)
    {
        $invoice = $params['object'];

        $msg = $this->getPaymentMessage($invoice->id_order);

        if (preg_match("/paymentType: *([^;]+);.*gatewayReferenceNumber: *([^;]+)/i", $msg, $matches)) {
            $paymentType = $matches[1];
            $gatewayReferenceNumber = $matches[2];
        } else {
            return '';
        }

        $ret = sprintf(
            $this->l(
                'Your Paymenttype is %s. Please use this number %s as reference for your bank account transactions.'
            ),
            $this->l($paymentType),
            $gatewayReferenceNumber
        );
        return $ret;
    }

    private function getPaymentMessage($id_order)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue(
            'SELECT `message`
                 FROM `' . _DB_PREFIX_ . 'message`
             WHERE `id_order` = ' . (int)$id_order . '
                 AND private = 1
                 AND message like \'%paymentType%\'
             ORDER BY `id_message`
        '
        );
    }

    /**
     * build basket
     *
     * @param Cart $cart
     *
     * @return WirecardCEE_Stdlib_Basket
     */
    public function getBasket(Cart $cart)
    {
        $basket = new WirecardCEE_Stdlib_Basket();

        foreach ($cart->getProducts() as $product) {
            $item = new WirecardCEE_Stdlib_Basket_Item($product['reference']);
            $item->setUnitGrossAmount(number_format($product['price_wt'], 2, '.', ''))
                ->setUnitNetAmount(number_format($product['price'], 2, '.', ''))
                ->setUnitTaxAmount(number_format($product['price_wt'] - $product['price'], 2, '.', ''))
                ->setUnitTaxRate($product['rate'])
                ->setDescription(Tools::substr(strip_tags($product['description_short']), 0, 127))
                ->setName(Tools::substr($product['name'], 0, 127))
                ->setImageUrl(
                    $this->context->link->getImageLink($product['link_rewrite'], $product['id_image'])
                );

            $basket->addItem($item, $product['cart_quantity']);
        }

        if ($cart->getTotalShippingCost(null, true) > 0) {
            $item = new WirecardCEE_Stdlib_Basket_Item('shipping');
            $item->setDescription('Shipping')
                ->setName('Shipping')
                ->setUnitGrossAmount($cart->getTotalShippingCost(null, true))
                ->setUnitNetAmount($cart->getTotalShippingCost(null, false))
                ->setUnitTaxAmount($item->getUnitGrossAmount() - $item->getUnitNetAmount())
                ->setUnitTaxRate((($item->getUnitGrossAmount() / $item->getUnitNetAmount()) - 1) * 100);

            $basket->addItem($item);
        }

        return $basket;
    }

    public function initiatePayment($paymentType, $additionalData)
    {
        if (in_array($paymentType, array(
            WirecardCEE_QMore_PaymentType::INSTALLMENT,
            WirecardCEE_QMore_PaymentType::INVOICE
        ))) {
            $keys_to_check = array('years','months','days');

            /** @var int $age - age from customer object */
            $customer = new Customer($this->context->customer->id);
            $age = 0;
            if (Tools::strlen($customer->birthday) && $customer->birthday != '0000-00-00') {
            $age = (new DateTime())->diff(DateTime::createFromFormat("Y-m-d", $customer->birthday))->y;
            }

            if ($age < 18 && count(array_intersect(array_flip(Tools::getAllValues()), $keys_to_check)) < count($keys_to_check)) {
                // redirect back because some params are missing
                Tools::redirect(
                    $this->context->link->getPageLink('order', true, $this->context->language->id),
                    array("submitReorder" => true)
                );
                die();
            } else {
                $birthdate = new DateTime();
                $birthdate->setDate(Tools::getValue('years'), Tools::getValue('months'), Tools::getValue('days'));
                /** @var int $age - age from dropdowns in payment form */
                $age = (new DateTime())->diff($birthdate)->y;

                if ($age < 18) {
                    $this->context->cookie->wcpMessage = $this->l("You have to be 18 years or older to use this payment.");

                    Tools::redirect(
                        $this->context->link->getPageLink('order', true, $this->context->language->id),
                        array("submitReorder" => true)
                    );
                    die();
                }

                $customer->birthday = $birthdate->format('Y-m-d');
                $customer->save();
            }
        }

        if (!$this->context->cookie->qpayRedirectUrl) {
            if (!$this->context->cookie->id_cart) {
                $this->context->cookie->wcpMessage = $this->l('Unable to load cart.');
                Tools::redirect(
                    $this->context->link->getPageLink('order', true, $this->context->language->id),
                    array("submitReorder" => true)
                );
                die();
            }

            if (!$this->isPaymentTypeEnabled($paymentType)) {
                throw new Exception($this->l('Payment method not enabled.'));
            }
            $this->setCart($this->context->cookie->id_cart);

            try {
                $redirectUrl = $this->initiate($paymentType, $additionalData);
                $this->context->cookie->qpayRedirectUrl = $redirectUrl;
                $this->context->cookie->write();
            } catch (Exception $e) {
                $this->log(__METHOD__ . ':' . $e->getMessage());
                $this->setOrderState(_PS_OS_ERROR_);
                throw $e;
            }
        } else {
            $redirectUrl = $this->context->cookie->qpayRedirectUrl;
        }

        if (Configuration::get(self::WCP_USE_IFRAME)) {
            Tools::redirect($this->context->link->getModuleLink($this->name, 'paymentIFrame'));
        } else {
            Tools::redirect($redirectUrl);
        }
    }

    private function initiate($paymentType, $additionalData)
    {
        $customer = new Customer($this->context->customer->id);
        $cart = new Cart($this->context->cookie->id_cart);


        $this->validateOrder(
            $this->getCart()->id,
            $this->getAwaitingState(),
            $this->myCart->getOrderTotal(true),
            $this->displayName,
            null,
            array(),
            null,
            false,
            $this->myCart->secure_key
        );

        $this->updatePaymentInformation($this->getCart()->id, $paymentType);
        $this->setOrder($this->currentOrder);

        $amount = round($this->getAmount(), 2);

        $init = new WirecardCEE_QPay_FrontendClient($this->getConfigArray());
        $init->setPluginVersion($this->getPluginVersion())
            ->setConfirmUrl($this->getConfirmUrl())
            ->setOrderReference($this->getOrderReference())
            ->setAmount($amount)
            ->setCurrency($this->getCurrentCurrency())
            ->setPaymentType($paymentType)
            ->setOrderDescription($this->getOrderDescription())
            ->setSuccessUrl($this->getReturnUrl())
            ->setPendingUrl($this->getReturnUrl())
            ->setCancelUrl($this->getReturnUrl())
            ->setFailureUrl($this->getReturnUrl())
            ->setServiceUrl($this->getServiceUrl())
            ->setAutoDeposit($this->getAutoDeposit())
            ->setCustomerStatement($this->getCustomerStatement())
            ->createConsumerMerchantCrmId($customer->email);

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->setIpAddress($_SERVER['REMOTE_ADDR']);
        $consumerData->setUserAgent($_SERVER['HTTP_USER_AGENT']);

        $init->setConsumerData($consumerData);

        if ($this->context->cookie->wcpConsumerDeviceId) {
            $init->consumerDeviceId = $this->context->cookie->wcpConsumerDeviceId;
            unset($this->context->cookie->wcpConsumerDeviceId);
        }

        if (isset($additionalData['financialinstitution'])) {
            $init->setFinancialInstitution($additionalData['financialinstitution']);
        }
        if (Tools::strlen(Configuration::get(self::WCP_DISPLAY_TEXT))) {
            $init->setDisplayText(Configuration::get(self::WCP_DISPLAY_TEXT));
        }

        if (Tools::strlen(Configuration::get(self::WCP_MAX_RETRIES))) {
            $init->setMaxRetries(Configuration::get(self::WCP_MAX_RETRIES));
        }


        if (Configuration::get(self::WCP_SEND_BASKET_DATA)
            || ($paymentType == WirecardCEE_QPay_PaymentType::INSTALLMENT && Configuration::get(self::WCP_INSTALLMENT_PROVIDER) == 'ratepay')
            || ($paymentType == WirecardCEE_QPay_PaymentType::INVOICE && (Configuration::get(self::WCP_INVOICE_PROVIDER) == 'ratepay' || Configuration::get(self::WCP_INVOICE_PROVIDER) == 'wirecard'))
        ) {
            $init->setBasket($this->getBasket($cart));
        }

        if ($paymentType == WirecardCEE_QPay_PaymentType::INVOICE) {
            $init->setFinancialInstitution(Configuration::get(self::WCP_INVOICE_PROVIDER));
        }

        if ($paymentType == WirecardCEE_QPay_PaymentType::INSTALLMENT) {
            $init->setFinancialInstitution(Configuration::get(self::WCP_INSTALLMENT_PROVIDER));
        }

        if ($paymentType == WirecardCEE_QPay_PaymentType::MASTERPASS) {
            $init->setShippingProfile('NO_SHIPPING');
        }
        //additionally parameters can be added easily because of the magic method __set
        $init->psOrderNumber = $this->getOrder()->id;

        if ($this->getSendAdditionalData()
            || $paymentType == WirecardCEE_QPay_PaymentType::INVOICE
            || $paymentType == WirecardCEE_QPay_PaymentType::INSTALLMENT
        ) {
            $init = $this->setConsumerInformation($init);
        }


        return $init->initiate()->getRedirectUrl();
    }

    private function setConsumerInformation(WirecardCEE_QPay_FrontendClient $request)
    {
        $psBillingAddress = new Address($this->getOrder()->id_address_invoice);
        $psShippingAddress = new Address($this->getOrder()->id_address_delivery);

        $billingAddress = new WirecardCEE_Stdlib_ConsumerData_Address(WirecardCEE_Stdlib_ConsumerData_Address::TYPE_BILLING);
        $billingState = new State($psBillingAddress->id_state);
        $billingCountry = new Country($psBillingAddress->id_country);
        $billingAddress->setFirstname($psBillingAddress->firstname)
            ->setLastname($psBillingAddress->lastname)
            ->setAddress1($psBillingAddress->address1)
            ->setAddress2($psBillingAddress->address2)
            ->setCity($psBillingAddress->city)
            ->setZipCode($psBillingAddress->postcode)
            ->setCountry($billingCountry->iso_code)
            ->setPhone($psBillingAddress->phone);
        if ($billingCountry->iso_code == 'US' || $billingCountry->iso_code == 'CA') {
            $billingAddress->setState($billingState->iso_code);
        } else {
            $billingAddress->setState($billingState->name);
        }

        $shippingAddress = new WirecardCEE_Stdlib_ConsumerData_Address(WirecardCEE_Stdlib_ConsumerData_Address::TYPE_SHIPPING);
        $shippingState = new State($psShippingAddress->id_state);
        $shippingCountry = new Country($psShippingAddress->id_country);
        $shippingAddress->setFirstname($psShippingAddress->firstname)
            ->setLastname($psShippingAddress->lastname)
            ->setAddress1($psShippingAddress->address1)
            ->setAddress2($psShippingAddress->address2)
            ->setCity($psShippingAddress->city)
            ->setZipCode($psShippingAddress->postcode)
            ->setCountry($shippingCountry->iso_code)
            ->setPhone($psShippingAddress->phone);

        if ($shippingCountry->iso_code == 'US' || $shippingCountry->iso_code == 'CA') {
            $shippingAddress->setState($shippingState->iso_code);
        } else {
            $shippingAddress->setState($shippingState->name);
        }

        $consumerData = new WirecardCEE_Stdlib_ConsumerData();
        $consumerData->addAddressInformation($billingAddress)
            ->addAddressInformation($shippingAddress)
            ->setUserAgent($this->getConsumerUserAgent())
            ->setIpAddress($this->getConsumerIpAddress());

        $customer = new Customer($this->getOrder()->id_customer);

        $consumerData->setBirthDate($this->getValidDate($customer->birthday, "Y-m-d"))
            ->setEmail($customer->email);

        $request->setConsumerData($consumerData);

        return $request;
    }

    /*
     * Returns today's date if $date is invalid
     */
    public function getValidDate($date, $format)
    {
        if (!empty($date) && strtotime($date) !== false) {
            if ($this->isValidDateFormat($date)) {
                return DateTime::createFromFormat($format, $date);
            }
        }
        return new DateTime();
    }

    /*
     * Checks if format is Y-m-d
     */
    public function isValidDateFormat($date)
    {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            return true;
        } else {
            return false;
        }
    }

    public function confirmResponse()
    {
        if (!$this->active) {
            return WirecardCEE_QPay_ReturnFactory::generateConfirmResponseString($this->l("Module is not active!"));
        }

        $response = Tools::file_get_contents('php://input');
        $this->log(__METHOD__ . ':raw:' . $response);

        try {
            $return = WirecardCEE_QPay_ReturnFactory::getInstance($response, $this->getSecret());
            $status = $return->validate();

            switch ($status) {
                case WirecardCEE_QPay_ReturnFactory::STATE_SUCCESS:
                    $orderState = _PS_OS_PAYMENT_;
                    //create message with returned Parameters.
                    $this->saveReturnedFields($return);
                    $this->updatePaymentInformation($return->getReturned()['psOrderNumber'], $return->getReturned()['paymentType'], $return->getReturned()[$this->getTransactionId()]);
                    break;
                case WirecardCEE_QPay_ReturnFactory::STATE_CANCEL:
                    $orderState = _PS_OS_CANCELED_;
                    break;
                case WirecardCEE_QPay_ReturnFactory::STATE_FAILURE:
                    $this->saveReturnedFields($return);
                    $orderState = _PS_OS_ERROR_;
                    break;
                case WirecardCEE_QPay_ReturnFactory::STATE_PENDING:
                    $this->saveReturnedFields($return);
                    $orderState = $this->getAwaitingState();
                    break;
                default:
                    return WirecardCEE_QPay_ReturnFactory::generateConfirmResponseString('Invalid uncaught paymentState. Should not happen.');
            }

            $this->setOrder($return->getReturned()['psOrderNumber']);
            $this->setOrderState($orderState);
        } catch (WirecardCEE_Stdlib_Validate_Exception $e) {
            $this->log(__METHOD__ . ':' . $e->getMessage());
            if (isset($response->psOrderNumber)) {
                $this->setOrder($response->psOrderNumber);
                $this->setOrderState(_PS_OS_ERROR_);
            }
            return WirecardCEE_QPay_ReturnFactory::generateConfirmResponseString($e->getMessage());
        }
        return WirecardCEE_QPay_ReturnFactory::generateConfirmResponseString();
    }

    private function updatePaymentInformation($orderId, $paymentType, $transactionId = '')
    {
        $info = $this->getPaymentTypeInfo('WCP_PT_' . $paymentType);

        $order = new Order($orderId);
        $aOrderPayments = OrderPayment::getByOrderReference($order->reference);
        if (!empty($aOrderPayments)) {
            $aOrderPayments[0]->payment_method = $this->displayName . ' ' . $info['title'];
            if ($transactionId != '') {
                $aOrderPayments[0]->transaction_id = $transactionId;
            }
            $aOrderPayments[0]->save();
        }
    }

    public function breakoutIFrame()
    {
        if (!$this->active) {
            return;
        }

        $this->smarty->assign('_POST', $_POST);
        if (!Tools::getIsset('id_cart') || !Tools::getIsset('id_module') || !Tools::getIsset('id_order')) {
            throw new Exception('Invalid Request. orderId, moduleId, cartId or secureKey not set');
        }

        $id_order = (int)Tools::getValue('id_order');
        $params = array(
            'id_cart' => (int)Tools::getValue('id_cart'),
            'id_module' => (int)Tools::getValue('id_module'),
            'id_order' => $id_order,
            'key' => Tools::getValue('key', null)
        );

        $this->setOrder($id_order);

        $this->smarty->assign(array(
            'orderConfirmation' =>
            $this->context->link->getPageLink(
                'order-confirmation',
                true,
                null,
                $params
            ),
            'this_path' => _THEME_CSS_DIR_
        ));
        return $this->display(__FILE__, 'breakout_iframe.tpl');
    }

    private function saveReturnedFields(WirecardCEE_Stdlib_Return_ReturnAbstract $response)
    {
        $msg = new Message();
        $message = '';

        $response = $response->getReturned();

        foreach ($response as $key => $value) {
            switch ($key) {
                case 'psOrderNumber':
                case 'paymentState':
                case 'amount':
                case 'currency':
                case 'language':
                case 'responseFingerprint':
                case 'responseFingerprintOrder':
                    break;
                default:
                    $message .= ';' . $key . ': ' . $value;
                    break;
            }
        }

        if (!Validate::isCleanHtml($message)) {
            $message = $this->l('Payment process results could not be saved reliably. Please check the payment in the Wirecard Payment Center.');
        }

        $msg->message = trim($message, ';');
        $msg->id_order = (int)($response['psOrderNumber']);
        $msg->private = 1;
        $msg->add();
    }

    private function setOrderState($state)
    {
        //Order::setCurrentState() does not save history. - it's not even used in presta itself.
        $history = new OrderHistory();
        $history->id_order = (int) $this->getOrder()->id;
        $history->changeIdOrderState((int)($state), $history->id_order, true);
        $history->addWithemail();
    }

    private function getEnabledPaymentTypes($cart)
    {
        $paymentTypes = array();
        foreach ($this->getPaymentTypes() as $type) {
            if (!Configuration::get($type) ||
                ($type == self::WCP_PT_INVOICE && !$this->isInvoiceAllowed($cart)) ||
                ($type == self::WCP_PT_INSTALLMENT && !$this->isInstallmentAllowed($cart))) {
                continue;
            }
            array_push($paymentTypes, $this->getPaymentTypeInfo($type));
        }
        return $paymentTypes;
    }

    private function isPaymentTypeEnabled($paymentType)
    {
        if ($paymentType == WirecardCEE_QPay_PaymentType::SELECT) {
            return true;
        } else {
            return Configuration::get('WCP_PT_' . $paymentType);
        }
    }

    private function getAllConfigurationParameter()
    {
        $params = array();

        foreach ($this->config as $group) {
            foreach ($group['fields'] as $f) {
                $params[] = $f;
            }
        }
        return $params;
    }

    private function getPaymentTypes()
    {
        return array(self::WCP_PT_CCARD, self::WCP_PT_MASTERPASS, self::WCP_PT_CCARD_MOTO, self::WCP_PT_MAESTRO,
            self::WCP_PT_EPS, self::WCP_PT_IDL, self::WCP_PT_GIROPAY, self::WCP_PT_TATRAPAY,
            self::WCP_PT_SOFORTUEBERWEISUNG, self::WCP_PT_PBX, self::WCP_PT_QUICK, self::WCP_PT_PAYPAL,
            self::WCP_PT_EPAY_BG, self::WCP_PT_SEPA_DD, self::WCP_PT_TRUSTPAY, self::WCP_PT_INVOICE,
            self::WCP_PT_INSTALLMENT, self::WCP_PT_BANCONTACT_MISTERCASH, self::WCP_PT_P24, self::WCP_PT_MONETA,
            self::WCP_PT_POLI, self::WCP_PT_EKONTO, self::WCP_PT_TRUSTLY, self::WCP_PT_SKRILLWALLET,
            self::WCP_PT_VOUCHER);
    }

    private function getPaymentTypeInfo($type)
    {
        switch ($type) {
            case self::WCP_PT_CCARD:
                return array('title' => $this->l('Credit Card'),
                    'value' => WirecardCEE_QPay_PaymentType::CCARD);
            case self::WCP_PT_CCARD_MOTO:
                return array('title' => $this->l('Credit Card - Mail Order and Telephone Order'),
                    'value' => WirecardCEE_QPay_PaymentType::CCARD_MOTO);
            case self::WCP_PT_MAESTRO:
                return array('title' => $this->l('Maestro SecureCode'),
                    'value' => WirecardCEE_QPay_PaymentType::MAESTRO);
            case self::WCP_PT_MASTERPASS:
                return array('title' => $this->l('Masterpass'),
                    'value' => WirecardCEE_QPay_PaymentType::MASTERPASS);
            case self::WCP_PT_EPS:
                return array('title' => $this->l('eps Online-Überweisung'),
                    'value' => WirecardCEE_QPay_PaymentType::EPS);
            case self::WCP_PT_IDL:
                return array('title' => $this->l('iDEAL'),
                    'value' => WirecardCEE_QPay_PaymentType::IDL);
            case self::WCP_PT_GIROPAY:
                return array('title' => $this->l('giropay'),
                    'value' => WirecardCEE_QPay_PaymentType::GIROPAY);
            case self::WCP_PT_TATRAPAY:
                return array('title' => $this->l('TatraPay'),
                    'value' => WirecardCEE_QPay_PaymentType::TATRAPAY);
            case self::WCP_PT_SOFORTUEBERWEISUNG:
                return array('title' => $this->l('Online bank transfer.'),
                    'value' => WirecardCEE_QPay_PaymentType::SOFORTUEBERWEISUNG);
            case self::WCP_PT_PBX:
                return array('title' => $this->l('paybox'),
                    'value' => WirecardCEE_QPay_PaymentType::PBX);
            case self::WCP_PT_PSC:
                return array('title' => $this->l('paysafecard'),
                    'value' => WirecardCEE_QPay_PaymentType::PSC);
            case self::WCP_PT_QUICK:
                return array('title' => $this->l('@Quick'),
                    'value' => WirecardCEE_QPay_PaymentType::QUICK);
            case self::WCP_PT_PAYPAL:
                return array('title' => $this->l('PayPal'),
                    'value' => WirecardCEE_QPay_PaymentType::PAYPAL);
            case self::WCP_PT_EPAY_BG:
                return array('title' => $this->l('ePay.bg'),
                    'value' => WirecardCEE_QPay_PaymentType::EPAYBG);
            case self::WCP_PT_SEPA_DD:
                return array('title' => $this->l('SEPA Direct Debit'),
                    'value' => WirecardCEE_QPay_PaymentType::SEPADD);
            case self::WCP_PT_TRUSTPAY:
                return array('title' => $this->l('TrustPay'),
                    'value' => WirecardCEE_QPay_PaymentType::TRUSTPAY);
            case self::WCP_PT_INVOICE:
                return array('title' => $this->l('Invoice'),
                    'value' => WirecardCEE_QPay_PaymentType::INVOICE);
            case self::WCP_PT_INSTALLMENT:
                return array('title' => $this->l('Installment'),
                    'value' => WirecardCEE_QPay_PaymentType::INSTALLMENT);
            case self::WCP_PT_BANCONTACT_MISTERCASH:
                return array('title' => $this->l('Bancontact'),
                    'value' => WirecardCEE_QPay_PaymentType::BMC);
            case self::WCP_PT_P24:
                return array('title' => $this->l('Przelewy24'),
                    'value' => WirecardCEE_QPay_PaymentType::P24);
            case self::WCP_PT_MONETA:
                return array('title' => $this->l('moneta.ru'),
                    'value' => WirecardCEE_QPay_PaymentType::MONETA);
            case self::WCP_PT_POLI:
                return array('title' => $this->l('POLi'),
                    'value' => WirecardCEE_QPay_PaymentType::POLI);
            case self::WCP_PT_EKONTO:
                return array('title' => $this->l('eKonto'),
                    'value' => WirecardCEE_QPay_PaymentType::EKONTO);
            case self::WCP_PT_TRUSTLY:
                return array('title' => $this->l('Trustly'),
                    'value' => WirecardCEE_QPay_PaymentType::TRUSTLY);
            case self::WCP_PT_SKRILLWALLET:
                return array('title' => $this->l('Skrill Digital Wallet'),
                    'value' => WirecardCEE_QPay_PaymentType::SKRILLWALLET);
            case self::WCP_PT_VOUCHER:
                return array('title' => $this->l('My Voucher'),
                    'value' => WirecardCEE_QPay_PaymentType::VOUCHER);
            default:
                return array('title' => $this->l('The consumer may select one of the activated payment methods directly in Wirecard Checkout Page.'),
                    'value' => WirecardCEE_QPay_PaymentType::SELECT);
        }
    }

    private function getAwaitingState()
    {
        return Configuration::get(self::WCP_OS_AWAITING);
    }

    private function getCart()
    {
        return $this->myCart;
    }

    private function setCart($cart_id)
    {
        $this->myCart = new Cart((int)$cart_id);
    }

    private function setOrder($order_id)
    {
        $this->myOrder = new Order($order_id);
    }

    private function getOrder()
    {
        return $this->myOrder;
    }

    private function getMultiSelectArray($key)
    {
        $val = Configuration::get($key);

        if (!Tools::strlen($val)) {
            return array();
        }

        $ret = json_decode($val);
        if (!is_array($ret)) {
            return array();
        }
        return $ret;
    }

    private function isInvoiceAllowed(Cart $cart)
    {
        $chosen_currencies = $this->getMultiSelectArray(self::WCP_INVOICE_CURRENCIES);
        $chosen_shipping_countries = $this->getMultiSelectArray(self::WCP_INVOICE_SHIPPING_COUNTRIES);
        $chosen_billing_countries = $this->getMultiSelectArray(self::WCP_INVOICE_BILLING_COUNTRIES);

        $currency = new Currency($cart->id_currency);
        if (!in_array($currency->iso_code, $chosen_currencies)) {
            return false;
        }

        $billingAddress = new Address($cart->id_address_invoice);
        $shippingAddress = new Address($cart->id_address_delivery);

        if (!in_array(
            (new Country($billingAddress->id_country))->iso_code,
            $chosen_billing_countries
        )
        ) {
            return false;
        }

        if (!in_array(
            (new Country($shippingAddress->id_country))->iso_code,
            $chosen_shipping_countries
        )
        ) {
            return false;
        }

        $total = $cart->getOrderTotal();

        if ($billingAddress->id != $shippingAddress->id) {
            $fields = array('country', 'company', 'firstname', 'lastname', 'address1', 'address2', 'postcode', 'city');
            foreach ($fields as $f) {
                if ($billingAddress->$f != $shippingAddress->$f) {
                    return false;
                }
            }
        }

        if ($this->getInvoiceMin() && $this->getInvoiceMin() > $total) {
            return false;
        }

        if ($this->getInvoiceMax() && $this->getInvoiceMax() < $total) {
            return false;
        }

        return true;
    }

    private function isInstallmentAllowed(Cart $cart)
    {
        $chosen_currencies = $this->getMultiSelectArray(self::WCP_INSTALLMENT_CURRENCIES);
        $chosen_shipping_countries = $this->getMultiSelectArray(self::WCP_INSTALLMENT_SHIPPING_COUNTRIES);
        $chosen_billing_countries = $this->getMultiSelectArray(self::WCP_INSTALLMENT_BILLING_COUNTRIES);

        $currency = new Currency($cart->id_currency);
        if (!in_array($currency->iso_code, $chosen_currencies)) {
            return false;
        }

        $billingAddress = new Address($cart->id_address_invoice);
        $shippingAddress = new Address($cart->id_address_delivery);

        if (!in_array(
            (new Country($billingAddress->id_country))->iso_code,
            $chosen_billing_countries
        )
        ) {
            return false;
        }

        if (!in_array(
            (new Country($shippingAddress->id_country))->iso_code,
            $chosen_shipping_countries
        )
        ) {
            return false;
        }

        $total = $cart->getOrderTotal();

        if ($billingAddress->id != $shippingAddress->id) {
            $fields = array('country', 'company', 'firstname', 'lastname', 'address1', 'address2', 'postcode', 'city');
            foreach ($fields as $f) {
                if ($billingAddress->$f != $shippingAddress->$f) {
                    return false;
                }
            }
        }

        if ($this->getInstallmentMin() && $this->getInstallmentMin() > $total) {
            return false;
        }

        if ($this->getInstallmentMax() && $this->getInstallmentMax() < $total) {
            return false;
        }

        return true;
    }

    private function getConfigurationModes()
    {
        return array(
            array('key' => 'production', 'value' => $this->l('Production')),
            array('key' => 'demo', 'value' => $this->l('Demo')),
            array('key' => 'test', 'value' => $this->l('Test')),
            array('key' => 'test3d', 'value' => $this->l('Test 3D'))
        );
    }

    private function getCustomerId()
    {
        $customerIdArray = array(
            'production' => Configuration::get(self::WCP_CUSTOMER_ID),
            'demo' => self::WCP_CUSTOMER_ID_DEMO,
            'test' => self::WCP_CUSTOMER_ID_TEST,
            'test3d' => self::WCP_CUSTOMER_ID_TEST3D
        );

        return $customerIdArray[Configuration::get(self::WCP_CONFIGURATION_MODE)];
    }

    private function getShopId()
    {
        $shopIdArray = array(
            'production' => Configuration::get(self::WCP_SHOP_ID),
            'demo' => self::WCP_SHOP_ID_DEMO,
            'test' => self::WCP_SHOP_ID_TEST,
            'test3d' => self::WCP_SHOP_ID_TEST3D
        );

        return $shopIdArray[Configuration::get(self::WCP_CONFIGURATION_MODE)];
    }

    private function getSecret()
    {
        $secretArray = array(
            'production' => Configuration::get(self::WCP_SECRET),
            'demo' => self::WCP_SECRET_DEMO,
            'test' => self::WCP_SECRET_TEST,
            'test3d' => self::WCP_SECRET_TEST3D
        );

        return $secretArray[Configuration::get(self::WCP_CONFIGURATION_MODE)];
    }

    private function getInvoiceMin()
    {
        return Configuration::get(self::WCP_INVOICE_MIN);
    }

    private function getInvoiceMax()
    {
        return Configuration::get(self::WCP_INVOICE_MAX);
    }

    private function getInstallmentMin()
    {
        return Configuration::get(self::WCP_INSTALLMENT_MIN);
    }

    private function getInstallmentMax()
    {
        return Configuration::get(self::WCP_INSTALLMENT_MAX);
    }

    private function getTransactionId()
    {
        return Configuration::get(self::WCP_TRANSACTION_ID);
    }

    private function getAutoDeposit()
    {
        return Configuration::get(self::WCP_AUTO_DEPOSIT);
    }

    private function getSendAdditionalData()
    {
        return Configuration::get(self::WCP_SEND_ADDITIONAL_DATA);
    }

    private function getDisplayText()
    {
        return Configuration::get(self::WCP_DISPLAY_TEXT);
    }

    private function getServiceUrl()
    {
        return $this->context->link->getPageLink('contact', true);
    }

    private function getImageUrl()
    {
        return $this->context->link->getMediaLink(_PS_IMG_ . 'logo.jpg');
    }

    private function getAmount()
    {
        return $this->getOrder()->total_paid_real;
    }

    private function getCurrentCurrency()
    {
        $current_currency = new Currency($this->getOrder()->id_currency);
        return $current_currency->iso_code;
    }

    /**
     * return config data as needed by the client library
     *
     * @return array
     */
    public function getConfigArray()
    {
        $cfg = array('LANGUAGE' => $this->getLanguage());
        $cfg['CUSTOMER_ID'] = $this->getCustomerId();
        $cfg['SHOP_ID'] = $this->getShopId();
        $cfg['SECRET'] = $this->getSecret();

        return $cfg;
    }

    private function getLanguage()
    {
        return Language::getIsoById($this->getOrder()->id_lang);
    }

    private function getOrderDescription()
    {
        $orderDescription = 'CID: ' . $this->getOrder()->id_customer . ' OID: ' . $this->getOrder()->id;
        return $orderDescription;
    }

    private function getOrderReference()
    {
        $orderReference = str_pad($this->getOrder()->id, 10, '0', STR_PAD_LEFT);
        return $orderReference;
    }

    private function getConsumerIpAddress()
    {
        if (!method_exists('Tools', 'getRemoteAddr')) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) and $_SERVER['HTTP_X_FORWARDED_FOR']) {
                if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')) {
                    $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                    return $ips[0];
                } else {
                    return $_SERVER['HTTP_X_FORWARDED_FOR'];
                }
            }
            return $_SERVER['REMOTE_ADDR'];
        } else {
            return Tools::getRemoteAddr();
        }
    }

    private function getConsumerUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    private function getCustomerStatement()
    {
        return sprintf(
            "%s %s",
            Configuration::get('PS_SHOP_NAME'),
            $this->getOrderReference()
        );
    }

    private function getDuplicateRequestCheck()
    {
        return 'yes';
    }

    public function getWindowName()
    {
        if (Configuration::get(self::WCP_USE_IFRAME)) {
            return self::WINDOW_NAME;
        } else {
            return null;
        }
    }

    private function getConfirmUrl()
    {
        return $this->context->link->getModuleLink($this->name, 'confirm', array(), true);
    }

    private function getReturnUrl()
    {
        $params = array(
            'id_cart' => (int)$this->getCart()->id,
            'id_module' => (int)$this->id,
            'id_order' => (int)$this->getOrder()->id,
            'key' => $this->getOrder()->secure_key
        );
        if (Configuration::get(self::WCP_USE_IFRAME)) {
            return $this->context->link->getModuleLink($this->name, 'breakoutIFrame', $params, true);
        } else {
            return $this->context->link->getPageLink('order-confirmation', true, $this->getOrder()->id_lang, $params);
        }
    }

    private function getPluginVersion()
    {
        return WirecardCEE_QPay_FrontendClient::generatePluginVersion(
            'Prestashop',
            _PS_VERSION_,
            $this->name,
            $this->version
        );
    }

    public function getMinorPrestaVersion()
    {
        $version = explode('.', _PS_VERSION_);
        return $version[1];
    }
}
