<?php

include('classes/pdo/pdomanager.class.php');
include('classes/character.class.php');

class CharacterPDO extends PDOManager {

    public function getAll() {
    	$pdo_statement = $this->prepare("SELECT * FROM characters");
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
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
}

?>