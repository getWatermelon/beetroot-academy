<?php

require 'functions.php';

deleteCartItem($_POST['deleted_book_id']);

header('Location: /cart.php');