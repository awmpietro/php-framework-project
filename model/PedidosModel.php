<?php
namespace model;

class PedidosModel extends BaseModel{

	function __construct(){
		$this->table = 'pedido';
		parent::__construct();
	}
	
	public function getPedidos(){
		$sql = "SELECT r.id as id, r.id_produto as produto_id, r.id_cliente as cliente_id,p.nome as produto_nome, c.nome as cliente_nome  FROM {$this->table} as r";
		$sql .= " LEFT JOIN produto as p ON (r.id_produto = p.id)";
		$sql .= " LEFT JOIN cliente as c ON (r.id_cliente = c.id)";
		$results = $this->db->select($sql);
		return $results;
	}
	
	public function getpedido($id){
		$sql = "SELECT r.id as id, r.id_produto as produto_id, r.id_cliente as cliente_id,p.nome as produto_nome, c.nome as cliente_nome  FROM {$this->table} as r";
		$sql .= " LEFT JOIN produto as p ON (r.id_produto = p.id)";
		$sql .= " LEFT JOIN cliente as c ON (r.id_cliente = c.id)";
		$sql .= " WHERE r.id = {$id}";
		$results = $this->db->select($sql);
		return $results;
	}
	
	public function createPedido($data){
		extract($data);
		$sql = "INSERT INTO {$this->table} (id_produto, id_cliente) VALUES ('{$id_produto}', '{$id_cliente}')";
		if($this->db->query($sql)){
			return true;
		}else{
			return false;
		}
	}
	
	public function updatePedido($id, $data){
		extract($data);
		$sql = "UPDATE {$this->table} SET id_produto = '{$id_produto}', id_cliente = '{$id_cliente}' WHERE id = {$id}";
		if($this->db->query($sql)){
			return true;
		}else{
			return false;
		}	
	}
	
	public function removerPedido($id) {
		$sql = "DELETE FROM {$this->table} WHERE id = {$id}";
		if($this->db->query($sql)){
			return true;
		}else{
			return false;
		}
	}
	
}