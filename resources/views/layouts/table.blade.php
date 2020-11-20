<div class="table-wrap">
	<div class="table-responsive">
		<table class="table table-striped table-bordered mb-0 demo1">
			<thead>
				<tr>
					<th><span style="color:#9E1D22; font-weight: bold;">MVNO</span></th>
					<th><span style="color:#9E1D22; font-weight: bold;">MSISDN</span></th>
					<th><span style="color:#9E1D22; font-weight: bold;">IMSI</span></th>
					<th><span style="color:#9E1D22; font-weight: bold;">IMEI <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Si se ha reemplazado el equipo o la Sim Card no ha sido utilizada en ning&uacute;n equipo el IMEI podr&iacute;a no ser el actual."> </span></th>
					<th><span style="color:#9E1D22; font-weight: bold;">ICC</span></th>
					<th><span style="color:#9E1D22; font-weight: bold;">BE_ID</span></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{ app('session')->get('choose_mvno')->name }}</td>
					<td id="setmsisdn"></td>
					<td id="setimsi"></td>
					<td id="setimei"></td>
					<td id="seticc"></td>
					<td id="setbeid"></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>