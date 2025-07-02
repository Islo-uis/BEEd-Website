<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
      <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.all.min.js
"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="admin.css" />
        <link rel="stylesheet" href="../game/style.css" />
</head>

<body>
    <div id="game-container">
        <div id="admin-gui">
            <div id="adminn">
                <h2 class="admin-title">Admin Login</h2>

                <div class="admin-field">
                    <label for="username">Username</label>
                    <input type="text" id="username" placeholder="Enter username" />
                </div>

                <div class="admin-field">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Enter password" />
                </div>

                <div class="button-group">
                    <button id="save-button">Login</button>
                    <button id="back-button">Back</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('back-button').addEventListener('click', () => {
            window.location.href = 'index.php';
        });

        document.getElementById('save-button').addEventListener('click', () => {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!username || !password) {
                alert('Please enter both username and password.');
                return;
            } else {
                $.ajax({
                    type: "POST",
                    url: "../game/ajax.php?action=getCreds",
                    data: {
                        username: username,
                        password: password
                    },
                    dataType: 'json',
                    success: function(response) {
                        var status = response.exists;
                        if (status == 0) {
                            Swal.fire({
                                icon: "error",
                                title: "Wrong Credentials!",
                                text: "The Username or Password you've entered is incorrect!"
                            });
                        } else {
                            Swal.fire("Login Success!", "", "success").then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "admin/admin.php";
                                }
                            });
                            return false;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("An error occurred: " + error);
                        console.log("Response text: " + xhr.responseText);
                    }
                });
            }
            // You can add login logic or redirection here
        });
    </script>
</body>

</html>