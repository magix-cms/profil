{extends file="layout.tpl"}
{block name="title"}{seo_rewrite config_param=['level'=>'0','idmetas'=>'1','default'=>#seo_t_static_login#]}{/block}
{block name="description"}{seo_rewrite config_param=['level'=>'0','idmetas'=>'2','default'=>#seo_d_static_login#]}{/block}
{block name='body:id'}activated{/block}

{block name="main"}
<main id="content">
    {block name="article:before"}{/block}

    {block name='article'}
    <article id="article" class="container">
        {block name='article:content'}
        <h1>{#activate_h1#|ucfirst}</h1>
        <div class="content-box">
            <p class="alert alert-success">
                <span class="fa fa-check"></span>
                {$smarty.config.activate_msg}
            </p>
            <p>
                {$smarty.config.activate_connect|sprintf:$smarty.config.website_name} <a class="btn btn-box btn-flat btn-main-theme" href="{geturl}/{getlang}/profil/login_redirect/">{#login_title#}</a>
            </p>
        </div>
        {/block}
    </article>
    {/block}

    {block name="article:after"}{/block}
</main>
{/block}