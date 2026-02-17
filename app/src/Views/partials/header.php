<?php

use App\Models\Enums\StudentType;

    $currentPage = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<div class="banner position-relative">
    <?php if($currentPage != '/privacy'){ ?>
    <img src="/assets/images/hero.png" alt="A student driving a car">
    <div class="row position-absolute" style="top:30%;left:10%;">
        <div class="column p-4 rounded bg-dark bg-opacity-75">
            <h1>Learn to drive with confidence</h1>
            <ul class="banner-list">
                <li>
                    <i class="fa-solid fa-arrow-right me-3 color" aria-hidden="true"></i>No waiting times, start now
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right me-3 color" aria-hidden="true"></i>Pay in installments
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right me-3 color" aria-hidden="true"></i>Urgent driving license
                </li>
            </ul>
            <a class="text-color btn cta-button" href="/triallessonform">Book Trial Lesson</a>
        </div>
    </div>
    <?php } ?>

    <header>
        <nav
            class="navbar navbar-dark navbar-expand-lg bg-dark <?= ($currentPage != '/privacy') ? 'position-absolute top-0 start-50 translate-middle-x mt-4' : 'container' ?>">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="/">DriveUp</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item me-3">
                            <a class="nav-link text-color <?= ($currentPage == '/') ? 'active' : '' ?>"
                                <?= ($currentPage == '/') ? 'aria-current="page"' : '' ?> href="/">Home</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link text-color <?= ($currentPage == '/drivinglessons') ? 'active' : '' ?>"
                                <?= ($currentPage == '/') ? 'aria-current="page"' : '' ?> href="/drivinglessons">Driving
                                Lessons</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link text-color <?= ($currentPage == '/prices') ? 'active' : '' ?>"
                                <?= ($currentPage == '/') ? 'aria-current="page"' : '' ?> href="/prices">Prices</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item me-3">
                            <a class="btn cta-button text-color" href="/triallessonform">Book Trial Lesson</a>
                        </li>
                        <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'){ ?>
                        <li class="nav-item me-3">
                            <a class="btn btn-info" href="/adminportal">Portal</a>
                        </li>
                        <?php } else if(isset($_SESSION['user']) && $student && $student->type == StudentType::REGULAR->value){ ?>
                        <li class="nav-item me-3">
                            <a class="btn btn-info" href="/studentportal">Portal</a>
                        </li>
                        <?php } ?>
                        <?php if(isset($_SESSION['user'])){ ?>
                        <li class="nav-item me-3">
                            <form method="post" action="/logout">
                                <button class="btn btn-primary">Logout</button>
                            </form>
                        </li>
                        <?php } else{ ?>
                        <li class="nav-item me-3">
                            <a class="text-color btn btn-primary" href="/login">Login</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</div>