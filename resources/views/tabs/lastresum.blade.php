<div  id="ofertas" class="tab-pane fade" role="tabpanel">
    <!-- Oferta Actual -->
    <div class="mb-10">
        <h6 class="txt-dark capitalize-font">Servicios Contratados</h6>
    </div>
    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-striped table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Nombre Oferta</th>                                                                    
                        <th>Tipo de Servicio</th>
                        <th style="width: 60px;">UoM</th>
                        <th style="width: 80px;">Cuota</th>
                        <th>Unidades Disponibles</th>
                        <th>Fecha Inicio CI</th>
                        <th>Fecha Fin CI</th>
                        <th>Velocidad Downlink</th>                
                        <th>Renovaci&oacute;n Automática</th>
                        <th>OfferID</th>
                        <th>Ciclo individual</th>
                    </tr>
                </thead>
                @foreach ($profile->purchasedOfferings->offers as $offert)
                @isset ($offert->offeringId)
                    @if ( isset( $offertname[$offert->offeringId] ) AND  $offertname[$offert->offeringId]['offerType'] == 'Primary' )
                        @if ( !in_array($offert->offeringId, $avalid) )
                            <tbody>
                                <tr style="font-weight: bold;">
                                    <td> 
                                        @if (isset( $offertname[$offert->offeringId])) 
                                            @php 
                                                $nombre = $offertname[$offert->offeringId]['productName'];
                                                $oferta = $offertname[$offert->offeringId];
                                            @endphp
                                            {{ $offertname[$offert->offeringId]['productName']  }} 
                                        @else 
                                            @php $nombre = "nombre"; @endphp
                                            No se encontro la oferta en el listado de ofertas para mvno 
                                        @endif 
                                    </td>                                                              
                                    <td>Oferta Primaria</td>
                                    @if ( $profile->redirect->active == "true" )
                                        <td>MB</td>
                                        <td>{{ convertToReadableSize($profile->redirect->initialAmt) }} <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor en Bytes: {{$profile->redirect->initialAmt}}"></td>
                                        <td>{{ convertToReadableSize($profile->redirect->availableAmt) }} <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor en Bytes: {{$profile->redirect->availableAmt}}"></td>
                                    @else
                                        <td>@if( $offert->uom == 'Mb' or $offert->uom == 'Bytes' ) GB <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor aproximando en Gb"> @else {{ $offert->uom }} @endif</td>
                                        <td>
                                            @if( $offert->uom == 'Mb' or $offert->uom == 'Bytes' )
                                                {{ convertToReadableSize($offert->initialAmt) }} <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor en Bytes: {{$offert->initialAmt}}">
                                            @else {{ $offert->initialAmt }} @endif
                                        </td>
                                        <td>
                                            @if( $offert->uom == 'Mb' or $offert->uom == 'Bytes' )
                                                {{ convertToReadableSize($offert->availableAmt) }} <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor en Bytes: {{$offert->availableAmt}}">
                                            @else {{ $offert->availableAmt }} @endif
                                        </td>
                                    @endif
                                    
                                    <td>{{ parser_date($offert->startEffectiveDate) }}</td>
                                    <td>{{ parser_date($offert->expireEffectiveDate) }}</td>
                                    <td>{{ $offert->speed }}</td>
                                    <td>@if($offert->isRennovable == 'false') NO @else SI @endif</td>
                                    <td>{{ $offert->offeringId }}</td>
                                    <td>{{ cicloindividual($nombre,$oferta,$offert->expireEffectiveDate) }}</td>
                                </tr>
                            </tbody>
                        @endif
                        @php 
                            $primario++;
                            $avalid[$offert->offeringId] = $offert->offeringId;
                            $renovacion = $offert->isRennovable;
                        @endphp
                    @endif
                @endisset
                    
                @endforeach
                @if ( $primario == 0 )
                    <tbody>
                        <tr style="font-weight: bold;">
                            <td> Oferta Primaria </td>                                                              
                            <td>Oferta Primaria</td>
                            @if ( $profile->redirect->active == "true" )
                                <td>MB</td>
                                <td>{{ convertToReadableSize($profile->redirect->initialAmt) }} <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor en Bytes: {{$profile->redirect->initialAmt}}"></td>
                                <td>{{ convertToReadableSize($profile->redirect->availableAmt) }} <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor en Bytes: {{$profile->redirect->availableAmt}}"></td>
                            @else
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                            @endif
                            <td>{{ parser_date($profile->redirect->startEffectiveDate) }}</td>
                            <td>{{ parser_date($profile->redirect->expireEffectiveDate) }}</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>offertid</td>
                            <td>N/A</td>
                        </tr>
                    </tbody>
                @endif
                @foreach ($profile->purchasedOfferings->offers as $offert)
                @isset ($offert->offeringId)
                    @if ( $offert->offeringId !== "N/A" )
                        @if ( isset( $offertname[$offert->offeringId] ) )
                            @if($offertname[$offert->offeringId]['offerType'] !== 'Primary')
                                <tbody>
                                    <tr>
                                        <td>
                                            @if (isset( $offertname[$offert->offeringId])) 
                                                @php 
                                                    $nombre = $offertname[$offert->offeringId]['productName']; 
                                                    $oferta = $offertname[$offert->offeringId];
                                                @endphp
                                                {{ $offertname[$offert->offeringId]['productName']  }} 
                                            @else 
                                                @php $nombre = "nombre"; @endphp
                                                No se encontro la oferta en el listado de ofertas para mvno 
                                            @endif
                                        </td>                                                              
                                        <td>{{ $offert->serviceType }}</td>
                                        <td>@if( $offert->uom == 'Mb' or $offert->uom == 'Bytes' ) GB <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor aproximando en Gb"> @else {{ $offert->uom }} @endif</td>
                                        <td>
                                            @if( $offert->uom == 'Mb' or $offert->uom == 'Bytes' )
                                                {{ convertToReadableSize($offert->initialAmt) }} <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor en Bytes: {{$offert->initialAmt}}">
                                            @else {{ $offert->initialAmt }} @endif
                                        </td>
                                        <td>
                                            @if( $offert->uom == 'Mb' or $offert->uom == 'Bytes' )
                                                {{ convertToReadableSize($offert->availableAmt) }} <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor en Bytes: {{$offert->availableAmt}}">
                                            @else {{ $offert->availableAmt }} @endif
                                        </td>
                                        <td>{{ parser_date($offert->startEffectiveDate) }}</td>
                                        <td>{{ parser_date($offert->expireEffectiveDate) }}</td>
                                        <td>@if(in_array($offert->serviceType,['SMS','Voz']) ) N/A @else {{$offert->speed}} @endif</td>
                                        <td>@if($offert->isRennovable == 'false') NO @else SI @endif</td>
                                        <td>{{ $offert->offeringId }}</td>
                                        <td>{{ cicloindividual($nombre,$oferta,$offert->expireEffectiveDate) }}</td>
                                    </tr>
                                </tbody>
                            @endif
                        @else
                            <tbody>
                                <tr>
                                    <td>N/A</td>                                                              
                                    <td>{{ $offert->serviceType }}</td>
                                    <td>@if( $offert->uom == 'Mb' or $offert->uom == 'Bytes' ) GB <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor aproximando en Gb"> @else {{ $offert->uom }} @endif</td>
                                    <td>
                                        @if( $offert->uom == 'Mb' or $offert->uom == 'Bytes' )
                                            {{ convertToReadableSize($offert->initialAmt) }} <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor en Bytes: {{$offert->initialAmt}}">
                                        @else {{ $offert->initialAmt }} @endif
                                    </td>
                                    <td>
                                        @if( $offert->uom == 'Mb' or $offert->uom == 'Bytes' )
                                            {{ convertToReadableSize($offert->availableAmt) }} <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor en Bytes: {{$offert->availableAmt}}">
                                        @else {{ $offert->availableAmt }} @endif
                                    </td>
                                    <td>{{ parser_date($offert->startEffectiveDate) }}</td>
                                    <td>{{ parser_date($offert->expireEffectiveDate) }}</td>
                                    <td>@if(in_array($offert->serviceType,['SMS','Voz']) ) N/A @else {{$offert->speed}} @endif</td>
                                    <td>@if($offert->isRennovable == 'false') NO @else SI @endif</td>
                                    <td>{{ $offert->offeringId }}</td>
                                    <td>N/A</td>
                                </tr>
                            </tbody>
                        @endif
                    @else
                        <tbody>
                            <tr>
                                <td>N/A</td>                                                              
                                <td>{{ $offert->serviceType }}</td>
                                <td>@if( $offert->uom == 'Mb' or $offert->uom == 'Bytes' ) GB <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor aproximando en Gb"> @else {{ $offert->uom }} @endif</td>
                                <td>
                                    @if( $offert->uom == 'Mb' or $offert->uom == 'Bytes' )
                                        {{ convertToReadableSize($offert->initialAmt) }} <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor en Bytes: {{$offert->initialAmt}}">
                                    @else {{ $offert->initialAmt }} @endif
                                </td>
                                <td>
                                    @if( $offert->uom == 'Mb' or $offert->uom == 'Bytes' )
                                        {{ convertToReadableSize($offert->availableAmt) }} <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Valor en Bytes: {{$offert->availableAmt}}">
                                    @else {{ $offert->availableAmt }} @endif
                                </td>
                                <td>{{ parser_date($offert->startEffectiveDate) }}</td>
                                <td>{{ parser_date($offert->expireEffectiveDate) }}</td>
                                <td>@if(in_array($offert->serviceType,['SMS','Voz']) ) N/A @else {{$offert->speed}} @endif</td>
                                <td>@if($offert->isRennovable == 'false') NO @else SI @endif</td>
                                <td>{{ $offert->offeringId }}</td>
                                <td>N/A</td>
                            </tr>
                        </tbody>
                    @endif
                @endisset
                @endforeach
            </table>
        </div>
    </div>
    <!-- Oferta Actual -->
    <ul><hr class="light-grey-hr mt-40 mb-0"/></ul>
    <div class="mt-20 mb-10">
        <h6 class="txt-dark capitalize-font">Periodo – Fecha solicitud.</h6>
    </div>
    <div class="row">
        <div class="form-fecha" style=" display:flex; align-items:flex-end;">
            <div class="col-sm-4">
                <label class="control-label mb-5">Fecha Inicial</label>
                <div class='input-group date' id="dateInicioResumen">
                    <input id="offert_txtDate2" type='text' class="form-control" placeholder="MM/DD/AÑO"/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
               </div>
            </div>
            <div class="col-sm-4">
                <label class="control-label mb-5">Fecha Final</label>
                <div class='input-group date' id="dateFinResumen">
                    <input id="offert_txtDate3" type='text' class="form-control" placeholder="MM/DD/AÑO"/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="col-sm-3">
                <a id="consult_offert" type="button" class="btn btn-primary">Buscar</a>
            </div>
        </div>
    </div>
    <div class="row" id="msg_offert">

    </div>

    <!-- Row -->
    <div class="row">
         <div class="col-sm-12 mt-40">
            <div class="panel panel-historico card-view">
                <h6 class="panel-title txt-dark mt-10">Hist&oacute;rico Ofertas</h6>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="offert_history" class="table table-hover display" >
                                    <thead>
                                        <tr>
                                            <th>OfferID</th>
                                            <th>Tipo de Servicio</th>
                                            <th>UoM</th>
                                            <th>Cuota</th>
                                            <th>Fecha Inicio CI</th>
                                            <th>Fecha Fin CI</th>
                                            <th>Velocidad Downlink</th>
                                            <th>Renovaci&oacute;n Automática</th>                      
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>    
        </div>
    </div>
    <!-- /Row -->
</div>