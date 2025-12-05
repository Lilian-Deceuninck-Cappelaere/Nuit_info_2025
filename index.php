<?php
include 'main.inc.php';
?>
<main class="content-area">

    <h2>Présentation</h2>
    <p class="presentation-text">
        Bienvenue sur la plateforme NIRD. Découvrez notre démarche pour un numérique plus inclusif et responsable grâce à nos outils interactifs.
    </p>

    <div class="image-container">
        <img src="https://via.placeholder.com/800x400/333/ccc?text=Illustration+NIRD" alt="Illustration du projet">
    </div>

    <button id="startSnake" class="game-btn">
        🐍 Démarrer le jeu de piste
    </button>

    <!-- Overlay du jeu -->
    <div id="snakeOverlay" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; 
        background: rgba(0,0,0,0.85); justify-content:center; align-items:center; z-index:9999; flex-direction:column;">

        <div style="position:relative; width:700px; height:500px; background:#111; border-radius:15px; overflow:hidden; display:flex; flex-direction:column;">
            <button id="closeSnake" style="position:absolute; top:10px; right:10px; z-index:1000; padding:5px 10px; border:none; border-radius:5px; cursor:pointer;">❌</button>

            <div id="score" style="color:white; font-size:18px; padding:10px;">Score: 0</div>
            <div id="game" style="flex:1; position:relative; background:#222;"></div>

            <div id="gameOver" style="display:none; position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); 
                background:#333; color:white; padding:30px; border-radius:15px; text-align:center; z-index:100;">
                <h2></h2>
                <button id="restartBtn" style="margin-top:15px; padding:10px 20px; border:none; border-radius:10px; cursor:pointer;">Rejouer</button>
            </div>
        </div>
    </div>

</main>
<script src="assets/script/script.js"></script>s