<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="{BASE_URL}">
    <link rel="stylesheet" href="styles/pageStyle.css">
    <script src="https://kit.fontawesome.com/728f81b46c.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title} | Fichajes.com</title>
</head>
<body>
   
    <header id="header">
        <a href="home"><h1 class="transform">fichajes</h1></a>
        
        {if $SESSION == null}
        <div>   
            <h4>iniciar sesión</h4>
            <form action="login" method="POST">
                <input class="form_login"type="text" name="username" placeholder="Usuario" >
                <input class="form_login" type="password" name="password" placeholder="Contraseña">
                <button class="btns login-submit" type="submit">Login</button>
           </form>
            <p id="register"><span id="loginError">{$loginError}</span>no tienes una cuenta? Regístrate <a href="register">aquí</a></p>
        <div>   
        {/if}
        {if $SESSION != null}
        <div>
            <form action="logout" method="POST" id="form">
                <input class="logout"type="submit" value="Logout">
            </form>
            <div class="bienvenido">
            <h3 >Bienvenido  {$SESSION}</h3>
        </div>
        {/if}
        
    </header>
    

      