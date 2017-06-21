<form action="{$action}" onsubmit="return wcp{$method|escape:'htmlall':'UTF-8'}Validate()">
    <input type="hidden" name="paymentType" value="{$method|escape:'htmlall':'UTF-8'}">


    {if $show_birthdate}
        <div class="required form-group">
            <label class="required"> {l s='Date of Birth' mod='wirecardceecheckoutseamless'}</label>
            <div class="row">
                <input type="hidden" name="birthdate" id="wcp{$method|escape:'htmlall':'UTF-8'}birthdate" data-wcp-fieldname="birthdate"/>
                <div class="col-sm-2">
                    <select name="days" id="wcp{$method|escape:'htmlall':'UTF-8'}day" class="form-control days">
                        <option value="">-</option>
                        {foreach from=$days item=v}
                            <option value="{$v|escape:'htmlall':'UTF-8'}" {if ($sl_day == $v)}selected="selected"{/if}>{$v|escape:'htmlall':'UTF-8'}&nbsp;&nbsp;</option>
                        {/foreach}
                    </select>
                </div>
                <div class="col-sm-2">
                    <select name="months" id="wcp{$method|escape:'htmlall':'UTF-8'}month" class="form-control months">
                        <option value="">-</option>
                        {foreach from=$months key=k item=v}
                            <option value="{$k|escape:'htmlall':'UTF-8'}" {if ($sl_month == $k)}selected="selected"{/if}>
                                {l s=$v mod='wirecardceecheckoutseamless'}&nbsp;
                            </option>
                        {/foreach}
                    </select>
                </div>
                <div class="col-sm-3">
                    <select name="years" id="wcp{$method|escape:'htmlall':'UTF-8'}year" class="form-control years">
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
                        <input id="wcp{$method|escape:'htmlall':'UTF-8'}consent" name="consent" type="checkbox">
                        <span><i class="material-icons checkbox-checked">&#xE5CA;</i></span>
                    </span>
                </div>
                <div class="condition-label">
                    <label class="js-terms" for="wcp{$method|escape:'htmlall':'UTF-8'}consent">
                        {$consent_text nofilter}
                    </label>
                </div>
            </li>
        </ul>
    {/if}
    <div class="form-group" style="display: none">
        <div class="alert alert-danger" role="alert">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary center-block" type="submit" disabled="disabled">{$submit_text|escape:'htmlall':'UTF-8'}</button>
    </div>
</form>

<script type="text/javascript">
    var wcp{$method|escape:'htmlall':'UTF-8'}Validate;
    wcp{$method|escape:'htmlall':'UTF-8'}Validate = function () {
        messageBox = $('div.alert.alert-danger');
        messageBox.html("").parent().hide();

        var m = $('#wcp{$method|escape:'htmlall':'UTF-8'}month').val();
        if (m < 10) m = "0" + m;
        var d = $('#wcp{$method|escape:'htmlall':'UTF-8'}day').val();
        if (d < 10) d = "0" + d;

        var dateStr = $('#wcp{$method|escape:'htmlall':'UTF-8'}year').val() + '-' + m + '-' + d;
        var minAge = 18;
        var msg = '';

        {if $show_birthdate}
        if (!wcpValidateMinAge(dateStr)) {
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