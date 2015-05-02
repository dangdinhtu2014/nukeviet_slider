<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.core.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.theme.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.menu.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.autocomplete.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.datepicker.css" rel="stylesheet" />

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
					<label class="col-sm-4 control-label" for="input-title">{LANG.photo_title}</label>
					<div class="col-sm-20">
						<input type="text" name="title" value="{DATA.title}" placeholder="{LANG.photo_title}" id="input-title" class="form-control" />
						<!-- BEGIN: error_title -->
						<div class="text-danger">{error_title}</div>
						<!-- END: error_title -->
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-sub-title">{LANG.photo_sub_title}</label>
					<div class="col-sm-20">
						 <input type="text" name="sub_title" value="{DATA.sub_title}" placeholder="{LANG.photo_sub_title}" id="input-sub-title" class="form-control" />
					</div>
				</div>	 
				
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-alias">{LANG.photo_alias}</label>
					<div class="col-sm-20">
						<div class="input-group">
							<input class="form-control" name="alias" placeholder="{LANG.photo_alias}" type="text" value="{DATA.alias}" maxlength="255" id="input-alias" />
							<div class="input-group-addon fixaddon" data-toggle="tooltip" title="{LANG.create_alias}">
								&nbsp;<em class="fa fa-refresh fa-lg fa-pointer text-middle" onclick="get_alias();">&nbsp;</em>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
                    <label class="col-sm-4 control-label" for="image">{LANG.photo_image} </label>
                    <div class="col-sm-20">
						<div class="input-group">
							<input class="form-control" type="text" name="image" id="image" value="{DATA.image}" placeholder="{LANG.photo_image}"  />
							<span class="input-group-btn" >
								<input type="button" value="{LANG.select_image}" name="selectimg" class="btn btn-primary"  />
							</span>
						</div>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-4 control-label" for="input-background">{LANG.photo_background} </label>
                    <div class="col-sm-20">
						<div class="input-group">
							<input class="form-control" type="text" name="background" id="background" value="{DATA.background}" placeholder="{LANG.photo_background}"  />
							<span class="input-group-btn"  >
								<input type="button" value="{LANG.select_image}" name="selectbackground" class="btn btn-primary"  />
							</span>
						</div>
                    </div>
                </div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-links"><span data-toggle="tooltip" title="{LANG.photo_links_help}">{LANG.photo_links}</span></label>
					<div class="col-sm-20">
						<input type="text" name="links" value="{DATA.links}" placeholder="{LANG.photo_links}" id="input-links" class="form-control" />
						<!-- BEGIN: error_links -->
						<div class="text-danger">{error_links}</div>
						<!-- END: error_links -->
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-group">{LANG.photo_group}</label>
					<div class="col-sm-20">
						<select name="group_id" id="input-group" class="form-control">
							<!-- BEGIN: group -->
							<option value="{GROUP.key}" {GROUP.selected}>{GROUP.name}</option>
							<!-- END: group -->
						</select>
 					</div>
				</div>	 
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-intro">{LANG.photo_intro}</label>
					<div class="col-sm-20">
						 <textarea name="intro" rows="2" col="3" id="input-intro" placeholder="{LANG.photo_intro}" class="form-control">{DATA.intro}</textarea>
						 
					</div>
				</div>	 
				
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-description">{LANG.photo_description}</label>
					<div class="col-sm-20">
						 {DATA.description}
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-keyword"> {GLANG.groups_view}</label>
					<div class="col-sm-20">
						<!-- BEGIN: groups_view -->

						<label>
							<input name="groups_view[]" type="checkbox" value="{GROUPS_VIEW.value}" {GROUPS_VIEW.checked} />{GROUPS_VIEW.title}</label>

						<!-- END: groups_view -->
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-status">{LANG.photo_status}</label>
					<div class="col-sm-20">
						<select name="status" id="input-status" class="form-control">
							<!-- BEGIN: status -->
							<option value="{STATUS.key}" {STATUS.selected}>{STATUS.name}</option>
							<!-- END: status -->
						</select>
					</div>
				</div>	 
				 		
				<div align="center">
					<input type="hidden" name ="photo_id" value="{DATA.photo_id}" />
					<input name="action" type="hidden" value="add" />
					<input name="save" type="hidden" value="1" />
				</div>
                     
			</form>
		</div>
	</div>
</div>
 
<script type="text/javascript" src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/footer.js"></script>
<script type="text/javascript">
$("input[name=selectimg]").click(function() {
	var area = "image";
	var path = "{UPLOAD_PATH}";
	var currentpath = "{UPLOAD_CURRENT}";
	var type = "image";
	nv_open_browse(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
	return false;
});
$("input[name=selectbackground]").click(function() {
	var area = "background";
	var path = "{UPLOAD_PATH}";
	var currentpath = "{UPLOAD_CURRENT}";
	var type = "image";
	nv_open_browse(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
	return false;
});
</script>
<!-- BEGIN: getalias -->
<script type="text/javascript">
//<![CDATA[
$("#input-title").change(function() {
	get_alias('photo', {DATA.photo_id});
});
//]]>
</script>
<!-- END: getalias -->
<!-- END: main -->