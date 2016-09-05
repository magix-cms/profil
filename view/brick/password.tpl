<div class="modal fade" id="password-renew" tabindex="-1" role="dialog" aria-labelledby="passwordRenew" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{$smarty.server.REQUEST_URI}" id="form-password-renew" method="post" class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="passwordRenew">{#send_renew_password#|ucfirst}</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="lo_email_pr">{#pn_profil_mail#|ucfirst}*&nbsp;:</label>
                            <input id="lo_email_pr" type="text" name="lo_email_pr" value="" class="form-control" placeholder="{#ph_email#|ucfirst}" />
                            <input type="hidden" id="hashtoken" name="hashtoken" value="{$hashpass}" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-sd-theme btn-block" value="{#pn_profil_send#|ucfirst}" />
                    <div class="ajax-message"></div>
                </div>
            </form>
        </div>
    </div>
</div>