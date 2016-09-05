<?php
require_once __DIR__ . '/recaptcha/autoload.php';
/**
 * Created by PhpStorm.
 * User: aurelien
 * Date: 3/04/14
 * Time: 14:59
 */
require_once('db/profil.php');
require('session.php');

class plugins_profil_public extends database_plugins_profil{
    protected $template, $module, $activeMods;
    private static $default_country = array(
        "AF"=>"Afghanistan",
        "AL"=>"Albania",
        "DZ"=>"Algeria",
        "AD"=>"Andorra",
        "AO"=>"Angola",
        "AG"=>"Antigua and Barbuda",
        "AR"=>"Argentina",
        "AM"=>"Armenia",
        "AW"=>"Aruba",
        "AU"=>"Australia",
        "AT"=>"Austria",
        "AZ"=>"Azerbaijan",
        "BS"=>"Bahamas",
        "BH"=>"Bahrain",
        "BD"=>"Bangladesh",
        "BB"=>"Barbados",
        "BY"=>"Belarus",
        "BE"=>"Belgium",
        "BZ"=>"Belize",
        "BJ"=>"Benin",
        "BM"=>"Bermuda",
        "BT"=>"Bhutan",
        "BO"=>"Bolivia",
        "BA"=>"Bosnia-Herzegovina",
        "BW"=>"Botswana",
        "BR"=>"Brazil",
        "VG"=>"British Virgin Islands",
        "BN"=>"Brunei",
        "BG"=>"Bulgaria",
        "BF"=>"Burkina Faso",
        "BI"=>"Burundi",
        "KH"=>"Cambodia",
        "CM"=>"Cameroon",
        "CA"=>"Canada",
        "CV"=>"Cape Verde",
        "KY"=>"Cayman Islands",
        "CF"=>"Central African Republic",
        "TD"=>"Chad",
        "CL"=>"Chile",
        "CN"=>"China",
        "CO"=>"Colombia",
        "KM"=>"Comoros",
        "CG"=>"Congo (Brazzaville)",
        "CD"=>"Congo (Democratic Rep.)",
        "CR"=>"Costa Rica",
        "CI"=>"Cote d'Ivoire",
        "HR"=>"Croatia",
        "CU"=>"Cuba",
        "CY"=>"Cyprus",
        "CZ"=>"Czech Republic",
        "DK"=>"Denmark",
        "DJ"=>"Djibouti",
        "DM"=>"Dominica",
        "DO"=>"Dominican Republic",
        "EC"=>"Ecuador",
        "EG"=>"Egypt",
        "SV"=>"El Salvador",
        "GQ"=>"Equatorial Guinea",
        "ER"=>"Eritrea",
        "EE"=>"Estonia",
        "ET"=>"Ethiopia",
        "FK"=>"Falkland Islands",
        "FO"=>"Faroe Islands",
        "FJ"=>"Fiji",
        "FI"=>"Finland",
        "FR"=>"France",
        "GF"=>"French Guiana",
        "PF"=>"French Polynesia",
        "GA"=>"Gabon",
        "GM"=>"Gambia",
        "GE"=>"Georgia",
        "DE"=>"Germany",
        "GH"=>"Ghana",
        "GI"=>"Gibraltar",
        "GR"=>"Greece",
        "GL"=>"Greenland",
        "GD"=>"Grenada",
        "GP"=>"Guadeloupe",
        "GT"=>"Guatemala",
        "GG"=>"Guernsey",
        "GN"=>"Guinea",
        "GW"=>"Guinea-Bissau",
        "GY"=>"Guyana",
        "HT"=>"Haiti",
        "HN"=>"Honduras",
        "HK"=>"Hong Kong",
        "HU"=>"Hungary",
        "IS"=>"Iceland",
        "IN"=>"India",
        "ID"=>"Indonesia",
        "IR"=>"Iran",
        "IQ"=>"Iraq",
        "IE"=>"Ireland",
        "IM"=>"Isle of Man",
        "IL"=>"Israel",
        "IT"=>"Italy",
        "JM"=>"Jamaica",
        "JP"=>"Japan",
        "JE"=>"Jersey",
        "JO"=>"Jordan",
        "KZ"=>"Kazakhstan",
        "KE"=>"Kenya",
        "KI"=>"Kiribati",
        "KV"=>"Kosovo",
        "KW"=>"Kuwait",
        "KG"=>"Kyrgyzstan",
        "LA"=>"Laos",
        "LV"=>"Latvia",
        "LB"=>"Lebanon",
        "LS"=>"Lesotho",
        "LR"=>"Liberia",
        "LY"=>"Libya",
        "LI"=>"Liechtenstein",
        "LT"=>"Lithuania",
        "LU"=>"Luxembourg",
        "MO"=>"Macau",
        "MK"=>"Macedonia",
        "MG"=>"Madagascar",
        "MW"=>"Malawi",
        "MY"=>"Malaysia",
        "MV"=>"Maldives",
        "ML"=>"Mali",
        "MT"=>"Malta",
        "MH"=>"Marshall Islands",
        "MQ"=>"Martinique",
        "MR"=>"Mauritania",
        "MU"=>"Mauritius",
        "YT"=>"Mayotte",
        "MX"=>"Mexico",
        "FM"=>"Micronesia",
        "MD"=>"Moldova",
        "MC"=>"Monaco",
        "MN"=>"Mongolia",
        "ME"=>"Montenegro",
        "MA"=>"Morocco",
        "MZ"=>"Mozambique",
        "MM"=>"Myanmar",
        "NA"=>"Namibia",
        "NR"=>"Nauru",
        "NP"=>"Nepal",
        "NL"=>"Netherlands",
        "NC"=>"New Caledonia",
        "NZ"=>"New Zealand",
        "NI"=>"Nicaragua",
        "NE"=>"Niger",
        "NG"=>"Nigeria",
        "KP"=>"North Korea",
        "NO"=>"Norway",
        "OM"=>"Oman",
        "PK"=>"Pakistan",
        "PW"=>"Palau",
        "PA"=>"Panama",
        "PG"=>"Papua New Guinea",
        "PY"=>"Paraguay",
        "PE"=>"Peru",
        "PH"=>"Philippines",
        "PL"=>"Poland",
        "PT"=>"Portugal",
        "PR"=>"Puerto Rico",
        "QA"=>"Qatar",
        "RE"=>"Reunion",
        "RO"=>"Romania",
        "RU"=>"Russia",
        "RW"=>"Rwanda",
        "BL"=>"Saint Barthelemy",
        "KN"=>"Saint Kitts and Nevis",
        "LC"=>"Saint Lucia",
        "MF"=>"Saint Martin",
        "PM"=>"Saint Pierre and Miquelon",
        "VC"=>"Saint Vincent and the Grenadines",
        "WS"=>"Samoa",
        "SM"=>"San Marino",
        "ST"=>"Sao Tome and Principe",
        "SA"=>"Saudi Arabia",
        "SN"=>"Senegal",
        "RS"=>"Serbia",
        "SC"=>"Seychelles",
        "SL"=>"Sierra Leone",
        "SG"=>"Singapore",
        "SK"=>"Slovakia",
        "SI"=>"Slovenia",
        "SB"=>"Solomon Islands",
        "SO"=>"Somalia",
        "ZA"=>"South Africa",
        "KR"=>"South Korea",
        "SS"=>"South Sudan",
        "ES"=>"Spain",
        "LK"=>"Sri Lanka",
        "SD"=>"Sudan",
        "SR"=>"Suriname",
        "SJ"=>"Svalbard",
        "SZ"=>"Swaziland",
        "SE"=>"Sweden",
        "CH"=>"Switzerland",
        "SY"=>"Syria",
        "TW"=>"Taiwan",
        "TJ"=>"Tajikistan",
        "TZ"=>"Tanzania",
        "TH"=>"Thailand",
        "TL"=>"Timor-Leste",
        "TG"=>"Togo",
        "TO"=>"Tonga",
        "TT"=>"Trinidad and Tobago",
        "TN"=>"Tunisia",
        "TR"=>"Turkey",
        "TM"=>"Turkmenistan",
        "TC"=>"Turks and Caicos",
        "TV"=>"Tuvalu",
        "UG"=>"Uganda",
        "UA"=>"Ukraine",
        "AE"=>"United Arab Emirates",
        "GB"=>"United Kingdom",
        "US"=>"United States",
        "UY"=>"Uruguay",
        "UZ"=>"Uzbekistan",
        "VU"=>"Vanuatu",
        "VA"=>"Vatican City",
        "VE"=>"Venezuela",
        "VN"=>"Vietnam",
        "WF"=>"Wallis et Futuna",
        "EH"=>"Western Sahara",
        "YE"=>"Yemen",
        "ZM"=>"Zambia",
        "ZW"=>"Zimbabwe"
    );
    //Les données du profil
    public $pstring1,$pnum1,$pstring2,$pnum2;
    public $login_redirect,
        $signup,
        $keyuniqid_pr,
        $pseudo_pr,
        $lastname_pr,
        $firstname_pr,
        $email_pr,
        $country_pr,
        $phone_pr,
        $street_pr,
        $city_pr,
        $postcode_pr,
        $tva_pr,
        $society_pr,
        $cond_gen,
        $singup_newsletter,
        $cryptkeypass_pr,
        $new_cryptkeypass_pr,
        $website_pr,
        $facebook_pr,
        $twitter_pr,
        $google_pr,
        $viadeo_pr,
        $linkedin_pr,
        $post_link,
        $lo_email_pr,
        $hashtoken,
        $lostpassword;
    public $pseudo_required = false;
    //session
    public $keyuniqid_pr_session,$email_pr_session,$idprofil_session,$hashuri,$vactivate;
    public $edit;
    public $json,$subaction;
    public $name_rcp,$img_rcp,$level_rcp,$preparation_rcp,$number_rcp,$budget_rcp,$content_rcp,$statut_rcp;
    public $name_ing;
    public $period_sub,$amount_sub;
    public $gRecaptchaResponse;
    public function __construct(){
		if(class_exists('plugins_profil_module')) {
			$this->module = new plugins_profil_module();
		}
        if(magixcjquery_filter_request::isPost('pseudo_pr')){
            $this->pseudo_pr = magixcjquery_form_helpersforms::inputClean($_POST['pseudo_pr']);
        }
        if(magixcjquery_filter_request::isPost('lastname_pr')){
            $this->lastname_pr = magixcjquery_form_helpersforms::inputClean($_POST['lastname_pr']);
        }
        if(magixcjquery_filter_request::isPost('firstname_pr')){
            $this->firstname_pr = magixcjquery_form_helpersforms::inputClean($_POST['firstname_pr']);
        }
        if(magixcjquery_filter_request::isPost('country_pr')){
            $this->country_pr = magixcjquery_form_helpersforms::inputClean($_POST['country_pr']);
        }
        if(magixcjquery_filter_request::isPost('phone_pr')){
            $this->phone_pr = magixcjquery_form_helpersforms::inputClean($_POST['phone_pr']);
        }
        if(magixcjquery_filter_request::isPost('street_pr')){
            $this->street_pr = magixcjquery_form_helpersforms::inputClean($_POST['street_pr']);
        }
        if(magixcjquery_filter_request::isPost('city_pr')){
            $this->city_pr = magixcjquery_form_helpersforms::inputClean($_POST['city_pr']);
        }
        if(magixcjquery_filter_request::isPost('postcode_pr')){
            $this->postcode_pr = magixcjquery_form_helpersforms::inputClean($_POST['postcode_pr']);
        }
        if(magixcjquery_filter_request::isPost('tva_pr')){
            $this->tva_pr = magixcjquery_form_helpersforms::inputClean($_POST['tva_pr']);
        }
        if(magixcjquery_filter_request::isPost('society_pr')){
            $this->society_pr = magixcjquery_form_helpersforms::inputClean($_POST['society_pr']);
        }
        if(magixcjquery_filter_request::isPost('cond_gen')){
            $this->cond_gen = magixcjquery_form_helpersforms::inputClean($_POST['cond_gen']);
        }
        if(magixcjquery_filter_request::isPost('signup_newsletter')){
            $this->signup_newsletter = magixcjquery_form_helpersforms::inputClean($_POST['signup_newsletter']);
        }
        if(magixcjquery_filter_request::isGet('email_pr')){
            $this->v_email = magixcjquery_filter_isVar::isMail($_GET['email_pr']);
        }
        if(magixcjquery_filter_request::isGet('pseudo_pr')){
            $this->v_pseudo = magixcjquery_form_helpersforms::inputClean($_GET['pseudo_pr']);
        }
        //CONNEXION
        if(magixcjquery_filter_request::isPost('hashtoken')){
            $this->hashtoken = magixcjquery_form_helpersforms::inputClean($_POST['hashtoken']);
        }
        if(magixcjquery_filter_request::isPost('email_pr')){
            $this->email_pr = magixcjquery_form_helpersforms::inputClean($_POST['email_pr']);
        }
        if(magixcjquery_filter_request::isPost('cryptkeypass_pr')){
            $this->cryptkeypass_pr = magixcjquery_form_helpersforms::inputClean(magixglobal_model_cryptrsa::hash_sha1($_POST['cryptkeypass_pr']));
        }
        if(magixcjquery_filter_request::isGet('pr_logout')){
            $this->pr_logout = magixcjquery_form_helpersforms::inputClean($_GET['pr_logout']);
        }
        //CHANGE PASSWORD
        if(magixcjquery_filter_request::isPost('new_cryptkeypass_pr')){
            $this->new_cryptkeypass_pr = magixcjquery_form_helpersforms::inputClean(magixglobal_model_cryptrsa::hash_sha1($_POST['new_cryptkeypass_pr']));
        }

        // Add links
        if(magixcjquery_filter_request::isPost('website_pr')){
            $this->website_pr = magixcjquery_form_helpersforms::inputClean($_POST['website_pr']);
            $this->post_link = true;
        }
        if(magixcjquery_filter_request::isPost('facebook_pr')){
            $this->facebook_pr = magixcjquery_form_helpersforms::inputClean($_POST['facebook_pr']);
            $this->post_link = true;
        }
        if(magixcjquery_filter_request::isPost('twitter_pr')){
            $this->twitter_pr = magixcjquery_form_helpersforms::inputClean($_POST['twitter_pr']);
            $this->post_link = true;
        }
        if(magixcjquery_filter_request::isPost('google_pr')){
            $this->google_pr = magixcjquery_form_helpersforms::inputClean($_POST['google_pr']);
            $this->post_link = true;
        }
        if(magixcjquery_filter_request::isPost('viadeo_pr')){
            $this->viadeo_pr = magixcjquery_form_helpersforms::inputClean($_POST['viadeo_pr']);
            $this->post_link = true;
        }
        if(magixcjquery_filter_request::isPost('linkedin_pr')){
            $this->linkedin_pr = magixcjquery_form_helpersforms::inputClean($_POST['linkedin_pr']);
            $this->post_link = true;
        }
        /**
         * Génnération d'une clé public unique pour servir d'identifiant
         * @return string
         */
        $this->keyuniqid_pr = magixglobal_model_cryptrsa::uuid_generator();
        //Global
        if(magixcjquery_filter_request::isGet('pstring1')){
            $this->pstring1 = magixcjquery_form_helpersforms::inputClean($_GET['pstring1']);
        }
        if(magixcjquery_filter_request::isGet('pstring2')){
            $this->pstring2 = magixcjquery_form_helpersforms::inputClean($_GET['pstring2']);
        }

        if(magixcjquery_filter_request::isGet('hashuri')){
            $this->hashuri = magixcjquery_form_helpersforms::inputClean($_GET['hashuri']);
        }
        if(magixcjquery_filter_request::isGet('action')){
            $this->action = magixcjquery_form_helpersforms::inputClean($_GET['action']);
        }
        if(magixcjquery_filter_request::isGet('subaction')){
            $this->subaction = magixcjquery_form_helpersforms::inputClean($_GET['subaction']);
        }
        //LOSTPASSWORD
        if(magixcjquery_filter_request::isPost('lo_email_pr')){
            $this->lo_email_pr = magixcjquery_filter_isVar::isMail($_POST['lo_email_pr']);
        }
        if(magixcjquery_filter_request::isGet('lostpassword')){
            $this->lostpassword = magixcjquery_form_helpersforms::inputClean($_GET['lostpassword']);
        }

        //session
        if(magixcjquery_filter_request::isSession('email_pr')){
            $this->email_pr_session = magixcjquery_form_helpersforms::inputClean($_SESSION['email_pr']);
        }
        if(magixcjquery_filter_request::isSession('keyuniqid_pr')){
            $this->keyuniqid_pr_session = magixcjquery_form_helpersforms::inputClean($_SESSION['keyuniqid_pr']);
        }
        if(magixcjquery_filter_request::isSession('idprofil')){
            $this->idprofil_session = magixcjquery_form_helpersforms::inputNumeric($_SESSION['idprofil']);
        }

        // Recipes
        if(magixcjquery_filter_request::isGet('edit')){
            $this->edit = magixcjquery_form_helpersforms::inputNumeric($_GET['edit']);
        }
        if(magixcjquery_filter_request::isGet('json')){
            $this->json = magixcjquery_form_helpersforms::inputClean($_GET['json']);
        }
        if(magixcjquery_filter_request::isPost('name_rcp')){
            $this->name_rcp = magixcjquery_form_helpersforms::inputClean($_POST['name_rcp']);
        }
        if(isset($_FILES['img_rcp']["name"])){
            $this->img_rcp = magixcjquery_url_clean::rplMagixString($_FILES['img_rcp']["name"]);
        }
        if(magixcjquery_filter_request::isPost('preparation_rcp')){
            $this->preparation_rcp = magixcjquery_form_helpersforms::inputClean($_POST['preparation_rcp']);
        }
        if(magixcjquery_filter_request::isPost('number_rcp')){
            $this->number_rcp = magixcjquery_form_helpersforms::inputClean($_POST['number_rcp']);
        }
        if(magixcjquery_filter_request::isPost('budget_rcp')){
            $this->budget_rcp = magixcjquery_form_helpersforms::inputClean($_POST['budget_rcp']);
        }
        if(magixcjquery_filter_request::isPost('preparation_rcp')){
            $this->preparation_rcp = magixcjquery_form_helpersforms::inputClean($_POST['preparation_rcp']);
        }
        if(magixcjquery_filter_request::isPost('level_rcp')){
            $this->level_rcp = magixcjquery_form_helpersforms::inputClean($_POST['level_rcp']);
        }
        if(magixcjquery_filter_request::isPost('content_rcp')){
            $this->content_rcp = magixcjquery_form_helpersforms::inputClean($_POST['content_rcp']);
        }
        if(magixcjquery_filter_request::isPost('statut_rcp')){
            $this->statut_rcp = magixcjquery_form_helpersforms::inputClean($_POST['statut_rcp']);
        }
        if(magixcjquery_filter_request::isPost('name_ing')){
            $this->name_ing = magixcjquery_form_helpersforms::inputClean($_POST['name_ing']);
        }
        if(isset($_FILES['img_rcp']["name"])){
            $this->img_rcp = magixcjquery_url_clean::rplMagixString($_FILES['img_rcp']["name"]);
        }
        //PRO
        if(magixcjquery_filter_request::isPost('period_sub')){
            $this->period_sub = magixcjquery_form_helpersforms::inputClean($_POST['period_sub']);
        }
        if(magixcjquery_filter_request::isPost('amount_sub')){
            $this->amount_sub = magixcjquery_form_helpersforms::inputClean($_POST['amount_sub']);
        }
        //global
        $this->template = new frontend_controller_plugins;
        // Google reCaptcha
        if(magixcjquery_filter_request::isPost('g-recaptcha-response')){
            $this->gRecaptchaResponse = magixcjquery_form_helpersforms::inputClean($_POST['g-recaptcha-response']);
        }
    }

