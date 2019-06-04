<?php

require 'pdomanager.class.php';
require SITE_ROOT.'/classes/transaction.class.php';

class TransactionPDO extends PDOManager {

	public function create($transaction) {
		$sql = "INSERT INTO transactions VALUES ()";
		$query = $this->prepare($sql);
		$query->execute();
		$transaction->setId($this->lastInsertId('id'));
		return $transaction;
	}

	public function get($id) {
    	$sql = "SELECT * FROM transactions WHERE id = :id";
    	$query = $this->prepare($sql);
        $query->execute(array(':id'=>$id));
        $result = $query->fetch();
        $transaction = new Transaction();
        if(!empty($result)) {
        	$transaction->setId($result['id']);
        }
        return $transaction;
    }

    /*public function update($transaction) {
		$sql = "UPDATE transactions WHERE id = :id";
		$query = $this->prepare($sql);
		
		$result = $query->execute(
			array(
				':id'=>$transaction->getId()
			)
		);
	}*/

	public function delete($id) {
		$sql = "DELETE FROM transactions WHERE id = :id";
		$query = $this->prepare($sql);
		$result = $query->execute(array(':id'=>$id));
	}

    public function getAll() {
    	$sql = "SELECT * FROM transactions";
    	$query = $this->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $transactions = [];
        foreach ($result as $key => $line) {
        	$transaction = new Transaction();
        	$transaction->setId($line['id']);
        	$transactions[] = $transaction;
        }
        return $transactions;
    }
}

?>