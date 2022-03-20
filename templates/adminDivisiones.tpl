{include file="templates/header.tpl"}
{include file="templates/nav.tpl"}
<h2> Administrar Divisiones</h2>
{if {$error}!=""}
    <h2 class="error">{$error}</h2>
    {else }
        <h2 class="exito">{$exito}</h2>
{/if}

  <section  id="tabla"class="tabla_user">
        <table>
            <thead>
                <tr>
                    <th>Divisiones</th>
                    <th class="eliminar">Eliminar y Modificar</th>
                </tr>
            </thead>
        <tbody class="filas">  
            {foreach from=$division item=$divisiones}
                <tr>
                    <td>{$divisiones->division}</a></td>  
                    <td><a href="eliminarDivision/{$divisiones->id_division}"><button class="btn"><i class="fas fa-trash-alt"></i></button></a>
                        <a href="modificarDivision/{$divisiones->id_division}"><button type="button"class="btn"><i class="far fa-edit"></i></button></a></td>     
                </tr>	
            {/foreach}
        </tbody>
            </table>
        <form action="agregarDivision" method="POST" class="form_agregar">
                <h1 class="suscribete_title">Agregar divisiones</h1>
                <input class="form_input " name="division" type="text" placeholder="Division">
                <input class="form_input " name="cantidad" type="number" min="1" placeholder="Cantidad de equipos">
                <button name="btn-agregar " type="submit" class="btns">Agregar División</button>
        </form>
    </section>        
</body>
</html>
