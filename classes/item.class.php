<?php

class Item {

	private $id;
    private $name;
    private $rarity;
    private $price;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getName() { return $this->name; }
    public function setName($name) { $this->name = $name; }

    public function getRarity() { return $this->rarity; }
    public function setRarity($rarity) { $this->rarity = $rarity; }

    public function getPrice() { return $this->price; }
    public function setPrice($price) { $this->price = $price; }

    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'rarity' => $this->rarity,
            'price' => $this->price
        ];
    }
}

?>