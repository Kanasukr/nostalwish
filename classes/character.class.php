<?php

class Character {

	private $id;
	private $race;
	private $class;
	private $level;
	private $name;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getRace() { return $this->race; }
    public function setRace($race) { $this->race = $race; }

    public function getClass() { return $this->class; }
    public function setClass($class) { $this->class = $class; }

    public function getLevel() { return $this->level; }
    public function setLevel($level) { $this->level = $level; }

    public function getName() { return $this->name; }
    public function setName($name) { $this->name = $name; }
}

?>
