<?php

require_once 'pdomanager.class.php';
require_once SITE_ROOT.'/classes/store.class.php';
require_once SITE_ROOT.'/classes/item.class.php';

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

    public function addItem($storeId,$itemId) {
        $sql = "INSERT INTO store_items(store_id,item_id) VALUES (:store_id,:item_id)";
        $query = $this->prepare($sql);
        $query->execute(
            array(
                ':store_id'=>$storeId,
                ':item_id'=>$itemId
            )
        );
    }

    public function removeItem($storeId,$itemId) {
        $sql = "DELETE FROM store_items(store_id,item_id) VALUES (:store_id,:item_id)";
        $query = $this->prepare($sql);
        $query->execute(
            array(
                ':store_id'=>$storeId,
                ':item_id'=>$itemId
            )
        );
    }

    public function getItems($storeId) {
        $sql = "SELECT items.* FROM items INNER JOIN store_items ON items.id = store_items.item_id WHERE store_items.store_id = :store_id";
        $query = $this->prepare($sql);
        $query->execute(array(':store_id'=>$storeId));
        $result = $query->fetchAll();
        $items = [];
        if(!empty($result)) {
            foreach ($result as $key => $line) {
                $item = new Item();
                $item->setId($line['id']);
                $item->setName($line['name']);
                $item->setRarity($line['rarity']);
                $item->setPrice($line['price']);
                $items[] = $item;
            }  
        }
        return $items;
    }

    public function searchItemsByName($name) {
        $sql = "SELECT items.* FROM items INNER JOIN store_items ON items.id = store_items.item_id WHERE items.name LIKE ?";
        $query = $this->prepare($sql);
        $query->execute(array('%'.$name.'%'));
        $result = $query->fetchAll();
        $items = [];
        foreach ($result as $key => $line) {
            $item = new Item();
            $item->setId($line['id']);
            $item->setName($line['name']);
            $item->setRarity($line['rarity']);
            $item->setPrice($line['price']);
            $items[] = $item;
        }
        return $items;
    }
}

?>