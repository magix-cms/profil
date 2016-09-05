<form id="profil_account" method="post" action="{$smarty.server.REQUEST_URI}" class="form-horizontal">
    <div class="form-group">
        <label class="col-md-3" for="pseudo_pr">
            {#pn_profil_pseudo#|ucfirst} :
        </label>
        <div class="col-md-6">
            <input id="pseudo_pr" type="text" name="pseudo_pr" value="{$data.pseudo}" class="form-control"  />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3" for="lastname_pr">
            {#pn_profil_lastname#|ucfirst} :
        </label>
        <div class="col-md-6">
            <input id="lastname_pr" type="text" name="lastname_pr" value="{$data.lastname}" class="form-control"  />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3" for="firstname_pr">
            {#pn_profil_firstname#|ucfirst} :
        </label>
        <div class="col-md-6">
            <input id="firstname_pr" type="text" name="firstname_pr" value="{$data.firstname}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3" for="email_pr">
            {#pn_profil_mail#|ucfirst}* :
        </label>
        <div class="col-md-6">
            <input id="email_pr" type="text" name="email_pr" value="{$data.email}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3" for="country_pr">
            {#pn_profil_country#|ucfirst} :
        </label>
        <div class="col-md-6">
            <select class="form-control" id="country_pr" name="country_pr">
                <option value="">{#select_country#}</option>
                {foreach $countryTools as $key => $val}
                    <option value="{$val.country}"{if $data.country eq $val.iso} selected{/if}>{#$val.iso#|ucfirst}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3" for="street_pr">
            {#pn_profil_street#|ucfirst} :
        </label>
        <div class="col-md-6">
            <input id="street_pr" type="text" name="street_pr"  value="{$data.street}" class="form-control"  />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3" for="city_pr">
            {#pn_profil_city#|ucfirst} :
        </label>
        <div class="col-md-6">
            <input id="city_pr" type="text" name="city_pr" value="{$data.city}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3" for="postcode_pr">
            {#pn_profil_postcode#|ucfirst} :
        </label>
        <div class="col-md-6">
            <input id="postcode_pr" type="text" name="postcode_pr" value="{$data.postcode}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3" for="phone_pr">
            {#pn_profil_phone#|ucfirst} :
        </label>
        <div class="col-md-6">
            <input id="phone_pr" type="text" name="phone_pr" value="{$data.phone}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3" for="website_pr">
            {#website#|ucfirst} :
        </label>
        <div class="col-md-6">
            <input id="website_pr" type="text" name="website_pr" value="{$data.website}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3" for="facebook_pr">
            Facebook :
        </label>
        <div class="col-md-6">
            <input id="facebook_pr" type="text" name="facebook_pr" value="{$data.facebook}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3" for="twitter_pr">
            Twitter :
        </label>
        <div class="col-md-6">
            <input id="twitter_pr" type="text" name="twitter_pr" value="{$data.twitter}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3" for="google_pr">
            Google :
        </label>
        <div class="col-md-6">
            <input id="google_pr" type="text" name="google_pr" value="{$data.google}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3" for="viadeo_pr">
            Viadeo :
        </label>
        <div class="col-md-6">
            <input id="viadeo_pr" type="text" name="viadeo_pr" value="{$data.viadeo}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3" for="linkedin_pr">
            Linkedin :
        </label>
        <div class="col-md-6">
            <input id="linkedin_pr" type="text" name="linkedin_pr" value="{$data.linkedin}" class="form-control" />
        </div>
    </div>
    {$classActive =  ' checked="checked" '}
    <div class="form-group">
        <label class="col-md-3" for="active_account">
            Statut du membre :
        </label>
        <div class="col-md-6">
            <label class="radio-inline">
                <input type="radio" {if $data.active eq '1'}{$classActive} {/if} name="active_account" id="activeAccount1" value="1"> Activé
            </label>
            <label class="radio-inline">
                <input type="radio" {if $data.active eq '0'}{$classActive} {/if} name="active_account" id="activeAccount2" value="0"> Désactivé
            </label>
        </div>
    </div>
    <div class="form-group">
        <p class="col-md-3">
            &nbsp;
        </p>
        <div class="col-md-6">
            <input type="submit" class="btn btn-primary" value="{#send#|ucfirst}" />
        </div>
    </div>
    <div class="clearfix mc-message"></div>
</form>