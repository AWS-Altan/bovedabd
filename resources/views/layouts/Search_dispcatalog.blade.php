<!-- Blade de busquedas de usuario-->
<!-- -->
<!-- -->


<div class="col-sm-1">
	<div class="radio radio-info" style="padding-top: 10px;">
		<input type="radio" name="radio1" id="radio5" value="option1" checked="checked" Onclick="TipoDato4('ip')">
		<label for="radio5" style="margin-bottom: 0px;">
			IP
		</label>
	</div>
</div>

<div class="col-sm-2">
	<div class="radio radio-info" style="padding-top: 10px;">
		<input type="radio" name="radio1" id="radio6" value="option2" Onclick="TipoDato4('hostname')">
		<label for="radio6" style="margin-bottom: 0px;">
			HOSTNAME
		</label>
	</div>
</div>


<!-- -->

<div class="col-sm-3">
	<div class="form-wrap" style="display: inline-block; width: 320px">
			<form id="form_identify">
				<div class="form-group">
					<input type="text" data-minlength="10" class="form-control" id="inputData" placeholder="Ingrese valor a consultar" data-error="Valor inv�lido" maxlength="150">
					<div class="help-block with-errors" id="inputMSISDNError"></div>
				</div>
			</form>
		</div>
</div>

