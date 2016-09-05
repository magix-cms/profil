<?php
/*
 # -- BEGIN LICENSE BLOCK ----------------------------------
 #
 # This file is part of MAGIX CMS.
 # MAGIX CMS, The content management system optimized for users
 # Copyright (C) 2008 - 2016 magix-cms.com support[at]magix-cms[point]com
 #
 # OFFICIAL TEAM :
 #
 #   * Gerits Aurelien (Author - Developer) <aurelien@magix-cms.com> <contact@aurelien-gerits.be>
 #
 # Redistributions of files must retain the above copyright notice.
 # This program is free software: you can redistribute it and/or modify
 # it under the terms of the GNU General Public License as published by
 # the Free Software Foundation, either version 3 of the License, or
 # (at your option) any later version.
 #
 # This program is distributed in the hope that it will be useful,
 # but WITHOUT ANY WARRANTY; without even the implied warranty of
 # MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 # GNU General Public License for more details.

 # You should have received a copy of the GNU General Public License
 # along with this program.  If not, see <http://www.gnu.org/licenses/>.
 #
 # -- END LICENSE BLOCK -----------------------------------

 # DISCLAIMER

 # Do not edit or add to this file if you wish to upgrade MAGIX CMS to newer
 # versions in the future. If you wish to customize MAGIX CMS for your
 # needs please refer to http://www.magix-cms.com for more information.
 */
class database_plugins_profil
{
	/**
	 * Checks if the tables of the plugins are installed
	 * @access protected
	 * return integer
	 */
	protected function c_show_tables(){
		$tables = array(
			'mc_plugins_profil',
			'mc_plugins_profil_session',
			'mc_plugins_profil_config',
			'mc_plugins_profil_module'
		);

		$i = 0;
		do {
			$t = magixglobal_model_db::layerDB()->showTable($tables[$i]);
			$i++;
		} while($t && $i < count($tables));

		return $t;
	}

	/**
	 * Checks if the requested table is installed
	 * @param $t
	 * @return integer
	 */
	protected function c_show_table($t){
		return magixglobal_model_db::layerDB()->showTable($t);
	}

	// --- Plugin Configuration
	/**
	 * @return array
	 */
	protected function fetchConfig(){
		$query = "SELECT *
                      FROM mc_plugins_profil_config";
		return magixglobal_model_db::layerDB()->selectOne($query);
	}

	/**
	 * @param $data
	 */
	protected function insert($data){
		if(is_array($data)){
			if (array_key_exists('fetch', $data)) {
				$fetch = $data['fetch'];
			} else {
				$fetch = 'config';
			}
			if($fetch == 'config') {
				$sql = 'INSERT INTO mc_plugins_profil_config (google_recaptcha,recaptchaApiKey,recaptchaSecret,links,cartpay)
		        VALUE(:google_recaptcha,:recaptchaApiKey,:recaptchaSecret,:links,:cartpay)';
				magixglobal_model_db::layerDB()->insert($sql,
					array(
						'google_recaptcha'  => $data['google_recaptcha'],
						'recaptchaApiKey'   => $data['recaptchaApiKey'],
						'recaptchaSecret'   => $data['recaptchaSecret'],
						'links'             => $data['links'],
						'cartpay'           => $data['cartpay']
					)
				);
			}
		}
	}

	/**
	 * @param $data
	 */
	protected function uData($data){
		if(is_array($data)){
			if (array_key_exists('fetch', $data)) {
				$fetch = $data['fetch'];
			} else {
				$fetch = 'config';
			}
			if($fetch == 'config') {
				$sql = 'UPDATE mc_plugins_profil_config
                SET google_recaptcha=:google_recaptcha,recaptchaApiKey=:recaptchaApiKey,recaptchaSecret=:recaptchaSecret,links=:links,cartpay=:cartpay
                WHERE idprofil_config=:edit';
				magixglobal_model_db::layerDB()->update($sql,
					array(
						':edit'             => $data['edit'],
						'google_recaptcha'  => $data['google_recaptcha'],
						'recaptchaApiKey'   => $data['recaptchaApiKey'],
						'recaptchaSecret'   => $data['recaptchaSecret'],
						'links'             => $data['links'],
						'cartpay'           => $data['cartpay']
					));
			}
		}
	}

	// --- Profil
	/**
	 * Compte le nombre de profil
	 * @return array
	 */
	protected function s_count_profil(){
		$sql = 'SELECT count(profil.idprofil) AS total
		FROM mc_plugins_profil AS profil';
		return magixglobal_model_db::layerDB()->selectOne($sql);
	}

