var MC_profil = (function($, window, document, undefined){
    /**
     * Save
     * @param id
     * @param collection
     * @param type
     */
    function save(iso,type,id,hashurl,edit){
        if(type === 'signup'){
            // *** Set required fields for validation
            var rules = {
                cond_gen: {
                    required: true
                },
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
                    email: true,
                    remote: {
                        url: '/'+iso+'/profil/signup/',
                        type: "get"
                    }
                },
                cryptkeypass_pr: {
                    required: true,
                    minlength: 2
                },
                cryptkeypass_confirm: {
                    required: true,
                    equalTo: "#cryptkeypass_pr"
                }
            };

            if(edit)
                rules['pseudo_pr'] = { required: true, remote: { url: '/'+iso+'/profil/signup/', type: "get" } };

            $(id).validate({
                onsubmit: true,
                event: 'submit',
                rules: rules,
                submitHandler: function(form) {
                    $.nicenotify({
                        ntype: "submit",
                        uri: hashurl,
                        typesend: 'post',
                        idforms: $(form),
                        resetform: true,
                        successParams:function(data){
                            $.nicenotify.initbox(data,{
                                display:true
                            });
                        }
                    });
                    return false;
                }
            });
        }else if(type === 'private'){
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
                    }/*,
                    email_pr: {
                        required: true,
                        email: true
                    },
                    street_pr: {
                        required: true,
                        minlength: 2
                    },
                    city_pr: {
                        required: true,
                        minlength: 2
                    },
                    postcode_pr: {
                        required: true,
                        minlength: 2
                    },
                    country_pr: {
                        required: true
                    }*/
                },
                submitHandler: function(form) {
                    $.nicenotify({
                        ntype: "submit",
                        uri: hashurl,
                        typesend: 'post',
                        idforms: $(form),
                        resetform: false,
                        successParams:function(data){
                            $.nicenotify.notifier = {
                                box:"",
                                elemclass : '.mc-message'
                            };
                            $.nicenotify.initbox(data,{
                                display:true
                            });
                        }
                    });
                    return false;
                }
            });
        }else if(type === 'cartpay'){
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
                    street_pr: {
                         required: true,
                         minlength: 2
                    },
                    city_pr: {
                         required: true,
                         minlength: 2
                    },
                    postcode_pr: {
                         required: true,
                         minlength: 2
                    },
                    country_pr: {
                        required: true
                    }
                },
                submitHandler: function(form) {
                    $.nicenotify({
                        ntype: "submit",
                        uri: hashurl,
                        typesend: 'post',
                        idforms: $(form),
                        resetform: false,
                        successParams:function(data){
                            $.nicenotify.notifier = {
                                box:"",
                                elemclass : '.mc-message'
                            };
                            $.nicenotify.initbox(data,{
                                display:true
                            });
                        }
                    });
                    return false;
                }
            });
        }else if(type === 'lostpassword'){
            $(id).validate({
                onsubmit: true,
                event: 'submit',
                rules: {
                    lo_email_pr: {
                        required: true,
                        email: true
                    }
                },
                submitHandler: function(form) {
                    $.nicenotify({
                        ntype: "submit",
                        uri: hashurl+'?lostpassword=true',
                        typesend: 'post',
                        idforms: $(form),
                        resetform: true,
                        successParams:function(data){
                            $.nicenotify.initbox(data,{
                                display:true
                            });
                        }
                    });
                    return false;
                }
            });
        }else if(type === 'password'){
            $(id).validate({
                onsubmit: true,
                event: 'submit',
                rules: {
                    new_cryptkeypass_pr: {
                        required: true,
                        minlength: 2
                    },
                    cryptkeypass_confirm: {
                        required: true,
                        equalTo: "#new_cryptkeypass_pr"
                    }
                },
                submitHandler: function(form) {
                    $.nicenotify({
                        ntype: "submit",
                        uri: hashurl,
                        typesend: 'post',
                        idforms: $(form),
                        resetform: true,
                        successParams:function(data){
                            $.nicenotify.notifier = {
                                box:"",
                                elemclass : '.mc-message-pwd'
                            };
                            $.nicenotify.initbox(data,{
                                display:true
                            });
                        }
                    });
                    return false;
                }
            });
        }else if(type === 'links'){
            $(id).validate({
                onsubmit: true,
                event: 'submit',
                submitHandler: function(form) {
                    $.nicenotify({
                        ntype: "submit",
                        uri: hashurl,
                        typesend: 'post',
                        idforms: $(form),
                        resetform: false,
                        successParams:function(data){
                            $.nicenotify.notifier = {
                                box:"",
                                elemclass : '.mc-message-link'
                            };
                            $.nicenotify.initbox(data,{
                                display:true
                            });
                        }
                    });
                    return false;
                }
            });
        }
    }

    return {
        runNewPassword:function(iso,hashurl){
            save(iso,'lostpassword','#form-password-renew',hashurl,null);
        },
        runSignup:function(iso,hashurl,pseudo){
            save(iso,'signup','#signup-form',hashurl,pseudo);
        },
        runPrivate:function(iso,hashurl){
            save(iso,'private','#private-form',hashurl,null);
            save(iso,'cartpay','#private-form-cartpay',hashurl,null);
            save(iso,'password','#newpassword-form',hashurl,null);
            save(iso,'links','#links-form',hashurl,null);
        }
    }
})(jQuery, window, document);