{include file="templates/header.tpl"}
{include file="templates/nav.tpl"}
<h2> tabla de equipos y divisiones</h2>
    <section  id="tabla"class="tabla_section">
     <form method="POST" action="busquedaAvanzada">
                <input type="text" name="loquebusco" placeholder="Equipo, posicion ">
                <input type="submit" value="buscar">
            </form>
        <div class="section-filtro">
            <form method="POST" action="filtrar">
                <select name="division">
                    {foreach from=$division item=$item}
                        <option>{$item->division}</option>
                    {/foreach}
                </select>
                <input type="submit" value="FILTRAR">
            </form>
           
            </div>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>División</th>
                </tr>
            </thead>
           <tbody class="filas">
                {foreach from=$equipo item=$item}
                    <tr>
                        <td class="td-equipo"><a href="equipo/{$item->id_equipo}">{$item->nombre}</a></td>
                        <td>{$item->division}</td>
                    </tr>	
                {/foreach}
			</tbody>
        </table>
    </section>
</body>
</html>