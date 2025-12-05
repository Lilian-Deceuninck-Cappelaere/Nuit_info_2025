<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Félicitations !</title>
    <style>
        /* Fullscreen et fond sombre */
        body,
        html {
            margin: 0;
            padding: 0;
            overflow: hidden;
            height: 100%;
            width: 100%;
            background-color: #0a0a0a;
            font-family: 'Arial', sans-serif;
        }

        /* Canvas couvrant tout l'écran */
        canvas {
            position: absolute;
            top: 0;
            left: 0;
        }

        /* Texte de félicitations */
        .congrats {
            position: absolute;
            top: 40%;
            width: 100%;
            text-align: center;
            font-size: 60px;
            color: #FFD700;
            text-shadow: 2px 2px 10px #ff0000, 0 0 20px #00ff00, 0 0 30px #00ffff;
            font-weight: bold;
            pointer-events: none;
        }

        /* Effet festif de confettis */
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #fff;
            pointer-events: none;
            opacity: 0.8;
            border-radius: 50%;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            100% {
                transform: translateY(100vh) rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <canvas id="fireworks"></canvas>
    <div class="congrats">🎉 Félicitations ! 🎉</div>

    <script>
        // Feux d'artifice sur canvas
        const canvas = document.getElementById('fireworks');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const fireworks = [];
        const particles = [];

        function random(min, max) {
            return Math.random() * (max - min) + min;
        }

        class Firework {
            constructor(x, y, targetY) {
                this.x = x;
                this.y = y;
                this.targetY = targetY;
                this.color = `hsl(${Math.random() * 360}, 100%, 50%)`;
                this.exploded = false;
            }

            update() {
                if (!this.exploded) {
                    this.y -= 5;
                    if (this.y <= this.targetY) {
                        this.explode();
                        this.exploded = true;
                    }
                }
            }

            explode() {
                const count = 50;
                for (let i = 0; i < count; i++) {
                    const angle = Math.random() * 2 * Math.PI;
                    const speed = random(2, 8);
                    particles.push(new Particle(this.x, this.y, speed * Math.cos(angle), speed * Math.sin(angle), this.color));
                }
            }

            draw() {
                if (!this.exploded) {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, 3, 0, Math.PI * 2);
                    ctx.fillStyle = this.color;
                    ctx.fill();
                }
            }
        }

        class Particle {
            constructor(x, y, vx, vy, color) {
                this.x = x;
                this.y = y;
                this.vx = vx;
                this.vy = vy;
                this.color = color;
                this.alpha = 1;
            }

            update() {
                this.x += this.vx;
                this.y += this.vy;
                this.vy += 0.05; // gravité
                this.alpha -= 0.02;
            }

            draw() {
                ctx.globalAlpha = this.alpha;
                ctx.beginPath();
                ctx.arc(this.x, this.y, 2, 0, Math.PI * 2);
                ctx.fillStyle = this.color;
                ctx.fill();
                ctx.globalAlpha = 1;
            }
        }

        function animate() {
            ctx.fillStyle = 'rgba(10, 10, 10, 0.2)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            if (Math.random() < 0.05) {
                fireworks.push(new Firework(random(50, canvas.width - 50), canvas.height, random(50, canvas.height / 2)));
            }

            fireworks.forEach((fw, index) => {
                fw.update();
                fw.draw();
                if (fw.exploded) fireworks.splice(index, 1);
            });

            particles.forEach((p, index) => {
                p.update();
                p.draw();
                if (p.alpha <= 0) particles.splice(index, 1);
            });

            requestAnimationFrame(animate);
        }

        animate();

        // Confettis aléatoires pour l'effet festif
        for (let i = 0; i < 100; i++) {
            const confetti = document.createElement('div');
            confetti.classList.add('confetti');
            confetti.style.backgroundColor = `hsl(${Math.random()*360}, 100%, 50%)`;
            confetti.style.left = Math.random() * window.innerWidth + 'px';
            confetti.style.animationDuration = (random(2, 5)) + 's';
            confetti.style.width = confetti.style.height = random(5, 12) + 'px';
            document.body.appendChild(confetti);
        }

        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
    </script>
</body>

</html>