{extends file="layout.tpl"}
{block name="title"}{seo_rewrite config_param=['level'=>'0','idmetas'=>'1','default'=>#order#]}{/block}
{block name="description"}{seo_rewrite config_param=['level'=>'0','idmetas'=>'2','default'=>#order#]}{/block}
{block name='body:id'}profil-private{/block}

{block name="article:content"}
    <header class="record-header">
        <h1>{#order#|ucfirst}</h1>
        {include file="profil/brick/nav.tpl" data=$getConfigData}
    </header>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="order">
            {include file="profil/loop/order.tpl" data=$getCartData}
        </div>
    </div>
{/block}

{block name="foot" append}
{script src="/min/?g=form" concat=$concat type="javascript"}
{capture name="formjs"}{strip}
    /min/?f=skin/{template}/js/form.min.js
{/strip}{/capture}
{script src=$smarty.capture.formjs concat=$concat type="javascript" load='async'}
<script type="text/javascript">
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