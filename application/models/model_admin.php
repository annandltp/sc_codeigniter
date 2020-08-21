<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Gilang
 * Date: 5/8/13
 * Time: 9:16 AM
 * To change this template use File | Settings | File Templates.
 */

class Model_admin extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    //  ================= AUTOMATIC CODE ==================
    //    KODE BARANG
    function getKodeFoto(){
        $q = $this->db->query("select MAX(RIGHT(kode_foto,3)) as kd_max from tbl_foto");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "B-".$kd;
    }
    public function getAllData($table)
    {
        return $this->db->get($table)->result();
    }
    public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, $data);
    }
    function updateData($table,$data,$field_key)
    {
        $this->db->update($table,$data,$field_key);
    }
    function deleteData($table,$data)
    {
        $this->db->delete($table,$data);
    }
    function insertData($table,$data)
    {
        $this->db->insert($table,$data);
    }
    function manualQuery($q)
    {
        return $this->db->query($q);
    }
}