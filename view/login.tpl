{extends file="layout.tpl"}
{block name="title"}{seo_rewrite config_param=['level'=>'0','idmetas'=>'1','default'=>#seo_t_static_login#]}{/block}
{block name="description"}{seo_rewrite config_param=['level'=>'0','idmetas'=>'2','default'=>#seo_d_static_login#]}{/block}
{block name='body:id'}login{/block}

{block name="main"}
    <main id="content">
        {block name="article:before"}{/block}

        {block name='article'}
            <article id="article" class="container">
                {block name="article:content"}
                    <div class="row">
                        <div id="login-box" class="col-sm-6">
                            <h2>{#login_root_h1#|ucfirst}</h2>
                            <div class="content-box">
                                <form id="login-form" method="post" action="{geturl}/{getlang}/profil/login_redirect/" class="form-horizontal">
                                    <div class="clearfix mc-message">{$login_message}</div>
                                    <label class="sr-only" for="email_pr">{#label_login#|ucfirst}</label>
                                    <p class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        <input type="text" class="form-control input-lg" placeholder="{#placeholder_login#|ucfirst}" id="email_pr" name="email_pr" value="" />
                                    </p>
                                    <label class="sr-only" for="cryptkeypass_pr">{#labelssword#|ucfirst}</label>
                                    <p class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </span>
                                        <input type="password" class="form-control input-lg" placeholder="{#placeholder_password#|ucfirst}" id="cryptkeypass_pr" name="cryptkeypass_pr" value="" />
                                    </p>
                                    <p class="pull-left">
                                        <input type="hidden" id="hashtoken" name="hashtoken" value="{$hashpass}" />
                                        <input type="submit" class="btn btn-box btn-flat btn-main-theme" value="{#pn_login_send#|ucfirst}" />
                                    </p>
                                </form>
                                <div id="forget-pwd" class="pull-left">
                                    <p>{#forget_password#|ucfirst}</p>
                                    <a data-target="#password-renew" data-toggle="modal" href="#">
                                        {#send_renew_password#}
                                    </a>
                                    {include file="profil/brick/password.tpl"}
                                </div>
                            </div>
                        </div>

                        <div id="signup-box" class="col-sm-6">
                            <h2>{#signup#|ucfirst}</h2>
                            <div class="content-box">
                                <p class="lead">{#text_signup#|ucfirst}</p>
                                <p class="text-center">
                                    <a href="{geturl}/{getlang}/{#create_profil_url#}" class="btn btn-box btn-flat btn-main-theme" title="{#signup_btn#|ucfirst}">
                                        {#signup_btn#|ucfirst}
                                    </a>
                                </p>
                            </div>
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
        elemclass : '.ajax-message'
    };
    var iso = '{getlang}';
    var hashurl = '/'+iso+'/profil/';
    $(function(){
        if (typeof MC_profil == "undefined")
        {
            console.log("MC_profil is not defined");
        }else{
            MC_profil.runNewPassword(iso,hashurl);
        }
    });
</script>
{/block}