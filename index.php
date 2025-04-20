<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    .splash-container {
            width: 100%;
            max-width: 400px; /* Set max width to prevent form stretching */
            padding: 20px;
        }

        .logo-img {
            max-width: 150px; /* Adjust logo size */
            height: auto;
            display: block;
            margin: 0 auto 10px; /* Center logo and add space below */
        }

        .card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .input-group-text {
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .logo-img {
                max-width: 120px; /* Adjust for mobile */
            }
        }
    
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="../index.html"><img class="logo-img" src="../assets/images/logo.jpg" alt="logo"></a><span class="splash-description"></span></div>
            <div id="error-message" class="alert alert-danger d-none"></div>
            <div class="card-body">
                <form id="loginForm">
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="username" type="text" placeholder="Username" autocomplete="off">
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 20px;">
                        <div class="input-group">
                            <input class="form-control form-control-lg" id="password" type="password" placeholder="Password">
                            <div class="input-group-append">
                                <span class="input-group-text" id="togglePassword">
                                    <i class="fa fa-eye-slash"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                
                   
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
     <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
    
      // Toastify function
         function showToast(message, type) {
            Toastify({
                text: message,
                style: {
                    background: type === 'success' 
                        ? "linear-gradient(to right, #00b09b, #96c93d)" 
                        : "linear-gradient(to right, #ff5f6d, #ffc371)"
                },
                duration: 3000,
                close: true
            }).showToast();
        }

        document.querySelector("form").addEventListener("submit", async (e) => {
    e.preventDefault();

    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    let response = await fetch("https://admin.fareastcafeshop.com/api/login.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        credentials: "include", // Keeps session data
        body: JSON.stringify({ name: username, password: password })
    });

    let data = await response.json();
    console.log(data);

    if (data.success) {
        showToast("Login successful! Redirecting...", "success");
        localStorage.setItem("user_id", data.id);
        setTimeout(() => {
            window.location.href = data.redirect;
        }, 1500);
    } else {
        showToast(data.error, "error");
    }
});



document.getElementById("togglePassword").addEventListener("click", function () {
    let passwordField = document.getElementById("password");
    let icon = this.querySelector("i");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        passwordField.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
});


    </script>
        
</body>
 
</html>