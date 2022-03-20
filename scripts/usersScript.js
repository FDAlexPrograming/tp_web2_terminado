"use strict"


const url = "api/users";

let app = new Vue({
    el: "#user",
    data: {
        users: [],
    },
    methods: {
        eliminar: function(id){
        id = id.currentTarget.id;
        eliminarUsuario(id);
        console.log(id);
      },
        admin: function(id){
            id = id.currentTarget.id;
            volverAdmin(id);
            console.log(id);
        },
        quitarAdmin: function(id){
            id = id.currentTarget.id;
            quitarAdmin(id);
            console.log(id);
        }
    }
});
       
function mostrarUsuarios() {
    fetch(url)
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            app.users = data;
        })
        .catch(function (error) {
            console.log(error);
        });
}
mostrarUsuarios();

async function eliminarUsuario(id) {
    try {
        let respuesta = await fetch(url + "/" + id, {
            'method': "DELETE"
        });
        if (respuesta.status == 200) {
            console.log("usuario eliminado");
            mostrarUsuarios();
        } else {
            console.log("no se pudo eliminar el usuario");
        }
    } catch (error) {
        console.log("no se pudo contactar con el servidor local");
        console.log(error);
    }
}

async function volverAdmin(id) {
    try {
        let respuesta = await fetch(url + "/" + id, {
            method: "PUT",
        })
        if (respuesta.status == 200) {
            console.log("usuario admin");
            mostrarUsuarios();
        } else {
            console.log("no se pudo hacer admin el usuario");
        }
    } catch (error) {
        console.log("no se pudo contactar con el servidor local");
        console.log(error);
    }
}

async function quitarAdmin(id) {
    try {
        let respuesta = await fetch(url + "/" + id, {
            method: "UPDATE",
        })
        if (respuesta.status == 200) {
            console.log("usuario admin");
            mostrarUsuarios();
        } else {
            console.log("no se pudo hacer admin el usuario");
        }
    } catch (error) {
        console.log("no se pudo contactar con el servidor local");
        console.log(error);
    }
}

