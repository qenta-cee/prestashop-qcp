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

ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'library');

require('Wirecard/CEE/QPay/PaymentType.php');

class WirecardCEECheckoutPage extends PaymentModule
{
    const WCP_CONFIGURATION_MODE_DEFAULT = 'production';
    const WCP_CUSTOMER_ID_DEMO = 'D200001';
    const WCP_SHOP_ID_DEMO = '';
    const WCP_SECRET_DEMO = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';
    const WCP_CUSTOMER_ID_TEST = 'D200411';
    const WCP_SHOP_ID_TEST = '';
    const WCP_SECRET_TEST = 'CHCSH7UGHVVX2P7EHDHSY4T2S4CGYK4QBE4M5YUUG2ND5BEZWNRZW5EJYVJQ';
    const WCP_CUSTOMER_ID_TEST3D = 'D200411';
    const WCP_SHOP_ID_TEST3D = '3D';
    const WCP_SECRET_TEST3D = 'DP4TMTPQQWFJW34647RM798E9A5X7E8ATP462Z4VGZK53YEJ3JWXS98B9P4F';
    const WCP_DISPLAY_TEXT_DEFAULT = '';
    const WCP_MAX_RETRIES_DEFAULT = '-1';
    const WCP_TRANSACTION_ID_DEFAULT = 'orderNumber';
    const WCP_AUTO_DEPOSIT_DEFAULT = 0;
    const WCP_SEND_ADDITIONAL_DATA_DEFAULT = 1;
    const WCP_USE_IFRAME_DEFAULT = 1;
    const WCP_PT_DEFAULT = 0;
    const WCP_AMOUNT_DEFAULT = '';
    const WINDOW_NAME = 'Checkout_Page_Frame';
    
    const WCP_CONFIGURATION_MODE = 'WCP_CONFIGURATION_MODE';
    const WCP_CUSTOMER_ID = 'WCP_CUSTOMER_ID';
    const WCP_SHOP_ID = 'WCP_SHOP_ID';
    const WCP_SECRET = 'WCP_SECRET';
    const WCP_DISPLAY_TEXT = 'WCP_DISPLAY_TEXT';
    const WCP_MAX_RETRIES = 'WCP_MAX_RETRIES';
    const WCP_INVOICE_MIN = 'WCP_INVOICE_MIN';
    const WCP_INVOICE_MAX = 'WCP_INVOICE_MAX';
    const WCP_INSTALLMENT_MIN = 'WCP_INSTALLMENT_MIN';
    const WCP_INSTALLMENT_MAX = 'WCP_INSTALLMENT_MAX';
    const WCP_TRANSACTION_ID = 'WCP_TRANSACTION_ID';
    const WCP_AUTO_DEPOSIT = 'WCP_AUTO_DEPOSIT';
    const WCP_SEND_ADDITIONAL_DATA = 'WCP_SEND_ADDITIONAL_DATA';
    const WCP_USE_IFRAME = 'WCP_USE_IFRAME';
    const WCP_OS_AWAITING = 'WCP_OS_AWAITING';

