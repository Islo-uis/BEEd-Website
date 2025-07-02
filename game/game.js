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
const level = document.getElementById('levell');
const difficultyOptions = document.getElementById('difficulty-options');
const easyButton = document.getElementById('easy-button');
const mediumButton = document.getElementById('medium-button');
const hardButton = document.getElementById('hard-button');
var difficulty = 0;

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
  title.style.display = 'flex'
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

function startGame(diff) {
  console.log(`Selected difficulty: ${diff}`);
  currentLevel = 0;
  if (diff == "Easy"){
    difficulty = 1;
  }
  else if (diff == "Medium"){
    difficulty = 2;
  }
  else if (diff == "Hard"){
    difficulty = 3;
  }


  $.ajax({
    type: "POST",
    url: "game/ajax.php?action=getLevel",
    data: {
      difficulty: difficulty
    },
    dataType: 'json',
    success: function (response) {
      var count = parseInt(response.count);
      if (count > 0) {
          // Hide overlay before showing first level
        overlay.style.display = 'none';
        difficultyOptions.style.display = 'none';
       // Small delay to ensure overlay click doesn't trigger immediately
          setTimeout(() => {
            startLevel(currentLevel);
          }, 300); // adjust if needed
      } else {

        Swal.fire({
          icon: "error",
          title: "Stay Tuned!",
          text: "There are currently no levels on this difficulty!"
        });
        return false;
      }
    },
    error: function (xhr, status, error) {
      console.error("An error occurred: " + error);
      console.log("Response text: " + xhr.responseText);
    }
  });

  
}

function startLevel(levelIndex) {
  if (levelIndex >= levels.length) {
    showMainTitle(); // If no more levels, go back to main title
    return;
  }

  console.log(`Displaying Level: ${levelIndex + 1}`, levels[levelIndex]);

  container.style.backgroundImage = `url('${levels[levelIndex]}')`;

  overlay.style.display = 'flex';
  title.style.display = 'none';
  level.textContent = `Level ${levelIndex + 1}`;

  // Hide other UI
  startButton.style.display = 'none';
  soundToggle.style.display = 'none';
  difficultyOptions.style.display = 'none';

  // Show dialogue box and characters
  document.getElementById('level-overlay').style.display = 'flex';
   const dialogueBox = document.getElementById('dialogue');
  dialogueBox.style.display = 'flex';
  


  overlay.onclick = null;

  overlay.onclick = () => {
    overlay.onclick = null;
    document.getElementById('dialogue').style.display = 'none'; // Hide dialogue on advance
    overlay.style.display = 'none';
    currentLevel++;
    startLevel(currentLevel);
  };
}
const settingsBtn = document.getElementById('settings-icon');
const settingGui = document.getElementById('setting-gui');
const blurTarget = document.getElementById('blur-target');

settingsBtn.addEventListener('click', () => {
  settingGui.style.display = 'flex';
  blurTarget.classList.add('blur');
});

settingGui.addEventListener('click', (e) => {
  if (e.target.id === 'setting-gui') {
    settingGui.style.display = 'none';
    blurTarget.classList.remove('blur');
  }
});


// Show the settings GUI
document.getElementById('settings-icon').addEventListener('click', () => {
  document.getElementById('setting-gui').style.display = 'flex';
});

// Optional: close when clicking outside button
document.getElementById('setting-gui').addEventListener('click', (e) => {
  if (e.target.id === 'setting-gui') {
    document.getElementById('setting-gui').style.display = 'none';
  }
});

// Login button click
document.getElementById('admin-login-button').addEventListener('click', () => {
  window.location.href = 'adminLogin.php';
});

document.getElementById('back-button').addEventListener('click', () => {
  document.getElementById('setting-gui').style.display = 'none';
  document.getElementById('blur-target').classList.remove('blur');
});





