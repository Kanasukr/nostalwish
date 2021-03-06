<?php

require_once 'pdomanager.class.php';
require_once SITE_ROOT.'/classes/character.class.php';
require_once SITE_ROOT.'/classes/wishlist.class.php';
require_once SITE_ROOT.'/classes/store.class.php';

class CharacterPDO extends PDOManager {

	public function create($character) {
		$sql = "INSERT INTO characters (race,class,level,name) VALUES (:race,:class,:level,:name)";
		$query = $this->prepare($sql);
		$query->execute(
			array(
				':race'=>$character->getRace(),
				':class'=>$character->getClass(),
				':level'=>$character->getLevel(),
				':name'=>$character->getName()
			)
		);
		$character->setId($this->lastInsertId('id'));
		return $character;
	}

	public function get($id) {
    	$sql = "SELECT * FROM characters WHERE id = :id";
    	$query = $this->prepare($sql);
        $query->execute(array(':id'=>$id));
        $result = $query->fetch();
        $character = new Character();
        if(!empty($result)) {
        	$character->setId($result['id']);
        	$character->setRace($result['race']);
        	$character->setClass($result['class']);
        	$character->setLevel($result['level']);
        	$character->setName($result['name']);
        }
        return $character;
    }

    public function update($character) {
		$sql = "UPDATE characters SET race=:race,class=:class,level=:level,name=:name WHERE id = :id";
		$query = $this->prepare($sql);
		
		$result = $query->execute(
			array(
				':id'=>$character->getId(),
				':race'=>$character->getRace(),
				':class'=>$character->getClass(),
				':level'=>$character->getLevel(),
				':name'=>$character->getName()
			)
		);
	}

	public function delete($id) {
		$sql = "DELETE FROM characters WHERE id = :id";
		$query = $this->prepare($sql);
		$result = $query->execute(array(':id'=>$id));
	}

    public function getAll() {
    	$sql = "SELECT * FROM characters";
    	$query = $this->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $characters = [];
        foreach ($result as $key => $line) {
        	$character = new Character();
        	$character->setId($line['id']);
        	$character->setRace($line['race']);
        	$character->setClass($line['class']);
        	$character->setLevel($line['level']);
        	$character->setName($line['name']);
        	$characters[] = $character;
        }
        return $characters;
    }

    public function getByName($name) {
    	$sql = "SELECT * FROM characters WHERE name=:name";
    	$query = $this->prepare($sql);
        $query->execute(array(':name'=>$name));
        $result = $query->fetch();
        $character = new Character();
        if(!empty($result)) {
        	$account->setId($result['id']);
        	$account->setName($result['name']);
        	$account->setRace($result['race']);
        	$account->setClass($result['class']);
        	$account->setLevel($result['level']);
        }
        return $character;
    }

    public function getWishlist($characterId) {
        $sql = "SELECT wishlists.* FROM wishlists INNER JOIN character_wishlist ON wishlists.id = character_wishlist.wishlist_id WHERE character_wishlist.character_id = :character_id";
        $query = $this->prepare($sql);
        $query->execute(array(':character_id'=>$characterId));
        $result = $query->fetch();
        $wishlist = new Wishlist();
        if(!empty($result)) {
            $wishlist->setId($result['id']);
        }
        return $wishlist;
    }

    public function addWishlist($characterId,$wishlistId) {
        $sql = "INSERT INTO character_wishlist(character_id,wishlist_id) VALUES (:character_id,:wishlist_id)";
        $query = $this->prepare($sql);
        $query->execute(
            array(
                ':character_id'=>$characterId,
                ':wishlist_id'=>$wishlistId
            )
        );
    }

    public function getStore($characterId) {
        $sql = "SELECT stores.* FROM stores INNER JOIN character_store ON stores.id = character_store.store_id WHERE character_store.character_id = :character_id";
        $query = $this->prepare($sql);
        $query->execute(array(':character_id'=>$characterId));
        $result = $query->fetch();
        $store = new Store();
        if(!empty($result)) {
            $store->setId($result['id']);
        }
        return $store;
    }

    public function addStore($characterId,$storeId) {
        $sql = "INSERT INTO character_store(character_id,store_id) VALUES (:character_id,:store_id)";
        $query = $this->prepare($sql);
        $query->execute(
            array(
                ':character_id'=>$characterId,
                ':store_id'=>$storeId
            )
        );
    }
}

?>