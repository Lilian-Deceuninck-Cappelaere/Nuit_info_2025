const game = document.getElementById('game');
const player = document.getElementById('player');
const gameOver = document.getElementById('gameOver');
const restartBtn = document.getElementById('restartBtn');

let bullets = [];
let enemies = [];
let enemyBullets = [];
let direction = 1;
let boss = null;
let score = 0;
let playerAlive = true;

// créer 6 ennemis
for (let i = 0; i < 6; i++) {
    const enemy = document.createElement('img');
    enemy.src = '../assets/images/windows.png';
    enemy.className = 'enemy';
    enemy.style.top = '50px';
    enemy.style.left = 100 + i * 100 + 'px';
    game.appendChild(enemy);
    enemies.push({ el: enemy, x: 100 + i * 100 });
}

// Déplacer le vaisseau
document.addEventListener('keydown', e => {
    if (!playerAlive) return;
    const step = 20;
    const left = player.offsetLeft;
    if (e.key === 'ArrowLeft' && left > 0) player.style.left = left - step + 'px';
    if (e.key === 'ArrowRight' && left + player.offsetWidth < window.innerWidth) player.style.left = left + step + 'px';
    if (e.key === ' ') shoot();
});

// Tirer au clic
document.addEventListener('click', () => {
    if (!playerAlive) return;
    shoot();
});

// Tir du joueur
function shoot() {
    const bullet = document.createElement('img');
    bullet.src = '../assets/images/tux.png';
    bullet.className = 'bullet';
    bullet.style.width = '20px';
    bullet.style.position = 'absolute';
    bullet.style.left = player.getBoundingClientRect().left + player.offsetWidth / 2 - 10 + 'px';
    bullet.style.top = (player.offsetTop || (window.innerHeight - player.offsetHeight - 20)) - 20 + 'px';
    game.appendChild(bullet);
    bullets.push(bullet);
}

// Mouvement ennemis
function moveEnemies() {
    let hitEdge = false;
    enemies.forEach(e => {
        e.x += 5 * direction;
        if (e.x <= 0 || e.x + e.el.offsetWidth >= window.innerWidth) hitEdge = true;
    });
    if (hitEdge) {
        direction *= -1;
        enemies.forEach(e => {
            e.x += 5 * direction;
        });
    }
    enemies.forEach(e => e.el.style.left = e.x + 'px');
}

// Tir d'un ennemi
function enemyShoot(enemy) {
    const bullet = document.createElement('img');
    bullet.src = '../assets/images/tux.png';
    bullet.className = 'enemyBullet';
    bullet.style.width = '20px';
    bullet.style.height = '20px';
    bullet.style.background = 'red';
    bullet.style.position = 'absolute';
    bullet.style.left = enemy.x + enemy.el.offsetWidth / 2 - 5 + 'px';
    bullet.style.top = enemy.el.offsetTop + enemy.el.offsetHeight + 'px';
    game.appendChild(bullet);
    enemyBullets.push(bullet);

    // Tir suivant aléatoire 3-5s
    setTimeout(() => {
        if (enemy.el.parentElement) enemyShoot(enemy);
    }, 3000 + Math.random() * 2000);
}

// Lancer les tirs pour les ennemis existants
enemies.forEach(e => enemyShoot(e));

// Mise à jour des tirs ennemis et collision joueur
function updateEnemyBullets() {
    for (let i = enemyBullets.length - 1; i >= 0; i--) {
        const b = enemyBullets[i];
        b.style.top = b.offsetTop + 5 + 'px';

        if (
            playerAlive &&
            b.offsetLeft < player.offsetLeft + player.offsetWidth &&
            b.offsetLeft + b.offsetWidth > player.offsetLeft &&
            b.offsetTop < player.offsetTop + player.offsetHeight &&
            b.offsetTop + b.offsetHeight > player.offsetTop
        ) {
            // collision joueur
            playerAlive = false;
            document.querySelector('#gameOver h2').textContent = "Perdu ! Score : " + score;
            gameOver.style.display = 'block';
            restartBtn.onclick = () => location.reload();
            return true;
        }

        if (b.offsetTop > window.innerHeight) {
            b.remove();
            enemyBullets.splice(i, 1);
        }
    }
    return false;
}

// Mise à jour générale
function update() {
    if (!playerAlive) return;

    // Déplacer bullets joueur
    for (let i = bullets.length - 1; i >= 0; i--) {
        const b = bullets[i];
        b.style.top = b.offsetTop - 10 + 'px';
        if (b.offsetTop < 0) {
            b.remove();
            bullets.splice(i, 1);
            continue;
        }

        // collision avec ennemis
        for (let j = enemies.length - 1; j >= 0; j--) {
            const e = enemies[j];

            if (b.offsetLeft < e.el.offsetLeft + e.el.offsetWidth &&
                b.offsetLeft + b.offsetWidth > e.el.offsetLeft &&
                b.offsetTop < e.el.offsetTop + e.el.offsetHeight &&
                b.offsetTop + b.offsetHeight > e.el.offsetTop) {

                // gestion PV du boss
                if (e.hp !== undefined) {
                    e.hp--;
                    b.remove();
                    bullets.splice(i, 1);
                    if (e.hp > 0) break;
                }

                e.el.remove();
                enemies.splice(j, 1);


                // points
                if (e.hp !== undefined) {
                    score += 500;  // boss
                } else {
                    score += 100;  // ennemi normal
                }
                document.getElementById('score').textContent = "Score : " + score;

                b.remove();
                bullets.splice(i, 1);
                break;
            }
        }
    }

    // spawn boss si tous les ennemis sont morts
    if (enemies.length === 0 && !boss) {
        const b = document.createElement('img');
        b.src = '../assets/images/boss.jpg';
        b.className = 'enemy';
        b.style.top = '50px';
        b.style.left = '50%';
        b.style.transform = 'translateX(-50%)';
        b.style.width = '100px';
        game.appendChild(b);

        boss = { el: b, x: window.innerWidth / 2 - 50, hp: 3 };
        enemies.push(boss);
        enemyShoot(boss);
    }

    // vérifier la victoire
    if (enemies.length === 0 && (!boss || boss.el.parentElement === null)) {
        document.querySelector('#gameOver h2').textContent = "Gagné ! Score : " + score;
        gameOver.style.display = 'block';
        restartBtn.textContent = "Suivant"; // change le texte du bouton
        restartBtn.onclick = () => {
            window.location.href = '../inc/end.php'; // <-- met la page de destination ici
        };
        return;
    }

    moveEnemies();

    // update tirs ennemis
    if (updateEnemyBullets()) return;

    requestAnimationFrame(update);
}

update();
