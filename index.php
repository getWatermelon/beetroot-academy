<?php
$languages =[];
?>
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
        <h1>Registration</h1>
        <div class="form-group">
            <label for="formGroupExampleInput">Name</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="name"  placeholder="Example input" value="<?=$_POST['name']?>">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Surname</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="surname" placeholder="Example input" value="<?=$_POST['surname']?>">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Email</label>
            <input type="email" class="form-control" id="formGroupExampleInput" name="email" placeholder="Example input" value="<?=$_POST['email']?>">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Age</label>
            <input type="number" class="form-control" id="formGroupExampleInput" name="age" placeholder="Example input" value="<?=$_POST['age']?>">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Password</label>
            <input type="password" class="form-control" id="formGroupExampleInput"name="password" placeholder="Example input" value="<?=$_POST['password']?>">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Example select</label>
            <select class="form-control" id="exampleFormControlSelect1" name="gender">
                <option></option>
                <option>Man</option>
                <option>Woman</option>
                <option>Others</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Example select</label>
            <select multiple class="form-control" id="exampleFormControlSelect1" name="languages[]">
                <option>English</option>
                <option>Russian</option>
                <option>Ukrainian</option>
                <option>German</option>
                <option>Polish</option>
                <option>French</option>
                <option>Japanese</option>
                <option>Chinese</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
</body>
</html>