	/**
	 *
	 */
	public function getform()
	{
		$this->template->configLoad();
		return $this->template->fetch('forms/order.tpl','profil');
    }

    // --- Session
    /**
     * clean old register 2 days
     * @access private
     * @return void
     */
    private function dbClean() {
        //On supprime les enregistrements de plus de deux jours
        $date = new DateTime('NOW');
        $date->modify('-1 day');
        $limit = $date->format('Y-m-d H:i:s');
        parent::delLastModified($limit);
    }

    /**
     * Open session
     * @param $idprofil
     * @param $session_id
     * @param $keyuniqid
     * @internal param $userid
     * @return true
     */
    private function openSession($idprofil,$session_id,$keyuniqid){
        $sessionRegister = new sessionRegister();
        parent::removeCurrent($idprofil);
        $this->dbClean();
        // Re-génération du sid
        $session_id;
        //On ajoute un nouvel identifiant de session dans la table
        if(parent::insertNewSessionId($idprofil,$sessionRegister->getIp(),$sessionRegister->getBrowser(),$keyuniqid)){
            return true;
        }

    }

    /**
     * close session
     * @return void
     */
    private function closeSession() {
        parent::deleteSessionSid(session_id());
    }

    /**
     * Compare la session avec une entrée session mysql
     * @return void
     */
    private function compareSessionId(){
        return parent::s_session();
    }

