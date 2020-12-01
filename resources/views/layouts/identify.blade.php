<div class="col-sm-1">
</div>
<div class="col-sm-2">
	<div class="radio radio-info" style="padding-top: 10px;">
		<input type="radio" name="radio1" id="radio5" value="option1" checked="checked" Onclick="fun_tipodato('msisdn')">
		<label for="radio5" style="margin-bottom: 0px;">
			MSISDN
		</label>
	</div>
</div>

<div class="col-sm-1">
	<div class="radio radio-info" style="padding-top: 10px;">
		<input type="radio" name="radio1" id="radio6" value="option2" Onclick="fun_tipodato('icc')">
		<label for="radio6" style="margin-bottom: 0px;">
			ICC
		</label>
	</div>
</div>

<div class="col-sm-2">
	<div class="radio radio-info" style="padding-top: 10px;">
		<input type="radio" name="radio1" id="radio7" value="option3" Onclick="fun_tipodato('imsi')">
		<label for="radio7" style="margin-bottom: 0px;">
			IMSI
		</label>
	</div>
</div>


<div class="col-sm-3">
	<div class="form-wrap" style="display: inline-block; width: 320px">
			<form id="form_identify">
				<div class="form-group">
					<input type="text" data-minlength="10" class="form-control" id="cmd_searchdata" placeholder="Ingrese valor de MSISDN a consultar" data-error="Valor inv�lido" maxlength="10">
					<div class="help-block with-errors" id="inputMSISDNError"></div>
				</div>
			</form>
		</div>
</div>
