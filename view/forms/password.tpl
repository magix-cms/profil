<form id="newpassword-form" method="post" action="{$smarty.server.REQUEST_URI}">
    <div class="form-group">
        <label for="cryptkeypass_pr">
            {#pn_profil_password#|ucfirst}* :
        </label>
        <input type="password" id="cryptkeypass_pr" name="cryptkeypass_pr" value="" class="form-control" placeholder="{#ph_profil_psw#|ucfirst}"/>
    </div>
    <div class="form-group">
        <label for="new_cryptkeypass_pr">
            {#pn_profil_new_password#|ucfirst}* :
        </label>
        <input type="password" id="new_cryptkeypass_pr" name="new_cryptkeypass_pr" value="" class="form-control" placeholder="{#ph_profil_new_password#|ucfirst}"/>
    </div>
    <div class="form-group">
        <label for="cryptkeypass_confirm">
            {#pn_profil_password_confirm#|ucfirst}* :
        </label>
        <input type="password" id="cryptkeypass_confirm" name="cryptkeypass_confirm" value="" class="form-control" placeholder="{#ph_profil_password_confirm#|ucfirst}"/>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-box btn-flat btn-main-theme" value="{#pn_profil_save#|ucfirst}" />
    </div>
    <div class="clearfix mc-message-pwd"></div>
</form>