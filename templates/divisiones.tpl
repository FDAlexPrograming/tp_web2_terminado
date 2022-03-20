{include file="templates/header.tpl"}
{include file="templates/nav.tpl"}
<h2> tabla de equipos y divisiones</h2>
    <section  id="tabla"class="tabla_section">
        <table>
            <thead>
                <tr>
                    <th>Division</th>
                    <th>Cantidad de equipos</th>
                </tr>
            </thead>
           <tbody class="filas">
                {foreach from=$division item=$item}
                    <tr >
                        <td>{$item->division}</a></td>
                        <td>{$item->cantidad_equipos}</td>
                    </tr>	
                {/foreach}
			</tbody>
        </table>
    </section>
</body>
</html>