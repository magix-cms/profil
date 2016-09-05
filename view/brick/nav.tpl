{if !$smarty.get.pstring2}
<ul class="nav nav-tabs record-menu" role="tablist">
    <li role="presentation"{if isset($smarty.get.tab)}{if $smarty.get.tab == 'profil'} class="active"{/if}{else} class="active"{/if}>
        <a href="#profil" aria-controls="profil" role="tab" data-toggle="tab">{#pn_profil#|ucfirst}</a>
    </li>
    {if $data.links eq '1'}
    <li role="presentation"{if isset($smarty.get.tab) && $smarty.get.tab == 'links'} class="active"{/if}>
        <a href="#links" aria-controls="links" role="tab" data-toggle="tab">{#pn_links#|ucfirst}</a>
    </li>
    {/if}
    {if $data.cartpay eq '1'}
    <li role="presentation">
        <a href="{$hashurl}order/">{#pn_order#|ucfirst}</a>
    </li>
    {/if}
</ul>
    {else}
    <ul class="nav nav-tabs record-menu" role="tablist">
        <li role="presentation">
            <a href="{$hashurl}?tab=profil">{#pn_profil#|ucfirst}</a>
        </li>
        {if $data.links eq '1'}
        <li role="presentation">
            <a href="{$hashurl}?tab=links">{#pn_links#|ucfirst}</a>
        </li>
        {/if}
        {if $data.cartpay eq '1'}
        <li role="presentation" {if $smarty.get.pstring2 eq 'order'}class="active"{/if}>
            <a href="{$hashurl}order/">{#pn_order#|ucfirst}</a>
        </li>
        {/if}
    </ul>
{/if}