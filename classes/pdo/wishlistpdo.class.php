<?php

require_once 'pdomanager.class.php';
require_once SITE_ROOT.'/classes/wishlist.class.php';
require_once SITE_ROOT.'/classes/item.class.php';

class WishlistPDO extends PDOManager {

	public function create($wishlist) {
		$sql = "INSERT INTO wishlists VALUES ()";
		$query = $this->prepare($sql);
		$query->execute();
		$wishlist->setId($this->lastInsertId('id'));
		return $wishlist;
	}

	public function get($id) {
    	$sql = "SELECT * FROM wishlists WHERE id = :id";
    	$query = $this->prepare($sql);
        $query->execute(array(':id'=>$id));
        $result = $query->fetch();
        $wishlist = new Wishlist();
        if(!empty($result)) {
        	$wishlist->setId($result['id']);
        }
        return $wishlist;
    }

    /*public function update($wishlist) {
		$sql = "UPDATE wishlists WHERE id = :id";
		$query = $this->prepare($sql);
		
		$result = $query->execute(
			array(
				':id'=>$wishlist->getId()
			)
		);
	}*/

	public function delete($id) {
		$sql = "DELETE FROM wishlists WHERE id = :id";
		$query = $this->prepare($sql);
		$result = $query->execute(array(':id'=>$id));
	}

    public function getAll() {
    	$sql = "SELECT * FROM wishlists";
    	$query = $this->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $wishlists = [];
        foreach ($result as $key => $line) {
        	$wishlist = new Wishlist();
        	$wishlist->setId($line['id']);
        	$wishlists[] = $wishlist;
        }
        return $wishlists;
    }

    public function addItem($wishlistId,$itemId) {
        $sql = "INSERT INTO wishlist_items(wishlist_id,item_id) VALUES (:wishlist_id,:item_id)";
        $query = $this->prepare($sql);
        $query->execute(
            array(
                ':wishlist_id'=>$wishlistId,
                ':item_id'=>$itemId
            )
        );
    }

    public function getItems($wishlistId) {
        $sql = "SELECT items.* FROM items INNER JOIN wishlist_items ON items.id = wishlist_items.item_id WHERE wishlist_items.wishlist_id = :wishlist_id";
        $query = $this->prepare($sql);
        $query->execute(array(':wishlist_id'=>$wishlistId));
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
}

?>