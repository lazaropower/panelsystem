    <h1>Registro de usuarios</h1>
    <form method="post" action="<?php echo base_url("general/registerUser"); ?>">
        <label for="name">Nombre:</label><br>
        <input type="text" id="name" name="name"><br>

        <label for="email">Correo:</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Contaseña:</label><br>
        <input type="password" id="password" name="password" required><br>

        <label for="password-confirm">Confirmar contaseña:</label><br>
        <input type="password" id="password-confirm" name="password-confirm" required><br>

        <button type="submit">Registrarse</button>
    </form>