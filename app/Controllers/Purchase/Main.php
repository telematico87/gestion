<?php

namespace App\Controllers\Purchase;
use CodeIgniter\Controller;
use App\Models\PurchaseModel;

class Main extends Controller
{
	public function index()
	{
		$purchaseModel = new PurchaseModel();
        $data["purchases"] = $purchaseModel->readPurchases();

		echo view('Layout/head');
		echo view('Layout/aside');
		echo view('Purchase/main', $data);
		echo view('Layout/footer');
		echo view('js/purchase');
	}
}