	/**
	 * Retourne les profils suivant la pagination
	 * @param int $limit
	 * @param null $max
	 * @param null $offset
	 * @return array
	 */
	protected function s_profil($limit=5,$max=null,$offset=null){
		$limit = $limit ? ' LIMIT '.$max : '';
		$offset = !empty($offset) ? ' OFFSET '.$offset: '';
		$sql='SELECT *
        FROM mc_plugins_profil AS profil
        ORDER BY profil.date_create_pr DESC'.$limit.$offset;
		return magixglobal_model_db::layerDB()->select($sql);
	}

	// --- Edit Profil
	/**
	 * Modification des données
	 * @param $idprofil
	 * @param $pseudo_pr
	 * @param $lastname_pr
	 * @param $firstname_pr
	 * @param $email_pr
	 * @param $country_pr
	 * @param $street_pr
	 * @param $city_pr
	 * @param $postcode_pr
	 * @param $phone_pr
	 * @param $active_account
	 */
	protected function u_data($idprofil,$pseudo_pr,$lastname_pr,$firstname_pr,$email_pr,$country_pr,$street_pr,$city_pr,$postcode_pr,$phone_pr,$website,$facebook,$twitter,$google,$viadeo,$linkedin,$active_account){
		$sql = 'UPDATE mc_plugins_profil
        SET pseudo_pr=:pseudo_pr,lastname_pr=:lastname_pr,firstname_pr=:firstname_pr,email_pr=:email_pr,
        country_pr=:country_pr,street_pr=:street_pr,city_pr=:city_pr,
        postcode_pr=:postcode_pr,phone_pr=:phone_pr,website = :website,
                facebook = :facebook,
                twitter = :twitter,
                google = :google,
                viadeo = :viadeo,
                linkedin = :linkedin,
                active_account=:active_account
        WHERE idprofil=:idprofil';
		magixglobal_model_db::layerDB()->update($sql,
			array(
				':idprofil'         =>  $idprofil,
				':pseudo_pr'        =>  $pseudo_pr,
				':lastname_pr'      =>  $lastname_pr,
				':firstname_pr'     =>  $firstname_pr,
				':email_pr'         =>  $email_pr,
				':country_pr'       =>  $country_pr,
				':street_pr'        =>  $street_pr,
				':city_pr'          =>  $city_pr,
				':postcode_pr'      =>  $postcode_pr,
				':phone_pr'         =>  $phone_pr,
				':website'      => $website,
				':facebook'     => $facebook,
				':twitter'      => $twitter,
				':google'       => $google,
				':viadeo'       => $viadeo,
				':linkedin'     => $linkedin,
				':active_account'   =>  $active_account
			));
	}

	/**
	 * @access protected
	 * @param integer $idprofil
	 */
	protected function d_profil($idprofil){
		$sql = 'DELETE FROM mc_plugins_profil WHERE idprofil = :idprofil';
		magixglobal_model_db::layerDB()->delete($sql,array(
			':idprofil'	=>	$idprofil
		));
	}

	// --- Session
	/**
	 * connexion des membres ou vérification du membre
	 * @access protected
	 * @param $email_pr
	 * @param $cryptkeypass_pr
	 * @return array
	 */
	protected function accountExist($email_pr, $cryptkeypass_pr){
		$sql='SELECT idprofil
		FROM mc_plugins_profil
		WHERE email_pr = :email_pr AND cryptkeypass_pr = :cryptkeypass_pr AND active_account=1';
		return magixglobal_model_db::layerDB()->select($sql,
			array(
				':email_pr'=> $email_pr,
				':cryptkeypass_pr' => $cryptkeypass_pr
			)
		);
	}

	/**
	 * Retourne la session du profil via la clé
	 * @param $keyuniqid_pr
	 * @return array
	 */
	protected function s_profil_session($keyuniqid_pr){
		$sql = 'SELECT *
        FROM mc_plugins_profil_session
		WHERE keyuniqid_pr = :keyuniqid_pr';
		return magixglobal_model_db::layerDB()->selectOne($sql,
			array(
				':keyuniqid_pr' => $keyuniqid_pr
			)
		);
	}

	/**
	 * deletes the current session id
	 * @param $idprofil
	 * @return void
	 */
	protected function removeCurrent($idprofil){
		$sql = 'DELETE FROM mc_plugins_profil_session
		WHERE idprofil = :idprofil';
		magixglobal_model_db::layerDB()->delete($sql,
			array(
				':idprofil'=> $idprofil

			)
		);
	}

	/**
	 * inserts a new session identifier
	 * @param $idprofil
	 * @param $ip_session
	 * @param $browser_session
	 * @param $keyuniqid_pr
	 */
	protected function insertNewSessionId($idprofil,$ip_session,$browser_session,$keyuniqid_pr){
		$sql = 'INSERT INTO mc_plugins_profil_session (idprofil_session,idprofil,ip_session,browser_session,keyuniqid_pr)
		VALUE (:idprofil_session,:idprofil,:ip_session,:browser_session,:keyuniqid_pr)';
		magixglobal_model_db::layerDB()->insert($sql,
			array(
				':idprofil_session'=> session_id(),
				':idprofil'=> $idprofil,
				':ip_session'=> $ip_session,
				':browser_session' => $browser_session,
				':keyuniqid_pr' => $keyuniqid_pr
			));
	}

