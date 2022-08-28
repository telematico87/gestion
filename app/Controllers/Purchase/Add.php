<?php

namespace App\Controllers\Purchase;
use CodeIgniter\Controller;
use App\Models\PurchaseModel;
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
		$purchaseModel = new PurchaseModel();
        $data["suppliers"] = $purchaseModel->readSuppliers();

		echo view('Layout/head');
		echo view('Layout/aside');
		echo view('Purchase/add', $data);
		echo view('Layout/footer');
		echo view('Js/purchase');
	}

	public function getProducts(){
		$purchaseModel = new PurchaseModel();
        echo json_encode($purchaseModel->readProducts());
	}

	public function getSuppliers(){
		$purchaseModel = new PurchaseModel();
        echo json_encode($purchaseModel->readSuppliers());
	}

	public function save()
	{
		$purchase = $this->request->getJsonVar("purchase", true);
		$purchaseDetails = $this->request->getJsonVar("purchasedetails", true);
	
		$validation = $this->validate([
			'purchase.total' => 'greater_than[0]',
			'purchase.supplier_id' => 'required'
			],
		    [
				'purchase.total' => [
					'greater_than' => 'No puedes realizar la compra sin productos validos',
				],
				'purchase.supplier_id' => [
					'required' => 'No puedes realizar la compra sin un proveedor',
				],
			]);

		if(!$validation){
			echo json_encode($this->validator->getErrors());
		} else {
			$this->detail($purchase, $purchaseDetails);
		}
	}

	private function detail($purchase, $purchaseDetails) {

		$purchaseModel = new PurchaseModel();
		
		$errorAmount = in_array(0, array_column($purchaseDetails, 'amount'));
		$errorSale = in_array(0, array_column($purchaseDetails, 'infopricesale'));

		if($errorSale){
			echo json_encode(['purchase.total' => 'No puedes realizar la compra si el precio de venta es menor que el de compra']);
		} else if($errorAmount){
			echo json_encode(['purchase.total' => 'No puedes realizar la compra sin importes validos']);
		} else {
			$id = $purchaseModel->createPurchase($purchase);

			foreach ($purchaseDetails as $value) {

				$productId = $value['productid'];
				$cant = $value['cant'];
				$amount = $value['amount'];
				$pricePurchase = $value['pricepurchase'];
				$priceSale = $value['pricesale'];
	
				$data = [
					'purchase_id' => $id,
					'product_id' => $productId,
					'cant' => $cant,
					'amount' => $amount
				];
				
				$purchaseModel->createPurchaseDetails($data);
				$this->updateStock($productId, $cant, $pricePurchase,  $priceSale);
			}

			echo json_encode("success");
		}

	}

	private function updateStock($id, $cant, $pricePurchase,  $priceSale) {
		$purchaseModel = new PurchaseModel();
		$purchaseModel->updateProduct($id, $cant, $pricePurchase, $priceSale);
		$session = Services::session();
		$session->setFlashdata("success", "Los datos se guardaron correctamente!");
	}
}