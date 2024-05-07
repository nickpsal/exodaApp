<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exoda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Exoda_model');
    }

    //exoda view
    public function index()
    {
        $this->load->view('allexoda');
    }

    public function getAllExoda()
    {
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $exodaData = $this->Exoda_model->getAllExoda();
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($exodaData));
        }
    }

    //get exoda by id
    public function getExodaById($id = null)
    {
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $exodaData = $this->Exoda_model->getExodaById($id);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($exodaData));
        }
    }

    //post exoda
    public function postExoda()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //post data
            $postdata = $this->input->post();
            $exodaData = $this->Exoda_model->postExoda($postdata);
        }else {
            //show edit form
        }
    }

    //update exoda
    public function putExoda($id)
    {
        if ($this->input->server('REQUEST_METHOD') == 'PUT') {
            if ($this->Exoda_model->Validate('Admin')) {
                // Retrieve POST data
                $datarow = file_get_contents('php://input');
                $data = json_decode($datarow, true);
                $exodaData = $this->Exoda_model->updateExoda($id, $data[0]);
                $this->Exoda_model->outputJSON($data, 200);
            }
        } else {
            $export['error'] = 'Error: Incorrect Method';
            $export['status'] = 400; // Bad Request
            $export['message'] = 'This method is not allowed on this URL.';
            $this->Exoda_model->outputJSON($export, $export['status']);
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
        } else {
            $export['error'] = 'Error: Incorrect Method';
            $export['status'] = 400; // Bad Request
            $export['message'] = 'This method is not allowed on this URL.';
            $this->Exoda_model->outputJSON($export, $export['status']);
        }
    }

    //sum of month exoda
    public function getExodaSumByMonth()
    {
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            if ($this->Exoda_model->Validate('User')) {
                $sum = $this->Exoda_model->getExodaSumbyMonth();
                $msg = "Month expenses are {$sum} Euro per Month";
                $this->Exoda_model->outputJSON($msg, 200);
            }
        } else {
            $export['error'] = 'Error: Incorrect Method';
            $export['status'] = 400; // Bad Request
            $export['message'] = 'This method is not allowed on this URL.';
            $this->Exoda_model->outputJSON($export, $export['status']);
        }
    }

    //sum of Year exoda
    public function getExodaSumByYear()
    {
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            if ($this->Exoda_model->Validate('User')) {
                $sum = $this->Exoda_model->getExodaSumbyYear();
                $msg = "Year expenses are {$sum} Euro per Year";
                $this->Exoda_model->outputJSON($msg, 200);
            }
        } else {
            $export['error'] = 'Error: Incorrect Method';
            $export['status'] = 400; // Bad Request
            $export['message'] = 'This method is not allowed on this URL.';
            $this->Exoda_model->outputJSON($export, $export['status']);
        }
    }
}
