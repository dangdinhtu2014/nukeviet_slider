<!-- BEGIN: main -->

<div id="content"> 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title" style="float:left"><i class="fa fa-list"></i> {LANG.group_list}</h3> 
			 <div class="pull-right">
				<a href="{ADD_NEW}" data-toggle="tooltip" data-placement="top" title="{LANG.add_new}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
				<button type="button" data-toggle="tooltip" data-placement="top" title="{LANG.delete}" class="btn btn-danger" id="button-delete">
					<i class="fa fa-trash-o"></i>
				</button>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="panel-body">
			<div class="well">
				<div class="row">	
					<form action="{NV_BASE_ADMINURL}index.php" method="get">
					<input type="hidden" name ="{NV_NAME_VARIABLE}"value="{MODULE_NAME}" />
					<input type="hidden" name ="{NV_OP_VARIABLE}"value="{OP}" />
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label" for="input-group-name">{LANG.group_name}</label>
							<input type="text" name="filter_name" value="{DATA.filter_name}" placeholder="{LANG.group_name}" id="input-group-name" class="form-control" autocomplete="off">
						</div>
						<div class="form-group">
							<label class="control-label" for="input-date-added">{LANG.group_date_added}</label>
							 
								<input type="text" name="filter_date_added" value="{DATA.filter_date_added}" placeholder="{LANG.column_date_added}" id="input-date-added" class="form-control">
								 
							 
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label" for="input-status">{LANG.group_status}</label>
							<select name="filter_status" id="input-status" class="form-control">
								<option value="*">   --------  </option>
								<!-- BEGIN: filter_status -->
								<option value="{STATUS.key}" {STATUS.selected}>{STATUS.name}</option>
								<!-- END: filter_status -->
							</select>
						</div>
						
						<input type="hidden" name ="checkss" value="{TOKEN}" />
						<button type="submit" id="button-filter" class="btn btn-primary pull-right" data-toggle="tooltip" title="{LANG.search}"><i class="fa fa-search"></i> {LANG.search}</button>
					</div>
					</form>
				</div>
			</div>
		
			<form action="" method="post" enctype="multipart/form-data" id="form-group">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<td class="col-md-0 text-center" ><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></td>
								<td class="col-md-6 text-left"><a href="{URL_NAME}">{LANG.group_name}</a> </td>
 								<td class="col-md-8 text-center"> <strong>{LANG.group_description} </strong></td>
								<td class="col-md-2 text-center"> <strong>{LANG.group_status} </strong></td>
								<td class="col-md-2 text-center"> <strong>{LANG.group_date_added} </strong></td>
								<td class="col-md-2 text-center" ><a href="{URL_WEIGHT}">{LANG.weight}</a></td>
								<td class="col-md-4 text-right"> <strong>{LANG.action} </strong></td>
							</tr>
						</thead>
						<tbody>
							<!-- BEGIN: loop --> 
							<tr id="group_{LOOP.group_id}">
								<td class="text-left"><input type="checkbox" name="selected[]" value="{LOOP.group_id}"></td>
								<td class="text-left"><a href="{LOOP.view}"> <strong>{LOOP.name}</strong> </a> </td>
								<td align="center">
									{LOOP.description}
								</td>	
								<td class="text-center">
									<select class="form-control" id="change_status_{LOOP.group_id}" onchange="nv_change_group('{LOOP.group_id}','status');">
										<!-- BEGIN: status -->
										<option value="{STATUS.key}"{STATUS.selected}>{STATUS.name}</option>
										<!-- END: status -->
									</select>
								</td>
								<td align="center">
									{LOOP.date_added}
								</td>
								<td class="text-center">
									<select id="change_weight_{LOOP.group_id}" onchange="nv_change_group('{LOOP.group_id}','weight');" class="form-control">
										<!-- BEGIN: weight -->
										<option value="{WEIGHT.key}"{WEIGHT.selected}>{WEIGHT.name}</option>
										<!-- END: weight -->
									</select>
								</td>
								<td class="text-right">
									<a href="{LOOP.add}" data-toggle="tooltip" title="{LANG.add_photo}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
									<a href="{LOOP.view}" data-toggle="tooltip" title="{LANG.view}" class="btn btn-info"><i class="fa fa-eye"></i></a>
									<a href="{LOOP.edit}" data-toggle="tooltip" title="{LANG.edit}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
									<a href="javascript:void(0);" onclick="delete_group('{LOOP.group_id}', '{LOOP.token}')" data-toggle="tooltip" title="{LANG.delete}" class="btn btn-danger"><i class="fa fa-trash-o"></i>
								</td>
							</tr>
							<!-- END: loop -->
						</tbody>
					</table>
				</div>
			</form>
			<!-- BEGIN: generate_page -->
			<div class="row">
				<div class="col-sm-24 text-left">
				
				<div style="clear:both"></div>
				{GENERATE_PAGE}
				
				</div>
				 
			</div>
			<!-- END: generate_page -->
		</div>
	</div>
