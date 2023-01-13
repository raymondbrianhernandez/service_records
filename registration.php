<!DOCTYPE html>
<html lang="en">
<!-- 
________________________________________________________
__|____|____|______|___|____|____|_____|___|_______|____
___|__|______|____|___|___/\__|____|__|___|__/\__|___|__
____|__|___|__|__\  |____|  |____|__|___|____)/_|___|___
_\__  \__\    _ \_| __ \_|  |  \_|  |_/  _ \____/  ___/_
__/ __ \__|  |_\/_| \_\ \|      \|  |\   __/____\__  \__
_(____  /_|__|____|___  /|___|  /|__|_\___  /|_/____  \_
___|__\/___|__________\/______\/__|_______\/_____|__\/__
_____|______|______|_______|___|___|___|___________|____
________________________________________________________
______|_____|___|____|_____|___|_|_____|__|____|___|____
____|___|__|___|______|______|_____|__|____|__|___|_____
__|___|_____|______|__|___|___|_|__|___|_______|________
___/  ___/_/  _ \_\    _ \\  \/ /|  |_/ ___\__/  _ \____
___\__  \_\   __/__|  |_\/_\   /_|  |\  \____\   __/____
__/____  \_\___  /_|__|___|_\_/__|__|_\___  /_\___  /___
____|__\/______\/___|_______|_____|_______\/______\/____
______|_____|________|________|____|____|______|________
________________________________________________________
___|______|___|___|__|_______|_____|______|___|_____|___
____|____|___|___|____|___|_________|____|___|____|___|_
__|__|_____|_______|_______|______|__|______|  /_|___|__
\    _ \_/  _ \__/ ___\__/ __ \_\    _ \_/ __ |__/  ___/
_|  |_\/\   __/_\  \____(  \_\ )_|  |_\// /_/ |__\__  \_
_|__|____\___  /_\___  /_\____/__|__|___\____ |_/____  \
__|__________\/______\/___|_______|__________\/___|__\/_
___|______|________|________|______|______|_________|___ 
-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Registration - Service Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" media="all" href="./stylesheets/styles.min.css?v=12"/>
    <link rel="stylesheet" media="all" href="./stylesheets/animatedbackground.css"/>
</head>

<body>
    <!-- These divs are needed for animated backgroound -->
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <!-- Above divs are needed for animated backgroound -->
    
    <header>
        <!-- Start: Navbar Right Links (Dark) -->
        <nav class="navbar navbar-dark navbar-expand-md bg-dark py-3">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M384 0H96C60.65 0 32 28.65 32 64v384c0 35.35 28.65 64 64 64h288c35.35 0 64-28.65 64-64V64C448 28.65 419.3 0 384 0zM240 128c35.35 0 64 28.65 64 64s-28.65 64-64 64c-35.34 0-64-28.65-64-64S204.7 128 240 128zM336 384h-192C135.2 384 128 376.8 128 368C128 323.8 163.8 288 208 288h64c44.18 0 80 35.82 80 80C352 376.8 344.8 384 336 384zM496 64H480v96h16C504.8 160 512 152.8 512 144v-64C512 71.16 504.8 64 496 64zM496 192H480v96h16C504.8 288 512 280.8 512 272v-64C512 199.2 504.8 192 496 192zM496 320H480v96h16c8.836 0 16-7.164 16-16v-64C512 327.2 504.8 320 496 320z"></path>
                        </svg>
                    </span>
                    <span>Service Records</span>
                </a>
                    <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5">
                        <span class="visually-hidden">Toggle navigation</span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navcol-5">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" href="registration.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link active" href="logout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End: Navbar Right Links (Dark) -->
        
        <main>
            <!-- Start: Login Form Basic -->
            <section class="position-relative py-4 py-xl-5">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-md-8 col-xl-6 text-center mx-auto">
                            <h2>Service Records</h2>
                            <p class="w-lg-50">Go, therefore, and make disciples of people of all the nations (<i>Matthew 28:19a, NWT</i>)</p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center" id="login-screen">
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-5">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-house-door">
                                            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"></path>
                                        </svg>
                                    </div>

                                    <form name="form" class="text-center" action="../private/newaccount.php" onsubmit = "return validation()" method="POST">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="name" required>
                                            <b><label for="name"> Full name: </label></b>
                                        </div>

                                        <div class="mb-3">
                                            <select name = "goal" class="form-control" style="text-align:center">
                                                <option value = "Regular Pioneer (70 hours)"> Regular Pioneer (70 hours) </option>
                                                <option value = "Auxiliary Pioneer (50 hours)"> Auxiliary Pioneer (50 hours) </option>
                                                <option value = "Auxiliary Pioneer (30 hours)"> Auxiliary Pioneer (30 hours) </option>
                                                <option value = "Future Pioneer"> Future Pioneer </option>
                                                <option value = "Special Pioneer (90 hours)"> Special Pioneer (90 hours) </option>
                                            </select>
                                            <b><label for="goal"> Goal: </label></b>
                                        </div>

                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="user" required>
                                            <b><label for="user"> Username: </label></b>
                                        </div>

                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="email" required>
                                            <b><label for="email"> E-mail: </label></b>
                                        </div>

                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password1" required>
                                            <b><label for="password1"> Create New Password: </label></b>
                                        </div>

                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password2" required>
                                            <b><label for="password2"> Re-type Password: </label></b>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <button class="btn btn-primary d-block w-100" type="submit"> Register </button>
                                        </div>

                                        <p class="text-muted" style="text-align:center; color:white">
                                            Already have an account? <a href='index.php'>Login Here</a>
                                        </p>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </section>
            <!-- End: Login Form Basic -->
        </main>
    </header>
    
    <footer>
        <!-- Start: Footer Basic -->
        <footer class="text-center">
            <div class="container text-muted py-4 py-lg-5">
                <p class="mb-0">
                    &copy; <?php echo date('Y'); ?> Service Records | <a href="https://www.arbhie.com" target="_blank">arbhie.com</a> by Raymond Hernandez
                </p>
            </div>
        </footer>
        <!-- End: Footer Basic -->
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>