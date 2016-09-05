<div id="menu-user">
    <div class="dropdown" role="menu">
        <a class="{*btn btn-flat btn-main-theme *}dropdown-toggle {if $smarty.session.idprofil && $smarty.session.keyuniqid_pr}user-logged{/if}" type="button" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="true" role="button">
            <span class="fa fa-user"></span>{*{if $smarty.session.idprofil && $smarty.session.keyuniqid_pr}{widget_profil_data} {$dataAccount.pseudo}{else}<span class="hidden-xs">{#member_label#|ucfirst}</span>{/if}*}
        </a>
        <ul id="nav-user" class="dropdown-menu" aria-labelledby="menu-user" role="menu">
            {if $smarty.session.idprofil && $smarty.session.keyuniqid_pr}
                {widget_profil_data}
                <li role="menuitem">
                    <a href="{$hashurl}" title="{#view_profil_title#|ucfirst}" role="link"><span class="fa fa-user"></span> {#view_profil_label#|ucfirst}</a>
                </li>
                <li role="menuitem">
                    <a href="{$hashurl}{#logout_profil_url#}" title="{#logout_profil_title#|ucfirst}" role="link"><span class="fa fa-power-off"></span> {#logout_profil_label#|ucfirst}</a>
                </li>
            {else}
                <li role="menuitem">
                    <a href="{geturl}/{getlang}/{#connect_profil_url#}" title="{#connect_profil_title#|ucfirst}" role="link"><span class="fa fa-sign-in"></span> {#connect_profil_label#|ucfirst}</a>
                </li>
                <li role="menuitem">
                    <a href="{geturl}/{getlang}/{#create_profil_url#}" title="{#create_profil_title#|ucfirst}" role="link"><span class="fa fa-user"></span> {#create_profil_label#|ucfirst}</a>
                </li>
            {/if}
        </ul>
    </div>
</div>