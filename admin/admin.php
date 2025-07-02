<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Admin Panel</title>
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="admin.css" />
  <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.all.min.js
"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
  <div id="game-container">
    <div id="admin-gui">
      <h2 class="admin-title">Admin Control</h2>
      <div id="adminn">
        <div style="display: flex; justify-content: space-between; gap: 50px;">
          <div class="admin-field">
            <label for="difficultySelect">Difficulty</label>
            <select id="difficultySelect" class="form-select" style="width: 100%;">
              <option value="">Select Difficulty</option>
              <option value="1">Easy</option>
              <option value="2">Medium</option>
              <option value="3">Hard</option>
            </select>
          </div>
          <div class="admin-field">
            <label for="levelSelect">Level</label>
            <select id="levelSelect">
              <option value="">Select Level</option>
              <!-- … through Level 7 … -->
            </select>
          </div>

        </div>
        <div class="admin-field" style="width: 100%;">
          <label for="question">Question</label>
          <textarea id="question" rows="4" placeholder="Enter your question here…"></textarea>
        </div>
        <div class="admin-field" style="width: 100%; display:flex; gap:5%">
          <div style="width: 70%;">
            <label for="choice1">Choice 1</label>
            <textarea id="choice1" rows="1" placeholder="Enter your question here…"></textarea>
          </div>
          <div style="display: grid; justify-content:center; align-items:center">
            <label for="choice1c">Correct Answer</label>
            <input type="radio" name="correct" id="choice1c" value="1">
          </div>

        </div>
        <div class="admin-field" style="width: 100%; display:flex; gap:5%">
          <div style="width: 70%;">
            <label for="choice2">Choice 2</label>
            <textarea id="choice2" rows="1" placeholder="Enter your question here…"></textarea>
          </div>
          <div style="display: grid; justify-content:center; align-items:center">
            <label for="choice2c">Correct Answer</label>
            <input type="radio" name="correct" id="choice2c" value="2">
          </div>

        </div>
        <div class="admin-field" style="width: 100%; display:flex; gap:5%">
          <div style="width: 70%;">
            <label for="choice3">Choice 3</label>
            <textarea id="choice3" rows="1" placeholder="Enter your question here…"></textarea>
          </div>
          <div style="display: grid; justify-content:center; align-items:center">
            <label for="choice3c">Correct Answer</label>
            <input type="radio" name="correct" id="choice3c" value="3">
          </div>

        </div>
        <div class="admin-field" style="width: 100%; display:flex; gap:5%">
          <div style="width: 70%;">
            <label for="choice4">Choice 4</label>
            <textarea id="choice4" rows="1" placeholder="Enter your question here…"></textarea>
          </div>
          <div style="display: grid; justify-content:center; align-items:center">
            <label for="choice4c">Correct Answer</label>
            <input type="radio" name="correct" id="choice4c" value="4">
          </div>

        </div>
        <div class="button-group">
          <button id="save-button">Save</button>
          <button id="back-button">Logout</button>
        </div>
      </div>

    </div>

    <script>
      // ensure this isn’t still alerting!
      document.getElementById('back-button')
        .addEventListener('click', () => window.location.href = '../index.php');
    </script>
    <script src="admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>