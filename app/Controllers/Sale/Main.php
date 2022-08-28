<?php

namespace App\Controllers\Sale;
use CodeIgniter\Controller;
use App\Models\SaleModel;

class Main extends Controller
{
	public function index()
	{
		$saleModel = new SaleModel();
        $data["sales"] = $saleModel->readSales();

		echo view('Layout/head');
		echo view('Layout/aside');
		echo view('Sale/main', $data);
		echo view('Layout/footer');
		echo view('js/sale');
	}
}