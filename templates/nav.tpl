<nav class="menu">
    <ul class="navigation">
    {if ($SESSION == '')}
        <li><a href="home" class="transform">equipos</a></li>  
        <li><a href="divisiones" class="transform">divisiones</a></li>  
    {/if}
    {if ($SESSION != '') && ($admin == 1)}
        <li><a href="home" class="transform">home</a></li>
        <li><a href="adminEquipo" class="transform">equipos</a></li>
        <li><a href="adminDivisiones" class="transform">divisiones</a></li>
        <li><a href="usersList" class="transform">users</a></li>      
    {/if}
    {if ($SESSION != '') && ($admin != 1)}
        <li><a href="home" class="transform">home</a></li>
         <li><a href="divisiones" class="transform">divisiones</a></li>    
    {/if}
    </ul>
</nav>