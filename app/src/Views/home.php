<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Font Awesome Free CDN -->
    <script src="https://kit.fontawesome.com/da26891097.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">
    <link rel="stylesheet" href="/assets/css/header.css?v=1.0">
    <link rel="stylesheet" href="/assets/css/footer.css?v=1.0">
    <link rel="stylesheet" href="/assets/css/home.css?v=1.0">
    <link rel="stylesheet" href="/assets/css/packages.css?v=1.0">
</head>

<body>
    <main class="main">
        <?php require __DIR__ . "/partials/header.php" ?>

        <section class="section-1 container-fluid text-center">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-3 mb-3 mt-3">
                    <div class="card bg-transparent card-style">
                        <div class="card-body">
                            <h1 class="card-title">🤩</h1>
                            <p class="card-text"><span class="counter" data-target="4.7">0</span>/5</p>
                            <p><span class="counter" data-target="500">0</span>+ Reviews</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3 mt-3">
                    <div class="card bg-transparent card-style">
                        <div class="card-body">
                            <h1 class="card-title">⭐</h1>
                            <p class="card-text"><span class="counter" data-target="70">0</span>%</p>
                            <p>Passing Percentage</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3 mt-3">
                    <div class="card bg-transparent card-style">
                        <div class="card-body">
                            <h1 class="card-title">🥳</h1>
                            <p class="card-text"><span class="counter" data-target="500">0</span>+</p>
                            <p>Passed Students</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section data-aos="fade-up" class="intro container rounded mt-5 p-5 bg-light">
            <div class="intro-text d-flex flex-column justify-content-center">
                <h1>Car driving lessons in Hoofddorp and surrounding areas</h1>
                <p>Learning to drive can be an exciting journey—or for some, a task
                    that needs to be completed
                    efficiently. Whatever your situation, having an instructor who understands your needs makes all the
                    difference. I focus not only on the rules and practical skills but also on how you learn and the
                    challenges you may face along the way.

                    We’ll start each lesson from a location that works for you, and from there, we work purposefully.
                    <b>Each 60-minute session</b> is structured with a clear goal, so you’re not just driving
                    aimlessly—you’re
                    making real progress. If something feels off or confusing, we’ll address it together and adjust your
                    learning path.
                </p>
            </div>
            <div class="d-flex justify-content-center align-content-center">
                <img src="/assets/images/driving-instructor-girl.jpg" class="img-fluid rounded"
                    style="object-fit: cover;" alt="driving instructor with a student">
            </div>
        </section>

        <?php
            use App\ViewModels\PackagesViewModel;

            /** @var PackagesViewModel $vm2 */
        ?>
        <section data-aos="fade-up" class="packages container mt-5 p-3">
            <div class="d-flex justify-content-end mb-4">
                <a href="/prices" class="btn btn-outline-primary">
                    See all packages →
                </a>
            </div>

            <div class="row g-4">
                <?php
                require __DIR__ . "/partials/packages.php";
                ?>
            </div>
        </section>

        <section data-aos="fade-up" class="successful-students text-center container mt-5 p-5">
            <h1 class="text-center">Successful Students</h1>
            <div class="row g-2">
                <div class="col-12 col-sm-6 col-lg-3">
                    <img src="/assets/images/student1.webp" alt="a student" class="rounded" width="280" height="280">
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <img src="/assets/images/student2.webp" alt="a student" class="rounded" width="280" height="280">
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <img src="/assets/images/student3.webp" alt="a student" class="rounded" width="280" height="280">
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <img src="/assets/images/student4.webp" alt="a student" class="rounded" width="280" height="280">
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <img src="/assets/images/student5.webp" alt="a student" class="rounded" width="280" height="280">
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <img src="/assets/images/student6.webp" alt="a student" class="rounded" width="280" height="280">
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <img src="/assets/images/student7.webp" alt="a student" class="rounded" width="280" height="280">
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <img src="/assets/images/student8.webp" alt="a student" class="rounded" width="280" height="280">
                </div>
            </div>
        </section>
        <section data-aos="fade-up" class="reviews container-fluid mt-5 bg-light">
            <?php require __DIR__ . '/../Views/partials/reviews.php'; ?>
        </section>

        <?php
            use App\ViewModels\FaqsViewModel;

            /** @var FaqsViewModel $vm3 */
        ?>
        <section data-aos="fade-up" class="faq container mt-5">
            <h1 class="text-center">Frequently Asked Questions</h1>
            <div class="accordion" id="accordionFaq">
                <?php foreach($vm3->faqs as $faq){ ?>
                <?php require __DIR__ . "/partials/faq.php" ?>
                <?php } ?>
            </div>
        </section>

        <?php require __DIR__ . "/partials/footer.php" ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
    <script>
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', () => {
            document.querySelector('.nav-link.active').classList.remove('active');
            link.classList.add('active');
        });
    });

    const counters = document.querySelectorAll('.counter');

    const startCounter = (counter) => {
        const target = +counter.getAttribute('data-target');
        let current = 0;
        const increment = Math.ceil(target / 100); // 100 steps for smooth animation

        const interval = setInterval(() => {
            current += increment;
            if (current >= target) {
                counter.textContent = target;
                clearInterval(interval);
            } else {
                counter.textContent = current;
            }
        }, 20); // update every 10ms
    };

    // Intersection Observer to trigger counting when visible
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                startCounter(entry.target);
                observer.unobserve(entry.target); // run only once
            }
        });
    }, {
        threshold: 0.5
    }); // trigger when 50% visible

    counters.forEach(counter => observer.observe(counter));

    AOS.init({
        duration: 900,
        once: true
    });
    </script>
</body>

</html>