<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driving Lessons</title>
    <!-- Font Awesome Free CDN -->
    <script src="https://kit.fontawesome.com/da26891097.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/home.css?v=1.0">
    <link rel="stylesheet" href="/assets/css/header.css?v=1.0">
    <link rel="stylesheet" href="/assets/css/footer.css?v=1.0">
</head>

<body>
    <main class="main">
        <?php require __DIR__ . "/partials/header.php" ?>

        <section class="intro container rounded mt-5 p-5 bg-light">
            <div class="intro-text d-flex flex-column justify-content-center">
                <h1>Get Your Driver’s License Quickly and Affordably with DriveUp</h1>
                <p>Looking to obtain your driver’s license without delay and at a great price? At DriveUp, we tailor
                    your
                    driving lessons to your pace and needs, offering maximum comfort in Audi training car that
                    meets all CBR standards.

                    With pre-booked CBR practical exams, there are no waiting lists—you can start your lessons right
                    away!

                    Our focus on high-quality instruction and personal attention ensures excellent results, a high pass
                    rate,
                    and many happy new drivers.
                </p>
                <p><b>We offer driving lessons of 60-minutes both with manual and automatic cars. At DriveUp, it is also
                        possible to get Urgent driving licence within a month.</b>
                </p>
            </div>
            <div class="d-flex justify-content-center align-content-center">
                <img src="/assets/images/section-2.png" class="img-fluid rounded"
                    alt="driving instructor with a student">
            </div>
        </section>

        <section data-aos="fade-up" class="overlap-section container mt-5 p-5 d-flex">
            <div class="image-container shadow">
                <img src="/assets/images/image1.jpeg" alt="a car" class="img-fluid rounded">
            </div>

            <div class="text-box rounded text-white bg-black p-5 shadow">
                <h3>Can't wait to start?</h3>
                <p>
                    To be able to plan your practical exam, you need to authorize your school.
                    You can authorize your driving school via cbr website. You need DigId to login.<br>
                    Authroize your school via <a
                        href="https://www.cbr.nl/nl/rijbewijs-halen/auto/praktijkexamen-auto/je-rijschool-machtigen"
                        target="_blank">cbr.nl</a>
                </p>
            </div>
        </section>

        <section data-aos="fade-up" class="overlap-section container mt-5 p-5 d-flex">
            <div class="image-container shadow">
                <img src="/assets/images/image2.jpg" alt="another car" class="img-fluid rounded">
            </div>

            <div class="text-box rounded text-white bg-black p-5 shadow">
                <h3>Health Statement</h3>
                <p>
                    Before your practical exam, you need to get a mandatory health statement from cbr. The CBR assesses
                    whether
                    you are healthy enough to drive. To do this, you must fill in a health questionnaire called the
                    Health
                    Declaration, which you pay for yourself.

                    You complete the Health Declaration when you are going to take your driving exam and, in some cases,
                    when
                    renewing your driving licence. This helps ensure that you are safe to drive on the road.
                    It costs € 45,25.<br>
                    Fill the questionnaire and get the <a
                        href="https://www.cbr.nl/nl/rijden-en-uw-gezondheid/nl/gezondheidsverklaring"
                        target="_blank">health
                        declaration</a> now.
                </p>
            </div>
        </section>

        <section data-aos="fade-up" class="reviews container-fluid mt-5 bg-light">
            <?php 
                use App\ViewModels\ReviewsViewModel;
                /** @var ReviewsViewModel $vm */
                require __DIR__ . '/../Views/partials/reviews.php'; 
            ?>
        </section>

        <?php
            use App\ViewModels\FaqsViewModel;

            /** @var FaqsViewModel $vm2 */
        ?>
        <section data-aos="fade-up" class="faq container mt-5">
            <h1 class="text-center">Frequently Asked Questions</h1>
            <div class="accordion" id="accordionFaq">
                <?php foreach($vm2->faqs as $faq){ ?>
                <?php require __DIR__ . "/partials/faq.php" ?>
                <?php } ?>
            </div>
        </section>

        <?php require __DIR__ . "/partials/footer.php" ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 900,
        once: true
    });
    </script>
</body>

</html>