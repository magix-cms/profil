{extends file="profil/mail/layout.tpl"}
<!-- Wrapper/Container Table: Use a wrapper table to control the width and the background color consistently of your email. Use this approach instead of setting attributes on the body tag. -->
{block name='body:content'}
    {autoload_i18n}
    {widget_about_data}
<table cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
    <tr>
        <td valign="top">
            <!-- Tables are the most common way to format your email consistently. Set your table widths inside cells and in most cases reset cellpadding, cellspacing, and border to zero. Use nested tables as a way to space effectively in your message. -->
            <table cellpadding="0" cellspacing="0" border="0" align="center"">
                <tr>
                    <td width="800" style="border-bottom: 10px solid #d6b170;background: #222;padding: 15px 0;text-align: center;" valign="top">
                        <!-- Gmail/Hotmail image display fix -->
                        <a href="{geturl}" target ="_blank" title="{$companyData.name}" style="text-decoration: none;font-size: 46px;">
                            <img src="{geturl}/skin/{template}/img/logo/{#logo_img_small#}" alt="{#logo_img_alt#|ucfirst}" height="60" width="229"/>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td width="800" style="padding: 30px;border: 1px solid #E3E3E3;border-top: none;" valign="top">
                        {if $smarty.get.pstring1 == 'activate'}
                        <div>
                            <p>{#login_text_mail#}</p>
                            <p><a class="btn btn-main-theme" href="{geturl}/{getlang}/profil/login_redirect/">{#login_title_mail#}</a> <span class="help-text">(&thinsp;{#your_login#|ucfirst}&nbsp;: {$data.email}&thinsp;)</span></p>
                            <ul>
                                {*<li>{#pn_profil_firstname#|ucfirst} : {$data.lastname}</li>
                                <li>{#pn_profil_lastname#|ucfirst} : {$data.firstname}</li>*}
                                {*<li>{#pn_profil_mail#|ucfirst}{#your_login#|ucfirst}&nbsp;: {$data.email}</li>*}
                            </ul>
                            <p>{$smarty.config.activation_text_footer_mail|sprintf:{#website_name#}}</p>
                        </div>
                        {elseif $smarty.get.lostpassword}
                            <div>
                                {capture name="loginLinkMail"}
                                    <a class="btn btn-main-theme" href="{geturl}/{getlang}/profil/login_redirect/"> {#login_title_mail#}</a>
                                {/capture}
                                <p>{#password_renew_text_mail#} {$smarty.capture.loginLinkMail}</p>
                                <ul>
                                    <li><strong>{#pn_profil_mail#|ucfirst}</strong> : {$data.email}</li>
                                    <li><strong>{#pn_profil_password#|ucfirst}</strong> : {$data.password}</li>
                                </ul>
                            </div>
                        {else}
                        <div>
                            <h1>{$setTitle}</h1>
                            <p>{$smarty.config.activation_thx_mail|sprintf:{#website_name#}}</p>
                            <p>{$smarty.config.activation_text_mail} <a class="btn btn-main-theme" href="{geturl}/{getlang}/profil/activate/{$data.keyuniqid_pr}">{#activation_title_mail#}</a></p>
                            <ul>
                                <li>{#pn_profil_firstname#|ucfirst} : {$data.lastname_pr}</li>
                                <li>{#pn_profil_lastname#|ucfirst} : {$data.firstname_pr}</li>
                                <li>{#pn_profil_mail#|ucfirst} : {$data.email_pr}</li>
                            </ul>
                            <p>{$smarty.config.activation_text_footer_mail|sprintf:{#website_name#}}</p>
                        </div>
                        {/if}
                    </td>
                </tr>
            </table>
            <!-- End example table -->
            {*
            <!-- Working with telephone numbers (including sms prompts).  Use the "mobile" class to style appropriately in desktop clients
            versus mobile clients. -->
            <span class="mobile_link">123-456-7890</span>
            *}
        </td>
    </tr>
</table>
{/block}
<!-- End of wrapper table -->