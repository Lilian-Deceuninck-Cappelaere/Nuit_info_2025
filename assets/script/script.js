// gameInterval = setInterval(update, speed);
const startBtn = document.getElementById('startSnake');
const overlay = document.getElementById('snakeOverlay');
const closeBtn = document.getElementById('closeSnake');
const game = document.getElementById('game');
const scoreEl = document.getElementById('score');
const gameOver = document.getElementById('gameOver');
const restartBtn = document.getElementById('restartBtn');

const gridSize = 30;
const speed = 200;
let gameInterval;
let score = 0;
let snake = [];
let snakeElements = [];
let dx = 1, dy = 0;
let food = { x: 0, y: 0 };

// Créer la nourriture
let foodEl = document.createElement('img');
foodEl.src = 'assets/images/miam.png';
foodEl.style.position = 'absolute';
foodEl.style.width = gridSize + 'px';
foodEl.style.height = gridSize + 'px';
game.appendChild(foodEl);

function placeFood() {
    const gridWidth = Math.floor(game.offsetWidth / gridSize);
    const gridHeight = Math.floor(game.offsetHeight / gridSize);
    food.x = Math.floor(Math.random() * gridWidth);
    food.y = Math.floor(Math.random() * gridHeight);
    foodEl.style.left = food.x * gridSize + 'px';
    foodEl.style.top = food.y * gridSize + 'px';
}

function drawSnake() {
    snakeElements.forEach(el => el.remove());
    snakeElements = [];
    snake.forEach((seg, i) => {
        const img = document.createElement('img');
        img.style.position = 'absolute';
        img.style.width = gridSize + 'px';
        img.style.height = gridSize + 'px';
        img.style.left = seg.x * gridSize + 'px';
        img.style.top = seg.y * gridSize + 'px';
        img.src = i === 0 ? 'assets/images/head.jpg' : 'assets/images/tail.png';
        game.appendChild(img);
        snakeElements.push(img);
    });
}

function update() {
    const head = snake[0];
    const newX = head.x + dx;
    const newY = head.y + dy;
    const gridWidth = Math.floor(game.offsetWidth / gridSize);
    const gridHeight = Math.floor(game.offsetHeight / gridSize);

    if (newX < 0 || newY < 0 || newX >= gridWidth || newY >= gridHeight) return endGame();

    for (let s of snake) if (s.x === newX && s.y === newY) return endGame();

    snake.unshift({ x: newX, y: newY });

    if (newX === food.x && newY === food.y) {
        score++;
        scoreEl.textContent = "Score: " + score;
        if (score >= 10) return winGame();
        placeFood();
    } else {
        snake.pop();
    }

    drawSnake();
}

function startGame() {
    overlay.style.display = 'flex';
    snake = [{ x: 5, y: 5 }];
    dx = 1; dy = 0;
    score = 0;
    scoreEl.textContent = "Score: 0";
    placeFood();
    drawSnake();
    gameOver.style.display = 'none';

    if (gameInterval) clearInterval(gameInterval);
    gameInterval = setInterval(update, speed);
}

function endGame() {
    clearInterval(gameInterval);
    gameOver.querySelector('h2').textContent = "Game Over! Score: " + score;
    gameOver.style.display = 'block';
}

function winGame() {
    clearInterval(gameInterval);
    alert("Victoire ! Score: " + score);
    overlay.style.display = 'none';
    window.location.href = "inc/qcm.php";
}

// Événements
startBtn.addEventListener('click', startGame);
restartBtn.addEventListener('click', startGame);
closeBtn.addEventListener('click', () => {
    clearInterval(gameInterval);
    overlay.style.display = 'none';
});

// Contrôles
document.addEventListener('keydown', e => {
    if (overlay.style.display !== 'flex') return;
    if (e.key === 'ArrowUp' && dy === 0) { dx = 0; dy = -1; }
    if (e.key === 'ArrowDown' && dy === 0) { dx = 0; dy = 1; }
    if (e.key === 'ArrowLeft' && dx === 0) { dx = -1; dy = 0; }
    if (e.key === 'ArrowRight' && dx === 0) { dx = 1; dy = 0; }
});
