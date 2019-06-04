<?php

require_once 'pdomanager.class.php';
require_once SITE_ROOT.'/classes/account.class.php';
require_once SITE_ROOT.'/classes/character.class.php';

class AccountPDO extends PDOManager {

	public function create($account) {
		$sql = "INSERT INTO accounts (name,email,password) VALUES (:name,:email,:password)";
		$query = $this->prepare($sql);
		$query->execute(
			array(
				':name'=>$account->getName(),
				':email'=>$account->getEmail(),
				':password'=>$account->getPassword()
			)
		);
		$account->setId($this->lastInsertId('id'));
		return $account;
	}

	public function get($id) {
    	$sql = "SELECT * FROM accounts WHERE id = :id";
    	$query = $this->prepare($sql);
        $query->execute(array(':id'=>$id));
        $result = $query->fetch();
        $account = new Account();
        if(!empty($result)) {
        	$account->setId($result['id']);
        	$account->setName($result['name']);
        	$account->setEmail($result['email']);
        	$account->setPassword($result['password']);
        }
        return $account;
    }

    public function update($account) {
		$sql = "UPDATE accounts SET name=:name,email=:email,password=:password WHERE id = :id";
		$query = $this->prepare($sql);
		
		$result = $query->execute(
			array(
				':id'=>$account->getId(),
				':name'=>$account->getName(),
				':email'=>$account->getEmail(),
				':password'=>$account->getPassword()
			)
		);
	}

	public function delete($id) {
		$sql = "DELETE FROM accounts WHERE id = :id";
		$query = $this->prepare($sql);
		$result = $query->execute(array(':id'=>$id));
	}

    public function getAll() {
    	$sql = "SELECT * FROM accounts";
    	$query = $this->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $accounts = [];
        foreach ($result as $key => $line) {
        	$account = new Account();
        	$account->setId($line['id']);
        	$account->setName($line['name']);
        	$account->setEmail($line['email']);
        	$account->setPassword($line['password']);
        	$accounts[] = $account;
        }
        return $accounts;
    }

    public function login($name,$password) {
    	$sql = "SELECT * FROM accounts WHERE name=:name AND password=:password";
    	$query = $this->prepare($sql);
        $query->execute(
        	array(
        		':name'=>$name,
        		':password'=>$password
        	)
        );
        $result = $query->fetch();
        $account = new Account();
        if(!empty($result)) {
        	$account->setId($result['id']);
        	$account->setName($result['name']);
        	$account->setEmail($result['email']);
        	$account->setPassword($result['password']);
        }
        return $account;
    }

    public function getByName($name) {
    	$sql = "SELECT * FROM accounts WHERE name=:name";
    	$query = $this->prepare($sql);
        $query->execute(array(':name'=>$name));
        $result = $query->fetch();
        $account = new Account();
        if(!empty($result)) {
        	$account->setId($result['id']);
        	$account->setName($result['name']);
        	$account->setEmail($result['email']);
        	$account->setPassword($result['password']);
        }
        return $account;
    }

    public function getByEmail($email) {
    	$sql = "SELECT * FROM accounts WHERE email=:email";
    	$query = $this->prepare($sql);
        $query->execute(array(':email'=>$email));
        $result = $query->fetch();
        $account = new Account();
        if(!empty($result)) {
        	$account->setId($result['id']);
        	$account->setName($result['name']);
        	$account->setEmail($result['email']);
        	$account->setPassword($result['password']);
        }
        return $account;
    }

    public function getCharacters($accountId) {
        $sql = "SELECT characters.* FROM characters INNER JOIN account_characters ON characters.id = account_characters.character_id WHERE account_characters.account_id = :account_id";
        $query = $this->prepare($sql);
        $query->execute(array(':account_id'=>$accountId));
        $result = $query->fetchAll();
        $characters = [];
        if(!empty($result)) {
            foreach ($result as $key => $line) {
                $character = new Character();
                $character->setId($line['id']);
                $character->setName($line['name']);
                $character->setRace($line['race']);
                $character->setClass($line['class']);
                $character->setLevel($line['level']);
                $characters[] = $character;
            }  
        }
        return $characters;
    }

    public function addCharacter($accountId,$characterId) {
        $sql = "INSERT INTO account_characters(account_id,character_id) VALUES (:account_id,:character_id)";
        $query = $this->prepare($sql);
        $query->execute(
            array(
                ':account_id'=>$accountId,
                ':character_id'=>$characterId
            )
        );
    }
}

?>