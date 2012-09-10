<?php
/******************************
* file removehook             *
* Remove the PortaMx hooks    *
* Coypright by PortaMx corp.  *
*******************************/
global $sourcedir, $boarddir, $boardurl, $smcFunc, $user_info, $txt;

// Load the SSI.php
if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
{
	function _write($string) { echo $string; }

	require_once(dirname(__FILE__) . '/SSI.php');

	// on manual installation you have to logged in
	if(!$user_info['is_admin'])
	{
		if($user_info['is_guest'])
		{
			echo '<b>', $txt['admin_login'],':</b><br />';
			ssi_login($boardurl.'/removehook.php');
			die();
		}
		else
		{
			loadLanguage('Errors');
			fatal_error($txt['cannot_admin_forum']);
		}
	}
}
// no SSI.php and no SMF?
elseif (!defined('SMF'))
	die('<b>Error:</b> SSI.php not found. Please verify you put this in the same place as SMF\'s index.php.');
else
{
	function _write($string) { return; }
}

// Load the SMF DB Functions
db_extend('packages');
db_extend('extra');

// remove all hooks
_write('Removing all PortaMx integration hooks.<br />');
$hooklist = array(
	'integrate_pre_include' => '$sourcedir/PortaMx/PortaMxLoader.php',
	'integrate_pre_load' => 'pmxsef_convertSEF',
	'integrate_redirect' => 'pmxsef_Redirect',
	'integrate_outgoing_email' => 'pmxsef_EmailOutput',
	'integrate_exit' => 'pmxsef_XMLOutput',
	'integrate_buffer' => 'ob_portamx',
	'integrate_buffer' => 'ob_pmxsef',
	'integrate_fix_url' => 'pmxsef_fixurl',
	'integrate_actions' => 'PortaMx_Actions',
	'integrate_admin_areas' => 'PortaMx_AdminMenu',
	'integrate_profile_areas' => 'PortaMx_ProfileMenu',
	'integrate_dynamic_buttons' => 'PortaMx_MenuContext',
	'integrate_whos_online' => 'PortaMx_whos_online',
	'integrate_logout' => 'PortaMx_logout',
	'integrate_load_theme' => 'pmx_eclnonemodal',
);

foreach($hooklist as $name => $func)
	remove_integration_function($name, $func);

// remove all settings
_write('Removing the PortaMx settings.<br />');
$smcFunc['db_query']('', '
	DELETE FROM {db_prefix}settings
	WHERE variable LIKE {string:variable}',
	array('variable' => 'pmx_%')
);

// clear the cache
_write('Clear the settings cache.<br />');
cache_put_data('modSettings', null, 90);
clean_cache();

_write('removehook done.<br />');
?>