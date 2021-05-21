<?php
/**
 * Shop System Plugins
 * - Terms of use can be found under
 * https://guides.qenta.com/shop_plugins:info
 * - License can be found under:
 * https://github.com/qenta-cee/prestashop-qcp/blob/master/LICENSE
*/

spl_autoload_register('wirecardceecheckoutpage_autoload');

function wirecardceecheckoutpage_autoload($class)
{
    $namespaces = array('WirecardCEE', 'Wirecard', 'React');
    $namespace = null;
    $modelNamespace = 'WirecardCheckoutPage';
    $paymentNamespace = 'WirecardCheckoutPagePayment';

    foreach ($namespaces as $ns) {

        if (strncmp($ns, $class, Tools::strlen($ns)) !== 0) {
            continue;
        } else {
            $namespace = $ns;
            break;
        }
    }
    if ($namespace === null) {
        return;
    }

    if (strcmp($class, $modelNamespace) > 0) {
        $classWithUnderscore = 'Wirecard_CheckoutPage_';
        if ((strcmp($paymentNamespace, Tools::substr($class, Tools::strlen($paymentNamespace))) >= 0)
            && ((Tools::substr($class, Tools::strlen($paymentNamespace))) != '')
        ) {
            $classWithUnderscore .= 'Payment_' . Tools::substr($class, Tools::strlen($paymentNamespace));
        } else {
            $classWithUnderscore .= Tools::substr($class, Tools::strlen($modelNamespace));
        }
        $class = $classWithUnderscore;
    }

    $file = str_replace(array('\\', '_'), '/', $class) . '.php';

    require_once $file;
}