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

function upgrade_module_1_3_6($object)
{
    Db::getInstance()->execute(
        'UPDATE `' . _DB_PREFIX_ . 'configuration` SET name="QCP_PT_CCARD-MOTO" WHERE name="QCP_PT_CCARD_MOTO";'
    );
    Db::getInstance()->execute(
        'UPDATE `' . _DB_PREFIX_ . 'configuration` SET name="QCP_PT_SEPA-DD" WHERE name="QCP_PT_SEPA_DD";'
    );
    return true;
}
