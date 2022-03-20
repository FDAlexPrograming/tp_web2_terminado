{include file="templates/header.tpl"}
{include file="templates/nav.tpl"}
<h2> Administrar equipos</h2>
{if {$error}!=""}
    <h2 class="error">{$error}</h2>
    {else }
        <h2 class="exito">{$exito}</h2>
{/if}
    <section  id="tabla"class="tabla_user">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th class="eliminar">Eliminar y Modificar</th>
                </tr>
            </thead>
            <tbody class="filas">
                {foreach from=$equipo item=$item}
                    <tr >
                        <td class="td-equipo"><a href="equipo/{$item->id_equipo}">{$item->nombre}</a></td>
                        <td><a href="eliminarEquipo/{$item->id_equipo}"><button class="btn"><i class="fas fa-trash-alt"></i></button></a>
                            <a href="modificarEquipo/{$item->id_equipo}"><button type="button"class="btn"><i class="far fa-edit"></i></button></a></td>
                    </tr>	
                {/foreach}
            </tbody>
        </table>

        <form action="agregarEquipo" method="POST" class="form_agregar">
			<h1 class="suscribete_title">Agregar equipos</h1>
			<select  class="form_input" name="division">
				{foreach from=$division item=$item}
				<option>{$item->division}</option>
				{/foreach}
			</select>
			<input class="form_input " name="equipo" type="text" placeholder="equipo">
			<textarea class="form_input " name="descripcion" type="text" placeholder="descripcion"></textarea>
			<input class="form_input " name="posicion" type="number" placeholder="posicion" min="1" max=13  >
			<button name="btn-agregar" type="submit" class="btns">Agregar Equipo</button>
		</form> 
    </section>
</body>
</html>


        