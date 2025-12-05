<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/qcm.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="assets/images/Decathlon.png" alt="decat">
        </div>
        <div class="header-title">Profil sportif</div>
        <div class="user-icon">👤</div>
    </header>

    <nav>
        <ul>
            <li><a>Accueil</a></li>
            <li><a>profil sportif</a></li>
        </ul>
    </nav>

    <div class="qcm-container">
        <h2 style="text-align: center; color: #333;">Questionnaire à Choix Multiples</h2>

        <form id="qcmForm">
            <div class="question">
                <h3>Question 1 : Quel est votre niveau sportif actuel ?</h3>
                <div class="options">
                    <div class="option">
                        <input type="checkbox" id="q1a" name="q1" value="a">
                        <label for="q1a">a. Débutant</label>
                    </div>
                    <div class="option">
                        <input type="checkbox" id="q1b" name="q1" value="b">
                        <label for="q1b">b. Intermédiaire</label>
                    </div>
                    <div class="option">
                        <input type="checkbox" id="q1c" name="q1" value="c">
                        <label for="q1c">c. Avancé</label>
                    </div>
                </div>
            </div>

            <div class="question">
                <h3>Question 2 : Quels sports pratiquez-vous régulièrement ?</h3>
                <div class="options">
                    <div class="option">
                        <input type="checkbox" id="q2a" name="q2" value="a">
                        <label for="q2a">a. Course à pied</label>
                    </div>
                    <div class="option">
                        <input type="checkbox" id="q2b" name="q2" value="b">
                        <label for="q2b">b. Musculation</label>
                    </div>
                    <div class="option">
                        <input type="checkbox" id="q2c" name="q2" value="c">
                        <label for="q2c">c. Yoga </label>
                    </div>
                    <div class="option">
                        <input type="checkbox" id="q2d" name="q2" value="d">
                        <label for="q2d">d. aucun</label>
                    </div>
                </div>
            </div>

            <div class="question">
                <h3>Question 3 : Quel est votre objectif principal ?</h3>
                <div class="options">
                    <div class="option">
                        <input type="checkbox" id="q3a" name="q3" value="a">
                        <label for="q3a">a. Améliorer ma posture</label>
                    </div>
                    <div class="option">
                        <input type="checkbox" id="q3b" name="q3" value="b">
                        <label for="q3b">b. Renforcer mes muscles</label>
                    </div>
                    <div class="option">
                        <input type="checkbox" id="q3c" name="q3" value="c">
                        <label for="q3c">c. Entretenir ma santé</label>
                    </div>
                </div>
            </div>

            <div class="question">
                <h3>Question 4 : Quelle est votre fréquence sportive</h3>
                <div class="options">
                    <div class="option">
                        <input type="checkbox" id="q4a" name="q4" value="a">
                        <label for="q4a">a. 1 fois par jour</label>
                    </div>
                    <div class="option">
                        <input type="checkbox" id="q4b" name="q4" value="b">
                        <label for="q4b">b. 1 fois par semaine</label>
                    </div>
                    <div class="option">
                        <input type="checkbox" id="q4c" name="q4" value="c">
                        <label for="q4c">c. 3 fois par semaine</label>
                    </div>
                    <div class="option">
                        <input type="checkbox" id="q4d" name="q4" value="d">
                        <label for="q4d">d. 1 fois par mois</label>
                    </div>
                </div>
            </div>


            <button type="submit" class="submit-btn">Valider mes réponses</button>
        </form>

        <div id="result" class="result"></div>
    </div>

    <div class="chat-button">💬</div>

    <figure>
        <figcaption>Générique Décathlon</figcaption>
        <audio controls src="./audio/generique_decathlon.mp3"></audio>
    </figure>

    <footer>
        <p>Développer par JlreCodege JuAPromejeuje</p>
        <div class="footer-logos">
            <img src="./assets/UlcoInfo.png" alt="Info">
            <img src="./assets/Jrcandev.png" alt="JrCanDev">
        </div>
    </footer>

    <script>
        document.getElementById('qcmForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Récupération des réponses
            const niveau = document.querySelector('input[name="q1"]:checked')?.value;
            const sports = Array.from(document.querySelectorAll('input[name="q2"]:checked')).map(box => box.value);
            const objectif = document.querySelector('input[name="q3"]:checked')?.value;
            const frequence = document.querySelector('input[name="q4"]:checked')?.value;

            const resultDiv = document.getElementById('result');

            // Génération des conseils personnalisés
            let conseils = '<h3>🎯 Votre Profil Sportif Personnalisé</h3>';

            // Analyse du profil
            conseils += '<div style="margin: 20px 0;">';
            conseils += '<h4 style="color: #7B8FD8;">📊 Votre Profil</h4>';
            if (niveau === 'a') conseils += '<p><strong>Niveau :</strong> Débutant - Parfait pour commencer !</p>';
            if (niveau === 'b') conseils += '<p><strong>Niveau :</strong> Intermédiaire - Vous avez déjà de bonnes bases !</p>';
            if (niveau === 'c') conseils += '<p><strong>Niveau :</strong> Avancé - Excellent niveau !</p>';
            conseils += '</div>';

            // Conseils personnalisés selon les sports
            conseils += '<div style="margin: 20px 0;">';
            conseils += '<h4 style="color: #7B8FD8;">💪 Conseils Personnalisés</h4>';
            if (sports.includes('a')) conseils += '<p>🏃 Course à pied : Échauffez-vous, gardez une posture droite, augmentez progressivement l’intensité.</p>';
            if (sports.includes('b')) conseils += '<p>💪 Musculation : Concentrez-vous sur la technique, respirez correctement et reposez-vous.</p>';
            if (sports.includes('c')) conseils += '<p>🧘 Yoga : Écoutez votre corps, respirez profondément et soyez régulier.</p>';
            if (sports.includes('d') || sports.length === 0) conseils += '<p>Démarrage : Commencez par des exercices doux 2-3 fois par semaine.</p>';

            if (objectif === 'a') conseils += '<p>📌 Amélioration posturale : Gainage, étirements et posture au quotidien.</p>';
            if (objectif === 'b') conseils += '<p>📌 Renforcement musculaire : Variez les exercices, augmentez la difficulté et apport protéique suffisant.</p>';
            if (objectif === 'c') conseils += '<p>📌 Entretien santé : Combinez cardio et renforcement, alimentation équilibrée.</p>';
            conseils += '</div>';

            // Illustrations / tutoriels
            conseils += '<div style="margin: 20px 0;">';
            conseils += '<h4 style="color: #7B8FD8;">🎨 Visualisation des Mouvements</h4>';
            conseils += '<p>📹 Tutoriels vidéo sur l’application Decathlon Coach</p>';
            conseils += '<p>📖 Guides illustrés disponibles en magasin</p>';
            conseils += '</div>';

            // Produits recommandés
            conseils += '<div style="margin: 20px 0;">';
            conseils += '<h4 style="color: #7B8FD8;">🛒 Produits Recommandés</h4>';
            if (sports.includes('a')) conseils += '<p>🏃 Chaussures adaptées, montre cardio, vêtements respirants</p>';
            if (sports.includes('b')) conseils += '<p>💪 Tapis de sol, haltères, bandes de résistance, gants</p>';
            if (sports.includes('c')) conseils += '<p>🧘 Tapis yoga antidérapant, briques, sangle, coussin méditation</p>';
            conseils += '<p>🔗 <a href="https://www.decathlon.fr" target="_blank" style="color: #7B8FD8; font-weight: bold;">Voir produits sur Decathlon.fr</a></p>';
            conseils += '</div>';

            // Conseil fréquence
            if (frequence === 'd') {
                conseils += '<p style="background: #fff3cd; padding: 10px; border-radius: 5px;">⚠️ Une séance par mois est insuffisante pour progresser. Essayez 2-3 séances par semaine !</p>';
            }

            // Bouton pour passer à la page suivante
            conseils += '<div style="text-align: center; margin-top: 20px;">';
            conseils += '<button id="nextPageBtn" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">Suivant</button>';
            conseils += '</div>';

            resultDiv.className = 'result show';
            resultDiv.innerHTML = conseils;
            resultDiv.scrollIntoView({
                behavior: 'smooth'
            });

            // Ajouter l'événement au bouton
            document.getElementById('nextPageBtn').addEventListener('click', () => {
                window.location.href = 'spaceinvader.php'; // chemin relatif au même dossier
            });
        });
    </script>
</body>

</html>