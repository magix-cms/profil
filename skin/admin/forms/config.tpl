<form id="profil_config" method="post" action="" class="form-horizontal">
    <fieldset>
        <h3>
            Onglets et Modules complémentaires
        </h3>
        <div class="form-group">
            <label for="links" class="col-sm-3 control-label">{#links#}</label>
            <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <input {if $data.links eq '1'} checked{/if} type="checkbox" name="links" id="links" data-toggle="toggle" type="checkbox" data-on="oui" data-off="non" data-onstyle="primary" data-offstyle="default">
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="cartpay" class="col-sm-3 control-label">Cartpay</label>
            <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <input {if $data.cartpay eq '1'} checked{/if} type="checkbox" name="cartpay" id="cartpay" data-toggle="toggle" type="checkbox" data-on="oui" data-off="non" data-onstyle="primary" data-offstyle="default">
                    </label>
                </div>
            </div>
        </div>
        <h3>
            Google reCaptcha
        </h3>
        <div class="form-group">
            <label for="recaptcha" class="col-sm-3 control-label">{#recaptcha#}</label>
            <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <input {if $data.google_recaptcha eq '1'} checked{/if} type="checkbox" name="google_recaptcha" id="google_recaptcha" data-toggle="toggle" type="checkbox" data-on="oui" data-off="non" data-onstyle="primary" data-offstyle="default">
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="recaptchaApiKey" class="col-sm-3 control-label">{#recaptchaApiKey#|ucfirst}</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="recaptchaApiKey" name="recaptchaApiKey" value="{$data.recaptchaApiKey}" placeholder="{#recaptchaApiKey_ph#|ucfirst}">
            </div>
        </div>
        <div class="form-group">
            <label for="recaptchaSecret" class="col-sm-3 control-label">{#recaptchaSecret#|ucfirst}</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="recaptchaSecret" name="recaptchaSecret" value="{$data.recaptchaSecret}" placeholder="{#recaptchaSecret_ph#|ucfirst}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">{#save#|ucfirst}</button>
            </div>
        </div>
    </fieldset>
</form>