<?= modules::run('Sections/Menu/HeaderBasico'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/libs/light-bootstrap/all.min.css" />
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered" >
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">ASIGNAR CAMA AL PACIENTE</span>
                </div>
                <div class="panel-body b-b b-light">
                    <form class="form-asignacion-cama">
                        <div class="row-sm">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="ac_ingreso_servicio" value="<?=$info_43051['ac_ingreso_servicio']?>" placeholder="SERVICIO ORDENO INGRESO" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="ac_ingreso_matricula" value="<?=$info_43051['ac_ingreso_matricula']?>" placeholder="MATRICULA ORDENO INGRESO" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="ac_ingreso_medico" value="<?=$info_43051['ac_ingreso_medico']?>" placeholder="MÉDICO ORDENO INGRESO" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="ac_salida_servicio" value="<?=$info_43051['ac_salida_servicio']?>" placeholder="SERVICIO ORDENO SALIDA" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="ac_salida_matricula" value="<?=$info_43051['ac_salida_matricula']?>" placeholder="MATRICULA ORDENO SALIDA" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="ac_salida_medico" value="<?=$info_43051['ac_salida_medico']?>" placeholder="MÉDICO ORDENO SALIDA" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select name="ac_infectado" class="form-control">
                                        <option>Seleccionar si el paciente esta infectado</option>
                                        <option value="Si">Si</option>
                                        <option value="No" selected="">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row-sm">
                            <div class="col-sm-12 back-imss" >
                              <div class="row-sm">
                                  <div class="col-sm-11">
                                      <div style="padding: 10px"  >
                                          <b>DIRECCIÓN DEL RESPONSABLE</b>
                                      </div>
                                  </div>
                                  <div class="col-sm-1">
                                    <div class="form-group" >
                                        <a class="btn btn-default tip" onclick="DireccionResponsable(<?=$_GET['triage_id']?>)" id="btnBuscarDireccion" value="2" data-original-title="Ingresa direccion del paciente" >
                                          <i class="glyphicon glyphicon-user"></i>
                                        </a>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row-sm">
                          <div class="col-sm-4">
                              <div class="form-group">
                                  <br><input type="text" name="responsable_nombre" value="<?=$Responsable['pic_responsable_nombre']?>" class="form-control" placeholder="Nombre">
                              </div>
                          </div>
                          <div class="col-sm-4">
                              <div class="form-group">
                                  <br><input type="text" name="responsable_parenteso" value="<?=$Responsable['pic_responsable_parentesco']?>" class="form-control" placeholder="Parentesco">
                              </div>
                          </div>
                          <div class="col-sm-4">
                              <div class="form-group">
                                  <br><input type="text" name="responsable_telefono" value="<?=$Responsable['pic_responsable_telefono']?>" class="form-control" placeholder="Telefono">
                              </div>
                          </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="directorio_cp" value="" class="form-control" placeholder="Código Postal">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="directorio_cn" value="" class="form-control" placeholder="Calle y Numero">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group" id="the-basics">
                                    <input type="text" name="directorio_colonia" class="form-control" autocomplete="off" placeholder="Colonia">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="directorio_municipio" class="form-control" placeholder="Municipio">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="directorio_estado" class="form-control" placeholder="Estado">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="hidden" name="cama_id" value="<?=$_GET['cama']?>">
                                    <input type="hidden" name="triage_id" value="<?=$_GET['triage_id']?>">
                                    <input type="hidden" name="empleado_matricula" value="<?=$_GET['empleado_matricula']?>">
                                    <input type="hidden" name="ac_cama_estatus" value="<?=$_GET['cama_estatus']?>">
                                    <input type="hidden" name="csrf_token">
                                    <button class="btn back-imss btn-block" id="btnGu" >Guardar</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script type="text/javascript" src="<?= base_url()?>assets/libs/light-bootstrap/shieldui-all.min.js"></script>
<script src="<?= base_url('assets/js/AdmisionHospitalaria.js?').md5(microtime())?>" type="text/javascript"></script>