    // --- Utility
    /**
     * @access public
     * @static
     * Retourne le tableau des pays par défaut
     */
    public static function default_country(){
        $country = self::$default_country;
        asort($country,SORT_STRING);
        return $country;
    }

    /**
     * Réécriture des url pour la connexion des membres
     * @static
     * @param $lang
     * @param array $params
     * options = edit : root,config,ask,immo,subscription,capaigns,statistics
     * options = level : login, newlogin, logout
     * @return string
     * @throws Exception
     * @example
     * Classique URL
     * $options = array('level'=>'login');
     * EDIT URL
     * $options = array('hashuri'=>'fgdg4d564gdfg456dg5d4fgd56','edit'=>'config');
     * plugins_member_public::seoURLProfil('fr',$options)
     */
    public static function seoURLProfil($lang,array $params){
        if(is_array($params)){
            $options = $params;
            $baseurl = '/'.$lang.'/profil/';
            //$params = array('hashuri','fgdg4d564gdfg456dg5d4fgd56',edit=>'root');
            if(array_key_exists('hashuri',$options)){
                if($options['hashuri'] != null){
                    $basedit = $baseurl.$options['hashuri'].'/';
                    if(array_key_exists('action',$options)){
                        switch($options['action']){
                            case 'root':
                                $uri = $basedit;
                                break;
                            case 'logout':
                                $uri = $basedit.'action/logout/';
                                break;
                            default:
                                $uri = $basedit;
                                break;
                        }
                    }
                }else{
                    throw new Exception('Error seoURLProfil in Hashuri is null');
                }
            }else{
                //$params = array(level=>'login');
                switch($options['level']){
                    case 'login':
                        $uri = $baseurl.'login_redirect/';
                        break;
                    case 'signup':
                        $uri = $baseurl.'signup/';
                        break;
                    case 'activate':
                        $uri = $baseurl.'activate/';
                        break;
                    case 'newlogin':
                        $uri = $baseurl.'newlogin/';
                        break;
                    default:
                        $uri = $baseurl;
                        break;
                }
                //
            }
            if($lang != null){
                return $uri;
            }else{
                throw new Exception('Error seoURLProfil in language is not found');
            }
        }else{
            throw new Exception('Error seoURLProfil in params is not array');
        }
    }

