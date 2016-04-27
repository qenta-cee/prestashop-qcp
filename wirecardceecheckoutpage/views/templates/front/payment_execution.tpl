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
{capture name=path}
	<a href="{$link->getPageLink('order', true, NULL, "step=3")|escape:'html':'UTF-8'}" title="{l s='Go back to checkout' mod='wirecardceecheckoutpage'}">{l s='Checkout' mod='wirecardceecheckoutpage'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='Wirecard Checkout Page' mod='wirecardceecheckoutpage'}
{/capture}

<h1 class="page-heading">{l s='Order summary' mod='wirecardceecheckoutpage'}</h1>

{assign var='current_step' value='payment'}
{include file="$tpl_dir./order-steps.tpl"}

{if isset($nbProducts) && $nbProducts <= 0}
	<p class="alert alert-warning">{l s='Your shopping cart is empty.' mod='wirecardceecheckoutpage'}</p>
{else}
	<form action="{$link->getModuleLink('wirecardceecheckoutpage', 'payment', ['paymentType' => $paymentType], true)|escape:'html':'UTF-8'}" method="post">
		<div class="box">
			<h3 class="page-subheading">{l s='Wirecard Checkout Page payment' mod='wirecardceecheckoutpage'}</h3>
			<p class="">
				<strong class="dark">
					{l s='You have chosen to pay with ' mod='wirecardceecheckoutpage'}{$paymentName}.
				</strong>
			</p>
			<p>
				- {l s='Total amount of your order:' mod='wirecardceecheckoutpage'}
				<span id="amount" class="price">{displayPrice price=$total}</span>
			</p>
			<p>- {l s='Please confirm your order by clicking "I confirm my order".' mod='wirecardceecheckoutpage'}</p>
		</div>
		<p class="cart_navigation clearfix" id="cart_navigation">
			<a href="{$link->getPageLink('order', true, NULL, "step=3")|escape:'html':'UTF-8'}" class="button-exclusive btn btn-default">
				<i class="icon-chevron-left"></i>{l s='Other payment methods' mod='wirecardceecheckoutpage'}
			</a>
			<button type="submit" class="button btn btn-default button-medium">
				<span>{l s='I confirm my order' mod='wirecardceecheckoutpage'}<i class="icon-chevron-right right"></i></span>
			</button>
		</p>
	</form>
{/if}
