<?php

namespace App\Controllers\Sale;
use CodeIgniter\Controller;
use App\Models\SaleModel;
use Config\Services;

class Add extends Controller
{
	/**
	* Instance of the main Request object.
	*
	* @var CLIRequest|IncomingRequest
	*/
	protected $request;

	public function index()
	{
		$saleModel = new SaleModel();
        $data["clients"] = $saleModel->readClients();

		echo view('Layout/head');
		echo view('Layout/aside');
		echo view('Sale/add', $data);
		echo view('Layout/footer');
		echo view('Js/sale');
	}

	public function getProducts(){
		$saleModel = new SaleModel();
        echo json_encode($saleModel->readProducts());
	}

	public function getClients(){
		$saleModel = new SaleModel();
        echo json_encode($saleModel->readClients());
	}

	public function save()
	{
		$sale = $this->request->getJsonVar("sale", true);
		$saledetails = $this->request->getJsonVar("saledetails", true);
	
		$saleModel = new SaleModel();

		$validation = $this->validate([
			'sale.total' => 'greater_than[0]',
			'sale.client_id' => 'required'
			],
		    [
				'sale.total' => [
					'greater_than' => 'No puedes realizar la compra sin productos validos',
				],
				'sale.client_id' => [
					'required' => 'No puedes realizar la compra sin un cliente',
				],
			]);

		if(!$validation){
			echo json_encode($this->validator->getErrors());
		} else {
			$id = $saleModel->createSale($sale);
			$this->detail($id, $saledetails);
		}
	}

	private function detail($id, $saledetails) {

		$saleModel = new SaleModel();

		foreach ($saledetails as $value) {
			$data = [
				'sale_id' => $id,
				'product_id' => $value['id'],
				'cant' => $value['cant'],
				'amount' => $value['amount']
			];

			$saleModel->createSaleDetails($data);
			$this->updateStock($value['id'], $value['cant']);
		}
		
		echo json_encode("success");
	}

	private function updateStock($id, $cant) {
		$saleModel = new SaleModel();
		$saleModel->updateProduct($id, $cant);
		$session = Services::session();
		$session->setFlashdata("success", "Los datos se guardaron correctamente!");
	}
}