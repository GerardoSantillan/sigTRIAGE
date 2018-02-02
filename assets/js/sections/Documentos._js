$(document).ready(function () {
    $('.select2').select2();
    $('textarea[name=cpr_nota]').wysihtml5();
    $('.hf_motivo_abierto').wysihtml5();
    
    var triage_paciente_accidente_lugar=$('input[name=pia_lugar_accidente]').val();
    if(triage_paciente_accidente_lugar=='TRABAJO'){
        $('.col-hojafrontal-info').removeClass('hide');
        $('textarea[name=hf_motivo]').keyup(function (e){
            $('textarea[name=asistentesmedicas_da]').val($(this).val());
        })
        $('textarea[name=hf_exploracionfisica]').keyup(function (e){
            $('textarea[name=asistentesmedicas_dl]').val($(this).val());
        })
        $('textarea[name=hf_diagnosticos]').keyup(function (e){
            $('textarea[name=asistentesmedicas_ip]').val($(this).val());
        })
        $('textarea[name=hf_indicaciones]').keyup(function (e){
            $('textarea[name=asistentesmedicas_tratamientos]').val($(this).val());
        })
    }else{
        $('body .hojafrontal-info').removeAttr('required');
    }
    $('select[name=hf_especialidad]').val($('select[name=hf_especialidad]').attr('data-value'))
    $('input[name=po_donador]').click(function (e) {
        if($(this).val()=='Si'){
            $('.po_donador').removeClass('hide');
        }else{
            $('select[name=po_criterio]').val('');
            $('.po_donador').addClass('hide');
        }
    })
    if($('input[name=po_donador]').attr('data-value')!='' && $('input[name=po_donador]').attr('data-value')=='Si'){
        $('input[name=po_donador][value="Si"]').attr('checked',true);
        $('.po_donador').removeClass('hide');
        $('select[name=po_criterio]').val($('select[name=po_criterio]').attr('data-value'))
    }
    $('input[name=hf_intoxitacion]').click(function (e) {
        if($(this).val()=='No'){
            $('.hf_intoxitacion').addClass('hide');
            $('input[name=hf_intoxitacion_descrip]').val('');
        }else{
            $('.hf_intoxitacion').removeClass('hide');
        }
    })
    if($('input[name=hf_intoxitacion]').attr('data-value')!='' && $('input[name=hf_intoxitacion]').attr('data-value')=='Si'){
        $('input[name=hf_intoxitacion]').attr('checked',true);
        $('.hf_intoxitacion').removeClass('hide');
    }
    $('.guardar-solicitud-hf').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"Sections/Documentos/GuardarHojaFrontal",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if($('input[name=tipo]').val()=='Consultorios'){
                    if($('input[name=ce_status]').val()!='Salida'){
                        GuardarDarAlta($('input[name=triage_id]').val());
                    }else{
                        AbrirDocumentoMultiple(base_url+'Inicio/Documentos/HojaFrontalCE/'+$('input[name=triage_id]').val(),'Hola Frontal',100);
                        if($('input[name=pia_lugar_accidente]').val()=='TRABAJO'){
                            AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ST7/'+$('input[name=triage_id]').val(),'ST7',500);
                        }if($('input[name=hf_ministeriopublico]:checked').val()=='Si'){
                            AbrirDocumentoMultiple(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/'+$('input[name=triage_id]').val(),'NMP',800);
                        }
                    }
                    
                }else{
                    bootbox.hideAll();
                    AbrirDocumentoMultiple(base_url+'Inicio/Documentos/HojaFrontalCE/'+$('input[name=triage_id]').val(),'Hola Frontal',100);
                    if($('input[name=pia_lugar_accidente]').val()=='TRABAJO'){
                        AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ST7/'+$('input[name=triage_id]').val(),'ST7',500);
                    }if($('input[name=hf_ministeriopublico]:checked').val()=='Si'){
                        AbrirDocumentoMultiple(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/'+$('input[name=triage_id]').val(),'NMP',800);
                    }
                    ActionCloseWindowsReload();
                }
            },error: function (e) {
                bootbox.hideAll();
                msj_error_serve()
                ReportarError(window.location.pathname,e.responseText);
            }
        })
    })
    $('input[name=asistentesmedicas_incapacidad_am]').click(function (e){
        if($(this).val()=='Si'){
            $('input[name=asistentesmedicas_incapacidad_ga]').removeAttr('disabled');
        }else{
            $('input[name=asistentesmedicas_incapacidad_ga]').attr('disabled',true);
            $('input[name=asistentesmedicas_incapacidad_ga][value=No]').prop("checked",true).click();
        }
    })
    $('input[name=asistentesmedicas_incapacidad_ga]').click(function (e){
        if($(this).val()=='Si'){
            $('select[name=asistentesmedicas_incapacidad_tipo]').removeAttr('disabled').click();
            $('input[name=asistentesmedicas_incapacidad_folio]').removeAttr('readonly');
            $('input[name=asistentesmedicas_incapacidad_fi]').removeAttr('readonly');
            $('input[name=asistentesmedicas_incapacidad_da]').removeAttr('readonly');
        }else{
            $('input[name=asistentesmedicas_incapacidad_folio]').attr('readonly',true).val('');
            $('input[name=asistentesmedicas_incapacidad_fi]').attr('readonly',true).val('');
            $('input[name=asistentesmedicas_incapacidad_da]').attr('readonly',true).val('');
            $('select[name=asistentesmedicas_incapacidad_tipo]').attr('disabled',true).val('');
            $('input[name=asistentesmedicas_incapacidad_dias_a]').attr('type','hidden').val('');
            
        }
    })
    if($('input[name=asistentesmedicas_incapacidad_am]').attr('data-value')=='Si'){
        $('input[name=asistentesmedicas_incapacidad_ga]').removeAttr('disabled');
        $('input[name=asistentesmedicas_incapacidad_ga][value="'+$('input[name=asistentesmedicas_incapacidad_ga]').data('value')+'"]').prop("checked",true).click();
        $('select[name=asistentesmedicas_incapacidad_tipo]').val($('select[name=asistentesmedicas_incapacidad_tipo]').attr('data-value'));
        
    }
    if($('input[name=asistentesmedicas_incapacidad_ga]').attr('data-value')=='Si' && $('select[name=asistentesmedicas_incapacidad_tipo]').attr('data-value')=='Subsecuente'){
        $('input[name=asistentesmedicas_incapacidad_dias_a]').attr('type','text');
    }
    $('select[name=asistentesmedicas_incapacidad_tipo]').click(function () {
        if($(this).val()=='Subsecuente'){
            $('input[name=asistentesmedicas_incapacidad_dias_a]').attr('type','text');
        }else{
            $('input[name=asistentesmedicas_incapacidad_dias_a]').attr('type','hidden');
        }
    })
    /**/
    $('input[name=hf_intoxitacion][value="'+$('input[name=hf_intoxitacion]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_urgencia][value="'+$('input[name=hf_urgencia]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_atencion][value="'+$('input[name=hf_atencion]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_especialidad][value="'+$('input[name=hf_especialidad]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_mecanismolesion_ab][value="'+$('input[name=hf_mecanismolesion_ab]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_mecanismolesion_td][value="'+$('input[name=hf_mecanismolesion_td]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_mecanismolesion_av][value="'+$('input[name=hf_mecanismolesion_av]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_mecanismolesion_maquinaria][value="'+$('input[name=hf_mecanismolesion_maquinaria]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_mecanismolesion_mordedura][value="'+$('input[name=hf_mecanismolesion_mordedura]').data('value')+'"]').prop("checked",true);
    
    $('input[name=hf_quemadura_fd][value="'+$('input[name=hf_quemadura_fd]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_quemadura_ce][value="'+$('input[name=hf_quemadura_ce]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_quemadura_e][value="'+$('input[name=hf_quemadura_e]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_quemadura_q][value="'+$('input[name=hf_quemadura_q]').data('value')+'"]').prop("checked",true);
    
    $('input[name=hf_trataminentos_curacion][value="'+$('input[name=hf_trataminentos_curacion]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_trataminentos_sutura][value="'+$('input[name=hf_trataminentos_sutura]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_trataminentos_vendaje][value="'+$('input[name=hf_trataminentos_vendaje]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_trataminentos_ferula][value="'+$('input[name=hf_trataminentos_ferula]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_trataminentos_vacunas][value="'+$('input[name=hf_trataminentos_vacunas]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_ministeriopublico][value="'+$('input[name=hf_ministeriopublico]').data('value')+'"]').prop("checked",true);
    
    $('select[name=hf_alta]').val($('select[name=hf_alta]').attr('data-value'))
    $('select[name=hf_alta]').click(function (e) {
        if($(this).val()=='Otros'){
            $('.hf_alta_otros').removeClass('hide');
        }else{
            $('.hf_alta_otros').addClass('hide');
        }
    });
    if($('select[name=hf_alta]').attr('data-value')=='Otros'){
        $('.hf_alta_otros').removeClass('hide');
    }
    $('input[name=asistentesmedicas_ss_in][value="'+$('input[name=asistentesmedicas_ss_in]').data('value')+'"]').prop("checked",true);
    $('input[name=asistentesmedicas_ss_ie][value="'+$('input[name=asistentesmedicas_ss_ie]').data('value')+'"]').prop("checked",true);
    $('input[name=asistentesmedicas_ss_in][value="'+$('input[name=asistentesmedicas_oc_hr]').data('value')+'"]').prop("checked",true);
    $('input[name=asistentesmedicas_oc_hr][value="'+$('input[name=asistentesmedicas_ss_in]').data('value')+'"]').prop("checked",true);
    $('input[name=asistentesmedicas_incapacidad_am][value="'+$('input[name=asistentesmedicas_incapacidad_am]').data('value')+'"]').prop("checked",true);
    $('input[name=asistentesmedicas_omitir]').click(function (e){
        if($(this).val()=='Si'){
            $('.asistentesmedicas_omitir').addClass('hide').find('.hojafrontal-info').removeAttr('required');
        }else{
            $('.asistentesmedicas_omitir').removeClass('hide').find('.hojafrontal-info').attr('required',true);
        }
    })
    if($('input[name=asistentesmedicas_omitir]').data('value')!='' && triage_paciente_accidente_lugar=='TRABAJO'){
        $('input[name=asistentesmedicas_omitir][value="'+$('input[name=asistentesmedicas_omitir]').data('value')+'"]').prop("checked",true);
        if($('input[name=asistentesmedicas_omitir]').data('value')=='Si'){
            $('.asistentesmedicas_omitir').addClass('hide').find('.hojafrontal-info').removeAttr('required');
        }if($('input[name=asistentesmedicas_omitir]').data('value')=='No'){
            $('.asistentesmedicas_omitir').removeClass('hide').find('.hojafrontal-info').attr('required',true);
        }
    }
    $('input[name=hf_alta][type=radio]').click(function (e){
        $('input[name=hf_alta][type=text]').val('');
    })
    function GuardarDarAlta(Folio) {
        bootbox.confirm({
            title:'<h5>GUARDAR Y DAR DE ALTA</h5>',
            message:'<div class="row">'+
                        '<div class="col-md-12">'+
                            '<h5>¿GUARDAR DATOS DATOS DEL PACIENTE Y DAR DE ALTA DE CONSULTORIO?</h5>'+
                        '</div>'+
                    '</div>',
            buttons:{
                cancel:{
                    label:'Espera Paciente'
                },confirm:{
                    label:'Egresar Paciente'
                }
            },callback:function (res) {
                if(res==true){
                    $.ajax({
                        url: base_url+"Consultorios/AjaxReportarSalida",
                        type: 'POST',
                        dataType: 'json',
                        data:{
                            'csrf_token':csrf_token,
                            'triage_id':Folio,
                        },beforeSend: function (xhr) {
                            msj_loading();
                        },success: function (data, textStatus, jqXHR) {
                            bootbox.hideAll();
                            AbrirDocumentoMultiple(base_url+'Inicio/Documentos/HojaFrontalCE/'+Folio,'Hola Frontal',100);
                            if($('input[name=pia_lugar_accidente]').val()=='TRABAJO'){
                                AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ST7/'+Folio,'ST7',500);
                            }if($('input[name=hf_ministeriopublico]:checked').val()=='Si'){
                                AbrirDocumentoMultiple(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/'+Folio,'NMP',800);
                            }
                            ActionCloseWindowsReload()
                        },error: function (e) {
                            msj_error_serve();
                            bootbox.hideAll();
                            ReportarError(window.location.pathname,e.responseText);
                        }
                    })
                }else{
                    bootbox.hideAll();
                    ActionCloseWindowsReload();
                    AbrirDocumentoMultiple(base_url+'Inicio/Documentos/HojaFrontalCE/'+Folio,'Hola Frontal',100);
                    if($('input[name=pia_lugar_accidente]').val()=='TRABAJO'){
                        AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ST7/'+Folio,'ST7',500);
                    }if($('input[name=hf_ministeriopublico]:checked').val()=='Si'){
                        AbrirDocumentoMultiple(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/'+Folio,'NMP',800);
                    }
                }
            }
        })
    }
    $('textarea[name=nota_nota]').wysihtml5();
    
    $('.Form-Notas-HojaFrontal').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url+"Sections/Documentos/AjaxHfCE",
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function (xhr) {
                msj_loading()
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    msj_success_noti('Registro Guardado');
                    AbrirDocumento(base_url+'Inicio/Documentos/NotaConsultoriosEspecialidad/'+data.notas_id);
                    ActionCloseWindowsReload();
                }
            },error: function (e) {
                bootbox.hideAll();
                msj_error_serve(e);
                ReportarError(window.location.pathname,e.responseText);
            }
        })
    })
    /*Uso de generacion de documento dinamicos*/
    if($('select[name=notas_tipo]').attr('data-value')!=''){
        $('select[name=notas_tipo]').val($('select[name=notas_tipo]').attr('data-value'));
    }
    /***/
    $('#hf_mecanismolesion').change(function () {
        if($(this).val().indexOf('Caida')!=-1){
            $('.mecanismo-lesion-caida').removeClass('hide');
        }else{
            $('input[name=hf_mecanismolesion_mtrs]').val('');
            $('.mecanismo-lesion-caida').addClass('hide');
        }
        if($(this).val().indexOf('Otros')!=-1){
            $('.mecanismo-lesion-otros').removeClass('hide');
        }else{
            $('input[name=hf_mecanismolesion_otros]').val('');
            $('.mecanismo-lesion-otros').addClass('hide');
        }
    })
    $('#hf_quemadura').change(function () {
        if($(this).val().indexOf('Otros')!=-1){
            $('.quemadura-otros').removeClass('hide');
        }else{
            $('input[name=hf_quemadura_otros]').val('');
            $('.quemadura-otros').addClass('hide');
        }
    })
    if($("input[name=hf_mecanismolesion_mtrs]").val()!=undefined){
        $("#hf_quemadura").val($('#hf_quemadura').attr('data-value').split(',')).select2();
        $("#hf_mecanismolesion").val($('#hf_mecanismolesion').attr('data-value').split(',')).select2();
        $("#hf_trataminentos").val($('#hf_trataminentos').attr('data-value').split(',')).select2();
    }
    
    if($('input[name=hf_mecanismolesion_mtrs]').val()!=''){
        $('.mecanismo-lesion-caida').removeClass('hide');
    }
    if($('input[name=hf_mecanismolesion_otros]').val()!=''){
        $('.mecanismo-lesion-otros').removeClass('hide');
    }
    if($('input[name=hf_quemadura_otros]').val()!=''){
        $('.quemadura-otros').removeClass('hide');
    }
    $('#hf_trataminentos').change(function () {
        if($(this).val().indexOf('Otros')!=-1){
            $('.hf_trataminentos_otros').removeClass('hide');
        }else{
            $('input[name=hf_trataminentos_otros]').val('');
            $('.hf_trataminentos_otros').addClass('hide');
        }
    });
    if($('input[name=hf_trataminentos_otros]').val()!=''){
        $('.hf_trataminentos_otros').removeClass('hide');
    }
    
    /*Diagnosticos*/
    if($('input[name=cie10_nombre').val()!=undefined){
       $('input[name=cie10_nombre').shieldAutoComplete({
            dataSource: {
                data: CIE10,
            },minLength: 5
        }); 
    }
    
    $('input[name=cie10_nombre]').removeClass('sui-input');
    $('body').on('click','.add-cie10',function() {
        if($('input[name=cie10_nombre]').val()!=''){
            SendAjax({csrf_token:csrf_token,cie10_nombre:$('input[name=cie10_nombre]').val()},'Sections/Documentos/AjaxCheckCIE10',function (response) {
                if(response.accion=='1'){
                    AjaxGuardarDiagnostico({
                        cie10_nombre:$('input[name=cie10_nombre]').val(),
                        cie10hf_obs:'',
                        cie10hf_id:0,
                        accion:'add'
                    })
                    $('input[name=cie10_nombre]').val('');   
                }else{
                    msj_error_noti('EL DIAGNOSTICO CIE10 NO EXISTE POR FAVOR SELECCIONE UNO DE LA LISTA')
                }
            },'');
             
        }
        
    })
    $('body').on('click','.sui-listbox-item',function() {
        var diagnostico=$(this).text();
        AjaxGuardarDiagnostico({
            cie10_nombre:diagnostico,
            cie10hf_obs:'',
            cie10hf_id:0,
            accion:'add'
        })
        $('input[name=cie10_nombre]').val('');
    })
    $('body').on('click','.editar-diagnostico-cie10',function() {
        AjaxGuardarDiagnostico({
            cie10_nombre:$(this).attr('data-nombre'),
            cie10hf_obs:$(this).attr('data-obs'),
            cie10hf_id:$(this).attr('data-id'),
            accion:'edit',
        })
    })
    function AjaxGuardarDiagnostico(info){
        bootbox.confirm({
            title:"<h5>AGREGAR DIAGNOSTICO</h5>",
            message:'<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<label class="mayus-bold">'+info.cie10_nombre+'</label><br>'+
                                '<label class="md-check">'+
                                    '<input type="radio" name="cie10hf_tipo" value="Primario" checked="">'+
                                    '<i class="blue"></i>Primario'+
                                '</label>&nbsp;&nbsp;&nbsp;&nbsp;'+
                                '<label class="md-check">'+
                                    '<input type="radio" name="cie10hf_tipo" value="Secundario">'+
                                    '<i class="blue"></i>Secundario'+
                                '</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
                                '<label class="md-check">'+
                                    '<input type="radio" name="cie10hf_estado" value="Presuntivo" checked="">'+
                                    '<i class="blue"></i>Presuntivo'+
                                '</label>&nbsp;&nbsp;&nbsp;&nbsp;'+
                                '<label class="md-check">'+
                                    '<input type="radio" name="cie10hf_estado" value="Definitivo">'+
                                    '<i class="blue"></i>Definitivo'+
                                '</label>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<textarea class="form-control" name="cie10hf_obs" placeholcer="Observaciones...">'+info.cie10hf_obs+'</textarea>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            buttons:{
                cancel:{
                    label:'Cancelar',
                    className:'btn-imss-cancel'
                },confirm:{
                    label:'Acepar',
                    className:'back-imss'
                }
            },callback:function(response){
                if(response==true){
                    var cie10hf_obs=$('body textarea[name=cie10hf_obs]').val();
                    var triage_id=$('body input[name=triage_id]').val();
                    var cie10hf_tipo=$('body input[name=cie10hf_tipo]:checked').val();
                    var cie10hf_estado=$('body input[name=cie10hf_estado]:checked').val()
                    SendAjax({
                        accion:info.accion,
                        cie10_nombre:info.cie10_nombre,
                        triage_id:triage_id,
                        cie10hf_obs:cie10hf_obs,
                        cie10hf_tipo:cie10hf_tipo,
                        cie10hf_estado:cie10hf_estado,
                        cie10hf_id:info.cie10hf_id,
                        csrf_token:csrf_token
                    },'Sections/Documentos/AjaxGuardarDiagnosticos',function(response) {
                        console.log(response)
                        if(response.accion=='1'){
                            AjaxObtenerDiagnosticos();
                        }else{
                            msj_error_noti('EL DIAGNOSTICO NO EXISTE');
                        }
                    },'');
                }
            }
            
        })
    }
    function AjaxObtenerDiagnosticos() {
        SendAjax({
            triage_id:$('input[name=triage_id]').val(),
            csrf_token:csrf_token
        },'Sections/Documentos/AjaxObtenerDiagnosticos',function(response) {
            $('.row-diagnosticos').html(response.row)
        },'');
    }
    if($('input[name=cie10_nombre]').val()!=undefined){
        AjaxObtenerDiagnosticos();
    }
    $('body').on('click','.eliminar-diagnostico-cie10',function(e) {
        var cie10hf_id=$(this).attr('data-id');
        $.ajax({
            url:base_url+'Sections/Documentos/AjaxEliminarDiagnostico',
            type: 'POST',
            dataType: 'json',
            data:{
                csrf_token:csrf_token,
                cie10hf_id:cie10hf_id
            },beforeSend: function (xhr) {
                
            },success: function (data, textStatus, jqXHR) {
                AjaxObtenerDiagnosticos()
            },error: function (jqXHR, textStatus, errorThrown) {
                bootbox.hideAll();
                MsjError();
            }
        })
    })
    /*Documento de Hoja Frontal Formato Abierto*/
    $('.hf_diagnosticos_abierto').wysihtml5();
    $('.guardar-solicitud-hi-abierto').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"Sections/Documentos/AjaxHojaInicialAbierto",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if($('input[name=tipo]').val()=='Consultorios'){
                    if($('input[name=ce_status]').val()!='Salida'){
                        AbrirDocumentoMultiple(base_url+'Inicio/Documentos/HojaInicialAbierto/'+$('input[name=triage_id]').val(),'Hola Inicial',100);
                        ActionCloseWindowsReload();
                    }else{
                        AbrirDocumentoMultiple(base_url+'Inicio/Documentos/HojaInicialAbierto/'+$('input[name=triage_id]').val(),'Hola Inicial',100);
                        if($('input[name=pia_lugar_accidente]').val()=='TRABAJO'){
                            AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ST7/'+$('input[name=triage_id]').val(),'ST7',500);
                        }
//                        if($('input[name=hf_ministeriopublico]:checked').val()=='Si'){
//                            AbrirDocumentoMultiple(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/'+$('input[name=triage_id]').val(),'NMP',800);
//                        }
                    }
                    
                }else{
                    bootbox.hideAll();
                    AbrirDocumentoMultiple(base_url+'Inicio/Documentos/HojaInicialAbierto/'+$('input[name=triage_id]').val(),'Hola Inicial',100);
                    if($('input[name=pia_lugar_accidente]').val()=='TRABAJO'){
                        AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ST7/'+$('input[name=triage_id]').val(),'ST7',500);
                    }
                    ActionCloseWindowsReload();
                }
            },error: function (e) {
                bootbox.hideAll();
                MsjError();
                console.log(e);
            }
        });
    });
    $('input[name=es_residente]').click(function () {
        if($(this).val()=='Si'){
            $('.notas_medicotratante').removeClass('hide');
        }else{
            $('.notas_medicotratante').addClass('hide');
            $('select[name=notas_medicotratante]').select2('val','').select2();
        }
    })
    if($('input[name=es_residente]').attr('data-value')!='0' && $('input[name=es_residente]').attr('data-value')!=''){
        $('input[name=es_residente][value=Si]').prop('checked',true);
        $('.notas_medicotratante').removeClass('hide');
        $('select[name=notas_medicotratante]').select2('val',$('select[name=notas_medicotratante]').attr('data-value')).select2();
    }
});