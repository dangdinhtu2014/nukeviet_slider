<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2013 Webdep24.com - dangdinhtu.com. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Wed, 21 Jan 2015 14:00:59 GMT
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$page_title = $lang_module['template'];
 
 
if( ACTION_METHOD == 'status' )
{
	$template_id = $nv_Request->get_int( 'template_id', 'post', 0 );
	$mod = $nv_Request->get_string( 'action', 'get,post', '' );
	$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );
	$content = 'NO_' . $template_id;

	list( $template_id ) = $db->query( 'SELECT template_id FROM ' . TABLE_SLIDER_NAME . '_template WHERE template_id=' . $template_id )->fetch( 3 );
	if( $template_id > 0 )
	{
		if( $mod == 'status' and ( $new_vid == 0 or $new_vid == 1 ) )
		{
			$sql = 'UPDATE ' . TABLE_SLIDER_NAME . '_template SET status=' . $new_vid . ' WHERE template_id=' . $template_id;
			$db->query( $sql );

			$content = 'OK_' . $template_id;
		}
 
		nv_del_moduleCache( $module_name );
	}
	echo $content;
	exit();

}

 
if( ACTION_METHOD == 'delete' )
{
	$info = array();
	$template_id = $nv_Request->get_int( 'template_id', 'post', 0 );
	$token = $nv_Request->get_title( 'token', 'post', '' );
	
	$listid = $nv_Request->get_string( 'listid', 'post', '' );
	if( $listid != '' and md5( $global_config['sitekey'] . session_id() ) == $token )
	{
		$del_array = array_map( 'intval', explode( ',', $listid ) );
	}
	elseif( $token == md5( $global_config['sitekey'] .  session_id() . $template_id ) )
	{
		$del_array = array( $template_id );
	}
 
	if( ! empty( $del_array ) )
	{
		$a = 0;
		foreach( $del_array as $template_id )
		{
			$template = $db->query( 'SELECT * FROM ' . TABLE_SLIDER_NAME . '_template WHERE template_id=' . (int)$template_id )->fetch();
	
			$delete = $db->prepare('DELETE FROM ' . TABLE_SLIDER_NAME . '_template WHERE template_id=' . (int)$template['template_id'] );
			$delete->execute();
			
			if( $delete->rowCount() )
			{ 
				$delete_row = $db->prepare('DELETE FROM ' . TABLE_SLIDER_NAME . '_rows WHERE template_id=' . (int)$template['template_id'] );
				$delete_row->execute();
				
				
				$info['id'][$a] = $template_id;
 
				++$a;
			}
 	
		}
		if( !empty( $a ) )
		{
			$info['success'] = $lang_module['template_success_delete'] ;
		}
		
	}else
	{
		$info['error'] = $lang_module['template_error_delete'];
	}
	echo json_encode( $info );
	exit();
}
  
 
if( ACTION_METHOD == 'add' || ACTION_METHOD == 'edit' )
{
 
	$data = array(
		'template_id' => 0,
		'name' => '',
		'status' => 1,
		'date_added' => NV_CURRENTTIME,
 	);
	 
	$error = array();
 
	$data['template_id'] = $nv_Request->get_int( 'template_id', 'get,post', 0 );
 	if( $data['template_id'] > 0 )
	{
		$data = $db->query( 'SELECT *
		FROM ' . TABLE_SLIDER_NAME . '_template  
		WHERE template_id=' . $data['template_id'] )->fetch();
 
		$caption = $lang_module['template_edit'];
	}
	else
	{
		$caption = $lang_module['template_add'];
	}

	if( $nv_Request->get_int( 'save', 'post' ) == 1 )
	{

		$data['template_id'] = $nv_Request->get_int( 'template_id', 'post', 0 );
 		$data['name'] = nv_substr( $nv_Request->get_title( 'name', 'post', '', '' ), 0, 255 );
 		$data['status'] = $nv_Request->get_int( 'status', 'post', 0 );
 
		if( empty( $data['name'] ) )
		{
			$error['name'] = $lang_module['template_error_name'];	
		}
		if( ! empty( $error ) && ! isset( $error['warning'] ) )
		{
			$error['warning'] = $lang_module['template_error_warning'];
		}
 
 
		$data['alias'] = strtolower( $data['alias'] );
		
		if( empty( $error ) )
		{
			 
			if( $data['template_id'] == 0 )
			{
 
				$stmt = $db->prepare( 'INSERT INTO ' . TABLE_SLIDER_NAME . '_template SET 
					status=' . intval( $data['status'] ) . ', 
					date_added=' . intval( $data['date_added'] ) . ',  
					name =:name' );
					
				$stmt->bindParam( ':name', $data['name'], PDO::PARAM_STR );
				$stmt->execute();

				if( $data['template_id'] = $db->lastInsertId() )
				{

					nv_insert_logs( NV_LANG_DATA, $module_name, 'Add A template', 'template_id: ' . $data['template_id'], $admin_info['userid'] );	 

				}
				else
				{
					$error['warning'] = $lang_module['template_error_save'];

				}
				$stmt->closeCursor();

			}
			else
			{
				
				try
				{
						
					$stmt = $db->prepare( 'UPDATE ' . TABLE_SLIDER_NAME . '_template SET 
						status=' . intval( $data['status'] ) . ', 
						name =:name 
						WHERE template_id=' . $data['template_id'] );
					$stmt->bindParam( ':name', $data['name'], PDO::PARAM_STR );
 	 
					if( $stmt->execute() )
					{
 
						nv_insert_logs( NV_LANG_DATA, $module_name, 'Edit A template', 'template_id: ' . $data['template_id'], $admin_info['userid'] );
						
					}
					else
					{
						$error['warning'] = $lang_module['template_error_save'];

					}

					$stmt->closeCursor();

				}
				catch ( PDOException $e )
				{ 
					$error['warning'] = $lang_module['template_error_save'];
					// var_dump($e);
				}

			}

		}
		
		if( empty( $error ) )
		{
			nv_del_moduleCache( $module_name );
			Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=template' );
			die();
		}

	}
 
	$xtpl = new XTemplate( 'template_add.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
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

	$xtpl->parse( 'main' );
	$contents = $xtpl->text( 'main' );
	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme( $contents );
	include NV_ROOTDIR . '/includes/footer.php';

	exit();
}

/*show list template*/

$per_page = 50;

$page = $nv_Request->get_int( 'page', 'get', 1 );

$sort = $nv_Request->get_string( 'sort', 'get', '' );
$order = $nv_Request->get_string( 'order', 'get' ) == 'desc' ? 'desc' : 'asc';
 
$sql = TABLE_SLIDER_NAME . '_template WHERE 1';
 
$sort_data = array( 'name', 'date_added' );
if( isset( $sort ) && in_array( $sort, $sort_data ) )
{
	$sql .= " ORDER BY " . $sort;
}
else
{
	$sql .= " ORDER BY date_added";
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

$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=template&amp;sort=' . $sort . '&amp;order=' . $order . '&amp;per_page=' . $per_page;

$db->sqlreset()->select( '*' )->from( $sql )->limit( $per_page )->offset( ( $page - 1 ) * $per_page );
 
$result = $db->query( $db->sql() );

$array = array();
while( $rows = $result->fetch() )
{
	$array[] = $rows;
}

$xtpl = new XTemplate( 'template.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
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
$xtpl->assign( 'TOKEN', md5( $global_config['sitekey'] . session_id() ) );

$order2 = ( $order == 'asc' ) ? 'desc' : 'asc';
$xtpl->assign( 'URL_NAME', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=name&amp;order=' . $order2 . '&amp;per_page=' . $per_page ); 
$xtpl->assign( 'ADD_NEW', NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=" . $op . "&action=add" );

if( ! empty( $array ) )
{
	foreach( $array as $item )
	{
 

  		$item['date_added'] = nv_date( 'd/m/Y', $item['date_added'] );
		$item['token'] = md5( $global_config['sitekey'] . session_id() . $item['template_id'] );
		
		$item['add'] = NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=template&action=add&token=" . $item['token'] . "&template_id=" . $item['template_id'];
		$item['edit'] = NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=template&action=edit&token=" . $item['token'] . "&template_id=" . $item['template_id'];

		$xtpl->assign( 'LOOP', $item );
		
		foreach( $array_status as $key => $name )
		{
			$xtpl->assign( 'STATUS', array( 'key'=> $key, 'name'=> $name, 'selected'=> ( $key == $item['status'] ) ? 'selected="selected"': '' ) );
			 $xtpl->parse( 'main.loop.status' );
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
