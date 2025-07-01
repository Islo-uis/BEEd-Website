<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Palengke Game</title>
  <link rel="stylesheet" href="style.css" />
  <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.all.min.js
"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
  <div id="game-container">

    <!-- All content that gets blurred -->
    <div id="blur-target">
      <div id="overlay">
        <!-- Icons -->
        <img id="settings-icon" src="Assets/icons/setting.png" alt="Settings">
        <img id="sound-toggle" src="Assets/icons/SOUND.png" alt="Sound Toggle">

        <!-- Title and buttons -->
        <h1 id="title">Palengke Adventure</h1>
        <img id="start-button" class="button-image" src="Assets/icons/START.png" alt="Start Game">

        <div id="difficulty-options">
          <img id="easy-button" class="button-image" src="Assets/icons/EASY.png" alt="Easy">
          <img id="medium-button" class="button-image" src="Assets/icons/MEDIUM.png" alt="Medium">
          <img id="hard-button" class="button-image" src="Assets/icons/DIFFICULT.png" alt="Hard">
        </div>
      </div>
    </div>

    <!-- Settings Overlay -->
    <div id="setting-gui" style="display: none;">
      <button id="admin-login-button">Login as Admin</button>
      <button id="back-button">Back</button>
    </div>


  </div>



  <!-- Level UI screen (initially hidden) -->
  <div id="level-overlay" style="display: none;">
    <h1 id="level-title" class="level-title">Level 1</h1>

    <!-- Dialogue Box + Characters -->
    <div id="dialogue">
      <img id="dialogue-box" src="Assets/icons/dialogue_box.png" alt="Dialogue Box">
      <img id="dong" src="Assets/characters/dong.png" alt="Dong">
      <img id="indae" src="Assets/characters/indae.png" alt="Indae">
    </div>
  </div>
  </div>

  <script src="game.js"></script>
</body>

</html>