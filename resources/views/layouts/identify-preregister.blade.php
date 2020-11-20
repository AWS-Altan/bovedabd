<div class="col-sm-1">
</div>
<div class="col-sm-2">
	<div class="radio radio-info" style="padding-top: 10px;">
		<input type="radio" name="radio1" id="radio5" value="option1" checked="checked" Onclick="TipoDato4('msisdn')">
		<label for="radio5" style="margin-bottom: 0px;">MSISDN</label>
	</div>
</div>

<div class="col-sm-1">
	<div class="radio radio-info" style="padding-top: 10px;">
		<input type="radio" name="radio1" id="radio6" value="option2" Onclick="TipoDato4('icc')">
		<label for="radio6" style="margin-bottom: 0px;">ICC</label>
	</div>
</div>

<div class="col-sm-2">
	<div class="radio radio-info" style="padding-top: 10px;">
		<input type="radio" name="radio1" id="radio7" value="option3" Onclick="TipoDato4('imsi')">
		<label for="radio7" style="margin-bottom: 0px;">IMSI</label>
	</div>
</div>

<div class="col-sm-2">
	<div class="radio radio-info" style="padding-top: 10px;">
		<input type="radio" name="radio1" id="radio8" value="option4" Onclick="TipoDatoIdPreregistro('idPreregistro')">
		<label for="radio8" style="margin-bottom: 0px;">ID PRE-REGISTRO</label>
	</div>
</div>


<div class="col-sm-3">
	<div class="form-wrap" style="display: inline-block; width: 320px">
		<div class="form-group">
			<input type="text" data-minlength="10" class="form-control" id="inputData" placeholder="Ingrese valor de MSISDN a consultar" data-error="Valor inv�lido" maxlength="10">
			<div class="help-block with-errors" id="inputMSISDNError"></div>
		</div>
	</div>
</div>