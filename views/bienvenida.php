<div class="container">
    <h1>👋 Bienvenido al Visor de Usuarios</h1>
    <p>Este sistema te permite registrar, buscar y gestionar usuarios de manera sencilla.</p> 
    <br>
    
    <?php if (isset($_SESSION['usuario'])): ?>
        <p>Selecciona una opción:</p>

        <div class="botones">
            <button onclick="location.href='create.php'">📝 Registrar Usuario</button>
            <button onclick="location.href='read.php'">🔍 Ver Usuarios</button>
        </div>
    <?php else: ?>
        <p><strong>Debes iniciar sesión para acceder a las funcionalidades.</strong></p>
    <?php endif; ?>
</div>

<style>
    .container {
        max-width: 600px;
        margin: 60px auto;
        background-color: #fff;
        padding: 40px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    h1 {
        color: #333;
    }

    p {
        font-size: 16px;
        color: #555;
    }

    .botones {
        margin-top: 30px;
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .botones button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        margin: 10px;
        transition: background-color 0.3s;
    }

    .botones button:hover {
        background-color: #0056b3;
    }
</style>
