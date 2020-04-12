<form method="post" action="<?php echo base_url("general/login"); ?>">
    <h1>Login</h1>
    <label for="email">Correo:</label><br>
    <input type="email" id="email" name="email" class="form-control" placeholder="Correo" required><br>
    <label for="password">Contaseña:</label><br>
    <input type="password" id="password" name="password" class="form-control" placeholder="Contaseña" required><br>
    <button type="submit">Acceder</button>
</form>