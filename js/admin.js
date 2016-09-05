var MC_profil = (function($, window, document, undefined){
    /**
     * set ajax load data
     * @param baseadmin
     * @param tab
     * @param action
     * @returns {string}
     */
    function setAjaxUrlLoad(baseadmin,tab,action,edit){
        if(tab != null) {
            if (action != null) {
                if (edit != null) {
                    return '/' + baseadmin + '/plugins.php?name=profil&tab=' + tab + '&action=' + action + '&edit=' + edit;
                } else {
                    return '/' + baseadmin + '/plugins.php?name=profil&tab=' + tab + '&action=' + action;
                }
            } else {
                return '/' + baseadmin + '/plugins.php?name=profil&tab=' + tab;
            }
        }else {
            if (action != null) {
                if (edit != null) {
                    return '/' + baseadmin + '/plugins.php?name=profil&action=' + action + '&edit=' + edit;
                } else {
                    return '/' + baseadmin + '/plugins.php?name=profil&action=' + action;
                }
            }else{
                return '/' + baseadmin + '/plugins.php?name=profil';
            }

        }
    }
    /**
     * Save
     * @param id
     * @param collection
     * @param type
     */
    function save(baseadmin,tab,action,id,edit){
        if(id === '#profil_account') {
            $(id).validate({
                onsubmit: true,
                event: 'submit',
                rules: {
                    lastname_pr: {
                        required: true,
                        minlength: 2
                    },
                    firstname_pr: {
                        required: true,
                        minlength: 2
                    },
                    email_pr: {
                        required: true,
                        email: true
                    }
                },
                submitHandler: function (form) {
                    $.nicenotify({
                        ntype: "submit",
                        uri: setAjaxUrlLoad(baseadmin,tab, action, edit),
                        typesend: 'post',
                        idforms: $(form),
                        resetform: false,
                        successParams: function (data) {
                            $.nicenotify.initbox(data, {
                                display: true
                            });
                        }
                    });
                    return false;
                }
            });
        }else{
            $(id).on('submit',function(){
                $.nicenotify({
                    ntype: "submit",
                    uri: setAjaxUrlLoad(baseadmin,tab, action, edit),
                    typesend: 'post',
                    idforms: $(this),
                    resetform: false,
                    beforeParams:function(){},
                    successParams:function(e){
                        $.nicenotify.initbox(e,{
                            display:true
                        });
                    }
                });
                return false;
            });
        }
    }
    /**
     * Suppression du contact
     * @param getlang
     */
    function remove(baseadmin){
        $(document).on('click','.delete-profil',function(event){
            event.preventDefault();
            var elem = $(this).data("delete");
            $("#window-dialog:ui-dialog").dialog( "destroy" );
            $('#window-dialog').dialog({
                modal: true,
                resizable: false,
                height:180,
                width:350,
                title:"Supprimer cet élément",
                buttons: {
                    'Delete': function() {
                        $(this).dialog('close');
                        $.nicenotify({
                            ntype: "ajax",
                            uri: '/'+baseadmin+'/plugins.php?name=profil&action=remove',
                            typesend: 'post',
                            noticedata : {delete:elem},
                            successParams:function(e){
                                $.nicenotify.initbox(e,{
                                    display:false
                                });
                            }
                        });
                    },
                    Cancel: function() {
                        $(this).dialog('close');
                    }
                }
            });
            return false;
        });
    }
    return {
        //Fonction public
        runEdit : function(baseadmin,tab,edit){
            save(baseadmin,tab,'edit','#profil_account',edit);
        },
        runConfig: function(baseadmin,tab){
            save(baseadmin,tab,'update','#profil_config',null);
        },
        run : function(baseadmin){
            remove(baseadmin);
        }
    }
})(jQuery, window, document);