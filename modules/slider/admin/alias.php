<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2013 Webdep24.com - dangdinhtu.com. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Wed, 21 Jan 2015 14:00:59 GMT
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$name = $nv_Request->get_title( 'name', 'post', '' );
$alias = change_alias( $name );

$id = $nv_Request->get_int( 'id', 'post', 0 );
$mod = $nv_Request->get_string( 'mod', 'post', '' );

if( $mod == 'photo' )
{
	$tab = TABLE_SLIDER_NAME . '_photo';
	$stmt = $db->prepare( 'SELECT COUNT(*) FROM ' . $tab . ' WHERE photo_id !=' . $id . ' AND alias= :alias' );
	$stmt->bindParam( ':alias', $alias, PDO::PARAM_STR );
	$stmt->execute();
	$nb = $stmt->fetchColumn();
	if( ! empty( $nb ) )
	{
		$nb = $db->query( 'SELECT MAX(album_id) FROM ' . $tab )->fetchColumn();

		$alias .= '-' . ( intval( $nb ) + 1 );
	}
}
 

include NV_ROOTDIR . '/includes/header.php';
echo strtolower( $alias );
include NV_ROOTDIR . '/includes/footer.php';