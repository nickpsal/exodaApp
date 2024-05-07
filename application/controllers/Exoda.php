<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exoda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Exoda_model');
    }

    //views
    //index view
    public function index()
    {
        $data['title'] = 'All Exoda';
        $this->load->view('allexoda', $data);
    }

    //Ajax Reuqests
    //get all exoda
    public function getAllExoda()
    {
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $exodaData = $this->Exoda_model->getAllExoda();
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
            $this->Exoda_model->postExoda($postdata);
            redirect(base_url('exoda'));
        }
    }

     //delete exoda
     public function deleteExoda()
     {
        $id = $this->input->post('ID');
        $this->Exoda_model->deleteExoda($id);
        return json_encode('');
     }

    //update exoda
    public function putExoda()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //update data
            $postData = $this->input->post();
            $dataDB['Description'] = $postData['updateDescription'];
            $dataDB['RenewType'] = $postData['updateRenewType'];
            $dataDB['ValidUntil'] = $postData['updateValidUntil'];
            $dataDB['Price'] = $postData['updatePrice'];
            $dataDB['Autopay'] = $postData['updateAutopay'];
            $this->Exoda_model->updateExoda($postData['ID'], $dataDB);
            redirect(base_url('exoda'));
        }else {
            //dend data to modal for update
            $id = $this->input->get('ID');
            $exodaData = $this->Exoda_model->getExodaById($id);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($exodaData));
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
