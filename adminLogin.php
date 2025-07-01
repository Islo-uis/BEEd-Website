<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css" />
      <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.all.min.js
"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <style>
        #game-container {
            width: 100vw;
            height: 100vh;
            background: url('Assets/bg/main.png') center/cover no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #admin-gui {
            width: 700px;
            height: 700px;
            background: url('Assets/icons/receipt.png') no-repeat center top;
            background-size: 100% auto;
            padding: 160px 40px 40px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 20px;
            box-shadow: none;
        }

        #adminn {
            width: 500px;
        }

        .admin-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .admin-field {
            width: 100%;
            margin-bottom: 20px;
        }

        .admin-field label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .admin-field input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box;
        }

        .button-group {
            margin-top: 20px;
            display: flex;
            gap: 20px;
        }

        #save-button,
        #back-button {
            padding: 12px 24px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            width: 120px;
            color: white;
        }

        #save-button {
            background-color: #4CAF50;
        }

        #save-button:hover {
            background-color: #388e3c;
        }

        #back-button {
            background-color: #f44336;
        }

        #back-button:hover {
            background-color: #d32f2f;
        }
    </style>
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
                    url: "ajax.php?action=getCreds",
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
                                    window.location.href = "admin.html";
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