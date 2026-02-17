<footer class="container-fluid pt-5 pb-1 mt-5 bg-black">
    <div class="container text-center text-md-start">
        <div class="row">
            <div class="col-12">
                <h5 class="mb-3 fw-bold">Contact Us!</h5>

                <ul
                    class="list-unstyled d-flex flex-column flex-md-row justify-content-md-between align-items-md-center flex-wrap mb-0">
                    <li class="mb-3 mb-md-0">
                        <a class="box-shadow" href="tel:+31687296715">
                            <i class="bi bi-telephone-fill" aria-hidden="true"></i> 0687296715 <br>
                            <small>Mo to Fr 09:00 - 17:00</small>
                        </a>
                    </li>
                    </a>

                    <li class="mb-3 mb-md-0">
                        <a class="box-shadow" href="mailto:d.radcliffe.hp@gmail.com">
                            <i class="bi bi-envelope-fill" aria-hidden="true"></i> Send an e-mail <br>
                            <small>Response in 1 hour</small>
                        </a>
                    </li>
                    </a>

                    <li class="mb-3 mb-md-0">
                        <a class="box-shadow" href="https://wa.me/31687296715" target="_blank">
                            <i class="bi bi-whatsapp" aria-hidden="true"></i> Via WhatsApp <br>
                            <small>Response in 1 hour</small>
                        </a>
                    </li>
                    </a>

                    <li class="mb-3 mb-md-0">
                        <a class="box-shadow" href="https://www.facebook.com/" target="_blank">
                            <i class="bi bi-facebook" aria-hidden="true"></i> Via Facebook <br>
                            <small>Response in 1 hour</small>
                        </a>
                    </li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
    <hr>
    <div class="opening-hours container">
        <div class="timings-review">
            <div class="timings">
                <h2>Opening Hours</h2>
                <ul>
                    <li><span>Monday</span><span>09:00 - 20:00</span></li>
                    <li><span>Tuesday</span><span>09:00 - 20:00</span></li>
                    <li><span>Wednesday</span><span>09:00 - 20:00</span></li>
                    <li><span>Thursday</span><span>09:00 - 20:00</span></li>
                    <li><span>Friday</span><span>09:00 - 20:00</span></li>
                    <li><span>Saturday</span><span>09:00 - 18:00</span></li>
                    <li><span>Sunday</span><span>09:00 - 18:00</span></li>
                </ul>
            </div>
            <div class="form px-4 py-3">
                <form method="post" action="/review" class="" id="review-form">
                    <h2 class="mb-4 text-center">Write us a review</h2>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
                            aria-required="true" required>
                        <span id="name-feedback" style="color: red; font-size: 14px;"></span>
                    </div>

                    <div class="mb-3">
                        <label for="review" class="form-label">Review:<span style="color:red;">*</span></label>
                        <textarea class="form-control" id="review" name="review" rows="4" placeholder="Your review..."
                            aria-required="true" required></textarea>
                        <span id="review-feedback" style="color: red; font-size: 14px;"></span>
                    </div>

                    <button type="submit" class="btn form-btn">Send Review</button>
                </form>
                <div class="alert alert-success" id="review-submitted" role="status"></div>
            </div>
        </div>
    </div>

    <hr>

    <div class="container">
        <ul class="privacy d-flex justify-content-between list-unstyled">
            <li>
                <a id="privacy" href="/privacy">Privacy Statement</a>
            </li>
            <li>
                <p>&copy; 2025-2026 - DriveUp - All Rights Reserved</p>
            </li>
        </ul>
    </div>

</footer>

<?php if(!isset($_COOKIE['cookiesAccepted'])){ ?>
<div id="cookieBanner" class="alert alert-info fixed-bottom text-center m-0 p-3" role="alert">
    This site uses cookies to persist user data across the website.
    <button id="acceptCookies" class="btn btn-primary btn-sm ms-2">Accept</button>
</div>
<?php } ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const acceptBtn = document.getElementById('acceptCookies');
    if (!acceptBtn) {
        return;
    }

    acceptBtn.addEventListener('click', function() {
        document.getElementById('cookieBanner').style.display = 'none';

        fetch('/setcookie', {
                method: 'POST'
            })
            .then(res => res.json())
            .catch(err => console.error('Error saving consent', err));
    });
});

// NProgress.configure({
//     showSpinner: false,
// });

document.getElementById("privacy").addEventListener("click", function(e) {
    e.preventDefault(); // prevent default button behavior

    NProgress.start(); // show top loading bar

    // Navigate to the page normally
    window.location.href = '/privacy';
});

window.addEventListener('load', () => {
    NProgress.done();
});
</script>


<a href="https://wa.me/31687296715" target="_blank" aria-label="Chat with us on WhatsApp">
    <div class="whatsapp-button"><i class="bi bi-whatsapp fs-2" aria-hidden="true"></i></div>
</a>
<script src="/assets/js/review.js"></script>