	/**
	 * delete lastest modified max 2 days
	 * @param $limit
	 * @return void
	 */
	protected function delLastModified($limit){
		$sql = 'DELETE FROM mc_plugins_profil_session
		WHERE TO_DAYS(DATE_FORMAT(NOW(), "%Y%m%d")) - TO_DAYS(DATE_FORMAT(last_modified_session, "%Y%m%d"))
		> :limit';
		magixglobal_model_db::layerDB()->delete($sql,
			array(
				':limit'=>$limit
			)
		);
	}

	/**
	 * delete session where sid
	 * @param $idprofil_session
	 * @return void
	 */
	protected function deleteSessionSid($idprofil_session){
		$sql = 'DELETE FROM mc_plugins_profil_session
		WHERE idprofil_session = :idprofil_session';
		magixglobal_model_db::layerDB()->delete($sql,
			array(
				':idprofil_session'=>$idprofil_session
			)
		);
	}

	/**
	 * récupère la session utilisateur via la session actuelle
	 * @return void
	 */
	protected function s_session(){
		$sql = 'SELECT *
		FROM mc_plugins_profil_session
		WHERE idprofil_session = :idprofil_session';
		return magixglobal_model_db::layerDB()->selectOne($sql,
			array(
				':idprofil_session' => session_id()
			)
		);
	}

	// --- Account
	/**
	 * @param $id
	 * @return array
	 */
	protected function selectOneAccount($id){
		$query = 'SELECT pr.*
        FROM mc_plugins_profil AS pr
        WHERE pr.idprofil = :id';
		return magixglobal_model_db::layerDB()->selectOne($query,array(
			':id'=>$id
		));
	}

	/**
	 * Retourne les informations du profil suivant son adresse mail
	 * @param $email_pr
	 * @return array
	 */
	protected function s_profil_by_mail($email_pr){
		$sql='SELECT *
		FROM mc_plugins_profil
		WHERE email_pr = :email_pr';
		return magixglobal_model_db::layerDB()->selectOne($sql,
			array(
				':email_pr'=> $email_pr
			)
		);
	}

	/**
	 * @param $pseudo_pr
	 * @return array
	 */
	protected function s_profil_by_pseudo($pseudo_pr)
	{
		$sql='SELECT *
		FROM mc_plugins_profil
		WHERE pseudo_pr = :pseudo_pr';
		return magixglobal_model_db::layerDB()->selectOne($sql,
			array(
				':pseudo_pr'=> $pseudo_pr
			)
		);
	}

	// --- Signup
	/**
	 * @param $data
	 * @param bool $pseudo
	 */
	protected function i_signup($data,$pseudo = false){
		$replace = array(
			':keyuniqid_pr'     =>  $data['keyuniqid_pr'],
			':lastname_pr'      =>  $data['lastname_pr'],
			':firstname_pr'     =>  $data['firstname_pr'],
			':email_pr'         =>  $data['email_pr'],
			':cryptkeypass_pr'  =>  $data['cryptkeypass_pr'],
			':newsletter'  		=>  $data['newsletter']
		);

		$cols = "keyuniqid_pr,lastname_pr,firstname_pr,email_pr,cryptkeypass_pr,newsletter,date_create_pr";
		$vals = ":keyuniqid_pr,:lastname_pr,:firstname_pr,:email_pr,:cryptkeypass_pr,:newsletter,NOW()";

		if($pseudo) {
			$replace[':pseudo_pr'] =  $data['pseudo_pr'];
			$cols .= ',pseudo_pr';
			$vals .= ',:pseudo_pr';
		}

		$sql = "INSERT INTO mc_plugins_profil ($cols) VALUE($vals)";
		magixglobal_model_db::layerDB()->insert($sql,$replace);
	}

	// --- Validation
	/**
	 * Vérifie si le profil existe
	 * @param $keyuniqid_pr
	 * @return array
	 */
	protected function verifyProfilKeyuniqid($keyuniqid_pr){
		$sql = 'SELECT pr.*
		FROM mc_plugins_profil AS pr
		WHERE pr.keyuniqid_pr = :keyuniqid_pr';
		return magixglobal_model_db::layerDB()->selectOne($sql,
			array(
				':keyuniqid_pr'=>$keyuniqid_pr
			)
		);
	}

