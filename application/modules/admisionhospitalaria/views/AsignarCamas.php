<?= modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12">
            <!-- Boton de Actualización -->
            <a href="#" class="md-btn md-fab md-fab-top-right pos-fix red " onclick="ActualizarCconteoAutomatico()" style="top: 75px">
                <i class="fa fa-refresh i-24 text-color-white tip" ></i>
            </a>
            <div class="row " style="margin-top: 10px">
                <div class="col-md-12">
                    <div class="panel-group visor-camas" id="accordion"></div>
                </div>

            </div>
        </div>
    </div>
</div>
<input type="hidden" name="AdmisionHospitalaria">
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/AdmisionHospitalaria.js?'). md5(microtime())?>" type="text/javascript"></script>
