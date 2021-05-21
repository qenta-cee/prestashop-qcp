<?php
/**
 * Shop System Plugins
 * - Terms of use can be found under
 * https://guides.qenta.com/shop_plugins:info
 * - License can be found under:
 * https://github.com/qenta-cee/prestashop-qcp/blob/master/LICENSE
*/

class QentaCEECheckoutPageConfirmModuleFrontController extends ModuleFrontController
{
    public $ssl = true;

    public function display()
    {
        echo $this->module->confirmResponse();
    }
}
