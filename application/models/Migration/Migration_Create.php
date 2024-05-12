<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->createTable_tblexoda();
	}

	private function createTable_tblexoda()
	{
		$sql = "
			CREATE TABLE IF NOT EXISTS `tblexoda` (
			`ID` int NOT NULL AUTO_INCREMENT,
			`Description` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
			`Price` decimal(6,2) NOT NULL,
			`ExodoMonth` int NOT NULL,
			`ExodoYear` int NOT NULL,
			`dateCreated` date NOT NULL,
			`Repeated` tinyint NOT NULL,
			`AutoRenew` tinyint NOT NULL,
			PRIMARY KEY (`ID`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
      	";

		$this->db->query($sql);
	}
}
