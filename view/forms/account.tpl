<form id="{if $getConfigData.cartpay eq '1'}private-form-cartpay{else}private-form{/if}" method="post" action="{$smarty.server.REQUEST_URI}">
    {if $pseudo_required}
    <div class="form-group">
        <label for="pseudo_pr">
            {#pn_profil_pseudo#|ucfirst}* :
        </label>
        <input id="pseudo_pr" type="text" value="{$data.pseudo}" class="form-control" disabled />
        <input name="pseudo_pr" type="hidden" value="{$data.pseudo}"/>
        <a href="#" class="text-info" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="top" data-content="{#uniq_pseudo#|ucfirst}">
            <span class="fa fa-question-circle"></span>
        </a>
    </div>
    {/if}
    <div class="form-group">
        <label for="firstname_pr">
            {#pn_profil_firstname#|ucfirst}* :
        </label>
        <input id="firstname_pr" type="text" name="firstname_pr" value="{$data.firstname}" class="form-control" />
    </div>
    <div class="form-group">
        <label for="lastname_pr">
            {#pn_profil_lastname#|ucfirst}* :
        </label>
        <input id="lastname_pr" type="text" name="lastname_pr" value="{$data.lastname}" class="form-control"  />
    </div>
    <div class="form-group">
        <label for="phone_pr">
            {#pn_profil_phone#|ucfirst} :
        </label>
        <input id="phone_pr" type="text" name="phone_pr" value="{$data.phone}" class="form-control" />
    </div>
    <div class="form-group">
        <label for="country_pr">
            {#pn_profil_country#|ucfirst}* :
        </label>
        {include file="section/brick/country.tpl" data=$data}
    </div>
    <div class="form-group">
        <label for="street_pr">
            {#pn_profil_street#|ucfirst}* :
        </label>
        <input id="street_pr" type="text" name="street_pr" value="{$data.street}" class="form-control"  />
    </div>
    <div class="form-group">
            <label for="city_pr">
                {#pn_profil_city#|ucfirst}* :
            </label>
            <input id="city_pr" type="text" name="city_pr" value="{$data.city}" class="form-control" />
    </div>
    <div class="form-group">
        <label for="postcode_pr">
            {#pn_profil_postcode#|ucfirst}* :
        </label>
        <input id="postcode_pr" type="text" name="postcode_pr" value="{$data.postcode}" class="form-control" />
    </div>
    <div class="form-group">
        <label for="company_pr">
            {#pn_profil_company#|ucfirst} :
        </label>
        <input id="company_pr" type="text" name="company_pr" value="{$data.company}" class="form-control" />
    </div>
    <div class="form-group">
        <label for="vat_pr">
            {#pn_profil_vat#|ucfirst} :
        </label>
        <input id="vat_pr" type="text" name="vat_pr" value="{$data.vat}" class="form-control" />
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-box btn-flat btn-main-theme" value="{#pn_profil_save#|ucfirst}" />
    </div>
    <div class="clearfix mc-message"></div>
</form>