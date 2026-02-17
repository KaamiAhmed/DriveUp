<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Font Awesome Free CDN -->
    <script src="https://kit.fontawesome.com/da26891097.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/triallessonform.css?v=1.0">
</head>

<body>
    <main class="main">
        <?php if(isset($_SESSION['invalid_credentials'])){ ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= htmlspecialchars($_SESSION['invalid_credentials']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['invalid_credentials']); ?>
        <?php } ?>

        <?php if(isset($_SESSION['account_created'])){ ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= htmlspecialchars($_SESSION['account_created']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['account_created']); ?>
        <?php } ?>

        <?php if(isset($_SESSION['success'])){ ?>
        <div class="alert alert-success alert-dismissible fade show"><?= htmlspecialchars($_SESSION['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
        <?php } ?>

        <?php if(isset($_SESSION['pre-condition'])){ ?>
        <div class="alert alert-info alert-dismissible fade show"><?= htmlspecialchars($_SESSION['pre-condition']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['pre-condition']); ?>
        <?php } ?>


        <div class="form-container">
            <h2 class="text-center">Login</h2>
            <form method="POST" action="/login" class="mb-4">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:<span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="username" name="username" aria-required="true" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:<span style="color:red;">*</span></label>
                    <div class="password-block">
                        <input type="password" class="form-control" id="password" name="password" aria-required="true"
                            required>
                        <div id="eye" style="cursor: pointer;" aria-label="Show password"><i tabindex="0"
                                class="bi bi-eye-fill" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    Login
                </button>

            </form>

            <div class="d-flex flex-row justify-content-between">
                <div>
                    <p class="d-inline">Don't have an account?</p><a href="/createaccount">Create one</a>
                </div>
                <div>
                    <a href="/forgotpassword">Forgot Password?</a>
                </div>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const password = document.getElementById("password");
    const eye = document.getElementById("eye");
    const eyeIcon = document.querySelector("i");

    function showhidepass() {
        if (password.type === "password") {
            password.type = "text";
            eyeIcon.className = "bi bi-eye-slash-fill";
            eye.setAttribute("aria-label", "Hide password");
        } else {
            password.type = "password";
            eyeIcon.className = "bi bi-eye-fill";
            eye.setAttribute("aria-label", "Show password");
        }
    }

    eye.addEventListener("click", showhidepass);
    eye.addEventListener("keydown", (e) => {
        if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            showhidepass();
        }
    });
    </script>
</body>

</html>