<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Dérailleur 3000 - Chatbot Inutile ULTIMATE</title>
    <style>
        /* J'ai gardé le même style, c'est propre et moderne */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1a1a1a;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .chat-container {
            width: 100%;
            max-width: 500px;
            background-color: #2d2d2d;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 80vh;
        }

        .chat-header {
            background: linear-gradient(90deg, #ff00cc, #333399);
            padding: 20px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .chat-box {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
            scroll-behavior: smooth;
        }

        .message {
            max-width: 85%;
            padding: 12px 16px;
            border-radius: 18px;
            line-height: 1.4;
            font-size: 0.95rem;
            animation: fadeIn 0.3s ease;
            word-wrap: break-word;
        }

        .user-message {
            background-color: #007bff;
            align-self: flex-end;
            border-bottom-right-radius: 4px;
        }

        .bot-message {
            background-color: #404040;
            align-self: flex-start;
            border-bottom-left-radius: 4px;
            border: 1px solid #555;
        }

        .bot-message strong {
            color: #ff00cc;
            /* Met la citation en valeur */
            display: block;
            margin-top: 10px;
            font-style: italic;
        }

        .input-area {
            padding: 20px;
            background-color: #252525;
            display: flex;
            gap: 10px;
            border-top: 1px solid #333;
        }

        input {
            flex: 1;
            padding: 12px 15px;
            border-radius: 25px;
            border: none;
            background-color: #3d3d3d;
            color: white;
            outline: none;
            font-size: 1rem;
        }

        button {
            background-color: #ff00cc;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.2s;
        }

        button:hover {
            background-color: #d900ad;
        }

        button:active {
            transform: scale(0.95);
        }

        .typing {
            font-size: 0.8rem;
            color: #aaa;
            margin: 0 0 10px 20px;
            display: none;
            font-style: italic;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="chat-container">
        <div class="chat-header">
            🤡 LE DÉRAILLEUR ULTIMATE
        </div>
        <div class="chat-box" id="chatBox">
            <div class="message bot-message">
                Salut l'artiste ! Pose ta question, j'ai une maîtrise en "Réponses à côté de la plaque" mention "Très Bien".
            </div>
        </div>
        <div class="typing" id="typingIndicator">Le Dérailleur cherche une ref...</div>
        <div class="input-area">
            <input type="text" id="userInput" placeholder="Écris un truc..." onkeypress="handleEnter(event)" autocomplete="off">
            <button onclick="sendMessage()">Envoyer</button>
        </div>
    </div>

    <script>
        // =================================================================
        // LA CAVE AUX TRESORS DU N'IMPORTE QUOI (Version XXL)
        // =================================================================

        // PARTIE 1 : L'intro qui ignore totalement l'utilisateur
        const intros = [
            "C'est marrant que tu dises ça, ça me rappelle ma tante en Creuse.",
            "Attends, chut. On s'en fiche de ça. Le vrai problème c'est :",
            "Tu sais, la vie c'est comme une boîte de chocolats, sauf quand c'est une boîte de clous rouillés.",
            "Je t'arrête tout de suite, tu pars sur une mauvaise piste.",
            "Intéressant... très intéressant... Mais est-ce que tu as pensé aux loutres ?",
            "C'est une bonne question, mais la réponse est dans la sauce béarnaise, pas ici.",
            "Non, non, non. Tu prends le problème à l'envers, comme un pull mis dans le noir.",
            "Écoute-moi bien, jeune padawan, car je ne vais le dire qu'une fois.",
            "Ah ! J'attendais que tu poses cette question stupide.",
            "Franchement, entre nous, tu crois vraiment que c'est important ?",
            "Oublie tout ce que tu viens de dire, concentre-toi sur l'essentiel.",
            "Parlons d'autre chose, tu veux bien ? Ton sujet m'ennuie.",
            "Tu me rappelles un gars que j'ai connu au Venezuela, un type louche.",
            "C'est pas faux ce que tu dis, mais c'est complètement à côté de la plaque.",
            "Avant de répondre, il faut qu'on règle un truc : qui a fini le jus d'orange ?",
            "Ta question est pertinente, mais ma réponse le sera beaucoup moins.",
            "Arrête de bouger, tu fais des interférences avec mes chakras.",
            "Si j'étais toi, je ne poserais pas ce genre de questions en public.",
            "Ça me fait penser à cette fois où j'ai essayé de monter un meuble IKEA les yeux bandés."
        ];

        // PARTIE 2 : Le milieu absurde et pseudo-scientifique
        const middles = [
            "Si on mélange du plâtre et de la compote, ça ne fait pas un mur porteur, c'est prouvé.",
            "Le cosmos est infini, contrairement à la patience d'un serveur parisien un lundi matin.",
            "Il faut toujours vérifier la pression des pneus avant de manger une raclette, question de digestion.",
            "Moi je pense que les pigeons sont des caméras du gouvernement pour surveiller les statues.",
            "C'est scientifiquement prouvé : l'eau ça mouille, sauf quand c'est de la vapeur, là ça brûle.",
            "Il ne faut pas pousser mémé dans les orties, surtout si elle est en short, ça gratte.",
            "Le problème avec les gens qui mangent des quiches, c'est qu'ils sont souvent frileux des genoux.",
            "Napoléon n'a jamais dit ça, je le sais, j'y étais, je tenais le cheval.",
            "Les dauphins sont juste des requins qui ont fait une école de commerce, c'est du marketing.",
            "Si tu creuses un trou assez profond, tu finiras par tomber sur des chinois qui creusent dans l'autre sens.",
            "Le camembert, pour être bon, doit être coulant, sinon le joint de culasse pète.",
            "J'ai lu dans une revue que les épinards donnaient des super-pouvoirs, mais seulement le mardi.",
            "C'est comme si tu essayais de faire rentrer un carré dans un rond, mais avec un marteau-piqueur.",
            "La gravité, c'est juste une invention des fabricants d'ascenseurs pour nous vendre des trucs.",
            "Il paraît que si tu dis trois fois 'Beetlejuice' devant un miroir, il apparaît un agent des impôts.",
            "Les maths, c'est comme le taboulé, y'a trop de persil et on comprend jamais la fin.",
            "Faut arrêter de croire que le grille-pain est ton ami. Il attend juste le bon moment.",
            "C'est la faute aux ondes 5G qui font tourner le lait dans les frigos.",
            "En 1515, Marignan. Voilà. C'est tout ce que je sais. C'est déjà pas mal, non ?"
        ];

        // PARTIE 3 : La réplique culte qui tombe comme un cheveu sur la soupe
        const quotes = [
            // Cité de la peur / Nuls
            "J'ai glissé chef !",
            "Prenez un chewing-gum Emile, ça vous détendra.",
            "On attend pas votre sœur ?",
            "Il s'appelle Juste Leblanc. Ah bon, il a pas de prénom ?",
            "Ça va trancher chérie.",
            "C'est cela oui...",
            "Quand je suis content, je vomis.",
            "Vous voulez un whisky ? Oh juste un doigt. Vous voulez pas un whisky d'abord ?",
            "Je ne vous jette pas la pierre, Pierre.",
            "On peut tromper 1000 personnes une fois... Non on peut tromper une personne 1000 fois... Non...",
            "Il ne peut plus rien nous arriver d'affreux maintenant !",
            "Barrez-vous, cons de mimes !",

            // OSS 117
            "J'aime me beurrer la biscotte.",
            "Habile !",
            "C’est notre Raïs à nous, c’est monsieur René Coty.",
            "J'ai été réveillé par une personne qui hurlait à la mort. C'était moi.",
            "Comment est votre blanquette ?",
            "C'est l'inexpérience qui parle. Moi, je suis dans le métier depuis 55 ans.",
            "On me dit le plus grand bien des harengs pommes à l'huile.",

            // Kaamelott
            "C’est pas faux.",
            "Le gras, c’est la vie.",
            "Je ne mange pas de graines !",
            "On en a gros !",
            "Arthour ! Couillère !",
            "Moi, je serais vous, je vous écouterais. Non, moi, je serais nous, je vous… Si moi, j’étais vous, je vous écouterais.",
            "C'est systématiquement débile, mais c'est toujours inattendu !",

            // Bronzés / Père Noel
            "Le train de tes injures roule sur le rail de mon indifférence.",
            "C'est fin, c'est très fin, ça se mange sans faim.",
            "J'ai failli conclure !",
            "Y'a le klaxon qui fait pimpon, mais la voiture elle fait pas pimpon.",
            "Zézette épouse X.",

            // Astérix Mission Cléopâtre
            "C'est une bonne situation ça scribe ?",
            "Il est où le magneau ?",
            "Pas de pierre ! Pas de construction. Pas de construction ! Pas de palais. Pas de palais... pas de palais.",
            "C'est trop calme. J'aime pas trop beaucoup ça.",
            "Lion ? Non, c'est un palais !",

            // Autres (Rasta Rocket, Dikkenek, etc.)
            "Balance man, cadence man, trace la glace c'est le bob man !",
            "Sanka, t'es mort ? Yeah man.",
            "Ou tu sors, ou j'te sors, hein ?",
            "T'es tendu Natacha, c'est pour ça que t'as des crampes.",
            "Il est gentil mais c'est pas une lumière.",
            "Tu bluffes Martoni !"
        ];

        // =================================================================
        // LA MECANIQUE DU ROBOT
        // =================================================================

        function getRandom(arr) {
            return arr[Math.floor(Math.random() * arr.length)];
        }

        function generateNonsense() {
            // On pioche une phrase dans chaque catégorie
            const part1 = getRandom(intros);
            const part2 = getRandom(middles);
            const part3 = getRandom(quotes);
            // On assemble le tout avec un peu de mise en forme HTML
            return `${part1} ${part2} <strong>« ${part3} »</strong>`;
        }

        function sendMessage() {
            const input = document.getElementById('userInput');
            const chatBox = document.getElementById('chatBox');
            const text = input.value.trim();

            if (text === "") return;

            // 1. Afficher le message de l'utilisateur
            chatBox.innerHTML += `<div class="message user-message">${text}</div>`;
            input.value = ""; // Vider le champ
            chatBox.scrollTop = chatBox.scrollHeight; // Scroller vers le bas

            // 2. Afficher l'indicateur de frappe
            const typing = document.getElementById('typingIndicator');
            typing.style.display = 'block';
            chatBox.scrollTop = chatBox.scrollHeight;

            // 3. Attendre un peu (pour faire croire qu'il réfléchit)
            setTimeout(() => {
                typing.style.display = 'none';
                // 4. Générer et afficher la réponse débile
                const botResponse = generateNonsense();
                chatBox.innerHTML += `<div class="message bot-message">${botResponse}</div>`;
                chatBox.scrollTop = chatBox.scrollHeight;
            }, 1200); // Délai de 1.2 secondes
        }

        // Permet d'envoyer avec la touche Entrée
        function handleEnter(e) {
            if (e.key === 'Enter') sendMessage();
        }
    </script>

</body>

</html>