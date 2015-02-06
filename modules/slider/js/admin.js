function get_alias(mod, id) {
	var name = strip_tags(document.getElementById('input-title').value);
	if (name != '') {
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=alias&nocache=' + new Date().getTime(), 'name=' + encodeURIComponent(name) + '&mod=' + mod + '&id=' + id, function(res) {
			if (res != "") {
				document.getElementById('input-alias').value = res;
			} else {
				document.getElementById('input-alias').value = '';
			}
		});
	}
	return false;
}
 