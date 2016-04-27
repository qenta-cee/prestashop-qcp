{*
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
 *}

{if $paymentTypes|@count gt 0}
{foreach from=$paymentTypes item=current}
	<p class="payment_module">
		<a href="{$link->getModuleLink('wirecardceecheckoutpage', 'paymentExecution', ['paymentType' => $current.value, 'paymentName' => $current.title], true)|escape:'html'}" title="{l s='Pay with ' mod='wirecardceecheckoutpage'}{$current.title}">
			<img src="{$this_path}img/payment_types/{$current.value|lower}.png" alt="{$current.title}"/>
			{$current.title}
		</a>
	</p>
{/foreach}
{else}
	<p class="payment_module">
		<a href="{$link->getModuleLink('wirecardceecheckoutpage', 'paymentExecution', ['paymentType' => 'SELECT', 'paymentName' => {l s='Wirecard CEE Checkout Page'}], true)|escape:'html'}" title="{l s='Pay with Wirecard CEE Checkout Page' mod='wirecardceecheckoutpage'}">
			<img src="{$this_path}img/payment_types/checkoutpage.png" alt="{l s='Pay with Wirecard CEE Checkout Page' mod='wirecardceecheckoutpage'}"/>
			{l s='Pay with Wirecard CEE Checkout Page' mod='wirecardceecheckoutpage'}
		</a>
	</p>
{/if}
