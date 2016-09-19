CREATE TABLE IF NOT EXISTS `mc_plugins_profil` (
  `idprofil` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `idlang` smallint(3) unsigned NOT NULL DEFAULT '1',
  `pseudo_pr` varchar(40) DEFAULT NULL,
  `lastname_pr` varchar(40) DEFAULT NULL,
  `firstname_pr` varchar(40) DEFAULT NULL,
  `cryptkeypass_pr` varchar(120) NOT NULL,
  `email_pr` varchar(150) NOT NULL,
  `keyuniqid_pr` varchar(50) NOT NULL,
  `country_pr` varchar(40) DEFAULT NULL,
  `street_pr` varchar(150) DEFAULT NULL,
  `city_pr` varchar(60) DEFAULT NULL,
  `postcode_pr` varchar(10) DEFAULT NULL,
  `phone_pr` varchar(45) DEFAULT NULL,
  `company_pr` varchar(50) DEFAULT NULL,
  `vat_pr` varchar(50) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `facebook` varchar(200) DEFAULT NULL,
  `twitter` varchar(150) DEFAULT NULL,
  `google` varchar(150) DEFAULT NULL,
  `viadeo` varchar(200) DEFAULT NULL,
  `linkedin` varchar(200) DEFAULT NULL,
  `newsletter` SMALLINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_create_pr` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active_account` smallint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`idprofil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `mc_plugins_profil_session` (
  `idprofil_session` varchar(150) NOT NULL,
  `idprofil` int(7) unsigned NOT NULL,
  `keyuniqid_pr` varchar(50) NOT NULL,
  `ip_session` varchar(25) NOT NULL,
  `browser_session` varchar(50) NOT NULL,
  `last_modified_session` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idprofil_session`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `mc_plugins_profil_config` (
  `idprofil_config` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `google_recaptcha` smallint(1) unsigned NOT NULL DEFAULT '0',
  `recaptchaApiKey` varchar(125) DEFAULT NULL,
  `recaptchaSecret` varchar(125) DEFAULT NULL,
  `links` smallint(1) unsigned NOT NULL DEFAULT '0',
  `cartpay` smallint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`idprofil_config`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

TRUNCATE `mc_plugins_profil_config`;

INSERT INTO `mc_plugins_profil_config` (`idprofil_config`, `google_recaptcha`, `recaptchaApiKey`, `recaptchaSecret`, `links`, `cartpay`) VALUES
(NULL, 0, NULL, NULL, 0, 0);

CREATE TABLE IF NOT EXISTS `mc_plugins_profil_module` (
  `idmodule` SMALLINT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `module_name` VARCHAR(150) NOT NULL,
  `active` SMALLINT(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`idmodule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;