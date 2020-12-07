<!-- Blade de busquedas de usuario-->
<!-- -->
<!-- -->

<!-- sisfen - falta arreglar los tipos de datos -->

<div class="col-sm-1">
</div>
<div class="col-sm-2">
	<div class="radio radio-info" style="padding-top: 10px;">
		<input type="radio" name="rdb_Radio1" id="radio5" value="option1" checked="checked" Onclick="fun_tipodato('hostname')">
		<label for="radio5" style="margin-bottom: 0px;">
			Host Name
		</label>
	</div>
</div>

<div class="col-sm-1">
	<div class="radio radio-info" style="padding-top: 10px;">
		<input type="radio" name="radio1" id="radio6" value="option2" Onclick="fun_tipodato('IP')">
		<label for="radio6" style="margin-bottom: 0px;">
			IP
		</label>
	</div>
</div>

<!-- sisfen - falta cambiar este: -->
<div class="col-sm-2">
	<div class="radio radio-info" style="padding-top: 10px;">
		<input type="radio" name="radio1" id="radio7" value="option3" Onclick="fun_tipodato('username')">
		<label for="radio7" style="margin-bottom: 0px;">
			Usuario
		</label>
	</div>
</div>



<div class="col-sm-3">
	<div class="form-wrap" style="display: inline-block; width: 320px">
			<form id="form_identify">
				<div class="form-group">
					<input type="text" data-minlength="5" class="form-control" id="cmd_searchdata" placeholder="Ingrese Nombre del dispositivo" data-error="Valor inv�lido" maxlength="100">
					<div class="help-block with-errors" id="inputMSISDNError"></div>
				</div>
			</form>
		</div>
</div>
