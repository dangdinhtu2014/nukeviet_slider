<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2013 Webdep24.com - dangdinhtu.com. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Wed, 21 Jan 2015 14:00:59 GMT
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$page_title = $lang_module['group'];
 
 
if( ACTION_METHOD == 'status' )
{
	$group_id = $nv_Request->get_int( 'group_id', 'post', 0 );
	$mod = $nv_Request->get_string( 'action', 'get,post', '' );
	$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );
	$content = 'NO_' . $group_id;

	list( $group_id ) = $db->query( 'SELECT group_id FROM ' . TABLE_SLIDER_NAME . '_group WHERE group_id=' . $group_id )->fetch( 3 );
	if( $group_id > 0 )
	{
		if( $mod == 'status' and ( $new_vid == 0 or $new_vid == 1 ) )
		{
			$sql = 'UPDATE ' . TABLE_SLIDER_NAME . '_group SET status=' . $new_vid . ' WHERE group_id=' . $group_id;
			$db->query( $sql );

			$content = 'OK_' . $group_id;
		}
 
		nv_del_moduleCache( $module_name );
	}
	echo $content;
	exit();

}

if( ACTION_METHOD == 'weight' )
{
	$group_id = $nv_Request->get_int( 'group_id', 'post', 0 );
	$mod = $nv_Request->get_string( 'action', 'get,post', '' );
	$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );
	$content = 'NO_' . $group_id;
 	
	if( empty( $new_vid ) ) die( 'NO_' . $mod );

	$sql = 'SELECT group_id FROM ' . TABLE_SLIDER_NAME . '_group WHERE group_id=' . $group_id;
	$group_id = $db->query( $sql )->fetchColumn();
	if( empty( $group_id ) ) die( 'NO_' . $group_id );


	$sql = 'SELECT group_id FROM ' . TABLE_SLIDER_NAME . '_group WHERE group_id!=' . $group_id . ' ORDER BY weight ASC';
	$result = $db->query( $sql );

	$weight = 0;
	while( $row = $result->fetch() )
	{
		++$weight;
		if( $weight == $new_vid ) ++$weight;

		$sql = 'UPDATE ' . TABLE_SLIDER_NAME . '_group SET weight=' . $weight . ' WHERE group_id=' . $row['group_id'];
		$db->query( $sql );
	}

	$sql = 'UPDATE ' . TABLE_SLIDER_NAME . '_group SET weight=' . $new_vid . ' WHERE group_id=' . $group_id;
	$db->query( $sql );

	nv_del_moduleCache( $module_name );
	
	$content = 'OK_' . $group_id; 
	
	echo $content;
	exit();

}

