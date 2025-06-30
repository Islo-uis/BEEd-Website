const levels = [
  'Assets/bg/background_palengke.png',
  'Assets/bg/bahay_ni_lalay_BG.png',
  'Assets/bg/bodega_ni_karina_BG.png',
  'Assets/bg/BUGASAN.png',
  'Assets/bg/chicken_meat_stall_BG.png',
  'Assets/bg/isdaan.png',
  'Assets/bg/fruit_stand.png'
];

const mainTitleBG = "Assets/bg/main.png"

// Elements
const container = document.getElementById('game-container');
const overlay = document.getElementById('overlay');
const startButton = document.getElementById('start-button');
const soundToggle = document.getElementById('sound-toggle');
const title = document.getElementById('title');
const difficultyOptions = document.getElementById('difficulty-options');
const easyButton = document.getElementById('easy-button');
const mediumButton = document.getElementById('medium-button');
const hardButton = document.getElementById('hard-button');

let currentLevel = -1;
let soundOn = true;

// Initial Screen
document.addEventListener('DOMContentLoaded', () => {
showMainTitle();
});


// Button Events
startButton.addEventListener('click', showDifficultyOptions);

soundToggle.addEventListener('click', () => {
  soundOn = !soundOn;
  soundToggle.src = soundOn ? 'Assets/icons/SOUND.png' : 'Assets/icons/MUTE.png';
});

easyButton.addEventListener('click', () => startGame('Easy'));
mediumButton.addEventListener('click', () => startGame('Medium'));
hardButton.addEventListener('click', () => startGame('Hard'));

// Main title screen
function showMainTitle() {
  container.style.backgroundImage = `url('${mainTitleBG}')`;
  overlay.style.display = 'flex';
  title.textContent = 'Palengke Adventure';

  startButton.style.display = 'inline-block';
  soundToggle.style.display = 'inline-block';
  difficultyOptions.style.display = 'none';

  overlay.onclick = null;
}

// Difficulty selection screen
function showDifficultyOptions() {
  container.style.backgroundImage = `url('${mainTitleBG}')`;
  overlay.style.display = 'flex';
  title.textContent = 'Choose Difficulty';

  startButton.style.display = 'none';
  soundToggle.style.display = 'inline-block';
  difficultyOptions.style.display = 'flex';

  overlay.onclick = null;
}

function startGame(difficulty) {
  console.log(`Selected difficulty: ${difficulty}`);
  currentLevel = 0;

  // Hide overlay before showing first level
  overlay.style.display = 'none';
  difficultyOptions.style.display = 'none';

  // Small delay to ensure overlay click doesn't trigger immediately
  setTimeout(() => {
    startLevel(currentLevel);
  }, 300); // adjust if needed
}

function startLevel(levelIndex) {
  if (levelIndex >= levels.length) {
    showMainTitle(); // If no more levels, go back to main title
    return;
  }

  console.log(`Displaying Level: ${levelIndex + 1}`, levels[levelIndex]);

  container.style.backgroundImage = `url('${levels[levelIndex]}')`;

  overlay.style.display = 'flex';
  title.textContent = `Level ${levelIndex + 1}`;

  // Hide other UI
  startButton.style.display = 'none';
  soundToggle.style.display = 'none';
  difficultyOptions.style.display = 'none';

  // Show dialogue box and characters
  document.getElementById('dialogue').style.display = 'flex';

  overlay.onclick = null;

  overlay.onclick = () => {
    overlay.onclick = null;
    document.getElementById('dialogue').style.display = 'none'; // Hide dialogue on advance
    overlay.style.display = 'none';
    currentLevel++;
    startLevel(currentLevel);
  };
}

