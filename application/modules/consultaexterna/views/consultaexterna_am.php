<?= modules::run('Sections/Menu/index'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/libs/light-bootstrap/all.min.css" />

<style>hr.style-eight {border: 0;border-top: 2px dashed #8c8c8c;text-align: center;}hr.style-eight:after {content: attr(data-titulo);display: inline-block;position: relative;top: -13px;font-size: 1.2em;padding: 0 0.20em;background: white;font-weight:bold;}</style>
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-11 col-centered">
            <div class="box-inner padding">
                <div class="panel panel-default " style="margin-top: -10px">
                    <div class="hide triage-status-paciente" style="margin-top: -10px;height: 35px;">
                        <br>
                        <h5 class="text-center" style="margin-top: -8px;color: white"><b>BAJA</b></h5>
                    </div>
                    <?php if($info[0]['triage_paciente_sexo']=='MUJER'){?>
                    <div  style="background: pink;width: 100%;height: 10px;border-radius: 3px 3px 0px 0px"></div>
                    <?php }?>
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                            ASISTENTES MÉDICAS - CONSULTA EXTERNA
                        </span>
                    </div>
                    <div class="panel-body b-b b-light">
                        <div class="card-body">
                            <form class="solicitud-am-consultaexterna">
                              <div class="row" style="margin-top: -20px">
                                  <div class="col-md-12" style="margin-top: 0px">
                                      <div class="row" >
                                        <hr class="style-eight" data-titulo="Datos de afiliación">
                                         <div class="col-md-4">
                                           <label style="text-transform: uppercase;font-weight: bold;">N.S.S</label>
                                             <div class="input-group">
                                               <input class="form-control"  required name="pum_nss" placeholder="" value="<?=$PINFO['pum_nss']?>">
                                               <span class="input-group-btn">
                                                 <button type="button" class="btn btn-secondary" id="btnVerificarNSS" >Verificar</button>
                                               </span>
                                             </div>
                                          </div>
                                          <!--   Modal para verificacion del la vigencia de afiliacion -->
                                          <div class="modal fade" id="ModalVigencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-lg" id="modalTamanioG">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                              <h4 class="modal-title" id="myModalLabel">Validacion de Vigencia de Derechos</h4>
                                                      </div>
                                                      <div class="modal-body table-responsive" id="infoNSS">
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group">
                                              <label style="text-transform: uppercase;font-weight: bold">N.S.S Agregado</label>
                                              <input class="form-control" required name="pum_nss_agregado" placeholder="" value="<?=$PINFO['pum_nss_agregado']?>">
                                          </div>
                                          </div>
                                          <div class="col-md-4" >
                                            <?php if($PINFO['pia_vigencia'] == 'SI'){
                                              $colorVigencia = 'background-color: rgb(144, 255, 149);';
                                            }else if($PINFO['pia_vigencia'] == 'NO'){
                                              $colorVigencia = 'background-color: rgb(252, 155, 155);';
                                            } ?>
                                              <div class="form-group" >
                                                  <label style="text-transform: uppercase;font-weight: bold">Vigencia de derechos</label>
                                                  <input class="form-control" style="<?=$colorVigencia ?>" required name="pia_vigencia" value="<?=$PINFO['pia_vigencia']?>">
                                              </div>
                                          </div>
                                      </div>
                                      <div class='row'>
                                        <div class="col-md-4">
                                              <div class="form-group">
                                                  <label style="text-transform: uppercase;font-weight: bold">Delegación IMSS</label>
                                                  <input class="form-control" required name="pum_delegacion" placeholder="" value="<?=$PINFO['pum_delegacion']?>">
                                              </div>
                                          </div>
                                         <div class="col-md-4">
                                              <div class="form-group" >
                                                  <label style="text-transform: uppercase;font-weight: bold">U.M.F de Adscripción</label>
                                                  <input class="form-control" required name="pum_umf" placeholder="" value="<?=$PINFO['pum_umf']?>">
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group" >
                                                  <label style="text-transform: uppercase;font-weight: bold">C.U.R.P</label>
                                                  <input class="form-control" required name="triage_paciente_curp" placeholder="" value="<?=$info[0]['triage_paciente_curp']?>">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <hr class="style-eight" data-titulo="Datos del Derechohabiente">
                                  <div class="col-md-4">
                                      <div class="form-group" >
                                          <label style="text-transform: uppercase;font-weight: bold">Apellido Paterno </label>
                                          <input class="form-control" required name="triage_nombre_ap" required=""  value="<?=$info[0]['triage_nombre_ap']?>">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group" >
                                          <label style="text-transform: uppercase;font-weight: bold">Apellido Materno </label>
                                          <input class="form-control" required name="triage_nombre_am" required=""  value="<?=$info[0]['triage_nombre_am']?>">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group" >
                                          <label style="text-transform: uppercase;font-weight: bold">Nombre </label>
                                          <input class="form-control" required name="triage_nombre" required="" placeholder="" value="<?=$info[0]['triage_nombre']?>">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group" >
                                          <label style="text-transform: uppercase;font-weight: bold">Fecha Nac</label>
                                          <input class="form-control dd-mm-yyyy" required name="triage_fecha_nac" placeholder="06/10/2016" value="<?=$info[0]['triage_fecha_nac']?>">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group" >
                                          <label style="text-transform: uppercase;font-weight: bold">Sexo</label>
                                          <select class="form-control" required="" name="triage_paciente_sexo" data-value="<?=$info[0]['triage_paciente_sexo']?>">
                                              <option value="">Seleccionar</option>
                                              <option value="HOMBRE">HOMBRE</option>
                                              <option value="MUJER">MUJER</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                        <hr class="style-eight" data-titulo="Domicilio">
                                        <div class="col-md-4">
                                            <div class="form-group" >
                                                <label style="text-transform: uppercase;font-weight: bold">Código Postal</label>
                                                <div class="input-group">
                                                <input class="form-control" required name="directorio_cp" placeholder="" value="<?=$DirPaciente['directorio_cp']?>">
                                                <span class="input-group-btn">
                                                  <button type="button" class="btn btn-secondary" id="buscarCP" ><i class="glyphicon glyphicon-search"></i></button>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Calle y Numero</label>
                                                <input class="form-control" required name="directorio_cn" placeholder="" value="<?=$DirPaciente['directorio_cn']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Colonia</label>
                                                <input class="form-control" required name="directorio_colonia" placeholder="" value="<?=$DirPaciente['directorio_colonia']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Municipio</label>
                                                <input class="form-control" required name="directorio_municipio" placeholder="" value="<?=$DirPaciente['directorio_municipio']?>">
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Estado</label>
                                                <input class="form-control" required name="directorio_estado" placeholder="" value="<?=$DirPaciente['directorio_estado']?>">
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase;font-weight: bold">Teléfono domicilio</label>
                                                <input class="form-control" type="number" required name="directorio_telefono" placeholder="" value="<?=$DirPaciente['directorio_telefono']?>">
                                            </div>
                                        </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <hr class="style-eight" data-titulo="Familiar Responsable">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label style="text-transform: uppercase;font-weight: bold">En Caso necesario llamar a:</label>
                                          <input class="form-control" name="pic_responsable_nombre" placeholder="" value="<?=$PINFO['pic_responsable_nombre']?>">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group" >
                                          <label style="text-transform: uppercase;font-weight: bold">Parentesco:</label>
                                          <input class="form-control" name="pic_responsable_parentesco" placeholder="" value="<?=$PINFO['pic_responsable_parentesco']?>">
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                      <div class="form-group" >
                                          <label style="text-transform: uppercase;font-weight: bold">Teléfono Responsable:</label>
                                          <div class="input-group">
                                            <input class="form-control" type="number" name="pic_responsable_telefono" placeholder="" value="<?=$PINFO['pic_responsable_telefono']?>">
                                            <span class="input-group-btn">
                                              <button target="_blank"  data-original-title="Dar click cuando el responsable tenga el mismo número que el paciente" type="button" class="btn btn-secondary tip" id="btnTelefonoPaciente" ><i class="glyphicon glyphicon-earphone"></i></button>
                                            </span>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <hr class="style-eight" data-titulo="Datos de internamiento">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="mayus-bold">ESPECIALIDAD:</label>
                                      <div class="input-group">
                                        <span class="input-group-addon back-imss border-back-imss"><i class="fa fa-user-md"></i></span>
                                        <select name="empleado_servicio" required id="selectServicios" class="select2 width100" data-value="Cardiología">
                                          <option value=''>Seleccione Servicio</option>
                                            <?php foreach ($Especialidades as $value) {?>
                                          <option value="<?=$value['especialidad_nombre']?>"><?=$value['especialidad_nombre']?></option>
                                        <?php }?>
                                          <option value='Cardiología'>Seleccione Servicio</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group notas_medicotratante" >
                                      <label class="mayus-bold">MEDICO TRATANTE:</label>
                                      <select class="select2 width100" required name="interConMedicoBase" id="divMedicos" data-value="<?=$Doc43051['ac_ingreso_matricula']?>">
                                        <option value="">SELECCIONAR MÉDICO TRATANTE</option>
                                        <?php foreach($Medico as $value){ ?>
                                          <option value="<?= $value['empleado_matricula']?>"><?php echo $value['empleado_nombre']." ".$value['empleado_apellidos'] ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group" >
                                        <label style="text-transform: uppercase;font-weight: bold">MATRICULA:</label>
                                        <input class="form-control" required name="ac_diagnostico" id="medicoMatricula" placeholder="" value="<?=$Doc43051['ac_ingreso_matricula']?>">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label style="text-transform: uppercase;font-weight: bold">HOSPITAL DE PROCEDENCIA</label>
                                      <select name="pia_procedencia_hospital" required data-value="<?=$PINFO['pia_procedencia_hospital']?>" class="form-control">
                                          <option value="">SELECCIONAR</option>
                                          <option value="UMF">UMF</option>
                                          <option value="HGZ">HGZ</option>
                                          <option value="UMAE">UMAE</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label style="text-transform: uppercase;font-weight: bold">Fecha de Ingreso</label>
                                      <div class="input-group">
                                        <input class="form-control dd-mm-yyyy" required name="ac_fecha" placeholder="06/10/2016" value="<?=$Doc43051['ac_fecha']?>">
                                        <span class="input-group-btn">
                                          <button target="_blank"  data-original-title="Dar click para asignar fecha y hora" type="button" class="btn btn-secondary tip" id="btnFecha" ><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group" >
                                        <label style="text-transform: uppercase;font-weight: bold">Diagnostico:</label>
                                        <input class="form-control" required name="ac_diagnostico" placeholder="" value="<?=$Doc43051['ac_diagnostico']?>">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="col-md-4">
                                    <div class="form-group" >
                                        <label style="text-transform: uppercase;font-weight: bold">Procedimiento:</label>
                                          <input class="form-control" required name="ac_procedimiento" placeholder="" value="<?=$Doc43051['ac_procedimiento']?>">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group" >
                                        <label style="text-transform: uppercase;font-weight: bold">Documento:</label>
                                        <select name="pia_documento" required data-value="<?=$PINFO['pia_documento']?>" class="form-control">
                                            <option value="" >DOCUMENTO</option>
                                            <option value="U4-30-8MF" >4-30-8</option>
                                            <option value="ESP" >ESP</option>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group" >
                                      <label style="text-transform: uppercase;font-weight: bold">Asistente Médica que registra</label>
                                      <input class="form-control" required name="pic_am" required="" placeholder="" value="<?=$PINFO['pic_am']=='' ? $empleado[0]['empleado_nombre'].' '.$empleado[0]['empleado_apellidos'] : $PINFO['pic_am']?>" disabled>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="col-md-4 col-md-offset-8">
                                    <input type="hidden" name="url_tipo" value="Am">
                                    <input type="hidden" name="csrf_token" >
                                    <input type="hidden" name="triage_id" value="<?=$this->uri->segment(3)?>">
                                    <input type="hidden" name="triage_solicitud_rx" value="<?=$info[0]['triage_solicitud_rx']?>">
                                    <input type="hidden" name="asistentesmedicas_id" value="<?=$solicitud[0]['asistentesmedicas_id']?>">
                                    <button class="md-btn md-raised m-b btn-fw back-imss  btn-block waves-effect no-text-transform pull-right" type="submit" style="margin-bottom: -10px">Guardar</button>
                                  </div>
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<input type="hidden" name="ConfigHojaInicialAsistentes" value="<?=CONFIG_AM_HOJAINICIAL?>">
<input type="hidden" name="CONFIG_AM_INTERACCION_LT" value="<?=CONFIG_AM_INTERACCION_LT?>">
<?= modules::run('Sections/Menu/footer'); ?>
<script type="text/javascript" src="<?= base_url()?>assets/libs/light-bootstrap/shieldui-all.min.js"></script>
<script src="<?= base_url('assets/js/Asistentemedica.js?'). md5(microtime())?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/ConsultaExterna.js?'). md5(microtime())?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/sections/Documentos.js?'). md5(microtime())?>" type="text/javascript"></script>