    /**
     * Retourne le message de notification
     * @param $type
     * @param bool $display
     */
    private function getNotify($type,$display = true){
        $this->template->assign('message',$type);
        if($display){
            $this->template->display('message.tpl');
        }else{
            $fetch = $this->template->fetch('message.tpl');
            $this->template->assign('login_message',$fetch);
        }
    }

    // --- Authentification
    /**
     * Crypt md5
     * @param $hash
     * @return string
     */
    static protected function hashPassCreate($hash){
        return md5($hash);
    }

    /**
     * @access private
     * Initialisation du token de session
     */
    private function tokenInitSession(){
        if (empty($_SESSION['mc_profil_token'])){
            return $_SESSION['mc_profil_token'] = magixglobal_model_cryptrsa::tokenId();
        }else{
            if (isset($_SESSION['mc_profil_token'])){
                return $_SESSION['mc_profil_token'];
            }
        }
    }

    /**
     * @access private
     * Système de session pour la connexion
     * @param bool $debug
     */
    private function authSession($debug = false){
        $agtoken = isset($_SESSION['mc_profil_token']) ? $_SESSION['mc_profil_token'] : magixglobal_model_cryptrsa::tokenId();
        $tokentools =	$agtoken;// $this->hashPassCreate($cstoken);
        $this->template->assign('hashpass',$agtoken);
        if (isset($this->cryptkeypass_pr) AND isset($this->email_pr) AND isset($this->hashtoken)) {
            if(!empty($this->cryptkeypass_pr) OR $this->cryptkeypass_pr != null){
                if(strcasecmp($this->hashtoken,$agtoken) == 0){
                    if($debug){
                        $firebug = new magixcjquery_debug_magixfire();
                        $firebug->magixFireGroup('tokentest');
                        if($this->hashtoken){
                            if(strcasecmp($this->hashtoken,$tokentools) == 0){
                                $firebug->magixFireLog('session compatible');
                            }else{
                                $firebug->magixFireError('session incompatible');
                            }
                        }
                        //$firebug->magixFireLog($_SESSION);
                        $firebug->magixFireGroupEnd();
                        $session = new frontend_model_session();
                        $session->debug();
                    }
                    if(count(parent::accountExist($this->email_pr,$this->cryptkeypass_pr))){
                        $session = new frontend_model_session();
                        $session->_start_session('lang');
                        $dataProfil = parent::s_profil_by_mail($this->email_pr);

                        if (!isset($_SESSION['idprofil']) AND !isset($_SESSION['keyuniqid_pr'])) {
                            $session_regenere = session_regenerate_id(true);

                            $this->openSession($dataProfil['idprofil'],$session_regenere,$dataProfil['keyuniqid_pr']);
                            $array_sess = array(
                                'idprofil'      =>  $dataProfil['idprofil'],
                                'email_pr'      =>  $this->email_pr,
                                'keyuniqid_pr'  =>  $dataProfil['keyuniqid_pr']
                            );
                            $session->session_run($array_sess);

                            $current_uri = parent::s_profil_session($_SESSION['keyuniqid_pr']);
                            $hashuri = magixglobal_model_cryptrsa::hash_sha1($current_uri['idprofil_session']);
                            $uriparams = array('hashuri'=>$hashuri,'action'=>'root');
                             if(!headers_sent()) {
                                header('location: '. $this->seoURLProfil(frontend_model_template::current_Language(),$uriparams));
                                //header('location: '. magixcjquery_html_helpersHtml::getUrl().'/'.frontend_model_template::current_Language().'/wine/?for_sale=all');
                             }
                        }else{
                            $this->openSession($dataProfil['idprofil'],null,$dataProfil['keyuniqid_pr']);
                            $array_sess = array(
                                'idprofil'      =>  $dataProfil['idprofil'],
                                'email_pr'      =>  $this->email_pr,
                                'keyuniqid_pr'  =>  $dataProfil['keyuniqid_pr']
                            );
                            $session->session_run($array_sess);

                            $current_uri = parent::s_profil_session($_SESSION['keyuniqid_pr']);
                            $hashuri = magixglobal_model_cryptrsa::hash_sha1($current_uri['idprofil_session']);
                            $uriparams = array('hashuri'=>$hashuri,'action'=>'root');
                            if (!headers_sent()) {
                                header('location: '. $this->seoURLProfil(frontend_model_template::current_Language(),$uriparams));
                                //header('location: '. magixcjquery_html_helpersHtml::getUrl().'/'.frontend_model_template::current_Language().'/wine/?for_sale=all');
                            }
                        }
                    }else{
                        /**
                         * On retourne le template qui affiche l'erreur de login
                         * @var $fetch void
                         */
                        $this->getNotify('login_error',false);
                    }
                }else{
                    $this->getNotify('hash_error',false);
                }
            }
        }
    }

