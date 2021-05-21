<?php
/**
 * Shop System Plugins
 * - Terms of use can be found under
 * https://guides.qenta.com/shop_plugins:info
 * - License can be found under:
 * https://github.com/qenta-cee/prestashop-qcp/blob/master/LICENSE
*/

class QentaCEECheckoutPagePaymentIFrameModuleFrontController extends ModuleFrontController
{
    public $ssl = true;
    public $display_column_left = false;

    /**
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        $this->ssl = true;
        $this->display_column_left = false;
        parent::initContent();

        $this->context->smarty->assign(array(
            'redirectUrl' => $this->context->cookie->qpayRedirectUrl,
            'windowName' => $this->module->getWindowName()
        ));

        $this->setTemplate('module:qentaceecheckoutpage/views/templates/front/payment_iframe.tpl');
        unset($this->context->cookie->qpayRedirectUrl);
    }
}
