{include file="templates/header.tpl"}
{include file="templates/nav.tpl"}
<article id="registerDiv">
    <form action="registerMesage" method="post">
        <h1>Regístrate</h1>
        <div>
            <div id="registerInputs">
                <input type="text" class="form_register" name="registerUsername" id="username" placeholder="Usuario">
                <input type="text"  class="form_register" name="registerPassword" id="password" placeholder="Contraseña">
            </div>
        </div>
{if {$error}!=""}
    <p class="error">{$error}</p>
    {else }
        <p class="exito">{$exito}</p>
{/if}
    <button class="btn_register" type="submit" >Registrarse Ahora</button>
    </form>
</article>