    /**
     * Sécurise l'espace membre
     */
    public function securePage(){
        //ini_set("session.cookie_lifetime",3600);
        $session = new frontend_model_session();
        $session->_start_session('lang');
        //$session->debug();
        if (!isset($_SESSION["email_pr"]) || empty($_SESSION['email_pr'])){
            if (!isset($this->email_pr)) {
                $uriparams = array('level'=>'login');
                if (!headers_sent()) {
                    header('location: '. $this->seoURLProfil(frontend_model_template::current_Language(),$uriparams));
                }
            }
        }elseif(!$this->compareSessionId()){
            $uriparams = array('level'=>'login');
            if (!headers_sent()) {
                header('location: '. $this->seoURLProfil(frontend_model_template::current_Language(),$uriparams));
            }
        }
    }

    /**
     * Ferme la session et supprime les cookies
     */
    private function closeCurrentSession(){
        if (isset($this->pstring2)) {
            if($this->pstring2 === 'logout'){
                if (isset($_SESSION['email_pr']) AND isset($_SESSION['keyuniqid_pr'])){
                    $this->closeSession();
                    session_unset();
                    $_SESSION = array();
                    session_destroy();
                    session_start();
                    $uriparams = array('level'=>'login');
                    header('location: '. $this->seoURLProfil(frontend_model_template::current_Language(),$uriparams));
                }
            }
        }
    }

    /**
     * Retourne L'url de l'espace membre ou du login suivant la session
     * @return string
     */
    public function hashUrl(){
        if(isset($this->keyuniqid_pr_session)){
            $current_uri = parent::s_profil_session($_SESSION['keyuniqid_pr']);
            $hashuri = magixglobal_model_cryptrsa::hash_sha1($current_uri['idprofil_session']);
            $uriparams = array('hashuri'=>$hashuri,'action'=>'root');
        }else{
            $uriparams = array('level'=>'login');
        }
        return $this->seoURLProfil(frontend_model_template::current_Language(),$uriparams);
    }
    // --- Signup

