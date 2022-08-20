<?php 
namespace App\Models;
use CodeIgniter\Model;

class SaleDetailModel extends Model {

	public function readSale($id){
		$results = $this->db
		->table('sale s')
		->select('s.id, s.subtotal, s.discount, s.igv, s.total, s.date, c.name as client, c.phone_number, c.type_document, c.num_document, c.email, v.name as voucher')
		->join('client c','c.id=s.client_id')
		->join('voucher v','v.id=s.voucher_id')
		->where('s.id', $id)
		->get()
		->getRowObject();

		return $results;
    }

	public function readSaleDetails($id){
		$results = $this->db
		->table('sale_detail d')
		->select('d.cant, d.amount, p.name as product, p.price_sale as pricesale')
		->join('product p','p.id=d.product_id')
		->where('d.sale_id', $id)
		->get()
		->getResultObject();

		return $results;
    }
}