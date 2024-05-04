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
    public function getAllExoda() {
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            if ($this->Exoda_model->Validate('User')) {
                $exodaData = $this->Exoda_model->getAllExoda();
                $this->Exoda_model->outputJSON($exodaData, 200);
            }
        }
    }

    //get exoda by id
    public function getExodaById($id = null) {
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            if ($this->Exoda_model->Validate('User')) {
                if ($id === null) {
                    $export['error'] = 'Error: No ID was provided';
                    $export['status'] = 404;
                    $export['message'] = 'You must provide an ID to get the data.';
                    $this->Exoda_model->outputJSON($export, $export['status']);
                }else {
                    $exodaData = $this->Exoda_model->getExodaById($id);
                    $this->Exoda_model->outputJSON($exodaData, 200);
                }
            }
        }
    }
}