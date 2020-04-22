<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<br />
<div class="container">
    <form method="post" action="index2.php">
        <h1>Congratulations! You have been registered!</h1>
        <h2 class="form-group">
            Your name is: <?=$_POST['name']?>
        </h2>
        <h2 class="form-group">
            Your surname is: <?=$_POST['surname']?>
        </h2>
        <h2 class="form-group">
            Your email is: <?=$_POST['email']?>
        </h2>
        <h2 class="form-group">
            Your age is: <?=$_POST['age']?>
        </h2>
<!--        <h2 class="form-group">-->
<!--            Your password is: --><?//=$_POST['password']?>
<!--        </h2>-->
        <h2 class="form-group">
            Your gender is: <?=$_POST['gender']?>
        </h2>
        <h2 class="form-group">
            The language(s) you have selected: <?=implode(", ", $_POST['languages'])?>
        </h2>
    </form>
</div>
</body>
</html>