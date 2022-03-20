"use strict"
const url = 'api/comentarios';
let id_equipo = document.querySelector("#id_equipo").value;

// funcion para agregar un comentario al hacer click en el boton de enviar
let btn = document.querySelector(".enviar").addEventListener("click", addComments);

 function addComments(e) {
    e.preventDefault();
    let comentario = document.querySelector("#comentario").value;
    let username = document.querySelector("#username").value;
    let equipo_id = id_equipo;
    let puntaje = document.querySelector("#puntuacion").value;
    let hoy = new Date();
   
    let nuevoComentario = {
        comentario: comentario,
        username: username,
        id_equipo: equipo_id,
        puntaje: puntaje,
        fecha: hoy.getHours() + ":" + hoy.getMinutes() + ":" + hoy.getSeconds(),
    }
    if ( comentario != "") {
        fetch(url, {
            method: "POST",
            headers: { 'Content-type': 'application/json' },
            body: JSON.stringify(nuevoComentario)
        })
        .then(resp => resp.json())
            .then(data => {
            console.log(data);
            document.querySelector("#comentario").value = "";
            showComments();    //actualizar la lista de comentarios
        })
        .catch(error => console.log(error));
        }
    else{
        console.log("no se puede agregar un comentario vacio");
    }
}
//funcion para borrar un comentario
async function deleteComments(id) {
    try {
        let resp = await fetch(url+"/"+id, {
            "method": "DELETE",
        });
        if (resp.ok) {
            showComments();
           await totalPoints();
            console.log("comentario eliminado");
        }
    }
    catch (error) {
        console.log("error" + error);
    }
}
//
let app = new Vue({
    el: "#comentarios-detalle",
    data: {
        comentarios: [],
        puntos: 0.0,
    },
    methods: {
        eliminarCommets: function (id) {
            id = id.currentTarget.id;
            deleteComments(id);
        },
        filtrar: function (e) {
            filterCommentsByScore(e);
        },
        mostrarTodos: function (e) {
            e.preventDefault();
            showComments();
        }
    }, 

});

//funcion que asigna el puntaje total a la variable puntos y los comentarios a la variable comentarios de la clase Vue
let auxMAX = 0;
let auxMIN = 0;
async function showComments(inicio = 0) {
    totalPoints();
    try{
        let id = id_equipo;
        let comments = await fetch(url+"/"+id+"/"+inicio);
        let getFirstAndLast = await fetch(url+"/"+id+"/firstAndLast");
        if(comments.ok && getFirstAndLast.ok) {
            let totalComentarios = await comments.json();
            let primeroSegundo = await getFirstAndLast.json();
            app.comentarios = totalComentarios;
         
          if(primeroSegundo.length > 0){
                auxMIN = parseInt(primeroSegundo[0].id_comentario);
                auxMAX = parseInt(primeroSegundo[1].id_comentario);
                paginacion(parseInt(totalComentarios[0].id_comentario));
            } 
        }
        else{
            app.comentarios = []; 
        }
    }
    catch (error) {
        console.log(error);
    }
  
}
showComments();

//funcion para calcular el puntaje total de los comentarios, por cada comentario se suma su puntaje
async function totalPoints(){
    let puntos =0.0;
    let id =id_equipo;
    try{
        let total = await fetch(url+"/"+id);
        if(total.ok){
            let totalComentarios = await total.json();
            for(let i = 0; i < totalComentarios.length; i++){
                puntos += parseFloat(totalComentarios[i].puntaje);
            }
            app.puntos = puntos;
        }
        else{
            app.puntos = 0.0;
        }
    }
    catch (error) {
        console.log(error);
    }
}

async function paginacion(pos) {
    let contenedor = document.getElementById("btn-toolbar");
    contenedor.innerHTML = "";

    if (!(auxMIN == pos)) {
        let btnAnt = document.createElement("button");
        btnAnt.setAttribute("class", "btn-primary");
        btnAnt.setAttribute("id", "atrasBtn");
        btnAnt.setAttribute("type", "button");
        btnAnt.innerHTML = "< anterior";
        contenedor.appendChild(btnAnt);
 
        document.getElementById("atrasBtn").addEventListener("click", function (e) {
            e.preventDefault();
            showComments(pos - 5);
        });
    } 

    if (!(auxMAX < pos + 5)) {
        let btnSig = document.createElement("button");
        btnSig.setAttribute("class", "btn-primary");
        btnSig.setAttribute("id", "adelanteBtn");
        btnSig.setAttribute("type", "button");
        btnSig.innerHTML = "siguiente >";
        contenedor.appendChild(btnSig);
       
        contenedor.appendChild(btnSig);
        document.getElementById("adelanteBtn").addEventListener("click", function (e) {
            e.preventDefault();  
            showComments(pos + 5);
        });
    }
}



