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
        $data['title'] = 'General expenses of the month';
        $this->load->view('allexoda', $data);
        $this->load->view('modals');
    }

    //Ajax Reuqests
    //get all exoda
    public function getCurrentMonthExoda()
    {
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $exodaData = $this->Exoda_model->getAllExoda();
            $currentMonth = date('m');
            $currentYear = date('Y');
            foreach ($exodaData as $key => $row) {
                if ($row['ExodoMonth'] != $currentMonth || $row['ExodoYear'] != $currentYear) {
                    unset($exodaData[$key]);
                }
            }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($exodaData));
        }
    }

    public function getExpensesbyMonthandYear() {
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $selectedMonth = $this->input->get('selectedMonth');
            $selectedYear = $this->input->get('selectedYear');
            $exodaData = $this->Exoda_model->getExodaByMonthandYear($selectedMonth, $selectedYear);
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
            $postdata['dateCreated'] = date('Y-m-d');
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
            $dataDB['Price'] = $postData['updatePrice'];
            $dataDB['ExodoMonth'] = $postData['updateExodoMonth'];
            $dataDB['Repeated'] = $postData['updateRepeated'];
            $dataDB['AutoRenew'] = $postData['updateAutoRenew'];
            $this->Exoda_model->updateExoda($postData['ID'], $dataDB);
            redirect(base_url('exoda'));
        }else {
            //send data to modal for update
            $id = $this->input->get('ID');
            $exodaData = $this->Exoda_model->getExodaById($id);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($exodaData));
        }
    }
}
