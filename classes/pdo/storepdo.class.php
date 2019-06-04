<?php

require 'pdomanager.class.php';
require SITE_ROOT.'/classes/store.class.php';

class StorePDO extends PDOManager {

	public function create($store) {
		$sql = "INSERT INTO stores VALUES ()";
		$query = $this->prepare($sql);
		$query->execute();
		$store->setId($this->lastInsertId('id'));
		return $store;
	}

	public function get($id) {
    	$sql = "SELECT * FROM stores WHERE id = :id";
    	$query = $this->prepare($sql);
        $query->execute(array(':id'=>$id));
        $result = $query->fetch();
        $store = new Store();
        if(!empty($result)) {
        	$store->setId($result['id']);
        }
        return $store;
    }

    /*public function update($store) {
		$sql = "UPDATE stores WHERE id = :id";
		$query = $this->prepare($sql);
		
		$result = $query->execute(
			array(
				':id'=>$store->getId()
			)
		);
	}*/

	public function delete($id) {
		$sql = "DELETE FROM stores WHERE id = :id";
		$query = $this->prepare($sql);
		$result = $query->execute(array(':id'=>$id));
	}

    public function getAll() {
    	$sql = "SELECT * FROM stores";
    	$query = $this->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $stores = [];
        foreach ($result as $key => $line) {
        	$store = new Store();
        	$store->setId($line['id']);
        	$stores[] = $store;
        }
        return $stores;
    }
}

?>