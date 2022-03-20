{include file="templates/header.tpl"}
{include file="templates/nav.tpl"}
{if $equipo!=''}
    <form action="actualizarEquipo" method="POST" class="form_agregar form_modificar">
        <h1 class="suscribete_title">Agregar equipos</h1>
        <select  class="form_input" name="division">
            <option >{$id->division}</option>
            {foreach from=$divisiones item=$item}
                {if $item->id_division != $equipo->id_division}
                    <option >{$item->division}</option>
                {/if}
            {/foreach}
        </select>
        <input  class="id_equipo" name="id_equipo" type="number" value="{$equipo->id_equipo}">
        <input class="form_input " name="equipo" type="text" placeholder="{$equipo->nombre}">
        <textarea class="form_input " name="descripcion" type="text" placeholder="{$equipo->descripcion}"></textarea>
        <input class="form_input " name="posicion" type="number" placeholder="{$equipo->posicion}" min="1">
        <button name="btn-agregar" type="submit" class="btns">Agregar Equipo</button>
	</form>
{/if}

{if $equipo ==''}
    <form action="actualizarDivision" method="POST" class="form_agregar form_modificar">
        <h1 class="suscribete_title">Modificar divisiones</h1>
            <input class="id_equipo" name="id_division" type="number" value="{$divisiones->id_division}">
            <input class="form_input " name="division" type="text" placeholder="Division: {$divisiones->division}">
        <input class="form_input " name="cantidad" type="number" placeholder="N° de equipops: {$divisiones->cantidad_equipos}">
        <button name="btn-agregar" type="submit" class="btns">Modificar División</button>
    </form>
{/if}
