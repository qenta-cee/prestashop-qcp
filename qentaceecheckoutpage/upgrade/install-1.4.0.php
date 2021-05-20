<?php
/**
 * Shop System Plugins
 * - Terms of use can be found under
 * https://guides.qenta.com/shop_plugins:info
 * - License can be found under:
 * https://github.com/qenta-cee/prestashop-qcp/blob/master/LICENSE
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_1_4_0($object)
{
    Db::getInstance()->execute(
        'DELETE FROM `' . _DB_PREFIX_ . 'configuration` WHERE name="QCP_PT_C2P" OR name="QCP_PT_MPASS" OR name="QCP_PT_SKRILLDIRECT";'
    );
    Configuration::updateValue('QCP_CONFIGURATION_MODE', 'production');
    return true;
}
