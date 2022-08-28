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
		
		echo view('Layout/head');
		echo view('Layout/aside');
		echo view('dashboard', $response);
		echo view('Layout/footer');
		echo view('Js/dashboard');
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