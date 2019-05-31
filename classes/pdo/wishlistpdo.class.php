<?php

include('classes/pdo/pdomanager.class.php');
include('classes/wishlist.class.php');

class WishlistPDO extends PDOManager {

	public function create($wishlist) {
		$sql = "INSERT INTO wishlists VALUES ()";
		$query = $this->prepare($sql);
		
		$result = $query->execute();
		if(!empty($result)) {
			$wishlist->setId($result['id']);
		}
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
}

?>