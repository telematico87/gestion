<?php

namespace App\Controllers\Purchase;
use CodeIgniter\Controller;
use App\Models\PurchaseDetailModel;

class Detail extends Controller
{
	public function index($id)
	{
		$purchaseDetailModel = new PurchaseDetailModel();
		$data = [
			"purchase" =>  $purchaseDetailModel->readPurchase($id),
			"purchasedetails" => $purchaseDetailModel->readPurchaseDetails($id)
		];

		echo view('Layout/head');
		echo view('Layout/aside');
		echo view('Purchase/detail', $data);
		echo view('Layout/footer');
		echo view('js/purchase');
	}
}