    /**
     * Validation des champs avant l'envoi
     */
    private function setValidateData(){
        //Controle des champs obligatoire, arrêt du script si null ou = à ''
        $data_validate = array(
            'lastname_pr','firstname_pr','email_pr','cryptkeypass_pr','cond_gen'
        );
        if($this->pseudo_required)
            $data_validate[] = 'pseudo_pr';
        foreach($data_validate as $input){
            if (!($_POST[$input]) OR $_POST[$input] == null OR $_POST[$input] == ''){
                $this->getNotify('empty');
                return;
            }else{
                return true;
            }
        }
    }

    /**
     * Envoi et nettoyage des données après validation
     * @param bool $debug
     * @return mixed
     */
    private function getValidateData($debug = false){
        if($debug){
            //Nettoyage des variable $_POST
            $data['firstname_pr']  =   "Aurelien";
            $data['lastname_pr']   =   "Gerits";
            $data['email_pr']      =   "test@mail.com";
            $data['phone_pr']      =   null;
            $data['street_pr']     =   null;
            $data['city_pr']       =   null;
            $data['postcode_pr']   =   null;
            $data['country_pr']    =   null;
            $data['tva_pr']        =   null;
            $data['society_pr']    =   null;
            $data['cryptkeypass_pr'] = "test";
            $data['keyuniqid_pr'] = $this->keyuniqid_pr;
            $data['cond_gen']      = "on";
            $data['newsletter'] = 0;

            if($this->pseudo_required)
                $data['pseudo_pr'] = "Aurelien";
        }else{
            //Nettoyage des variable $_POST
            $data['firstname_pr']  =   $this->firstname_pr;
            $data['lastname_pr']   =   $this->lastname_pr;
            $data['email_pr']      =   $this->email_pr;
            $data['phone_pr']      =   isset($this->phone_pr) ? $this->phone_pr : null;
            $data['street_pr']     =   isset($this->street_pr) ? $this->street_pr : null;
            $data['city_pr']       =   isset($this->city_pr) ? $this->city_pr : null;
            $data['postcode_pr']   =   isset($this->postcode_pr) ? $this->postcode_pr : null;
            $data['country_pr']    =   isset($this->country_pr) ? $this->country_pr : null;
            $data['tva_pr']        =   isset($this->tva_pr) ? $this->tva_pr : null;
            $data['society_pr']    =   isset($this->society_pr) ? $this->society_pr : null;
            $data['cond_gen']      =   isset($this->cond_gen) ? $this->cond_gen : null;
            $data['links']['website']       =   isset($this->website_pr) ? $this->website_pr : null;
            $data['links']['facebook']      =   isset($this->facebook_pr) ? $this->facebook_pr : null;
            $data['links']['twitter']       =   isset($this->twitter_pr) ? $this->twitter_pr : null;
            $data['links']['google']        =   isset($this->google_pr) ? $this->google_pr : null;
            $data['links']['viadeo']        =   isset($this->viadeo_pr) ? $this->viadeo_pr : null;
            $data['links']['linkedin']      =   isset($this->linkedin_pr) ? $this->linkedin_pr : null;
            $data['newsletter'] = isset($this->signup_newsletter) ? $this->signup_newsletter : 0;
            $data['cryptkeypass_pr'] = $this->cryptkeypass_pr;
            $data['new_cryptkeypass_pr'] = $this->new_cryptkeypass_pr;
            $data['keyuniqid_pr'] = $this->keyuniqid_pr;

            if($this->pseudo_required)
                $data['pseudo_pr'] = $this->pseudo_pr;
        }
        return $data;
    }

    /**
     * Retourne le tableau des données de configuration
     * @return array
     */
    public function getConfigData(){
        $config = parent::fetchConfig();
        return $config;
    }

    /**
     * @return array
     */
    private function dataRecaptcha(){
        // Register API keys at https://www.google.com/recaptcha/admin
        $data = $this->getConfigData();
        return $data;
    }

    /**
     * @throws Exception
     */
    private function setRecaptcha(){
        $data = $this->dataRecaptcha();
        if($data['google_recaptcha'] == '1'){
            if($data['recaptchaApiKey'] === NULL && $data['recaptchaSecret'] === NULL){
                $this->template->assign('googleRecaptcha',Null);
            }else{
                $this->template->assign('googleRecaptcha',$data);
            }
        }
    }

