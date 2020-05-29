<?php

require 'functions.php';

if(!empty($_COOKIE['cart'])) {
    deleteCartItem($_POST['deleted_book_id']);
}

header('Location: /cart.php');