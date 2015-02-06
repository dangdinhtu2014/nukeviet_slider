<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.core.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.theme.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.menu.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.autocomplete.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.datepicker.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}js/shadowbox/shadowbox.js"></script>
<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}js/shadowbox/shadowbox.css" />
<script type="text/javascript">Shadowbox.init();</script>
<div id="content">
    <!-- BEGIN: error_warning -->
    <div class="alert alert-danger">
        <i class="fa fa-exclamation-circle"></i> {error_warning}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <br>
    </div>
    <!-- END: error_warning -->
    <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title" style="float:left"><i class="fa fa-pencil"></i> {CAPTION}</h3>
			<div class="pull-right">
				<button type="submit" data-toggle="tooltip" class="btn btn-primary" title="{LANG.save}"><i class="fa fa-save"></i></button> 
				<a href="{CANCEL}" data-toggle="tooltip" class="btn btn-default" title="{LANG.cancel}"><i class="fa fa-reply"></i></a>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="panel-body">
			<form action="" method="post" enctype="multipart/form-data" id="form-group" class="form-horizontal">
				<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-name">{LANG.group_name}</label>
					<div class="col-sm-10">
						<input type="text" name="name" value="{DATA.name}" placeholder="{LANG.group_name}" id="input-name" class="form-control" />
						<!-- BEGIN: error_name -->
						<div class="text-danger">{error_name}</div>
						<!-- END: error_name -->
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-alias">{LANG.group_alias}</label>
					<div class="col-sm-10">
						<div class="input-group">
							<input class="form-control" name="alias" placeholder="{LANG.group_alias}" type="text" value="{DATA.alias}" maxlength="255" id="input-alias" />
							<div class="input-group-addon fixaddon" data-toggle="tooltip" title="{LANG.create_alias}">
								&nbsp;<em class="fa fa-refresh fa-lg fa-pointer text-middle" onclick="get_alias();">&nbsp;</em>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-description">{LANG.group_description}</label>
					<div class="col-sm-10">
						<input type="text" name="description" value="{DATA.description}" placeholder="{LANG.group_description}" id="input-description" class="form-control" />
						<!-- BEGIN: error_description -->
						<div class="text-danger">{error_description}</div>
						<!-- END: error_description -->
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-keyword"> {GLANG.groups_view}</label>
					<div class="col-sm-10">
						<!-- BEGIN: groups_view -->

						<label>
							<input name="groups_view[]" type="checkbox" value="{GROUPS_VIEW.value}" {GROUPS_VIEW.checked} />{GROUPS_VIEW.title}</label>

						<!-- END: groups_view -->
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-status">{LANG.group_status}</label>
					<div class="col-sm-10">
						<select name="status" id="input-status" class="form-control">
							<!-- BEGIN: status -->
							<option value="{STATUS.key}" {STATUS.selected}>{STATUS.name}</option>
							<!-- END: status -->
						</select>
					</div>
				</div>	 
				 		
				<div align="center">
					<input type="hidden" name ="group_id" value="{DATA.group_id}" />
					<input name="action" type="hidden" value="add" />
					<input name="save" type="hidden" value="1" />
				</div>
                     
			</form>
		</div>
	</div>
</div>
 
<script type="text/javascript" src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/footer.js"></script>

<!-- BEGIN: getalias -->
<script type="text/javascript">
//<![CDATA[
$("#input-name").change(function() {
	get_alias('group', {DATA.group_id});
});
//]]>
</script>
<!-- END: getalias -->
<!-- END: main -->