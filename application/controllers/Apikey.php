<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ApiKey extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
        $this->load->model('Exoda_model');
	}

    //restfull API urls

    //get all exoda
    public function generatenewApiKey($userID) {
        $this->Exoda_model->generate_key($userID);
    }
}