	/**
	 * @return bool
	 */
    private function getRecaptcha(){
        $data = $this->dataRecaptcha();
        if($data['google_recaptcha'] == '1') {
            if (isset($this->gRecaptchaResponse)) {
                // If the form submission includes the "g-captcha-response" field
                // Create an instance of the service using your secret
                $recaptcha = new \ReCaptcha\ReCaptcha($data['recaptchaSecret']);
                // Make the call to verify the response and also pass the user's IP address
                $resp = $recaptcha->verify($this->gRecaptchaResponse, $_SERVER['REMOTE_ADDR']);
                if ($resp->isSuccess()) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    /**
     * Set Signup subscriber
     * @param $data
     */
    private function setSignup($data){
        parent::i_signup($data, $this->pseudo_required);
        $this->getNotify('signup');
        $this->getSignupSendMail();

		if(!empty($this->activeMods)) {
			foreach ($this->activeMods as $name => $mod) {
				if(property_exists($mod,'newsletter')) {
					if (isset($this->signup_newsletter) && $this->signup_newsletter == "on") {
						if(method_exists($mod,'subscribe')) {
							$mod->subscribe($data['email_pr'], null, null, false);
						}
					}
				};
			}
		}
    }

    /**
     * Add signup profil
     */
    private function addSignup(){
        if($this->setValidateData()){
            $data = $this->getValidateData();
            $dataRecaptcha = $this->dataRecaptcha();
            if($dataRecaptcha['google_recaptcha'] == '1') {
                if ($this->getRecaptcha() == true) {
                    $this->setSignup($data);
                } else {
                    $this->getNotify('signup_error');
                }
            }else{
                $this->setSignup($data);
            }
        }
    }

    /**
     * Vérifife si l'adresse mail existe
     */
    private function getVerifyMail(){
        if(isset($this->v_email)){
            $data = parent::s_profil_by_mail($this->v_email);
            if($data['email_pr'] != null){
                print "false";
            }else{
                print "true";
            }
        }
    }

    /**
     * Vérifife si le pseudo existe
     */
    private function getVerifyPseudo(){
        if(isset($this->v_pseudo)){
            $data = parent::s_profil_by_pseudo($this->v_pseudo);
            if($data['pseudo_pr'] != null){
                print "false";
            }else{
                print "true";
            }
        }
    }

    // --- Mail Signup
    /**
     * @return string
     */
    private function setSignupMail(){
        $this->template->configLoad();
        //$title = $this->template->getConfigVars('titlemail_signup');
        $subject = $this->template->getConfigVars('subject_profil');
        $website = $this->template->getConfigVars('website');
        return sprintf($subject,$website);
    }

    /**
     * Charge le template contenant les données a recevoir dans le mail
     * @access private
     * @param bool $debug
     * @return string
     */
    private function getBodyMail($debug = false){
        if($debug){
            if(isset($this->pstring2)){
                $data = parent::verifyProfilKeyuniqid($this->pstring2);
                $account = $this->setAccountData($data['idprofil']);
                $this->template->assign('data', $account);
            }else{
                $this->template->assign('data',$this->getValidateData(true));
            }
            $this->template->display('mail/admin.tpl');
        }else{
            if(isset($this->pstring2)){
                $data = parent::verifyProfilKeyuniqid($this->pstring2);
                $account = $this->setAccountData($data['idprofil']);
                $this->template->assign('data', $account);
            }else{
                $this->template->assign('data',$this->getValidateData(false));
            }
            return $this->template->fetch('mail/admin.tpl');
        }
    }

    /**
     * Envoi du mail
     * Si return true retourne success.tpl
     * sinon retourne empty.tpl
     */
    private function getSignupSendMail($debug = false){
        if(isset($this->email_pr)){
            $this->template->configLoad();
            if(empty($this->lastname_pr)
                OR empty($this->firstname_pr)
                OR empty($this->email_pr)){
                $this->getNotify('empty');
            }else{
                $core_mail = new magixglobal_model_mail('mail');
                //Initialisation du contenu du message
                $message = $core_mail->body_mail(
                    self::setSignupMail(),
                    array($this->template->getConfigVars('mail_admin')),
                    array($this->email_pr),
                    self::getBodyMail(false),
                    false
                );
                $core_mail->batch_send_mail($message);
            }
        }elseif($debug){
            $this->template->assign('setTitleMail',$this->setSignupMail());
            $this->getBodyMail(true);
        }
    }

    // --- Validate
    /**
     * @return string
     */
    private function setValidateMail(){
        $this->template->configLoad();
        //$title = $this->template->getConfigVars('titlemail_signup');
        $subject = $this->template->getConfigVars('activate_profil');
        $website = $this->template->getConfigVars('website');
        return sprintf($subject,$website);
    }

    /**
     * Envoi du mail
     * Si return true retourne success.tpl
     * sinon retourne empty.tpl
     */
    private function getValidateSendMail($debug = false){
        $this->template->configLoad();
        if($debug){
            $this->template->assign('setTitleMail',$this->setValidateMail());
            $this->getBodyMail(true);
        }elseif(isset($this->pstring2)){
            $core_mail = new magixglobal_model_mail('mail');
            $data = parent::verifyProfilKeyuniqid($this->pstring2);
            if($data['idprofil'] != null){
                $account = $this->setAccountData($data['idprofil']);
                //print_r($account);
                //Initialisation du contenu du message
                $message = $core_mail->body_mail(
                    self::setValidateMail(),
                    array($this->template->getConfigVars('mail_admin')),
                    array($account['email']),
                    self::getBodyMail(false),
                    false
                );
                $core_mail->batch_send_mail($message);
            }
        }
    }

    /**
     *
     */
    private function setValidate(){
        $this->template->display('activate.tpl');
    }

    /**
     *
     */
    private function getValidate(){
        $data = parent::verifyProfilKeyuniqid($this->pstring2);
        if($data != null){
            parent::updateProfilValidation($this->pstring2);
        }
        $this->setValidate();
    }

    // --- New password
    /**
     * @return string
     */
    private function setPasswordMail(){
        $this->template->configLoad();
        $title = $this->template->getConfigVars('titlemail_password');
        $subject = $this->template->getConfigVars('renew_password');
        $website = $this->template->getConfigVars('website');
        return sprintf($title,$subject,$website);
    }

    /**
     * Charge le template contenant les données a recevoir dans le mail
     * @access private
     * @param $data
     * @param bool $debug
     * @return string
     * @throws Exception
     */
    private function getPasswordBodyMail($data, $debug){
        if($debug){
            $this->template->assign('data', $data);
            $this->template->display('mail/admin.tpl');
        }else{
            $this->template->assign('data', $data);
            return $this->template->fetch('mail/admin.tpl');
        }
    }

    /**
     * @param $data
     * @param bool $debug
     */
    private function sendNewPassword($data,$debug){
        $this->template->configLoad();
        if($debug){
            self::getPasswordBodyMail($data,true);
        }elseif(isset($this->lo_email_pr)){
            $core_mail = new magixglobal_model_mail('mail');
            //Initialisation du contenu du message
            $message = $core_mail->body_mail(
                self::setPasswordMail(),
                array($this->template->getConfigVars('mail_admin')),
                array($this->lo_email_pr),
                self::getPasswordBodyMail($data,false),
                false
            );
            $core_mail->batch_send_mail($message);
        }
    }

    /**
     * @param bool $debug
     */
    private function createNewPassword($debug = false){
        if($debug){
            if(isset($this->lostpassword) && isset($_GET['testmail'])){
                $profil = parent::s_profil_by_mail($_GET['testmail']);
                if($profil!= null){
                    $cryptpass = magixglobal_model_cryptrsa::short_alphanumeric_id(8);
                    $data = array(
                        'password'  =>  $cryptpass,
                        'email'     =>  $profil['email_pr']
                    );
                    $this->sendNewPassword($data,$debug);
                }
            }
        }else{
            if(isset($this->lo_email_pr)){
                if(empty($this->lo_email_pr)){
                    $this->getNotify('empty');
                }else{
                    $profil = parent::s_profil_by_mail($this->lo_email_pr);
                    if($profil!= null){
                        $cryptpass = magixglobal_model_cryptrsa::short_alphanumeric_id(8);
                        $data = array(
                            'password'  =>  $cryptpass,
                            'email'     =>  $profil['email_pr']
                        );

                        $this->sendNewPassword($data,false);
                        parent::u_dataPassword(
                            $profil['idprofil'],
                            magixglobal_model_cryptrsa::hash_sha1($data['password'])
                        );
                        $this->getNotify('new_password_success');
                    }else{
                        $this->getNotify('new_password_error');
                    }
                }
            }
        }

    }

    // --- Account
    /**
     * Retourne un tableau des données du client
     * @param $id
     * @return array
     */
    public function setAccountData($id){
        $data = parent::selectOneAccount($id);
        return array(
            'pseudo'        =>  $data['pseudo_pr'],
            'lastname'      =>  $data['lastname_pr'],
            'firstname'     =>  $data['firstname_pr'],
            'email'         =>  $data['email_pr'],
            'country'       =>  $data['country_pr'],
            'street'        =>  $data['street_pr'],
            'city'          =>  $data['city_pr'],
            'postcode'      =>  $data['postcode_pr'],
            'phone'         =>  $data['phone_pr'],
            'tva'           =>  $data['tva_pr'],
            'society'       =>  $data['society_pr'],
            'website' => $data['website'],
            'facebook' => $data['facebook'],
            'twitter' => $data['twitter'],
            'google' => $data['google'],
            'viadeo' => $data['viadeo'],
            'linkedin' => $data['linkedin'],
            'keyuniqid'     =>  $data['keyuniqid_pr']
        );
    }

    /**
     * Assign le tableau de données pour modification
     */
    public function getAccountData(){
        $data = $this->setAccountData($this->idprofil_session);
        $this->template->assign('dataAccount', $data, true);
    }

    /**
     * Sauvegarde les données du client
     */
    private function save(){
        $data = $this->getValidateData();

        if($this->new_cryptkeypass_pr){
            if(isset($this->cryptkeypass_pr)){
                if(parent::verifyPassword($this->idprofil_session,$data['cryptkeypass_pr']) != null){
                    parent::u_dataPassword($this->idprofil_session, $data['new_cryptkeypass_pr']);
                }
            }
        } else if($this->post_link) {
            parent::u_dataLinks($this->idprofil_session,$data['links']);
        } else {
            parent::u_account(
                $this->idprofil_session,
                $data,
                $this->pseudo_required
            );
        }
        $this->getNotify('update');
    }

    /**
     * Execute le plugin dans la partie public
     */
    public function run(){
        $modelSystem = new magixglobal_model_system();
        frontend_model_template::addConfigFile(
            array(
                $modelSystem->base_path().'plugins/profil/i18n/tools'
            ),
            array(
                'country_',
            )
            ,false
        );
        $create = frontend_controller_plugins::create();
        $create->configLoad();
        $session = new frontend_model_session();

		if(isset($this->module)) {
			$this->activeMods = $this->module->load_module(false);
		}

        if(isset($this->pstring1)){
            if($this->pstring1 === 'login_redirect'){
                $session->_start_session('lang');
                $this->tokenInitSession();
                $this->authSession();
                $this->template->display('login.tpl');
            }elseif($this->pstring1 === 'signup'){
                if(isset($_GET['testmail'])){
                    $this->getSignupSendMail(true);
                }elseif(isset($this->email_pr)){
                    $this->addSignup();
                }elseif(isset($this->v_email)){
                    $this->getVerifyMail();
                }elseif(isset($this->v_pseudo)){
                    $this->getVerifyPseudo();
                }else{
                    $this->setRecaptcha();
                    $this->template->assign('countryTools',$this->default_country());
                    $this->template->assign('pseudo_required',$this->pseudo_required);

					$newsletter = false;
					if(!empty($this->activeMods)) {
						foreach ($this->activeMods as $name => $mod) {
							if(property_exists($mod,'newsletter')) $newsletter = $mod->newsletter;
						}
					}
					$this->template->assign('newsletter',$newsletter);
                    $this->template->display('signup.tpl');
                }
            }elseif($this->pstring1 === 'activate'){
                if($this->pstring2){
                    if(isset($_GET['testmail'])){
                        $this->getValidateSendMail(true);
                    }else{
                        $this->getValidateSendMail(false);
                        $this->getValidate();
                    }
                }
            }elseif($this->pstring1 === 'lostpassword'){
                $this->createNewPassword(false);
            }else{
                $this->securePage();
                $array_sess = array(
                    'idprofil'      =>  $_SESSION['idprofil'],
                    'keyuniqid_pr'  =>  $_SESSION['keyuniqid_pr'],
                    'email_pr'      =>  $_SESSION['email_pr']
                );
                $session->session_run($array_sess);
                //$session->debug();
                if(isset($this->keyuniqid_pr_session)){
                    $getConfigData = $this->getConfigData();
                    $this->template->assign('getConfigData',$getConfigData);
                    if(isset($this->pstring2)){
                        switch($this->pstring2){
                            case 'order':
                                $cartpay = new plugins_cartpay_public();
                                $this->template->assign('getCartData',$cartpay->setProfilOrder($_SESSION['idprofil']));
                                $this->template->display('order.tpl');
                                break;
                            case 'logout':
                                $this->closeCurrentSession();
                                break;
                        }
                    }else{
                        if(isset($this->lastname_pr) OR isset($this->cryptkeypass_pr) OR isset($this->post_link)){
                            $this->save();
                        }else{
                            $this->getAccountData();
                            $this->template->assign('countryTools',$this->default_country());
                            $this->template->assign('pseudo_required',$this->pseudo_required);
                            $this->template->display('index.tpl');
                        }
                    }
                }
            }
        }
    }
}