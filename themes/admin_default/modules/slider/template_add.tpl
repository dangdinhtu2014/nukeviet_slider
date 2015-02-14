<!-- BEGIN: main -->
 
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
					<label class="col-sm-2 control-label" for="input-name">{LANG.template_name}</label>
					<div class="col-sm-10">
						<input type="text" name="name" value="{DATA.name}" placeholder="{LANG.template_name}" id="input-name" class="form-control" />
						<!-- BEGIN: error_name -->
						<div class="text-danger">{error_name}</div>
						<!-- END: error_name -->
					</div>
				</div>
 
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-status"><span data-toggle="tooltip" title="{LANG.template_help}">{LANG.template_status}</span></label>
					<div class="col-sm-10">
						<select name="status" id="input-status" class="form-control">
							<!-- BEGIN: status -->
							<option value="{STATUS.key}" {STATUS.selected}>{STATUS.name}</option>
							<!-- END: status -->
						</select>
					</div>
				</div>	 
				 		
				<div align="center">
					<input type="hidden" name ="template_id" value="{DATA.template_id}" />
					<input name="action" type="hidden" value="add" />
					<input name="save" type="hidden" value="1" />
				</div>
                     
			</form>
		</div>
	</div>
</div>
 
<script type="text/javascript" src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/footer.js"></script>
<!-- END: main -->