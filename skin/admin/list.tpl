{extends file="layout.tpl"}
{block name='body:id'}plugins-{$pluginName}{/block}
{block name="article:content"}
    {*<h1>Liste des achats avec paiements sécurisées</h1>*}
    <h1>{$pluginName|ucfirst}</h1>
    {include file="section/tab.tpl"}
    <h2>Liste des membres</h2>
    <table class="table table-condensed table-bordered">
        <tr>
            <th>Email</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Statut</th>
            <th><span class="fa fa-edit"></span></th>
            <th><span class="fa fa-trash-o"></span></th>
        </tr>
        {*<pre>{$getCartData|print_r}</pre>*}
    {foreach $getProfilData as $key => $value nocache}
        <tr>
            <td>{$value.email}</td>
            <td>{$value.lastname}</td>
            <td>{$value.firstname}</td>
            <td>{if $value.active_account eq 0}<span class="fa fa-minus-square"></span>{else}<span class="fa fa-check-square"></span>{/if}</td>
            <td><a href="{$pluginUrl}&action=edit&edit={$value.id}"><span class="fa fa-edit"></span></a></td>
            <td><a href="#" class="delete-profil" data-delete="{$value.id}"><span class="fa fa-trash-o"></span></a></td>
        </tr>
    {/foreach}
    </table>
    <div id="list-{$pluginName}-data" class="list-{$pluginName}-data"></div>
    {$pagination}
{/block}
{block name="javascript"}
    {include file="js.tpl"}
{/block}
{block name="modal"}
    <div id="window-dialog"></div>
{/block}