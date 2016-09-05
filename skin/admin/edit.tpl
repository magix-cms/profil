{extends file="layout.tpl"}
{block name='body:id'}plugins-{$pluginName}{/block}
{block name="article:content"}
    <h1>Edition du membre</h1>
    {include file="forms/account.tpl" data=$dataAccount}
{/block}
{block name="javascript"}
    {include file="js.tpl"}
{/block}
{block name="modal"}
    <div id="window-dialog"></div>
{/block}