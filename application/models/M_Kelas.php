<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
/**
 * Description of Import Model
 *
 * @author Coders Mag Team
 *
 * @email  info@techarise.com
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class M_Kelas extends CI_Model {
    private $_batchImport;
 
    public function setBatchImport($batchImport) {
        $this->_batchImport = $batchImport;
    }
 
    // save data
    public function importData() {
        $data = $this->_batchImport;
        $this->db->insert_batch('kelas', $data);
    }
    // get employee list
    public function matkul() {
        $this->db->select(array('k.id_kelas','k.nama_kelas'));
        $this->db->from('kelas as k');
        $query = $this->db->get();
        return $query->result_array();
    }
}
 
?>