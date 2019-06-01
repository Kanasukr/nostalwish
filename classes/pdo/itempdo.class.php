<?php

require_once 'pdomanager.class.php';
require_once SITE_ROOT.'/classes/item.class.php';

class ItemPDO extends PDOManager {

	public function create($item) {
		$sql = "INSERT INTO items (name,rarity,price) VALUES (:name,:rarity,:price)";
		$query = $this->prepare($sql);
		
		$result = $query->execute(
			array(
				':name'=>$item->getName(),
				':rarity'=>$item->getRarity(),
				':price'=>$item->getPrice()
			)
		);
		if(!empty($result)) {
			$item->setId($result['id']);
		}
		return $item;
	}

	public function get($id) {
    	$sql = "SELECT * FROM items WHERE id = :id";
    	$query = $this->prepare($sql);
        $query->execute(array(':id'=>$id));
        $result = $query->fetch();
        $item = new Item();
        if(!empty($result)) {
        	$item->setId($result['id']);
        	$item->setName($result['name']);
        	$item->setRarity($result['rarity']);
        	$item->setPrice($result['price']);
        }
        return $item;
    }

    public function update($item) {
		$sql = "UPDATE items SET name=:name,rarity=:rarity,price=:price WHERE id = :id";
		$query = $this->prepare($sql);
		
		$result = $query->execute(
			array(
				':id'=>$item->getId(),
				':name'=>$item->getName(),
				':rarity'=>$item->getRarity(),
				':price'=>$item->getPrice()
			)
		);
	}

	public function delete($id) {
		$sql = "DELETE FROM items WHERE id = :id";
		$query = $this->prepare($sql);
		$result = $query->execute(array(':id'=>$id));
	}

    public function getAll() {
    	$sql = "SELECT * FROM items";
    	$query = $this->prepare($sql);
        $query->execute();
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

    public function getByName($name) {
    	$sql = "SELECT * FROM items WHERE name=:name";
    	$query = $this->prepare($sql);
        $query->execute(array(':name' => $name));
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

    public function searchByName($name) {
    	$sql = "SELECT * FROM items WHERE name LIKE ?";
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