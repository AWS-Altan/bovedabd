@extends('layouts.app')

@section('content')
	<div class="col-sm-12">
		<div class="panel panel-default card-view">
			<div class="panel-heading">
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body" style="text-align: center;">
					<object width="800" height="500" type="application/pdf" data="{{ config('conf.url_miniature').$doc }}">
			            <p>PDF no disponible.</p>
			        </object>
				</div>
			</div>
		</div>
	</div>
@endsection