</div>

<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.core.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.theme.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.menu.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.autocomplete.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.datepicker.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.menu.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.autocomplete.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.datepicker.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>	

<script type="text/javascript" src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/footer.js"></script>
<script type="text/javascript">
$('#input-date-added').datepicker({
	showOn : "both",
	dateFormat : "dd/mm/yy",
	changeMonth : true,
	changeYear : true,
	showOtherMonths : true,
	buttonImage : nv_siteroot + "images/calendar.gif",
	buttonImageOnly : true
});
$('input[name=\'filter_name\']').autofill({
	'source': function(request, response) {
		$.ajax({
			url: '{URL_SEARCH}&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['group_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_name\']').val(item['label']);
	}
});

function delete_group(group_id, token) {
	if(confirm('{LANG.confirm}')) {
		$.ajax({
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=group&action=delete&nocache=' + new Date().getTime(),
			type: 'post',
			dataType: 'json',
			data: 'group_id=' + group_id + '&token=' + token,
			beforeSend: function() {
				$('#button-delete i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
				$('#button-delete').prop('disabled', true);
			},	
			complete: function() {
				$('#button-delete i').replaceWith('<i class="fa fa-trash-o"></i>');
				$('#button-delete').prop('disabled', false);
			},
			success: function(json) {
				$('.alert').remove();

				if (json['error']) {
					$('#content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
				}
				
				if (json['success']) {
					$('#content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
					 $.each(json['id'], function(i, id) {
						$('#group_' + id ).remove();
					});
				}		
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}

$('#button-delete').on('click', function() {
	if(confirm('{LANG.confirm}')) 
	{
		var listid = [];
		$("input[name=\"selected[]\"]:checked").each(function() {
			listid.push($(this).val());
		});
		if (listid.length < 1) {
			alert("{LANG.please_select_one}");
			return false;
		}
	 
		$.ajax({
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=group&action=delete&nocache=' + new Date().getTime(),
			type: 'post',
			dataType: 'json',
			data: 'listid=' + listid + '&token={TOKEN}',
			beforeSend: function() {
				$('#button-delete i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
				$('#button-delete').prop('disabled', true);
			},	
			complete: function() {
				$('#button-delete i').replaceWith('<i class="fa fa-trash-o"></i>');
				$('#button-delete').prop('disabled', false);
			},
			success: function(json) {
				$('.alert').remove();
 
				if (json['error']) {
					$('#content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
				}
				
				if (json['success']) {
					$('#content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
					 $.each(json['id'], function(i, id) {
						$('#group_' + id ).remove();
					});
				}		
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}	
});

</script>

<script type="text/javascript">
function nv_change_group(group_id, mod) {
    var nv_timer = nv_settimeout_disable('change_' + mod + '_' + group_id, 5000);
    var new_vid = $('#change_' + mod + '_' + group_id).val();
    $.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=group&action=' + mod + '&nocache=' + new Date().getTime(), 'group_id=' + group_id + '&new_vid=' + new_vid, function(res) {
        var r_split = res.split("_");
        if (r_split[0] != 'OK') {
            alert(nv_is_change_act_confirm[2]);
            clearTimeout(nv_timer);
        } else {
            window.location.href = window.location.href;
        }
    });
    return;
}
</script>

<!-- END: main -->