<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Areasacceso
 *
 * @author bienTICS
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Areasacceso extends Config{
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
        $sql['Gestion']=  $this->config_mdl->_query('SELECT * FROM os_areas_acceso, os_roles WHERE
                                                    os_areas_acceso.areas_acceso_rol=os_roles.rol_id');
        $this->load->view('Areasacceso/index',$sql);
    }
    public function AjaxArea() {
        $data=array(
            'areas_acceso_nombre'=>  $this->input->post('areas_acceso_nombre'),
            'areas_acceso_rol'=> $this->input->post('areas_acceso_rol'),
            'areas_acceso_status'=>'',
            'areas_acceso_mod'=> $this->input->post('areas_acceso_mod'),
            'areas_acceso_mod_val'=> $this->input->post('areas_acceso_mod_val')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->_insert('os_areas_acceso',$data);
        }else{
            unset($data['areas_acceso_status']);
            $this->config_mdl->_update_data('os_areas_acceso',$data,array(
                'areas_acceso_id'=>  $this->input->post('areas_acceso_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxObtenerArea() {
        $this->setOutput($this->config_mdl->_get_data_condition('os_areas_acceso',array('areas_acceso_id'=>  $this->input->post('areas_acceso_id'))));
    }
    public function AjaxEliminarArea() {
        if($this->config_mdl->_delete_data('os_areas_acceso',array('areas_acceso_id'=>  $this->input->post('areas_acceso_id')))
        ){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function AjaxGetRoles() {
        $sql= $this->config_mdl->_get_data('os_roles');
        foreach ($sql as $value) {
            $option.='<option value="'.$value['rol_id'].'">'.$value['rol_nombre'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function AjaxAcciones() {
        $this->config_mdl->_update_data('os_areas_acceso',array(
            'areas_acceso_status'=> $this->input->post('areas_acceso_status')
        ),array(
            'areas_acceso_id'=>  $this->input->post('areas_acceso_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
