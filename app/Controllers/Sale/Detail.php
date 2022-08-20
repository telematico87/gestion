<?php

namespace App\Controllers\Sale;
use CodeIgniter\Controller;
use App\Models\SaleDetailModel;

class Detail extends Controller
{
	public function index($id)
	{
		$saleDetailModel = new SaleDetailModel();
		$data = [
			"sale" =>  $saleDetailModel->readSale($id),
			"saledetails" => $saleDetailModel->readSaleDetails($id)
		];

		echo view('Layout/head');
		echo view('Layout/aside');
		echo view('Sale/detail', $data);
		echo view('Layout/footer');
		echo view('js/sale');
	}
}