	/**
	 * @access protected
	 * Activation du compte
	 * @param string $keyuniqid_pr
	 */
	protected function updateProfilValidation($keyuniqid_pr){
		$sql = 'UPDATE mc_plugins_profil SET active_account= 1
		WHERE keyuniqid_pr = :keyuniqid_pr';
		magixglobal_model_db::layerDB()->update($sql,
			array(
				':keyuniqid_pr'=>$keyuniqid_pr
			)
		);
	}

	// --- Edit Account

	/**
	 * @param $idprofil
	 * @param $cryptkeypass_pr
	 * @return array
	 */
	protected function verifyPassword($idprofil,$cryptkeypass_pr){
		$query = 'SELECT pr.* FROM mc_plugins_profil AS pr WHERE idprofil=:idprofil AND cryptkeypass_pr=:cryptkeypass_pr';
		return magixglobal_model_db::layerDB()->selectOne($query,array(
			':idprofil'=>$idprofil,
			':cryptkeypass_pr'=>$cryptkeypass_pr
		));
	}

	/**
	 * Mise à jour du mot de passe
	 * @param $idprofil
	 * @param $cryptkeypass_pr
	 */
	protected function u_dataPassword($idprofil,$cryptkeypass_pr){
		$sql = 'UPDATE mc_plugins_profil
        		SET cryptkeypass_pr=:cryptkeypass_pr
				WHERE idprofil=:idprofil';
		magixglobal_model_db::layerDB()->update($sql,
			array(
				':idprofil'         =>  $idprofil,
				':cryptkeypass_pr'  =>  $cryptkeypass_pr,
			));
	}

	/**
	 * @param $idprofil
	 * @param $links
	 */
	protected function u_dataLinks($idprofil,$links)
	{
		$sql = "UPDATE mc_plugins_profil
                SET website = :website,
                facebook = :facebook,
                twitter = :twitter,
                google = :google,
                viadeo = :viadeo,
                linkedin = :linkedin
                WHERE idprofil=:idprofil";

		magixglobal_model_db::layerDB()->update($sql,array(
			':website'      => $links['website'],
			':facebook'     => $links['facebook'],
			':twitter'      => $links['twitter'],
			':google'       => $links['google'],
			':viadeo'       => $links['viadeo'],
			':linkedin'     => $links['linkedin'],
			':idprofil'     => $idprofil
		));
	}

	/**
	 * @param $idprofil
	 * @param $data
	 */
	protected function u_account($idprofil, $data){
		$sql = 'UPDATE mc_plugins_profil
        		SET lastname_pr = :lastname_pr,
        			firstname_pr = :firstname_pr,
        			country_pr = :country_pr,
        			street_pr = :street_pr,
        			city_pr = :city_pr,
        			postcode_pr = :postcode_pr,
        			phone_pr = :phone_pr
				WHERE idprofil = :idprofil';

		magixglobal_model_db::layerDB()->update($sql,
			array(
				':idprofil'         => $idprofil,
				':lastname_pr'      => $data['lastname_pr'],
				':firstname_pr'     => $data['firstname_pr'],
				':country_pr'       => $data['country_pr'],
				':street_pr'        => $data['street_pr'],
				':city_pr'          => $data['city_pr'],
				':postcode_pr'      => $data['postcode_pr'],
				':phone_pr'         => $data['phone_pr']
			)
		);
	}

	// --- Modules
	/**
	 * Get mod registration
	 * @param $name
	 * @return array
	 */
	protected function g_mod($name)
	{
		$query = "SELECT * FROM `mc_plugins_profil_module` WHERE module_name = :mname";

		return magixglobal_model_db::layerDB()->selectOne($query,array(':mname' => $name));
	}

	/**
	 * Register profil module
	 * @param $name
	 * @param $active
	 */
	protected function register_module($name,$active)
	{
		$query = "INSERT INTO `mc_plugins_profil_module` (module_name,active) VALUES (:mname,:active)";

		magixglobal_model_db::layerDB()->insert($query,array(':mname' => $name,':active' => $active));
	}

	/**
	 * Update register profil module
	 * @param $name
	 * @param $active
	 */
	protected function u_register_module($name,$active)
	{
		$query = "UPDATE `mc_plugins_profil_module` SET active = :active WHERE module_name = :mname";

		magixglobal_model_db::layerDB()->update($query,array(':mname' => $name,':active' => $active));
	}

	/**
	 * Unregister profil module
	 * @param $name
	 */
	protected function unregister_module($name)
	{
		$query = "DELETE FROM `mc_plugins_profil_module` WHERE module_name = :mname";

		magixglobal_model_db::layerDB()->delete($query,array(':mname' => $name));
	}

	/**
	 * Get all active modules
	 * @return array
	 */
	protected function g_module()
	{
		$query = "SELECT * FROM `mc_plugins_profil_module` WHERE `active` = 1";

		return magixglobal_model_db::layerDB()->select($query);
	}
}