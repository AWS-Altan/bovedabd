<!-- Blade de busquedas de usuario-->
<!-- -->
<!-- -->

<!-- sisfen - falta arreglar los tipos de datos -->

<div class="col-sm-1">
</div>
<div class="col-sm-2">
	<div class="radio radio-info" style="padding-top: 10px;">
		<input type="radio" name="rdb_Radio1" id="radio5" value="option1" checked="checked" Onclick="TipoDato4('email')">
		<label for="radio5" style="margin-bottom: 0px;">
			Ticket /  INC:
		</label>
	</div>
</div>

<div class="col-sm-1">
	<div class="radio radio-info" style="padding-top: 10px;">
		<input type="radio" name="radio1" id="radio6" value="option2" Onclick="TipoDato4('icc')">
		<label for="radio6" style="margin-bottom: 0px;">
			REQ:
		</label>
	</div>
</div>

<!-- sisfen - falta cambiar este: -->
<div class="col-sm-2">
	<div class="radio radio-info" style="padding-top: 10px;">
		<input type="radio" name="radio1" id="radio7" value="option3" Onclick="TipoDato4('imsi')">
		<label for="radio7" style="margin-bottom: 0px;">
			CR:
		</label>
	</div>
</div>



<div class="col-sm-3">
	<div class="form-wrap" style="display: inline-block; width: 320px">
			<form id="form_identify">
				<div class="form-group">
					<input type="text" data-minlength="10" class="form-control" id="inputData" placeholder="Ingrese Numero de INC" data-error="Valor inv�lido" maxlength="10">
					<div class="help-block with-errors" id="inputMSISDNError"></div>
				</div>
			</form>
		</div>
</div>
