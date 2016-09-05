<?php
/**
 * Created by PhpStorm.
 * User: aurelien
 * Date: 3/06/14
 * Time: 13:35
 */

require_once('db/profil.php');

class plugins_profil_admin extends database_plugins_profil{
    /**
     * template
     */
    protected $header, $template, $message, $module, $activeMods, $cartpayModule, $country;
    public static $notify = array('plugin' => 'true');

    /**
     * data
     */
    public $keyuniqid_pr,
        $pseudo_pr,
        $lastname_pr,
        $firstname_pr,
        $email_pr,
        $country_pr,
        $phone_pr,
        $street_pr,
        $city_pr,
        $postcode_pr,$website_pr,$facebook_pr,$twitter_pr,$google_pr,$viadeo_pr,$linkedin_pr,
        $active_account,$google_recaptcha,$recaptchaApiKey,$recaptchaSecret,$cartpay,$links;
    // getpage
    public $action,$edit,$tab,$plugin,$getpage,$delete;

    /**
     * construct
     */
    public function __construct(){
        if (class_exists('backend_model_message')) {
            $this->message = new backend_model_message();
        }
		if (class_exists('plugins_profil_cartpay')) {
			$this->cartpayModule = new plugins_profil_cartpay();
		}
		if(class_exists('plugins_profil_module')) {
			$this->module = new plugins_profil_module();
		}
		$this->template = new backend_controller_plugins();
        $this->translation = new backend_controller_template();
        $this->country = new backend_controller_country();
        // ACTION
        if(magixcjquery_filter_request::isGet('action')){
            $this->action = magixcjquery_form_helpersforms::inputClean($_GET['action']);
        }
        if(magixcjquery_filter_request::isGet('edit')){
            $this->edit = magixcjquery_form_helpersforms::inputNumeric($_GET['edit']);
        }
        if (magixcjquery_filter_request::isGet('tab')) {
            $this->tab = magixcjquery_form_helpersforms::inputClean($_GET['tab']);
        }
        if (magixcjquery_filter_request::isGet('edit')) {
            $this->edit = magixcjquery_filter_isVar::isPostNumeric($_GET['edit']);
        }

        if (magixcjquery_filter_request::isGet('plugin')) {
            $this->plugin = magixcjquery_form_helpersforms::inputClean($_GET['plugin']);
        }
        // EDIT
        if(magixcjquery_filter_request::isPost('lastname_pr')){
            $this->lastname_pr = magixcjquery_form_helpersforms::inputClean($_POST['lastname_pr']);
        }
        if(magixcjquery_filter_request::isPost('pseudo_pr')){
            $this->pseudo_pr = magixcjquery_form_helpersforms::inputClean($_POST['pseudo_pr']);
        }
        if(magixcjquery_filter_request::isPost('firstname_pr')){
            $this->firstname_pr = magixcjquery_form_helpersforms::inputClean($_POST['firstname_pr']);
        }
        if(magixcjquery_filter_request::isPost('email_pr')){
            $this->email_pr = magixcjquery_form_helpersforms::inputClean($_POST['email_pr']);
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
        if(magixcjquery_filter_request::isPost('country_pr')){
            $this->country_pr = magixcjquery_form_helpersforms::inputClean($_POST['country_pr']);
        }
        if(magixcjquery_filter_request::isPost('active_account')){
            $this->active_account = magixcjquery_form_helpersforms::inputNumeric($_POST['active_account']);
        }
        //GET
        if(magixcjquery_filter_request::isGet('page')) {
            // si numéric
            if(is_numeric($_GET['page'])){
                $this->getpage = intval($_GET['page']);
            }else{
                // Sinon retourne la première page
                $this->getpage = 1;
            }
        }else {
            $this->getpage = 1;
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
        // $website_pr,$facebook_pr,$twitter_pr,$google_pr,$viadeo_pr,$linkedin_pr
        if(magixcjquery_filter_request::isPost('delete')){
            $this->delete = magixcjquery_form_helpersforms::inputNumeric($_POST['delete']);
        }
        //Configuration
        if (magixcjquery_filter_request::isPost('google_recaptcha')) {
            $this->google_recaptcha = 1;
        }
        if(magixcjquery_filter_request::isPost('recaptchaApiKey')){
            $this->recaptchaApiKey = magixcjquery_form_helpersforms::inputClean($_POST['recaptchaApiKey']);
        }
        if(magixcjquery_filter_request::isPost('recaptchaSecret')){
            $this->recaptchaSecret = magixcjquery_form_helpersforms::inputClean($_POST['recaptchaSecret']);
        }
        if (magixcjquery_filter_request::isPost('cartpay')) {
            $this->cartpay = 1;
        }
        if (magixcjquery_filter_request::isPost('links')) {
            $this->links = 1;
        }
    }

	/**
	 * @access private
	 * Installing mysql database plugin
	 */
	private function install_table()
	{
		if (parent::c_show_tables() == 0) {
			$this->template->db_install_table('db.sql', 'request/install.tpl');
		} else {
			if(class_exists('plugins_cartpay_admin')) {
				$this->cartpayModule->register();
			}
			return true;
		}
	}

    /**
     * offset for pager in pagination
     * @param $max
     * @return int
     */
    private function offsetPager($max){
        $pagination = new magixcjquery_pager_pagination();
        return $pagination->pageOffset($max,$this->getpage);
    }

    /**
     * Construction de la pagination
     * @param $limit
     * @return null|string
     */
    private function paginationList($limit){
        $dbcatalog = parent::s_count_profil();
        $total = $dbcatalog['total'];
        // *** Set pagination
        $dataPager = null;
        if (isset($total) AND isset($limit)) {
            $lib_rewrite = new magixglobal_model_rewrite();
            $basePath = $this->template->pluginUrl().'&amp;';
            $dataPager = magixglobal_model_pager::setPaginationData(
                $total,
                $limit,
                $basePath,
                $this->getpage,
                '='
            );
            $pagination = null;
            if ($dataPager != null) {
                $pagination = '<ul class="pagination">';
                foreach ($dataPager as $row) {
                    switch ($row['name']){
                        case 'first':
                            $name = '<<';
                            break;
                        case 'previous':
                            $name = '<';
                            break;
                        case 'next':
                            $name = '>';
                            break;
                        case 'last':
                            $name = '>>';
                            break;
                        default:
                            $name = $row['name'];
                    }
                    $classItem = ($name == $this->getpage) ? ' class="active"' : null;
                    $pagination .= '<li'.$classItem.'>';
                    $pagination .= '<a href="'.$row['url'].'" title="'.$name.'" >';
                    $pagination .= $name;
                    $pagination .= '</a>';
                    $pagination .= '</li>';
                }
                $pagination .= '</ul>';
            }
            unset($total);
            unset($limit);
        }
        return $pagination;
    }
    /**
     * @param $arraySource
     * @param $keys
     * @return array
     */
    public function arrayChangeKeys($arraySource, $keys)
    {
        $newArray = array();
        foreach($arraySource as $key => $value)
        {
            $k = (array_key_exists($key, $keys)) ? $keys[$key] : $key;
            $v = ((is_array($value))) ? $this->arrayChangeKeys($value, $keys) : $value;
            $newArray[$k] = $v;
        }
        return $newArray;
    }
    /**
     * @param $row
     * @return array
     */
    public function setItemData ($row)
    {
        $data = null;
        $newData = array();
        foreach($row as $key => $value){
            $newData[$key]['id'] = $value['idprofil'];
            $newData[$key]['pseudo'] = $value['pseudo_pr'];
            $newData[$key]['lastname'] = $value['lastname_pr'];
            $newData[$key]['firstname'] = $value['firstname_pr'];
            $newData[$key]['email'] = $value['email_pr'];
            $newData[$key]['active_account'] = $value['active_account'];
        }
        return $newData;
    }

    /**
     * @param $max
     * @return array
     */
    private function getItemData($max){
        $limit = $max;
        $offset = $this->offsetPager($max);
        $data = parent::s_profil($limit,$max,$offset);
        return $this->setItemData($data);
    }
    /**
     * @param $max
     */
    private function setProfilData($max){
        $row = $this->getItemData($max);
        $pagination = $this->paginationList($max);
        $this->template->assign('pagination',$pagination);
        $this->template->assign('getProfilData',$row);
        /**/
    }
    //Account
    /**
     * Retourne un tableau des données du profil
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
            'website'       => $data['website'],
            'facebook'      => $data['facebook'],
            'twitter'       => $data['twitter'],
            'google'        => $data['google'],
            'viadeo'        => $data['viadeo'],
            'linkedin'      => $data['linkedin'],
            'active'        =>  $data['active_account']
        );
    }
    /**
     * Assign le tableau de données pour modification
     */
    public function getAccountData(){
        $data = $this->setAccountData($this->edit);
        $this->template->assign('dataAccount', $data, true);
    }
    /**
     * @return mixed
     */
    private function getValidateData(){
        //Nettoyage des variable $_POST
        $data['pseudo_pr']     =   $this->pseudo_pr;
        $data['firstname_pr']  =   $this->lastname_pr;
        $data['lastname_pr']   =   $this->firstname_pr;
        $data['email_pr']      =   $this->email_pr;
        $data['phone_pr']      =   $this->phone_pr;
        $data['street_pr']     =   $this->street_pr;
        $data['city_pr']       =   $this->city_pr;
        $data['postcode_pr']   =   $this->postcode_pr;
        $data['country_pr']    =   $this->country_pr;
        $data['website']       =   isset($this->website_pr) ? $this->website_pr : null;
        $data['facebook']      =   isset($this->facebook_pr) ? $this->facebook_pr : null;
        $data['twitter']       =   isset($this->twitter_pr) ? $this->twitter_pr : null;
        $data['google']        =   isset($this->google_pr) ? $this->google_pr : null;
        $data['viadeo']        =   isset($this->viadeo_pr) ? $this->viadeo_pr : null;
        $data['linkedin']      =   isset($this->linkedin_pr) ? $this->linkedin_pr : null;
        $data['active_account'] =  $this->active_account;
        return $data;
    }
    /**
     * Retourne le message de notification
     * @param $type
     */
    private function getNotify($type){
        $this->template->assign('message',$type);
        $this->template->display('message.tpl');
    }
    /**
     * Sauvegarde les données du client
     */
    private function savePr(){
        $data = $this->getValidateData();
        //print $this->edit;
        //print_r($data);
        parent::u_data(
            $this->edit,
            $data['pseudo_pr'],
            $data['lastname_pr'],
            $data['firstname_pr'],
            $data['email_pr'],
            $data['country_pr'],
            $data['street_pr'],
            $data['city_pr'],
            $data['postcode_pr'],
            $data['phone_pr'],
            $data['website'],
            $data['facebook'],
            $data['twitter'],
            $data['google'],
            $data['viadeo'],
            $data['linkedin'],
            $data['active_account']
        );
        $this->message->getNotify('update',self::$notify);
    }
    /**
     * Suppression d'un profil
     */
    private function remove(){
        if(isset($this->delete)){
            parent::d_profil($this->delete);
        }
    }
    /* ################# CONFIG ###################*/
    /**
     * Retourne le tableau des données de configuration
     * @return array
     */
    private function getConfigData(){
        $config = parent::fetchConfig();
        return $config;
    }
    /**
     * @return array
     */
    private function setPostConfig(){
        $data = $this->getConfigData();
        if($data['idprofil_config'] != null){
            $edit = $data['idprofil_config'];
        }else{
            $edit = false;
        }
        if(!isset($this->google_recaptcha)){
            $google_recaptcha = '0';
        }else{
            $google_recaptcha = $this->google_recaptcha;
        }
        if(!isset($this->links)){
            $links = '0';
        }else{
            $links = $this->links;
        }
        if(!isset($this->cartpay)){
            $cartpay = '0';
        }else{
            $cartpay = $this->cartpay;
        }
        /**
         *
         */
        return array(
            'edit'              =>  $edit,
            'fetch'             =>  'config',
            'google_recaptcha'  =>  $google_recaptcha,
            'recaptchaApiKey'   =>  (!empty($this->recaptchaApiKey))? $this->recaptchaApiKey: NULL,
            'recaptchaSecret'   =>  (!empty($this->recaptchaSecret))? $this->recaptchaSecret: NULL,
            'links'             =>  $links,
            'cartpay'           =>  $cartpay
        );
    }
    /* ########### Global ##############*/
    /**
     * @param $data
     */
    private function add($data){
        parent::insert($data);
    }

    /**
     * @param $data
     */
    private function update($data){
        parent::uData($data);
    }

    /**
     * @param $data
     */
    private function save($data,$action){
        if($action == 'update'){
            $this->update($data);
            $this->message->getNotify('update',self::$notify);
        }else{
            $this->add($data);
            $this->message->getNotify('add',self::$notify);
        }
    }
    /**
     *
     */
    public function run(){
        if(self::install_table() == true){
			if(isset($this->module)) {
				$this->activeMods = $this->module->load_module(true);
			}
            $this->translation->addConfigFile(
                array(
                    'country/tools'
                ),array(
                    'country_iso_',
                ),false
            );
            if($this->tab == 'config'){
                if(isset($this->action)){
                    if($this->action === 'update'){
                        $this->save(
                            $this->setPostConfig(),
                            'update'
                        );
                    }
                }else{
                    $this->template->assign('getDataConfig',$this->getConfigData());
                    $this->template->display('config.tpl');
                }
            }else{
                if(isset($this->action)){
                    if($this->action === 'edit'){
                        if(isset($this->active_account)){
                            $this->savePr();
                        }else{
                            $this->getAccountData();
                            $this->template->assign('countryTools',$this->country->setItemsData());
                            $this->template->display('edit.tpl');
                        }
                    }elseif($this->action === 'remove'){
                        $this->remove();
                    }
                }else{
                    $this->setProfilData(30);
                    $this->template->display('list.tpl');
                }
            }
        }
    }

    /**
     * @return array
     */
    public function setConfig()
    {
        return array(
            'url' => array(
                'lang' => 'none',
                'action' => '',
                'name' => 'Profils'
            ),
            'icon' => array(
                'type' => 'font',
                'name' => 'fa fa-users'
            )
        );
    }
}