    const WCP_PT_CCARD = 'WCP_PT_CCARD';
    const WCP_PT_CCARD_MOTO = 'WCP_PT_CCARD-MOTO';
    const WCP_PT_MAESTRO = 'WCP_PT_MAESTRO';
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
        file_put_contents(
            _PS_ROOT_DIR_ . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . 'WirecardCheckoutPage.log',
            $text . "\r\n",
            FILE_APPEND | LOCK_EX
        );
    }

    public function __construct()
    {
        $this->config = $this->config();
        $this->name = 'wirecardceecheckoutpage';
        $this->tab = 'payments_gateways';
        $this->version = '2.0.0';
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
            || !Configuration::updateValue(self::WCP_CONFIGURATION_MODE, self::WCP_CONFIGURATION_MODE_DEFAULT)
            || !Configuration::updateValue(self::WCP_CUSTOMER_ID, self::WCP_CUSTOMER_ID_DEMO)
            || !Configuration::updateValue(self::WCP_SHOP_ID, self::WCP_SHOP_ID_DEMO)
            || !Configuration::updateValue(self::WCP_SECRET, self::WCP_SECRET_DEMO)
            || !Configuration::updateValue(self::WCP_DISPLAY_TEXT, self::WCP_DISPLAY_TEXT_DEFAULT)
            || !Configuration::updateValue(self::WCP_MAX_RETRIES, self::WCP_MAX_RETRIES_DEFAULT)
            || !Configuration::updateValue(self::WCP_INVOICE_MIN, self::WCP_AMOUNT_DEFAULT)
            || !Configuration::updateValue(self::WCP_INVOICE_MAX, self::WCP_AMOUNT_DEFAULT)
            || !Configuration::updateValue(self::WCP_INSTALLMENT_MIN, self::WCP_AMOUNT_DEFAULT)
            || !Configuration::updateValue(self::WCP_INSTALLMENT_MAX, self::WCP_AMOUNT_DEFAULT)
            || !Configuration::updateValue(self::WCP_TRANSACTION_ID, self::WCP_TRANSACTION_ID_DEFAULT)
            || !Configuration::updateValue(self::WCP_AUTO_DEPOSIT, self::WCP_AUTO_DEPOSIT_DEFAULT)
            || !Configuration::updateValue(self::WCP_SEND_ADDITIONAL_DATA, self::WCP_SEND_ADDITIONAL_DATA_DEFAULT)
            || !Configuration::updateValue(self::WCP_USE_IFRAME, self::WCP_USE_IFRAME_DEFAULT)
            || !$this->installPaymentTypes()
        ) {
            return false;
        }

        // http://forge.prestashop.com/browse/PSCFV-1712
        if ($this->registerHook('displayPDFInvoice') === false) {
            return false;
        }

        if (!Configuration::get(self::WCP_OS_AWAITING)) {
            $orderState = new OrderState();
            $orderState->name = array();
            foreach (Language::getLanguages() as $language) {
                if (strtolower($language['iso_code']) == 'de') {
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
                    dirname(__FILE__) . '/img/awaiting_payment.gif',
                    dirname(__FILE__) . '/../../img/os/' . (int)($orderState->id) . '.gif'
                );
            }
            Configuration::updateValue(self::WCP_OS_AWAITING, (int)($orderState->id));
        }
        return true;
    }

    public function hookActionFrontControllerSetMedia($params){

        $controllerArray = array('order');
        if (in_array($this->context->controller->php_self, $controllerArray)) {
            $this->context->controller->registerStylesheet(
                'module-' . $this->name . '-style',
                'modules/' . $this->name . '/css/style.css',
                [
                    'media' => 'all',
                    'priority' => 200,
                ]
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
            Configuration::deleteByName($parameter);
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
                if ($parameter == self::WCP_OS_AWAITING) {
                    continue;
                }
                Configuration::updateValue($parameter, Tools::getValue($parameter));
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
                        'desc' => $this->l('Shop identifier in case of more than one shop.').' <a target="_blank" href="https://guides.wirecard.at/request_parameters#shopid">'.$this->l('More information').' <i class="icon-external-link"></i></a>'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Secret'),
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
                        'required' => true,
                        'desc' => $this->l('Text displayed during the payment process, i.e. "Thank you for ordering in xy-shop".').' <a target="_blank" href="https://guides.wirecard.at/request_parameters#displaytext">'.$this->l('More information').' <i class="icon-external-link"></i></a>'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Max. retries'),
                        'name' => self::WCP_MAX_RETRIES,
                        'class' => 'fixed-width-xs',
                        'required' => true,
                        'desc' => $this->l('Maximum number of payment attempts regarding a certain order.').' <a target="_blank" href="https://guides.wirecard.at/request_parameters#maxretries">'.$this->l('More information').' <i class="icon-external-link"></i></a>'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Invoice minimum amount'),
                        'name' => self::WCP_INVOICE_MIN,
                        'class' => 'fixed-width-md',
                        'suffix' => 'EUR'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Invoice maximum amount'),
                        'name' => self::WCP_INVOICE_MAX,
                        'class' => 'fixed-width-md',
                        'suffix' => 'EUR'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Installment minimum amount'),
                        'name' => self::WCP_INSTALLMENT_MIN,
                        'class' => 'fixed-width-md',
                        'suffix' => 'EUR'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Installment maximum amount'),
                        'name' => self::WCP_INSTALLMENT_MAX,
                        'class' => 'fixed-width-md',
                        'suffix' => 'EUR'
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Transaction ID'),
                        'name' => self::WCP_TRANSACTION_ID,
                        'options' => 'getTransactionIdOptions',
                        'desc' => $this->l('Wirecard order number: Unique number defined by Wirecard identifying the payment.') . '<br>' . $this->l('Gateway reference number: Reference number defined by the processor or acquirer.')
                    ),
                    array(
                        'type' => $radio_type,
                        'label' => $this->l('Automated deposit'),
                        'name' => self::WCP_AUTO_DEPOSIT,
                        'is_bool' => true,
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
                        'values' => $radio_options,
                        'desc' => $this->l('Forwarding shipping and billing data about your consumer to the respective financial service provider.')
                    ),
                    array(
                        'type' => $radio_type,
                        'label' => $this->l('Display as iframe'),
                        'name' => self::WCP_USE_IFRAME,
                        'is_bool' => true,
                        'class' => 't',
                        'values' => $radio_options
                    )
                )
            ),
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

        $fields_form_payment = array(
            'paymentmethods' => array(
                'tab' => $this->l('Payment methods'),
                'fields' => $paymentTypeSwitches
            ),
        );

        $settings = array_merge($fields_form_settings,$fields_form_payment);

        return $settings;
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
                $configGroup = isset($f['group']) ? $f['group'] : $groupKey;
                if (isset($f['class'])) {
                    $configGroup = 'pt';
                }

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
                                $options = $this->$optfunc();
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
            $values[$parameter] = Tools::getValue($parameter, Configuration::get($parameter));
        }
        return $values;
    }

    public function hookPaymentOptions($params)
    {
        if (!$this->active) {
            return;
        }

        $result = array();

        unset($this->context->cookie->qpayRedirectUrl);
        $paymentTypes = $this->getEnabledPaymentTypes($params['cart']);

        foreach ($paymentTypes as $paymentType) {
            $payment = new PaymentOption();
            $payment->setLogo(Media::getMediaPath(dirname(__FILE__) . '/img/payment_types/' . strtolower($paymentType['value']) . '.png'))
                ->setCallToActionText($this->l('Pay using') . ' ' . $this->l($paymentType['title']))
                ->setAction($this->context->link->getModuleLink($this->name, 'payment', array('paymentType' => $paymentType['value']), true));

            $result[] = $payment;
        }

        return count($result) ? $result : false;
    }

    public function hookDisplayPaymentReturn($params)
    {
        if (!$this->active) {
            return;
        }

        require('Wirecard/CEE/QPay/Response.php');

        $this->setOrder((int)Tools::getValue('psOrderNumber'));
        unset($this->context->cookie->qpayRedirectUrl);

        $info = $this->getPaymentTypeInfo('WCP_PT_' . Tools::getValue('paymentType'));
        if ($this->getOrder()->hasBeenPaid() || Tools::getValue('paymentState') == Wirecard_CEE_QPay_Response::STATE_SUCCESS) {
            $this->smarty->assign(array(
                'status' => 'ok'
            ));
            return $this->display(__FILE__, 'payment_return.tpl');
        }

        if (Tools::getValue('paymentState') == Wirecard_CEE_QPay_Response::STATE_PENDING) {
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

    public function initiatePayment($paymentType)
    {
        require('Wirecard/CEE/QPay/Exception.php');

        if (!$this->context->cookie->qpayRedirectUrl) {
            if (!$this->context->cookie->id_cart) {
                throw new Wirecard_CEE_QPay_Exception($this->l('Unable to load cart.'));
            }
            if (!$this->isPaymentTypeEnabled($paymentType)) {
                throw new Wirecard_CEE_QPay_Exception($this->l('Payment method not enabled.'));
            }
            $this->setCart($this->context->cookie->id_cart);

            try {
                $redirectUrl = $this->initiate($paymentType);
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

        if ($this->getUseIFrame()) {
            Tools::redirect($this->context->link->getModuleLink($this->name, 'paymentIFrame'));
        } else {
            Tools::redirect($redirectUrl);
        }
    }

    private function initiate($paymentType)
    {
        require('Wirecard/CEE/QPay/Initiation.php');

        $customer = new Customer($this->getOrder()->id_customer);

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
        $language = $this->getLanguage();
        $pluginVersion = $this->getPluginVersion();

        $request = new Wirecard_CEE_QPay_Initiation(
            $this->getCustomerId(),
            $this->getSecret(),
            $amount,
            $this->getCurrentCurrency(),
            $paymentType,
            $language,
            $this->getOrderDescription(),
            $this->getReturnUrl(),
            $this->getReturnUrl(),
            $this->getReturnUrl(),
            $this->getServiceUrl(),
            $this->getConsumerUserAgent(),
            $this->getConsumerIpAddress()
        );

        $request->setShopId($this->getShopId())
            ->setConfirmUrl($this->getConfirmUrl())
            ->setPendingUrl($this->getReturnUrl())
            ->setDisplayText($this->getDisplayText())
            ->setCustomerStatement($this->getCustomerStatement())
            ->setOrderReference($this->getOrderReference())
            ->setDuplicateRequestCheck($this->getDuplicateRequestCheck())
            ->setImageUrl($this->getImageUrl())
            ->setMaxRetries($this->getMaxRetries())
            ->setAutoDeposit($this->getAutoDeposit())
            ->setWindowName($this->getWindowName())
            ->createConsumerMerchantCrmId($customer->email)
            ->setPluginVersion(
                $pluginVersion['shopName'],
                $pluginVersion['shopVersion'],
                $pluginVersion['pluginName'],
                $pluginVersion['pluginVersion'],
                array()
            );
        //additionally parameters can be added easily because of the magic method __set
        $request->psOrderNumber = $this->getOrder()->id;

        if ($this->getSendAdditionalData()
            || $paymentType == Wirecard_CEE_QPay_PaymentType::INVOICE
            || $paymentType == Wirecard_CEE_QPay_PaymentType::INSTALLMENT
        ) {
            $request = $this->setConsumerInformation($request);
        }

        return $request->initiate();
    }

    private function setConsumerInformation(Wirecard_CEE_QPay_Initiation $request)
    {
        require('Wirecard/CEE/QPay/Address.php');

        $psBillingAddress = new Address($this->getOrder()->id_address_invoice);
        $psShippingAddress = new Address($this->getOrder()->id_address_delivery);

        $billingAddress = new Wirecard_CEE_QPay_Address(Wirecard_CEE_QPay_Address::TYPE_BILLING);
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

        $shippingAddress = new Wirecard_CEE_QPay_Address(Wirecard_CEE_QPay_Address::TYPE_SHIPPING);
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

        $consumerData = new Wirecard_CEE_QPay_ConsumerData();
        $consumerData->addAddressInformation($billingAddress)
            ->addAddressInformation($shippingAddress);

        $customer = new Customer($this->getOrder()->id_customer);
        $consumerData->setBirthDate($customer->birthday)
            ->setEmail($customer->email);

        $request->addConsumerData($consumerData);

        return $request;
    }

    public function confirmResponse()
    {
        if (!$this->active) {
            return Wirecard_CEE_QPay_Response::generateConfirmResponse($this->l("Module is not active!"));
        }

        require('Wirecard/CEE/QPay/Response.php');
        
        $response = $_POST ? $_POST : array();
        $this->log(__METHOD__ . ':' . print_r($response, true));

        $secret = $this->getSecret();
        try {
            $responseHandler = new Wirecard_CEE_QPay_Response($response, $secret);
            $status = $responseHandler->validateResponse();

            switch ($status) {
                case Wirecard_CEE_QPay_Response::STATE_SUCCESS:
                    $orderState = _PS_OS_PAYMENT_;
                    //create message with returned Parameters.
                    $this->saveReturnedFields($response);
                    $this->updatePaymentInformation($response['psOrderNumber'], $response['paymentType'], $response[$this->getTransactionId()]);
                    break;
                case Wirecard_CEE_QPay_Response::STATE_CANCEL:
                    $orderState = _PS_OS_CANCELED_;
                    break;
                case Wirecard_CEE_QPay_Response::STATE_FAILURE:
                    $this->saveReturnedFields($response);
                    $orderState = _PS_OS_ERROR_;
                    break;
                case Wirecard_CEE_QPay_Response::STATE_PENDING:
                    $this->saveReturnedFields($response);
                    $orderState = $this->getAwaitingState();
                    break;
                default:
                    return Wirecard_CEE_QPay_Response::generateConfirmResponse('Invalid uncaught paymentState. Should not happen.');
            }

            $this->setOrder($response['psOrderNumber']);
            $this->setOrderState($orderState);
        } catch (Wirecard_CEE_QPay_Exception $e) {
            $this->log(__METHOD__ . ':' . $e->getMessage());
            if (isset($response['psOrderNumber'])) {
                $this->setOrder($response['psOrderNumber']);
                $this->setOrderState(_PS_OS_ERROR_);
            }
            return Wirecard_CEE_QPay_Response::generateConfirmResponse($e->getMessage());
        }
        return Wirecard_CEE_QPay_Response::generateConfirmResponse();
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

        require('Wirecard/CEE/QPay/Exception.php');
        $this->smarty->assign('_POST', $_POST);
        if (!Tools::getIsset('id_cart') || !Tools::getIsset('id_module') || !Tools::getIsset('id_order')) {
            throw new Wirecard_CEE_QPay_Exception('Invalid Request. orderId, moduleId, cartId or secureKey not set');
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

    private function saveReturnedFields($response)
    {
        $msg = new Message();
        $message = '';
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
        if ($paymentType == Wirecard_CEE_QPay_PaymentType::SELECT) {
            return true;
        } else {
            return Configuration::get('WCP_PT_' . $paymentType);
        }
    }

    private function getAllConfigurationParameter()
    {
        return array_merge(array(self::WCP_CONFIGURATION_MODE, self::WCP_CUSTOMER_ID, self::WCP_SHOP_ID,
            self::WCP_SECRET, self::WCP_DISPLAY_TEXT, self::WCP_MAX_RETRIES, self::WCP_INVOICE_MIN,
            self::WCP_INVOICE_MAX, self::WCP_INSTALLMENT_MIN, self::WCP_INSTALLMENT_MAX, self::WCP_TRANSACTION_ID,
            self::WCP_AUTO_DEPOSIT, self::WCP_SEND_ADDITIONAL_DATA, self::WCP_USE_IFRAME, self::WCP_OS_AWAITING),
            $this->getPaymentTypes());
    }

    private function getPaymentTypes()
    {
        return array(self::WCP_PT_CCARD, self::WCP_PT_CCARD_MOTO, self::WCP_PT_MAESTRO, self::WCP_PT_EPS,
            self::WCP_PT_IDL, self::WCP_PT_GIROPAY, self::WCP_PT_TATRAPAY, self::WCP_PT_SOFORTUEBERWEISUNG,
            self::WCP_PT_PBX, self::WCP_PT_QUICK, self::WCP_PT_PAYPAL, self::WCP_PT_EPAY_BG, self::WCP_PT_SEPA_DD,
            self::WCP_PT_TRUSTPAY, self::WCP_PT_INVOICE, self::WCP_PT_INSTALLMENT, self::WCP_PT_BANCONTACT_MISTERCASH,
            self::WCP_PT_P24, self::WCP_PT_MONETA, self::WCP_PT_POLI, self::WCP_PT_EKONTO, self::WCP_PT_TRUSTLY,
            self::WCP_PT_SKRILLWALLET, self::WCP_PT_VOUCHER);
    }

    private function getPaymentTypeInfo($type)
    {
        switch ($type) {
            case self::WCP_PT_CCARD:
                return array('title' => $this->l('Credit Card'),
                    'value' => Wirecard_CEE_QPay_PaymentType::CCARD);
            case self::WCP_PT_CCARD_MOTO:
                return array('title' => $this->l('Credit Card - Mail Order and Telephone Order'),
                    'value' => Wirecard_CEE_QPay_PaymentType::CCARD_MOTO);
            case self::WCP_PT_MAESTRO:
                return array('title' => $this->l('MasterCard SecureCode'),
                    'value' => Wirecard_CEE_QPay_PaymentType::MAESTRO);
            case self::WCP_PT_EPS:
                return array('title' => $this->l('eps Online-Überweisung'),
                    'value' => Wirecard_CEE_QPay_PaymentType::EPS);
            case self::WCP_PT_IDL:
                return array('title' => $this->l('iDEAL'),
                    'value' => Wirecard_CEE_QPay_PaymentType::IDL);
            case self::WCP_PT_GIROPAY:
                return array('title' => $this->l('giropay'),
                    'value' => Wirecard_CEE_QPay_PaymentType::GIROPAY);
            case self::WCP_PT_TATRAPAY:
                return array('title' => $this->l('TatraPay'),
                    'value' => Wirecard_CEE_QPay_PaymentType::TATRAPAY);
            case self::WCP_PT_SOFORTUEBERWEISUNG:
                return array('title' => $this->l('SOFORT Banking'),
                    'value' => Wirecard_CEE_QPay_PaymentType::SOFORTUEBERWEISUNG);
            case self::WCP_PT_PBX:
                return array('title' => $this->l('paybox'),
                    'value' => Wirecard_CEE_QPay_PaymentType::PBX);
            case self::WCP_PT_PSC:
                return array('title' => $this->l('paysafecard'),
                    'value' => Wirecard_CEE_QPay_PaymentType::PSC);
            case self::WCP_PT_QUICK:
                return array('title' => $this->l('@Quick'),
                    'value' => Wirecard_CEE_QPay_PaymentType::QUICK);
            case self::WCP_PT_PAYPAL:
                return array('title' => $this->l('PayPal'),
                    'value' => Wirecard_CEE_QPay_PaymentType::PAYPAL);
            case self::WCP_PT_EPAY_BG:
                return array('title' => $this->l('ePay.bg'),
                    'value' => Wirecard_CEE_QPay_PaymentType::EPAY_BG);
            case self::WCP_PT_SEPA_DD:
                return array('title' => $this->l('SEPA Direct Debit'),
                    'value' => Wirecard_CEE_QPay_PaymentType::SEPA_DD);
            case self::WCP_PT_TRUSTPAY:
                return array('title' => $this->l('TrustPay'),
                    'value' => Wirecard_CEE_QPay_PaymentType::TRUSTPAY);
            case self::WCP_PT_INVOICE:
                return array('title' => $this->l('Invoice'),
                    'value' => Wirecard_CEE_QPay_PaymentType::INVOICE);
            case self::WCP_PT_INSTALLMENT:
                return array('title' => $this->l('Installment'),
                    'value' => Wirecard_CEE_QPay_PaymentType::INSTALLMENT);
            case self::WCP_PT_BANCONTACT_MISTERCASH:
                return array('title' => $this->l('Bancontact'),
                    'value' => Wirecard_CEE_QPay_PaymentType::BANCONTACT_MISTERCASH);
            case self::WCP_PT_P24:
                return array('title' => $this->l('Przelewy24'),
                    'value' => Wirecard_CEE_QPay_PaymentType::P24);
            case self::WCP_PT_MONETA:
                return array('title' => $this->l('moneta.ru'),
                    'value' => Wirecard_CEE_QPay_PaymentType::MONETA);
            case self::WCP_PT_POLI:
                return array('title' => $this->l('POLi'),
                    'value' => Wirecard_CEE_QPay_PaymentType::POLI);
            case self::WCP_PT_EKONTO:
                return array('title' => $this->l('eKonto'),
                    'value' => Wirecard_CEE_QPay_PaymentType::EKONTO);
            case self::WCP_PT_TRUSTLY:
                return array('title' => $this->l('Trustly'),
                    'value' => Wirecard_CEE_QPay_PaymentType::TRUSTLY);
            case self::WCP_PT_SKRILLWALLET:
                return array('title' => $this->l('Skrill Digital Wallet'),
                    'value' => Wirecard_CEE_QPay_PaymentType::SKRILLWALLET);
            case self::WCP_PT_VOUCHER:
                return array('title' => $this->l('My Voucher'),
                    'value' => Wirecard_CEE_QPay_PaymentType::VOUCHER);
            default:
                return array('title' => $this->l('The consumer may select one of the activated payment methods directly in Wirecard Checkout Page.'),
                    'value' => Wirecard_CEE_QPay_PaymentType::SELECT);
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
        $this->myCart = new Cart(intval($cart_id));
    }

    private function setOrder($order_id)
    {
        $this->myOrder = new Order($order_id);
    }

    private function getOrder()
    {
        return $this->myOrder;
    }

    private function isInvoiceAllowed(Cart $cart)
    {
        $currency = new Currency($cart->id_currency);
        if ($currency->iso_code != 'EUR') {
            return false;
        }

        $customer = new Customer($cart->id_customer);
        $billingAddress = new Address($cart->id_address_invoice);
        $shippingAddress = new Address($cart->id_address_delivery);

        $d1 = new DateTime($customer->birthday);
        $diff = $d1->diff(new DateTime);
        $customerAge = $diff->format('%y');

        $total = $cart->getOrderTotal();

        if ($billingAddress->id != $shippingAddress->id) {
            $fields = array('country', 'company', 'firstname', 'lastname', 'address1', 'address2', 'postcode', 'city');
            foreach ($fields as $f) {
                if ($billingAddress->$f != $shippingAddress->$f) {
                    return false;
                }
            }
        }

        if ($customerAge < Wirecard_CEE_QPay_PaymentType::INVOICE_INSTALLMENT_MIN_AGE) {
            return false;
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
        $currency = new Currency($cart->id_currency);
        if ($currency->iso_code != 'EUR') {
            return false;
        }

        $customer = new Customer($cart->id_customer);

        $billingAddress = new Address($cart->id_address_invoice);
        $shippingAddress = new Address($cart->id_address_delivery);

        $d1 = new DateTime($customer->birthday);
        $diff = $d1->diff(new DateTime());
        $customerAge = $diff->format('%y');

        $total = $cart->getOrderTotal();

        if ($billingAddress->id != $shippingAddress->id) {
            $fields = array('country', 'company', 'firstname', 'lastname', 'address1', 'address2', 'postcode', 'city');
            foreach ($fields as $f) {
                if ($billingAddress->$f != $shippingAddress->$f) {
                    return false;
                }
            }
        }

        if ($customerAge < Wirecard_CEE_QPay_PaymentType::INVOICE_INSTALLMENT_MIN_AGE) {
            return false;
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

    private function getMaxRetries()
    {
        return Configuration::get(self::WCP_MAX_RETRIES);
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

    private function getUseIFrame()
    {
        return Configuration::get(self::WCP_USE_IFRAME);
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
        $orderNumber = sprintf(' #%06s', $this->getOrder()->id);
        return Configuration::get('PS_SHOP_NAME') . $orderNumber;
    }

    private function getDuplicateRequestCheck()
    {
        return 'yes';
    }

    public function getWindowName()
    {
        if ($this->getUseIFrame()) {
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
        if ($this->getUseIFrame()) {
            return $this->context->link->getModuleLink($this->name, 'breakoutIFrame', $params, true);
        } else {
            return $this->context->link->getPageLink('order-confirmation', true, $this->getOrder()->id_lang, $params);
        }
    }

    private function getPluginVersion()
    {
        $pluginVersion = array(
            'shopName' => 'Presta Store',
            'shopVersion' => _PS_VERSION_,
            'pluginName' => $this->name,
            'pluginVersion' => $this->version
        );
        return $pluginVersion;
    }

    public function getMinorPrestaVersion()
    {
        $version = explode('.', _PS_VERSION_);
        return $version[1];
    }
}
