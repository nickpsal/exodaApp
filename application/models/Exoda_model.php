<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exoda_model extends CI_Model
{    
    public function getAllExoda()
    {
        return $this->db->get("tblexoda")->result_array();
    }

    public function getExodaById($id)
    {
        $query['ID'] = $id;
        return $this->db->get_where("tblexoda", $query)->row_array();
    }

    public function getExodaByMonth($selectedMonth)
    {
        $this->db->where('ExodoMonth', $selectedMonth);
        return $this->db->get('tblexoda')->result_array();
    }

    public function postExoda($data)
    {
        $this->db->insert("tblexoda", $data);
    }

    public function deleteExoda($id)
    {
        $this->db->delete("tblexoda", ['ID' => $id]);
    }

    public function updateExoda($id, $data)
    {
        foreach ($data as $column => $replace) {
            $this->db->set($column, $replace);
        }
        $this->db->where('ID', $id);
        $this->db->update('tblexoda');
    }
}
