{*
 * Shop System Plugins - Terms of Use
 *
 * The plugins offered are provided free of charge by Qenta Payment CEE GmbH
 * (abbreviated to Qenta CEE) and are explicitly not part of the Qenta CEE range of
 * products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License Version 2 (GPLv2) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Qenta CEE does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the plugins at their own risk. Qenta CEE does not guarantee their full
 * functionality neither does Qenta CEE assume liability for any disadvantages related to
 * the use of the plugins. Additionally, Qenta CEE does not guarantee the full functionality
 * for customized shop systems or installed plugins of other vendors of plugins within the same
 * shop system.
 *
 * Customers are responsible for testing the plugin's functionality before starting productive
 * operation.
 *
 * By installing the plugin into the shop system the customer agrees to these terms of use.
 * Please do not use the plugin if you do not agree to these terms of use!
 *}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<link href="{$this_path}global.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<h3>{l s='You will be redirected in a moment.' mod='qentaceecheckoutpage'}</h3>
<p>{l s='If the redirect does not work please click' mod='qentaceecheckoutpage'} <a href="#" onclick="iframeBreakout()" >{l s='here' mod='qentaceecheckoutpage'}.</a></p>
<form method="POST" name="redirectForm" action="{$orderConfirmation}" target="_parent">
	{foreach from=$_POST key=k item=current}
		<input type="hidden" name="{$k|escape}" value="{$current|escape}" />
	{/foreach}
</form>
<script type="text/javascript">
	// <![CDATA[
	function iframeBreakout()
	{ldelim}
		document.redirectForm.submit();
		{rdelim}

	iframeBreakout();
	//]]>
</script>
</body>
</html>