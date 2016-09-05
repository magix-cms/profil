{autoload_i18n}
{switch $message}
    {case 'login_error' break}
    {capture name="alert"}
        {#request_login_error#}
    {/capture}
    {capture name="class_alert"}
        alert-danger
    {/capture}
    {case 'new_password_error' break}
    {capture name="alert"}
        {#request_email_error#}
    {/capture}
    {capture name="class_alert"}
        alert-danger
    {/capture}
    {case 'empty' break}
    {capture name="alert"}
        {#request_empty#}
    {/capture}
    {capture name="class_alert"}
        alert-danger
    {/capture}
    {case 'add' break}
    {capture name="alert"}
        {#request_success_add#}
    {/capture}
    {capture name="class_alert"}
        alert-success
    {/capture}
    {case 'signup' break}
    {capture name="alert"}
        {$smarty.config.request_success_signup|sprintf:{#website_name#}}
    {/capture}
    {capture name="class_alert"}
        alert-success
    {/capture}
    {case 'signup_error' break}
    {capture name="alert"}
        {#request_error_signup#}
    {/capture}
    {capture name="class_alert"}
        alert-danger
    {/capture}
    {case 'update' break}
    {capture name="alert"}
        {#request_success_update#}
    {/capture}
    {capture name="class_alert"}
        alert-success
    {/capture}
    {case 'new_password_success' break}
    {capture name="alert"}
        {#request_newpassword_success#}
    {/capture}
    {capture name="class_alert"}
        alert-success
    {/capture}

{/switch}

<p class="alert {$smarty.capture.class_alert} fade in">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <span class="icon-ok"></span> {$smarty.capture.alert}
</p>