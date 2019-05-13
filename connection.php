<?php 
try {
	$user = "nostalwish";
	$pass = "Fuck1ngM0onSP3ak%";
    $dbh = new PDO('mysql:host=localhost;dbname=nostalwish', $user, $pass);
    foreach($dbh->query('SELECT * from characters') as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

?>