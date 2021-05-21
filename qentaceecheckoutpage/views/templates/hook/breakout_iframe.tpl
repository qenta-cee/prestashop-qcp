{*
 * Shop System Plugins
 * - Terms of use can be found under
 * https://guides.qenta.com/shop_plugins:info
 * - License can be found under:
 * https://github.com/qenta-cee/prestashop-qcp/blob/master/LICENSE
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