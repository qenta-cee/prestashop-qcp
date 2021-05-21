{**
 * Shop System Plugins
 * - Terms of use can be found under
 * https://guides.qenta.com/shop_plugins:info
 * - License can be found under:
 * https://github.com/qenta-cee/prestashop-qcp/blob/master/LICENSE
*}

{if $status == 'ok'}
	<p>{l s='Thank you for your order.' mod='qentaceecheckoutpage'}
		<br /><br />
		<strong>{l s='Your order will soon be shipped.' mod='qentaceecheckoutpage'}</strong>
		<br /><br />
		{l s='For any questions or further information contact our' mod='qentaceecheckoutpage'} <a href="{$link->getPageLink('contact', true)|escape:'html'}">{l s='customer support' mod='qentaceecheckoutpage'}</a>.
	</p>
{else}
	<p class="warning">
		{l s='We have noticed that there is a problem with your order. If you think this is an error, you can contact our' mod='qentaceecheckoutpage'}
		<a href="{$link->getPageLink('contact', true)|escape:'html'}">{l s='customer support' mod='qentaceecheckoutpage'}</a>.
	</p>
{/if}
