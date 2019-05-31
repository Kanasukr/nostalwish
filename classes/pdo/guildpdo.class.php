<?php

include('classes/pdo/pdomanager.class.php');
include('classes/guild.class.php');

class GuildPDO extends PDOManager {

	public function create($guild) {
		$sql = "INSERT INTO guilds (name) VALUES (:name)";
		$query = $this->prepare($sql);
		
		$result = $query->execute(array(':name'=>$guild->getName()));
		if(!empty($result)) {
			$guild->setId($result['id']);
		}
		return $guild;
	}

	public function get($id) {
    	$sql = "SELECT * FROM guilds WHERE id = :id";
    	$query = $this->prepare($sql);
        $query->execute(array(':id'=>$id));
        $result = $query->fetch();
        $guild = new Guild();
        if(!empty($result)) {
        	$guild->setId($result['id']);
        	$guild->setName($result['name']);
        }
        return $guild;
    }

    public function update($guild) {
		$sql = "UPDATE guilds SET name=:name WHERE id = :id";
		$query = $this->prepare($sql);
		
		$result = $query->execute(
			array(
				':id'=>$guild->getId(),
				':name'=>$guild->getName()
			)
		);
	}

	public function delete($id) {
		$sql = "DELETE FROM guilds WHERE id = :id";
		$query = $this->prepare($sql);
		$result = $query->execute(array(':id'=>$id));
	}

    public function getAll() {
    	$sql = "SELECT * FROM guilds";
    	$query = $this->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $guilds = [];
        foreach ($result as $key => $line) {
        	$guild = new Guild();
        	$guild->setId($line['id']);
        	$guild->setName($line['name']);
        	$guilds[] = $guild;
        }
        return $guilds;
    }
}

?>