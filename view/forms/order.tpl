<div id="form-cart-send-container">
   {* {if $config.online_payment eq '1'}
        {capture name="formCart"}
            <form id="form-cart-send" action="{geturl}/{getlang}/cartpay/payment/" method="post" class="form">
        {/capture}
    {elseif $config.online_payment eq '0'}
        {capture name="formCart"}
            <form id="form-cart-devis" action="" method="post" class="form">
                <div class="mc-message"></div>
        {/capture}
    {/if}
    {$smarty.capture.formCart}*}
    {if $smarty.session.idprofil && $smarty.session.keyuniqid_pr}
        <form id="form-cart-send" action="{geturl}/{getlang}/cartpay/payment/" method="post" class="form">
            {include file="profil/forms/client-infos.tpl"}
            {include file="cartpay/forms/common.tpl"}
        </form>
    {else}
        {capture name="loginAlert"}<a class="btn btn-box btn-flat btn-main-theme" href="{geturl}/{getlang}/profil/login_redirect" title="{#connect_profil_label#|ucfirst}">{#login_alert#}</a>{/capture}
        <div class="alert alert-warning">
            {$smarty.config.login_alert_cart|sprintf:$smarty.capture.loginAlert}
        </div>
    {/if}
</div>