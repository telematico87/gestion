<?php 
namespace App\Models;
use CodeIgniter\Model;

class DashboardModel extends Model {

	public function readInfo(){
		$product = $this->db
		->table('product')
		->where('barcode !=','')
		->countAllResults();

		$sale = $this->db
		->table('sale')
		->select('SUM(total) as totalselling')
		->get()
		->getRow();

		$client = $this->db
		->table('client')
		->countAllResults();

		$supplier = $this->db
		->table('supplier')
		->countAllResults();

		$years = $this->db
		->table('sale')
		->select('YEAR(date) as year')
		->groupBy('year')
		->orderBy('year', 'desc')
		->get()
		->getResultArray();

		return ['product' => $product, 'sale' => $sale, 'client' => $client, 'supplier' => $supplier, 'years' => json_encode($years)];
    }

	public function readSalesGlobal($year){
		$results = $this->db
		->table('sale')
		->select('MONTH(date) as month, SUM(total) as amount')
		->where("date >=", "$year-01-01")
		->where("date <=", "$year-12-31")
		->groupBy('month')
		->orderBy('month')
		->get()
		->getResultArray();

		return $results;
    }

	public function readSalesWeek(){
		$results = $this->db
		->query('SELECT DAYOFWEEK(sale.date) as day, SUM(sale.total) as data FROM `sale` WHERE YEARWEEK(sale.date) = YEARWEEK(CURDATE()) GROUP BY day ORDER BY day')
		->getResultArray();
		
		return $results;
    }
}