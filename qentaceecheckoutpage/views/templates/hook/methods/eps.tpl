<form action="{$action|escape:'htmlall':'UTF-8'}">
    <input type="hidden" name="paymentType" value="{$method|escape:'htmlall':'UTF-8'}">
    <div class="required form-group">
        <label class="required"> {l s='Financial institution' mod='qentaceecheckoutpage'}</label>

        <select name="financialInstitution" data-wcs-fieldname="financialinstitution" class="form-control" >
            {foreach $financialInstitutions as $key => $value }
                <option value="{$key|escape:'htmlall':'UTF-8'}"{if 0} selected="selected"{/if}>{Tools::htmlentitiesDecodeUTF8($value)|escape:'htmlall':'UTF-8'}</option>
            {/foreach}
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-primary center-block" type="submit" disabled="disabled">{$submit_text|escape:'htmlall':'UTF-8'}</button>
    </div>
</form>
