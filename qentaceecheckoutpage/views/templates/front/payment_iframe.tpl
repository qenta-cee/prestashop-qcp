{*
 * Shop System Plugins
 * - Terms of use can be found under
 * https://guides.qenta.com/shop_plugins:info
 * - License can be found under:
 * https://github.com/qenta-cee/prestashop-qcp/blob/master/LICENSE
 *}
{extends file='page.tpl'}
{block name='content'}
	<section id="content">
		<div class="card card-block">
			<div class="row">
				<div class="col-xs-12">

					{if isset($nbProducts) && $nbProducts <= 0}
						<p class="alert alert-warning">{l s='Your shopping cart is empty.' mod='qentaceecheckoutpage'}</p>
					{else}
						<iframe width="100%" height="640px" frameborder="0" name="{$windowName}" src="{$redirectUrl}"></iframe>
					{/if}
				</div>
			</div>
		</div>
	</section>
{/block}