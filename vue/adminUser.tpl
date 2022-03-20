{literal}
        <tbody class="filas" id="user">
            <tr v-for="user in users">
                <td >{{ user.username }}</td>
                <td v-if= "user.username != 'admin'">
                    <button class="btn fas fa-trash-alt" v-bind:id="user.id_usuario" v-on:click="eliminar"></button>
                    <button v-if="user.privilege_level==1 " class="fas fa-user-cog fas fa-trash-alt" v-bind:id="user.id_usuario" v-on:click="quitarAdmin">soy admin</button>
                    <button v-else="user.privilege_level" class="fas fa-user-cog  fas fa-trash-verde"  v-bind:id="user.id_usuario" v-on:click="admin">no soy admin</button>
                </td>
                <td v-if="user.username == 'admin'">
                    <p>i'm the master, you can't modify me</p>
                </td>
            </tr
        </tbody>
    </table>

{/literal}
