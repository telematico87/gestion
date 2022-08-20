<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\DashboardModel;

class Dashboard extends Controller
{
	/**
	* Instance of the main Request object.
	*
	* @var CLIRequest|IncomingRequest
	*/
  	protected $request;

	public function index()
	{
		$dashboardModel = new DashboardModel();
		$response = $dashboardModel->readInfo();
		
		echo view('layout/head');
		echo view('layout/aside');
		echo view('dashboard', $response);
		echo view('layout/footer');
		echo view('js/dashboard');
	}

	public function getSalesGlobal()
	{	
		$year = $this->request->getVar("year");
		$dashboardModel = new DashboardModel();
		$response = $dashboardModel->readSalesGlobal($year);
		echo json_encode($response);
	}

	public function getSalesWeek()
	{
		$dashboardModel = new DashboardModel();
		$response = $dashboardModel->readSalesWeek();
		echo json_encode($response);
	}
}