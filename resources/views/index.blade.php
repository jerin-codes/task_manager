<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <title>Document</title>
</head>
<body>
    <div class="index-page">

        <button><a href="company-login">Company login</a></button>
         <button onclick="window.location.href='/employee-login'">Employee login</button>

    </div>
</body>
</html>

<style>


body {
    display: block;
    margin: 0px;
}
    .index-page {
        
    height: 100vh;
    display: flex;
    justify-content: center;
    gap:7px;
    align-items: center;
    background-image:url("https://mailmktg.makemytrip.com/mybusiness/images/Exp-Management_2.jpg");
    background-size: cover;
    background-position: center;
    background-repeat:no-repeat;

}

.index-page button {
    background-color: green;
    border-radius: 7px;
    cursor: pointer;
    text-decoration: none;
    height: 40px;
    width: 166px;
    font-size: 17px;
}

.index-page button a{
     text-decoration: none;
     color: #000000;
}
</style>