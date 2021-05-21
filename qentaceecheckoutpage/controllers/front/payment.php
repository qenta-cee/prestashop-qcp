<?php
/**
 * Shop System Plugins
 * - Terms of use can be found under
 * https://guides.qenta.com/shop_plugins:info
 * - License can be found under:
 * https://github.com/qenta-cee/prestashop-qcp/blob/master/LICENSE
*/

class QentaCEECheckoutPagePaymentModuleFrontController extends ModuleFrontController
{
    public function postProcess()
    {
        $cart = $this->context->cart;

        if (
            $cart->id_customer == 0
            || $cart->id_address_delivery == 0
            || $cart->id_address_invoice == 0
            || !$this->module->active
        ) {
            Tools::redirect('index.php?controller=order&step=1');
        }

        // Check that this payment option is still available in case the customer
        // changed his address just before the end of the checkout process
        $authorized = false;
        foreach (Module::getPaymentModules() as $module) {
            if ($module['name'] == 'qentaceecheckoutpage') {
                $authorized = true;
                break;
            }
        }

        if (!$authorized) {
            die($this->module->l('This payment method is not available.', 'validation'));
        }

        $customer = new Customer($cart->id_customer);

        if (!Validate::isLoadedObject($customer)) {
            Tools::redirect('index.php?controller=order&step=1');
        }

        try {
            $additionalData = array();
            if (Tools::strlen(Tools::getValue('financialInstitution', ''))) {
                $additionalData['financialinstitution'] = Tools::getValue('financialInstitution');
            }
            $this->module->initiatePayment(Tools::getValue('paymentType'), $additionalData);
        } catch (Zend_Exception $e) {
            echo $this->module->displayError($e->getMessage());
        }
    }
}
