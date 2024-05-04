<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exoda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Exoda_model');
    }

    //restfull API urls
    //get all exoda
    public function getAllExoda()
    {
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            if ($this->Exoda_model->Validate('User')) {
                $exodaData = $this->Exoda_model->getAllExoda();
                $this->Exoda_model->outputJSON($exodaData, 200);
            }
        }
    }

    //get exoda by id
    public function getExodaById($id = null)
    {
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            if ($this->Exoda_model->Validate('User')) {
                if ($id === null) {
                    $export['error'] = 'Error: No ID was provided';
                    $export['status'] = 404;
                    $export['message'] = 'You must provide an ID to get the data.';
                    $this->Exoda_model->outputJSON($export, $export['status']);
                } else {
                    $exodaData = $this->Exoda_model->getExodaById($id);
                    $this->Exoda_model->outputJSON($exodaData, 200);
                }
            }
        }
    }

    //post exoda
    public function postExoda()
    {
        $isChecked = true;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if ($this->Exoda_model->Validate('Admin')) {
                // Retrieve POST data
                $data = $this->input->post();
                // Check if required data is provided
                $requiredFields = array('Description', 'RenewType', 'ValidUntil', 'Price', 'Autopay');
                foreach ($requiredFields as $field) {
                    if (!isset($data[$field]) || $data[$field] === '') {
                        $isChecked = false;
                        $export['error'] = 'Error: Missing data';
                        $export['status'] = 400; // Bad Request
                        $export['message'] = 'Missing data. Please provide all required fields.';
                        $this->Exoda_model->outputJSON($export, $export['status']);
                    }
                }
                if ($isChecked) {
                    // Insert data into the database
                    $exodaData = $this->Exoda_model->postExoda($data);
                    $this->Exoda_model->outputJSON($data, 200);
                }
            }
        }
    }

    //delete exoda
    public function deleteExoda($id = null)
    {
        if ($this->input->server('REQUEST_METHOD') === 'DELETE') {
            if ($this->Exoda_model->Validate('Admin')) {
                if ($id === null) {
                    $export['error'] = 'Error: No ID was provided';
                    $export['status'] = 404;
                    $export['message'] = 'You must provide an ID to get the data.';
                    $this->Exoda_model->outputJSON($export, $export['status']);
                } else {
                    $exodaData = $this->Exoda_model->deleteExoda($id);
                    $export['message'] = 'Exoda deleted successfully';
                    $this->Exoda_model->outputJSON($export, 200);
                }
            }
        }
    }

    
}