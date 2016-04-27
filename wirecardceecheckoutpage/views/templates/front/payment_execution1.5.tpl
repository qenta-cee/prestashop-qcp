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

{capture name=path}{l s='Wirecard Checkout Page' mod='wirecardceecheckoutpage'}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}

<h2>{l s='Order summary' mod='wirecardceecheckoutpage'}</h2>

{assign var='current_step' value='payment'}
{include file="$tpl_dir./order-steps.tpl"}

{if isset($nbProducts) && $nbProducts <= 0}
	<p class="warning">{l s='Your shopping cart is empty.' mod='wirecardceecheckoutpage'}</p>
{else}
	<h3>{l s='Wirecard Checkout Page payment' mod='wirecardceecheckoutpage'}</h3>
	<form action="{$link->getModuleLink('wirecardceecheckoutpage', 'payment', ['paymentType' => $paymentType], true)|escape:'html':'UTF-8'}" method="post">
		<p>
			{l s='You have chosen to pay with ' mod='wirecardceecheckoutpage'}{$paymentName}.
		</p>
		<p>
			- {l s='Total amount of your order:' mod='wirecardceecheckoutpage'}
			<span id="amount" class="price">{displayPrice price=$total}</span>
		</p>
		<p>- {l s='Please confirm your order by clicking "I confirm my order".' mod='wirecardceecheckoutpage'}</p>
		<p class="cart_navigation">
			<input type="submit" name="submit" value="{l s='I confirm my order' mod='wirecardceecheckoutpage'}" class="exclusive_large" />
			<a href="{$link->getPageLink('order', true, null, "step=3")}" class="button_large">{l s='Other payment methods' mod='wirecardceecheckoutpage'}</a>
		</p>
	</form>
{/if}