if( ACTION_METHOD == 'delete' )
{
	$info = array();
	$group_id = $nv_Request->get_int( 'group_id', 'post', 0 );
	$token = $nv_Request->get_title( 'token', 'post', '' );
	
	$listid = $nv_Request->get_string( 'listid', 'post', '' );
	if( $listid != '' and md5( $global_config['sitekey'] . session_id() ) == $token )
	{
		$del_array = array_map( 'intval', explode( ',', $listid ) );
	}
	elseif( $token == md5( $global_config['sitekey'] .  session_id() . $group_id ) )
	{
		$del_array = array( $group_id );
	}
 
	if( ! empty( $del_array ) )
	{
		$a = 0;
		foreach( $del_array as $group_id )
		{
			$group = $db->query( 'SELECT * FROM ' . TABLE_SLIDER_NAME . '_group WHERE group_id=' . (int)$group_id )->fetch();
	
			$delete = $db->prepare('DELETE FROM ' . TABLE_SLIDER_NAME . '_group WHERE group_id=' . (int)$group['group_id'] );
			$delete->execute();
			
			if( $delete->rowCount() )
			{ 
				$delete_row = $db->prepare('DELETE FROM ' . TABLE_SLIDER_NAME . '_rows WHERE group_id=' . (int)$group['group_id'] );
				$delete_row->execute();
				
				
				$info['id'][$a] = $group_id;
 
				++$a;
			}
 	
		}
		if( !empty( $a ) )
		{
			$info['success'] = $lang_module['group_success_delete'] ;
		}
		
	}else
	{
		$info['error'] = $lang_module['group_error_delete'];
	}
	echo json_encode( $info );
	exit();
}
  
 
if( ACTION_METHOD == 'add' || ACTION_METHOD == 'edit' )
{
 
	$groups_list = nv_groups_list();
	
	$data = array(
		'group_id' => 0,
		'name' => '',
		'alias' => '',
		'description' => '',
		'status' => 1,
		'groups_view' => 6,
		'date_added' => NV_CURRENTTIME,
		'date_modified' => NV_CURRENTTIME,
	);
	 
	$error = array();
 
	$data['group_id'] = $nv_Request->get_int( 'group_id', 'get,post', 0 );
 	if( $data['group_id'] > 0 )
	{
		$data = $db->query( 'SELECT *
		FROM ' . TABLE_SLIDER_NAME . '_group  
		WHERE group_id=' . $data['group_id'] )->fetch();
 
		$caption = $lang_module['group_edit'];
	}
	else
	{
		$caption = $lang_module['group_add'];
	}

	if( $nv_Request->get_int( 'save', 'post' ) == 1 )
	{

		$data['group_id'] = $nv_Request->get_int( 'group_id', 'post', 0 );
 		$data['name'] = nv_substr( $nv_Request->get_title( 'name', 'post', '', '' ), 0, 255 );
		$data['alias'] = nv_substr( $nv_Request->get_title( 'alias', 'post', '', '' ), 0, 255 );
 		$data['description'] = nv_substr( $nv_Request->get_title( 'alias', 'post', '', '' ), 0, 255 );
		$data['status'] = $nv_Request->get_int( 'status', 'post', 0 );
 
		if( empty( $data['name'] ) )
		{
			$error['name'] = $lang_module['group_error_name'];	
		}
		if( ! empty( $error ) && ! isset( $error['warning'] ) )
		{
			$error['warning'] = $lang_module['group_error_warning'];
		}
 
		$_groups_post = $nv_Request->get_array( 'groups_view', 'post', array() );
		$data['groups_view'] = ! empty( $_groups_post ) ? implode( ',', nv_groups_post( array_intersect( $_groups_post, array_keys( $groups_list ) ) ) ) : '';
 
		$data['alias'] = strtolower( $data['alias'] );
		
		if( empty( $error ) )
		{
			 
			if( $data['group_id'] == 0 )
			{
				$weight = $db->query( 'SELECT MAX(weight) FROM ' . TABLE_SLIDER_NAME . '_group' )->fetchColumn();
				$data['weight'] = intval( $weight ) + 1;
				
				$stmt = $db->prepare( 'INSERT INTO ' . TABLE_SLIDER_NAME . '_group SET 
					status=' . intval( $data['status'] ) . ', 
					weight=' . intval( $data['weight'] ) . ', 
					date_added=' . intval( $data['date_added'] ) . ',  
					date_modified=' . intval( $data['date_modified'] ) . ', 
					name =:name,
					alias =:alias,
					description =:description,
					groups_view=:groups_view ' );
					
				$stmt->bindParam( ':name', $data['name'], PDO::PARAM_STR );
				$stmt->bindParam( ':alias', $data['alias'], PDO::PARAM_STR );
				$stmt->bindParam( ':description', $data['description'], PDO::PARAM_STR );
  				$stmt->bindParam( ':groups_view', $data['groups_view'], PDO::PARAM_STR );
				$stmt->execute();

				if( $data['group_id'] = $db->lastInsertId() )
				{
					 	
					
					nv_insert_logs( NV_LANG_DATA, $module_name, 'Add A group', 'group_id: ' . $data['group_id'], $admin_info['userid'] );	 

				}
				else
				{
					$error['warning'] = $lang_module['group_error_save'];

				}
				$stmt->closeCursor();

			}
			else
			{
				
				try
				{
						
					$stmt = $db->prepare( 'UPDATE ' . TABLE_SLIDER_NAME . '_group SET 
						status=' . intval( $data['status'] ) . ', 
						date_added=' . intval( $data['date_added'] ) . ',  
						date_modified=' . intval( $data['date_modified'] ) . ', 
						name =:name,
						alias =:alias,
						description =:description,
						groups_view=:groups_view 
						WHERE group_id=' . $data['group_id'] );
					$stmt->bindParam( ':name', $data['name'], PDO::PARAM_STR );
					$stmt->bindParam( ':alias', $data['alias'], PDO::PARAM_STR );
					$stmt->bindParam( ':description', $data['description'], PDO::PARAM_STR );
					$stmt->bindParam( ':groups_view', $data['groups_view'], PDO::PARAM_STR );
 	 
					if( $stmt->execute() )
					{
 
						nv_insert_logs( NV_LANG_DATA, $module_name, 'Edit A group', 'group_id: ' . $data['group_id'], $admin_info['userid'] );
						
					}
					else
					{
						$error['warning'] = $lang_module['group_error_save'];

					}

					$stmt->closeCursor();

				}
				catch ( PDOException $e )
				{ 
					$error['warning'] = $lang_module['group_error_save'];
					// var_dump($e);
				}

			}

		}
		
		if( empty( $error ) )
		{
			nv_del_moduleCache( $module_name );
			Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=group' );
			die();
		}

	}
 
	$xtpl = new XTemplate( 'group_add.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
	$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'THEME', $global_config['site_theme'] );
	$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
	$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
	$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
	$xtpl->assign( 'MODULE_FILE', $module_file );
	$xtpl->assign( 'MODULE_NAME', $module_name );
	$xtpl->assign( 'OP', $op );
	$xtpl->assign( 'CAPTION', $caption );
	$xtpl->assign( 'DATA', $data );
	$xtpl->assign( 'CANCEL', NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=" . $op );
 
	if( isset( $error['warning'] ) )
	{
		$xtpl->assign( 'error_warning', $error['warning'] );
		$xtpl->parse( 'main.error_warning' );
	}
 
 
	if( isset( $error['name'] ) )
	{
		$xtpl->assign( 'error_name', $error['name'] );
		$xtpl->parse( 'main.error_name' );
	}
 
 
	
	foreach( $array_status as $key => $name )
	{
		$xtpl->assign( 'STATUS', array( 'key'=> $key, 'name'=> $name, 'selected'=> ( $key == $data['status'] ) ? 'selected="selected"' : '' ) );
		$xtpl->parse( 'main.status' );
	}

	$groups_view = explode( ',', $data['groups_view'] );
	foreach( $groups_list as $_group_id => $_title )
	{
		$xtpl->assign( 'GROUPS_VIEW', array(
			'value' => $_group_id,
			'checked' => in_array( $_group_id, $groups_view ) ? ' checked="checked"' : '',
			'title' => $_title ) );
		$xtpl->parse( 'main.groups_view' );
	}

	if( empty( $data['alias'] ) )
	{
		$xtpl->parse( 'main.getalias' );
	}
	$xtpl->parse( 'main' );
	$contents = $xtpl->text( 'main' );
	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme( $contents );
	include NV_ROOTDIR . '/includes/footer.php';

	exit();
}


if( ACTION_METHOD == 'get_group' )
{
	$name = $nv_Request->get_string( 'filter_name', 'get', '' );
	$info = array();

	$and = '';
	if( ! empty( $name ) )
	{
		$and .= ' AND name LIKE :name ';
	}

	$sql = 'SELECT group_id, name FROM ' . TABLE_SLIDER_NAME . '_group  
	WHERE 1 ' . $and . '
	ORDER BY name DESC LIMIT 0, 10';

	$sth = $db->prepare( $sql );

	if( ! empty( $name ) )
	{
		$sth->bindValue( ':name', '%' . $name . '%' );
	}
	$sth->execute();
	while( list( $group_id, $name ) = $sth->fetch( 3 ) )
	{
		$info[] = array( 'group_id' => $group_id, 'name' => nv_htmlspecialchars( $name ) );
	}
	header( 'Content-Type: application/json' );
	echo json_encode( $info );
	exit();
}

/*show list group*/

$per_page = 50;

$page = $nv_Request->get_int( 'page', 'get', 1 );

$data['filter_status'] = $nv_Request->get_string( 'filter_status', 'get', '' );
$data['filter_name'] = strip_tags( $nv_Request->get_string( 'filter_name', 'get', '' ) );
$data['filter_date_added'] = $nv_Request->get_string( 'filter_date_added', 'get', '' );
$data['filter_catalogs'] = $nv_Request->get_int( 'filter_catalogs', 'get', 0 );

$sort = $nv_Request->get_string( 'sort', 'get', '' );
$order = $nv_Request->get_string( 'order', 'get' ) == 'desc' ? 'desc' : 'asc';
 
 
$sql = TABLE_SLIDER_NAME . '_group WHERE 1';
 
if( ! empty( $data['filter_name'] ) )
{
	$sql .= " AND name LIKE '" . $db->dblikeescape( $data['filter_name'] ) . "%'";
}
 
if( $data['filter_catalogs'] > 0 )
{
	$sql .= " AND catalogs_id = " . ( int )$data['filter_catalogs'];
}
 
if( isset( $data['filter_status'] ) && is_numeric( $data['filter_status'] ) )
{
	$sql .= " AND status = " . ( int )$data['filter_status'];
}

if( preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $data['filter_date_added'], $m ) )
{
	$date_added_start = mktime( 0, 0, 0, $m[2], $m[1], $m[3] );
	$date_added_end = $date_added_start + 86399;

	$sql .= " AND date_added BETWEEN " . $date_added_start . " AND " . $date_added_end . "";
}
$sort_data = array( 'name', 'catalogs_id', 'date_added' );
if( isset( $sort ) && in_array( $sort, $sort_data ) )
{

	$sql .= " ORDER BY " . $sort;
}
else
{
	$sql .= " ORDER BY weight";
}

if( isset( $order ) && ( $order == 'desc' ) )
{
	$sql .= " DESC";
}
else
{
	$sql .= " ASC";
}


 
$num_items = $db->query( 'SELECT COUNT(*) FROM ' . $sql )->fetchColumn();

$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=group&amp;sort=' . $sort . '&amp;order=' . $order . '&amp;per_page=' . $per_page;

$db->sqlreset()->select( '*' )->from( $sql )->limit( $per_page )->offset( ( $page - 1 ) * $per_page );
 
$result = $db->query( $db->sql() );

$array = array();
while( $rows = $result->fetch() )
{
	$array[] = $rows;
}

$xtpl = new XTemplate( 'group.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'THEME', $global_config['site_theme'] );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'MODULE_FILE', $module_file );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'DATA', $data );
$xtpl->assign( 'TOKEN', md5( $global_config['sitekey'] . session_id() ) );
$xtpl->assign( 'URL_SEARCH', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&action=get_group' );

$order2 = ( $order == 'asc' ) ? 'desc' : 'asc';
$xtpl->assign( 'URL_NAME', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=name&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_WEIGHT', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=weight&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
 
$xtpl->assign( 'ADD_NEW', NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=" . $op . "&action=add" );
 
/*search*/
 
foreach( $array_status as $key => $name )
{
	$xtpl->assign( 'STATUS', array( 'key'=> $key, 'name'=> $name, 'selected'=> ( $key == $data['filter_status'] && is_numeric( $data['filter_status'] ) ) ? 'selected="selected"': '' ) );
	$xtpl->parse( 'main.filter_status' );
}
 
 
if( ! empty( $array ) )
{
	foreach( $array as $item )
	{
 

  		$item['date_added'] = nv_date( 'd/m/Y', $item['date_added'] );
		$item['token'] = md5( $global_config['sitekey'] . session_id() . $item['group_id'] );
		
		$item['add'] = NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=photo&action=add&token=" . $item['token'] . "&group_id=" . $item['group_id'];
		$item['view'] = NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=photo&token=" . $item['token'] . "&group_id=" . $item['group_id'];
		$item['edit'] = NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=group&action=edit&token=" . $item['token'] . "&group_id=" . $item['group_id'];

 
		$xtpl->assign( 'LOOP', $item );
		
		foreach( $array_status as $key => $name )
		{
			$xtpl->assign( 'STATUS', array( 'key'=> $key, 'name'=> $name, 'selected'=> ( $key == $item['status'] ) ? 'selected="selected"': '' ) );
			 $xtpl->parse( 'main.loop.status' );
		}
		for( $i = 1; $i <= $num_items; ++$i )
		{
			$xtpl->assign( 'WEIGHT', array(
				'key' => $i,
				'name' => $i,
				'selected' => ( $i == $item['weight'] ) ? ' selected="selected"' : ''
			) );

			$xtpl->parse( 'main.loop.weight' );
		}

		$xtpl->parse( 'main.loop' );
	}

}
 
$generate_page = nv_generate_page( $base_url, $num_items, $per_page, $page );
if( ! empty( $generate_page ) )
{
	$xtpl->assign( 'GENERATE_PAGE', $generate_page );
	$xtpl->parse( 'main.generate_page' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );
include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
