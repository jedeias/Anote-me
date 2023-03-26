<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Error Login</title>
    <style>
        body{
            background-color: rgb(0, 200, 255);
        }
        h1,p{
            color: white;
        }
        h1{
            font-size: 100px;
        }
        p{
            font-size: 50px;
        }
        .container{
            padding: 200px;
        }
    </style>
</head>
<body>
    <div class="container">  
        <h1>:(</h1>
        <p>Error você não conseguiu fazer o login</p>
    </div>
    
</body>
</html>
<?php
header("Refresh: 2; url=../");
?>