{if isset($getCartData.id_cart)}
    {$data = $getCartData}
{/if}
{*<pre>{$data|print_r}</pre>*}
{if is_array($data) && !empty($data)}
{foreach $data as $item => $key}
<div class="panel panel-default">
    <div class="panel-heading">
        <p>{$smarty.config.profil_text_order|sprintf:{$key.date_order|date_format:"%d/%m/%Y"}:{$key.date_order|date_format:"%H:%M"}}<br />
            <a class="accordion-toggle collapsed" data-toggle="collapse" href="#order_collapse_{$key.id_cart}" aria-expanded="false" aria-controls="order_collapse_{$key.id_cart}">
                {#view_order_info#}
            </a>
        </p>
    </div>
    <div class="collapse" id="order_collapse_{$key.id_cart}">
        <div class="panel-body">
            {assign var='to_pay_htva' value=($key.amount_order - $key.amount_tax)}
            {assign var='shipping_htva' value=(($key.shipping_price_order/121)*100)}
            {#pn_profil_lastname#|ucfirst} : <strong>{$key.lastname_cart}</strong><br />
            {#pn_profil_firstname#|ucfirst} : <strong>{$key.firstname_cart}</strong><br />
            {#vat#} : <strong>{$key.amount_tva}%</strong> <br />
            {#to_pay_htva#|ucfirst} : <strong>{$to_pay_htva}</strong> €<br />
            {#tax_amount#|ucfirst} : <strong>{$key.amount_tax}</strong> €<br />
            {if $shipping_htva != '0.00'}
            {#shipping_cart_htva#|ucfirst} :<strong>{$shipping_htva|string_format:"%.2f"}</strong> €<br /> {* <strong>{$key.shipping_price_order}</strong> €<br />*}
            {/if}
            {#to_pay_ttc#|ucfirst} : <strong>{$key.amount_order}</strong> €</p>
        </div>
        <div class="panel-body">
        <table class="table table-hover table-condensed">
            <tr>
                <td colspan="3">
                    <h4>{#order_resume#} : </h4>
                </td>
            </tr>
            {foreach $key.catalog as $val => $key1}
                <tr>
                    <td colspan="3">
                        {assign var='total_price' value={$key1.CATALOG_LIST_QUANTITY}*{$key1.CATALOG_LIST_PRICE}}
                        {assign var='price_hvat' value=($key1.CATALOG_LIST_PRICE - $key.amount_tax)}
                        {assign var='total_price_hvat' value=($total_price - $key.amount_tax)}
                        <h4>{$key1.CATALOG_LIST_NAME}</h4>
                        <ul>
                            <li>{#quantity_cart#} : <strong>{$key1.CATALOG_LIST_QUANTITY}</strong></li>
                            <li>{#price_items#} : <strong>{$key1.CATALOG_LIST_PRICE}</strong> €</li>
                            <li>{#price_htva_items#|ucfirst} : <strong>{$price_hvat}</strong> €</li>
                            <li>{#vat#} : <strong>{$key.amount_tva}</strong> %</li>
                            <li>{#to_pay_htva_items#|ucfirst} : <strong>{$total_price_hvat}</strong> €</li>
                            <li>{#to_pay#} : <strong>{$total_price|string_format:"%.2f"}</strong> €</li>
                        </ul>
                    </td>
                </tr>
            {/foreach}
            <tr>
                <td colspan="3">
                    <h4>{#coordonnees_cart#|ucfirst} : </h4>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        {#pn_profil_mail#|ucfirst} :
                    </label>
                    {$key.email_cart}
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        {#pn_profil_phone#|ucfirst} :
                    </label>
                    {$key.phone_cart}
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        {#pn_profil_tva#|ucfirst} :
                    </label>
                    {$key.tva_cart}
                </td>
            </tr>
            {if $key.street_liv_cart != null OR $key.postal_liv_cart != null OR $key.city_liv_cart != null OR $key.country_liv_cart != null}
                <tr>
                    <td colspan="3">
                        <label>
                            {#coordonnees_cart#|ucfirst} :
                        </label><br />
                        <ul>
                            <li>{$key.street_cart}</li>
                            <li>{$key.postal_cart} {$key.city_cart}</li>
                            <li>{$key.country_cart}</li>
                        </ul>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label>
                            {#coordonnees_liv#|ucfirst} :
                        </label><br />
                        <ul>
                            <li>{$key.street_liv_cart}</li>
                            <li>{$key.city_liv_cart} {$key.postal_liv_cart}</li>
                            <li>{$key.country_liv_cart}</li>
                        </ul>
                    </td>
                </tr>
            {else}
                <tr>
                    <td colspan="3">
                        <label>
                            {#coordonnees_liv_and_cart#|ucfirst} :
                        </label><br />
                        <ul>
                            <li>{$key.street_cart}</li>
                            <li>{$key.postal_cart} {$key.city_cart}</li>
                            <li>{$key.country_cart}</li>
                        </ul>
                    </td>
                </tr>
            {/if}
            {if $key.message_cart != null}
                <tr>
                    <td colspan="3">
                        <label>
                            {#pn_profil_message#|ucfirst} :
                        </label>
                        <br />
                        {$key.message_cart}
                    </td>
                </tr>
            {/if}
        </table>
        </div>
    </div>
</div>
{/foreach}
{/if}