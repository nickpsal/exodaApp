<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exoda_model extends CI_Model
{

    public function generate_key($userID)
    {
        // Generate a random string and then hash it
        $randomBytes = random_bytes(16);  // Generates secure random bytes
        $key = bin2hex($randomBytes);     // Converts bytes to hex to make it a usable API key

        $data = [
            'userID' => $userID,
            'apiKey' => $key,
            'role' => 'user',
        ];

        $this->db->insert('tblapikeys', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    public function get_api_key_from_header()
    {
        $header = $this->input->get_request_header('Authorization', TRUE);
        if (!empty($header) && strpos($header, 'Basic ') === 0) {
            $token = substr($header, 6); // Remove 'Basic ' from the beginning
            return $token;
        }
        return null;
    }

    public function Validate($required_role)
    {
        // Retrieve and validate API key from Authorization header
        $apikey = $this->get_api_key_from_header();
        $queryData = $this->db->get_where('tblapikeys', ['apiKey' => $apikey])->row();
        if (!empty($queryData)) {
            if ($queryData->role === "Admin" || $queryData->role === $required_role) {
                return true;
            } else {
                $export['error'] = 'Forbidden: Insufficient Permissions';
                $export['status'] = 403;
                $export['message'] = 'You do not have permission to access this resource.';
                $this->outputJSON($export, $export['status']);
            }
        } else {
            $export['error'] = 'Unauthorized: Invalid API Key';
            $export['status'] = 401;
            $export['message'] = 'You are not authorized to access this resource.';
            $this->outputJSON($export, $export['status']);
        }
    }

    public function outputJSON($data, $statusCode = 200)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_status_header($statusCode)
            ->set_output(json_encode($data));
    }

    public function getAllExoda()
    {
        return $this->db->get("tblexoda")->result_array();
    }

    public function getExodaById($id)
    {
        $query['ID'] = $id;
        return $this->db->get_where("tblexoda", $query)->row_array();
    }
}
