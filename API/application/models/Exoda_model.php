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
        // Get the Authorization header
        $authorization_header = $this->input->get_request_header('Authorization', TRUE);
        // Check if the Authorization header exists
        if ($authorization_header) {
            // Split the header value to extract the authentication type and API key
            $parts = explode(' ', $authorization_header);
            // Check if the header is in the format "Basic <base64_encoded_api_key>"
            if (!empty($parts[1]) && $parts[0] === 'Basic'){
                // Use the API key as needed
                return $parts[1];
            } else {
                return null;
            }
        }
    }


    //get clients IP
    private function getClientIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            // IP from shared internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // IP passed from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    private function isIpAllowed()
    {
        $allowedIps = array('127.0.0.1', '::1'); // Example IP addresses allowed to access
        $clientIp = $this->getClientIp();
        return in_array($clientIp, $allowedIps);
    }

    public function Validate($required_role)
    {
        // Retrieve and validate API key from Authorization header
        $apikey = $this->get_api_key_from_header();
        $queryData = $this->db->get_where('tblapikeys', ['apiKey' => $apikey])->row();
        if (!empty($queryData)) {
            if (($queryData->role === "Admin" || $queryData->role === $required_role)) {
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

    public function getExodaSum()
    {
        $this->db->select_sum('Price');
        $this->db->where('RenewType', 'Month');
        return $this->db->get('tblexoda')->row()->Price;
    }
}
