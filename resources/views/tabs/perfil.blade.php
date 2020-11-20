<div  id="perfil" class="tab-pane fade" role="tabpanel">
    <!-- Row -->
    <div class="row">
         <div class="col-sm-12 mt-40">
            <div class="panel panel-historico card-view">
                <h6 class="panel-title txt-dark mt-10">Perfil HSS/PCRF</h6>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table  class="table table-hover display pb-30" id ="perfilTable">
                                    <thead>
                                        <tr>
                                            <th>HLR</th>
                                            <th>UmtsSubscriber</th>
                                            <th>PdpContext</th>
                                            <th>EpsPdnContext</th>
                                            <th>vlrMobData</th>
                                            <th>sgsnMobData</th>
                                            <th>EPS</th>
                                            <th>HSS</th>
                                            <th>PCRF</th>               
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><ul id ="hlr"></ul></td>
                                            <td><ul id ="umt"></ul></td>
                                            <td><ul id ="pdp"></ul></td>
                                            <td><ul id ="epsPdn"></ul></td>
                                            <td><ul id ="vlr"></ul></td>
                                            <td><ul id ="sgs"></ul></td>
                                            <td><ul id ="eps"></ul></td>
                                            <td><ul id ="hss"></ul></td>
                                            <td>
                                                <ul>
                                                    <li id = "Dscimsi"><strong>Dscimsi: </strong>  </li>
                                                    <li id = "Dscnai"><strong>Dscnai: </strong>  </li>
                                                    <li id = "Dsccategory"><strong>Dsccategory: </strong>  </li>
                                                    <li id = "Dscoverage"><strong>Dscoverage: </strong>  </li>
                                                    <li id = "Dscsubstate"><strong>Dscsubstate: </strong>  </li>
                                                    <li id = "Dscsmsenable"><strong>Dscsmsenable: </strong> </li>
                                                    <li id = "Dscsubscriberprofileitem"><strong>Dscsubscriberprofileitem: </strong> </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                    
                                    
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>    
        </div>
    </div>
    <!-- /Row -->
    <div class="row" id="msg_perfil">
    </div>
</div>
