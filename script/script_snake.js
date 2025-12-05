const game = document.getElementById('game');
const scoreEl = document.getElementById('score');
const gameOver = document.getElementById('gameOver');
const restartBtn = document.getElementById('restartBtn');

const gridSize = 30;
const gameWidth = game.offsetWidth;
const gameHeight = game.offsetHeight;
const gridWidth = Math.floor(gameWidth / gridSize);
const gridHeight = Math.floor(gameHeight / gridSize);
const speed = 200;

let gameInterval;
let score = 0;

// serpent
let snake = [
    { x: 5, y: 5 }
];
let snakeElements = [];

let dx = 1;
let dy = 0;

// créer le serpent
function drawSnake() {
    snakeElements.forEach(el => el.remove());
    snakeElements = [];

    snake.forEach((segment, index) => {
        const img = document.createElement('img');
        img.style.position = 'absolute';
        img.style.left = segment.x * gridSize + 'px';
        img.style.top = segment.y * gridSize + 'px';
        img.src = index === 0 ? 'assets/images/head.jpg' : 'assets/images/tail.png';
        img.className = index === 0 ? 'snakeHead' : 'snakeBody';
        game.appendChild(img);
        snakeElements.push(img);
    });
}

// nourriture
let food = { x: 10, y: 5 };
let foodEl = document.createElement('img');
foodEl.src = 'assets/images/miam.png';
foodEl.className = 'food';
foodEl.style.position = 'absolute';
foodEl.style.left = food.x * gridSize + 'px';
foodEl.style.top = food.y * gridSize + 'px';
game.appendChild(foodEl);

function placeFood() {
    food.x = Math.floor(Math.random() * gridWidth);
    food.y = Math.floor(Math.random() * gridHeight);
    foodEl.style.left = food.x * gridSize + 'px';
    foodEl.style.top = food.y * gridSize + 'px';
}

// logique du jeu
function update() {
    const head = snake[0];
    const newX = head.x + dx;
    const newY = head.y + dy;

    // murs
    if (newX < 0 || newY < 0 || newX >= gridWidth || newY >= gridHeight) {
        return endGame();
    }

    // collision corps
    for (let s of snake) {
        if (s.x === newX && s.y === newY) return endGame();
    }

    const newHead = { x: newX, y: newY };
    snake.unshift(newHead);

    // nourriture
    if (newX === food.x && newY === food.y) {
        score += 1;
        scoreEl.textContent = "Score : " + score;
        placeFood();
        if (score >= 15) return winGame();
    } else {
        snake.pop();
    }

    drawSnake();
}

function winGame() {
    clearInterval(gameInterval);
    document.querySelector('#gameOver h2').textContent = "Victoire ! Score : " + score;
    gameOver.style.display = 'block';
    restartBtn.onclick = () => location.reload();
}

// popup fin de partie
function endGame() {
    clearInterval(gameInterval);
    document.querySelector('#gameOver h2').textContent = "Game Over ! Score : " + score;
    gameOver.style.display = 'block';

    restartBtn.onclick = () => location.reload();
}

// contrôles
document.addEventListener('keydown', e => {
    if (e.key === 'ArrowUp' && dy === 0) { dx = 0; dy = -1; }
    if (e.key === 'ArrowDown' && dy === 0) { dx = 0; dy = 1; }
    if (e.key === 'ArrowLeft' && dx === 0) { dx = -1; dy = 0; }
    if (e.key === 'ArrowRight' && dx === 0) { dx = 1; dy = 0; }
});

// lancer
gameInterval = setInterval(update, speed);
