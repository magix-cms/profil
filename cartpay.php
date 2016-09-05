<?php
/*
 # -- BEGIN LICENSE BLOCK ----------------------------------
 #
 # This file is part of MAGIX CMS.
 # MAGIX CMS, The content management system optimized for users
 # Copyright (C) 2008 - 2013 magix-cms.com <support@magix-cms.com>
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
require_once('db/profil.php');

class plugins_profil_cartpay extends database_plugins_profil
{
	/**
	 * @var frontend_controller_plugins
	 */
	protected $module, $public;

	/**
	 * @var bool
	 */
	public $dynamicForm = true;

	/**
	 * Class constructor
	 */
	public function __construct(){
		if(class_exists('plugins_cartpay_module')){
			$this->module = new plugins_cartpay_module();
		}
	}

	/**
	 * Checks if the tables of the plugins are installed
	 * Indicate to the cartpay plugin if the plugin is already installed/active or not
	 */
	public function c_active()
	{
		return parent::c_show_tables();
	}

	/**
	 * Load conf files
	 */
	public function getform()
	{
		if(class_exists('plugins_profil_public')){
			$this->public = new plugins_profil_public();
			return $this->public->getform();
		}
	}

	/**
	 * Register module in cartpay tools
	 */
	public function register()
	{
		$this->module->register('profil');
	}
}
?>