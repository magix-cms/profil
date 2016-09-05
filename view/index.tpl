{extends file="layout.tpl"}
{block name="title"}{seo_rewrite config_param=['level'=>'0','idmetas'=>'1','default'=>#my_account#]}{/block}
{block name="description"}{seo_rewrite config_param=['level'=>'0','idmetas'=>'2','default'=>#my_account#]}{/block}
{block name='body:id'}profil-private{/block}

{block name="article:content"}
    <header>
        <h1>{#my_account#|ucfirst}</h1>
        {include file="profil/brick/nav.tpl" data=$getConfigData}
    </header>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade{if isset($smarty.get.tab)}{if $smarty.get.tab == 'profil'} in active{/if}{else} in active{/if}" id="profil">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    {include file="profil/forms/account.tpl" data=$dataAccount}
                </div>
                <div class="col-xs-12 col-sm-6">
                    {include file="profil/forms/password.tpl"}
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade{if isset($smarty.get.tab) && $smarty.get.tab == 'links'} in active{/if}" id="links">
            {include file="profil/forms/links.tpl" data=$dataAccount}
        </div>
    </div>
{/block}

{block name="foot" append}
    {script src="/min/?f=plugins/profil/js/public.js" concat=$concat type="javascript"}
    <script type="text/javascript">
        var hashurl = "{$hashurl}",
            iso = "{getlang}";
        $(function(){
            if (typeof MC_profil == "undefined")
            {
                console.log("MC_profil is not defined");
            }else{
                MC_profil.runPrivate(iso,hashurl);
            }
        });
    </script>
{/block}