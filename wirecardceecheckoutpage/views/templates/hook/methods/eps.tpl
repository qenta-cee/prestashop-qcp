<form action="{$action}">
    <input type="hidden" name="paymentType" value="{$method|escape:'htmlall':'UTF-8'}">
    <div class="required form-group">
        <label class="required"> {l s='Financial institution' mod='wirecardceecheckoutpage'}</label>

        <select name="financialInstitution" data-wcs-fieldname="financialinstitution" class="form-control" >
            {foreach $financialInstitutions as $key => $value }
                <option value="{$key|escape:'htmlall':'UTF-8'}"{if 0} selected="selected"{/if}>{Tools::htmlentitiesDecodeUTF8($value)|escape:'htmlall':'UTF-8'}</option>
            {/foreach}
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-primary center-block" type="submit">{$submit_text|escape:'htmlall':'UTF-8'}</button>
    </div>
</form>
