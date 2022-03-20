{include file="templates/header.tpl"}
{include file="templates/nav.tpl"}
<h2 class="titulo-detalle"> Tabla de equipos y divisiones</h2>
    <section  id="tabla"class="tabla-detalle detalles">
        <table class="equipoDetalle">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>División</th>
                    <th>Posición</th>
                </tr>
            </thead>
           <tbody>
                <tr class="td-equipo">
                    <td >{$equipo->nombre}</td>
                    <td >{$equipo->division}</td>
                    <td >{$equipo->posicion}</td>
                </tr>	   
			</tbody>
        </table>
   
    {if $equipo->descripcion != ""}
    <table class="descripcion">
        <thead>
            <tr>
                    <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <tr >
                <td class="td_descripcion" >{$equipo->descripcion}</td>
            </tr>	
        </tbody>
    </table>
    
    {/if}
     </section>  
    <div class="comentarios">
        <h2>Comentarios</h2>
        <section >            
        {if $SESSION != null}
            <form class="form_comentarios" method="post" >
                <input type="text" id="comentario" class="input_coment"  placeholder="Comentario" >   
                <input type="text" id="username" value="{$usuario->username}" hidden >  
                <input type="number" id="id_equipo"  value="{$equipo->id_equipo}" hidden >  
                <button type="submit" class="btn_coment enviar"value="insertarComentario">Enviar comentario</button>   
                <label class="p_coment">Puntaje 1 • 5</label>
                <div  class= "div-puntaje">
                    <input id="puntuacion" type="range"   min="1" max="5" step="1" value="5" >
                    <div>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>         
            </form>
            {else}
                <button class="enviar" hidden></button>
                <input type="number" id="id_equipo"  value="{$equipo->id_equipo}" hidden >  
        {/if}        
        </section>
        <div id="btn-toolbar">
        </div>    
        {include "vue/adminComents.tpl"} 
        
    </div>
    </div>
    
   

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="scripts/comentarios.js"></script> 
</body>
</html>