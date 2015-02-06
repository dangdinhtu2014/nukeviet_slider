<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2013 Webdep24.com. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate  7, 23, 2013 4:41
 */

if( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) or ! defined( 'NV_IS_MODADMIN' ) ) die( 'Stop!!!' );
 
$allow_func = array(
	'main',
	'alias',
	'photo',
	'group',
	'template' );

define( 'NV_IS_FILE_ADMIN', true );

define( 'TABLE_SLIDER_NAME', NV_PREFIXLANG . '_' . $module_data ); 

define( 'ACTION_METHOD', $nv_Request->get_string( 'action', 'get,post', '' ) ); 
 
//require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php'; 
 
$array_status = array( '0' => $lang_module['disabled'], '1' => $lang_module['enable'] );

$sql = 'SELECT * FROM ' . TABLE_SLIDER_NAME . '_group ORDER BY weight ASC';
$global_groups_slider = nv_db_cache( $sql, 'group_id', $module_name );
 