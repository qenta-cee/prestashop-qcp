<form action="{$action}">
    <input type="hidden" name="paymentType" value="{$method|escape:'htmlall':'UTF-8'}">


    {if $show_birthdate}
        <div class="required form-group">
            <label class="required"> {l s='Date of Birth' mod='wirecardceecheckoutseamless'}</label>
            <div class="row">
                <input type="hidden" name="birthdate" id="wcs{$method|escape:'htmlall':'UTF-8'}birthdate" data-wcs-fieldname="birthdate"/>
                <div class="col-sm-2">
                    <select name="days" id="wcs{$method|escape:'htmlall':'UTF-8'}day" class="form-control days">
                        <option value="">-</option>
                        {foreach from=$days item=v}
                            <option value="{$v|escape:'htmlall':'UTF-8'}" {if ($sl_day == $v)}selected="selected"{/if}>{$v|escape:'htmlall':'UTF-8'}&nbsp;&nbsp;</option>
                        {/foreach}
                    </select>
                </div>
                <div class="col-sm-2">
                    <select name="months" id="wcs{$method|escape:'htmlall':'UTF-8'}month" class="form-control months">
                        <option value="">-</option>
                        {foreach from=$months key=k item=v}
                            <option value="{$k|escape:'htmlall':'UTF-8'}" {if ($sl_month == $k)}selected="selected"{/if}>
                                {l s=$v mod='wirecardceecheckoutseamless'}&nbsp;
                            </option>
                        {/foreach}
                    </select>
                </div>
                <div class="col-sm-3">
                    <select name="years" id="wcs{$method|escape:'htmlall':'UTF-8'}year" class="form-control years">
                        <option value="">-</option>
                        {foreach from=$years item=v}
                            <option value="{$v|escape:'htmlall':'UTF-8'}" {if ($sl_year == $v)}selected="selected"{/if}>{$v|escape:'htmlall':'UTF-8'}&nbsp;&nbsp;</option>
                        {/foreach}
                    </select>
                </div>
            </div>
        </div>
    {/if}

    {if $has_consent}
        <ul>
            <li>
                <div class="pull-xs-left">
                    <span class="custom-checkbox">
                        <input id="wcs{$method|escape:'htmlall':'UTF-8'}consent" name="consent" type="checkbox">
                        <span><i class="material-icons checkbox-checked">&#xE5CA;</i></span>
                    </span>
                </div>
                <div class="condition-label">
                    <label class="js-terms" for="wcs{$method|escape:'htmlall':'UTF-8'}consent">
                        {$consent_text nofilter}
                    </label>
                </div>
            </li>
        </ul>
    {/if}
</form>

<script type="text/javascript">
    var wcp{$method|escape:'htmlall':'UTF-8'}Validate;
    wcp{$method|escape:'htmlall':'UTF-8'}Validate = function (messageBox) {
        var m = $('#wcp{$method|escape:'htmlall':'UTF-8'}month').val();
        if (m < 10) m = "0" + m;
        var d = $('#wcp{$method|escape:'htmlall':'UTF-8'}day').val();
        if (d < 10) d = "0" + d;

        var dateStr = $('#wcp{$method|escape:'htmlall':'UTF-8'}year').val() + '-' + m + '-' + d;
        var minAge = 18;
        var msg = '';

        {if $show_birthdate}
        if (!wcpValidateMinAge(dateStr, minAge)) {
            {* escape was causing encoding issues *}
            msg = '{$min_age_message nofilter}';
            messageBox.append('<li>{$min_age_message nofilter}</li>');
        }

        $('#wcp{$method|escape:'htmlall':'UTF-8'}birthdate').val(dateStr);
        {/if}

        {if $has_consent}

        if (!$('#wcp{$method|escape:'htmlall':'UTF-8'}consent').is(':checked')) {
            msg = '{$consent_error_message|escape:'htmlall':'UTF-8'}';
            messageBox.append('<li>' + msg + '</li>');
        }
        {/if}

        if (msg.length) {
            messageBox.parent().show();
            return false;
        }

        return true;
    }
</script>