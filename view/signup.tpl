{extends file="layout.tpl"}
{block name="title"}{seo_rewrite config_param=['level'=>'0','idmetas'=>'1','default'=>{$smarty.config.seo_t_static_signup|sprintf:$companyData.name}]}{/block}
{block name="description"}{seo_rewrite config_param=['level'=>'0','idmetas'=>'2','default'=>{$smarty.config.seo_d_static_signup|sprintf:$companyData.name}]}{/block}
{block name="recaptcha"}<script src='https://www.google.com/recaptcha/api.js'></script>{/block}
{block name='body:id'}profil-signup{/block}
{block name="main"}
    <main id="content">
        {block name="article:before"}{/block}
        {block name='article'}
            <article id="article" class="container">
                {block name='article:content'}
                <h1>{#signup_root_h1#|ucfirst}</h1>
                <div class="content-box">
                    <div class="clearfix mc-message"></div>
                    <div class="row">
                        <form id="signup-form" method="post" action="{geturl}/{getlang}/profil/signup/">
                            <div class="col-sm-6">
                                {if $pseudo_required}
                                <div class="row">
                                    <div class="form-group col-sm-8">
                                        <label class="sr-only" for="pseudo_pr">{#pn_profil_pseudo#|ucfirst}*&nbsp;:</label>
                                        <input type="text" class="form-control" id="pseudo_pr" name="pseudo_pr" placeholder="{#ph_profil_pseudo#|ucfirst}">
                                    </div>
                                </div>
                                {/if}
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="sr-only" for="firstname_pr">{#pn_profil_firstname#|ucfirst}*&nbsp;:</label>
                                        <input type="text" class="form-control" id="firstname_pr" name="firstname_pr" placeholder="{#ph_profil_firstname#|ucfirst}">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="sr-only" for="lastname_pr">{#pn_profil_lastname#|ucfirst}*&nbsp;:</label>
                                        <input type="text" class="form-control" id="lastname_pr" name="lastname_pr" placeholder="{#ph_profil_lastname#|ucfirst}">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label class="sr-only" for="email_pr">{#pn_profil_mail#|ucfirst}*&nbsp;:</label>
                                        <input type="email" class="form-control" id="email_pr" name="email_pr" placeholder="{#ph_profil_mail#|ucfirst}">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="sr-only" for="cryptkeypass_pr">{#pn_profil_password#|ucfirst}*&nbsp;:</label>
                                        <input type="password" class="form-control" id="cryptkeypass_pr" name="cryptkeypass_pr" placeholder="{#ph_profil_psw#|ucfirst}">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="sr-only" for="cryptkeypass_confirm">{#pn_profil_password_confirm#|ucfirst}*&nbsp;:</label>
                                        <input type="password" class="form-control" id="cryptkeypass_confirm" name="cryptkeypass_confirm" placeholder="{#ph_psw_conf#|ucfirst}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                {if isset($newsletter) && $newsletter}
                                <div class="checkbox">
                                    <label for="signup_newsletter">
                                        <input type="checkbox" name="signup_newsletter" id="signup_newsletter"> {$smarty.config.pn_profil_signup_news|sprintf:$companyData.name|ucfirst}
                                    </label>
                                </div>
                                {/if}
                                {capture name="cond_gen"}
                                    <a class="targetblank" href="{geturl}{#cond_gen_uri#}" title="{#cond_gen#}">{#cond_gen#}</a>
                                {/capture}
                                {capture name="private_laws"}
                                    <a class="targetblank" href="{geturl}{#private_laws_uri#}" title="{#private_laws#}">{#private_laws#}</a>
                                {/capture}
                                <div class="checkbox">
                                    <label for="cond_gen">
                                        <input type="checkbox" name="cond_gen" id="cond_gen"> {#pn_profil_cond_gen#|ucfirst|sprintf:$smarty.capture.cond_gen:$smarty.capture.private_laws}*
                                    </label>
                                </div>
                                {if $googleRecaptcha.google_recaptcha eq '1'}
                                <div class="g-recaptcha" data-sitekey="{$googleRecaptcha.recaptchaApiKey}"></div>
                                <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
                                <script type="text/javascript"
                                        src="https://www.google.com/recaptcha/api.js?hl={getlang}">
                                </script>
                                {/if}
                                <input type="submit" class="btn btn-box btn-flat btn-main-theme" value="{#pn_profil_signup#|ucfirst}" />
                            </div>
                        </form>
                    </div>
                </div>
                {/block}
            </article>
        {/block}

        {block name="article:after"}{/block}
    </main>
{/block}

{block name="foot" append}
    {script src="/min/?g=form" concat=$concat type="javascript"}
    {capture name="formjs"}{strip}
        /min/?f=skin/{template}/js/form.min.js
    {/strip}{/capture}
    {script src=$smarty.capture.formjs concat=$concat type="javascript" load='async'}
    {script src="/min/?f=libjs/vendor/localization/messages_{getlang}.js,plugins/profil/js/public.js" concat=$concat type="javascript"}
    <script type="text/javascript">
        $.nicenotify.notifier = {
            box:"",
            elemclass : '.mc-message'
        };
        var iso = '{getlang}';
        var hashurl = '/'+iso+'/profil/signup/';
        var pseudo = {if $pseudo_required}1{else}0{/if};
        $(function(){
            if (typeof MC_profil == "undefined")
            {
                console.log("MC_profil is not defined");
            }else{
                MC_profil.runSignup(iso,hashurl,pseudo);
            }
        });
    </script>
{/block}