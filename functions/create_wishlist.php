<?php

require_once '../config.php';
require_once SITE_ROOT.'/classes/wishlist.class.php';
require_once SITE_ROOT.'/classes/pdo/wishlistpdo.class.php';

$wishlistPdo = new wishlistPDO();
$wishlist = $wishlistPdo->create(new Wishlist());

header("Location: /wishlist.php?wishlist_id=".$wishlist->getId());
die();

?>