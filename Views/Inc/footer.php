 <!-- footer -->
 <footer class="w3l-footer-29-main">
        <div class="footer-29 py-5">
            <div class="container py-sm-4">
                <div class="row footer-top-29">
                    <div class="col-lg-5 col-md-6 footer-list-29 footer-1">
                        <h2 class="mb-4">
                            <a class="footer-logo" href="index.html">
                                Foodi<span>e</span> Blog<i class="fas fa-utensils"></i>
                            </a>
                        </h2>
                        <p>Lorem ipsum viverra feugiat. Pellen tesque libero ut justo, ultrices in ligula. Semper at
                            tempufddfel. Lorem ipsum dolor sit amet Semper at elit team advisors.</p>
                        <div class="main-social-footer-29 mt-md-4 mt-3">
                            <a href="#facebook" class="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#twitter" class="twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#instagram" class="instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#linkedin" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-4 col-md-6 footer-list-29 footer-1 px-xl-5 mt-md-0 mt-5">
                        <h6 class="footer-title-29">Contact Info </h6>
                        <p class="mb-2">Address : Foodie, 10001, 5th Avenue, #06 lane street, NY - 62617.
                        </p>
                        <p class="mb-2">Phone Number : <a href="tel:+1(21) 234 4567">+1(21) 234 4567</a></p>
                        <p class="mb-2">Email : <a href="mailto:info@example.com">info@example.com</a></p>
                        <p>Support : <a href="mailto:info@support.com">info@support.com</a></p>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-6 col-sm-5 col-6 footer-list-29 footer-2 mt-lg-0 mt-5">
                        <ul>
                            <h6 class="footer-title-29">Help</h6>
                            <li><a href="#support">Support</a></li>
                            <li><a href="#privacy">Privacy policy</a></li>
                            <li><a href="#terms">Terms & conditions</a></li>
                            <li><a href="#license">License & uses</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- copyright -->
        <section class="w3l-copyright text-center">
            <div class="container">
                <p class="copy-footer-29">© 2021 Foodie Blog. All rights reserved. Design by <a
                        href="https://w3layouts.com/" target="_blank">
                        W3Layouts</a></p>
            </div>
        </section>
        <!-- //copyright -->
    </footer>
    <!-- //footer -->

    <!-- Js scripts -->
    <!-- move top -->
    <button onclick="topFunction()" id="movetop" title="Go to top">
        <span class="fas fa-level-up-alt" aria-hidden="true"></span>
    </button>
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("movetop").style.display = "block";
            } else {
                document.getElementById("movetop").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- //move top -->

    <!-- common jquery plugin -->
    <script src="Public/assets/js/jquery-3.3.1.min.js"></script>
    <!-- //common jquery plugin -->

    <!-- banner slider -->
    <script src="Public/assets/js/owl.carousel.js"></script>
    <script>
        $(document).ready(function () {
            $('.owl-blog').owlCarousel({
                stagePadding: 200,
                loop: true,
                nav: false,
                responsiveClass: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplaySpeed: 1000,
                autoplayHoverPause: false,
                responsive: {
                    0: {
                        items: 1,
                        stagePadding: 40,
                        nav: false
                    },
                    480: {
                        items: 1,
                        stagePadding: 40,
                        nav: true
                    },
                    667: {
                        items: 2,
                        stagePadding: 50,
                        nav: true
                    },
                    1000: {
                        items: 2,
                        nav: true
                    }
                }
            })
        })
    </script>
    <!-- //banner slider -->

    <!-- magnific popup -->
    <script src="Public/assets/js/jquery.magnific-popup.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.popup-with-zoom-anim').magnificPopup({
                type: 'inline',

                fixedContentPos: false,
                fixedBgPos: true,

                overflowY: 'auto',

                closeBtnInside: true,
                preloader: false,

                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in'
            });

            $('.popup-with-move-anim').magnificPopup({
                type: 'inline',

                fixedContentPos: false,
                fixedBgPos: true,

                overflowY: 'auto',

                closeBtnInside: true,
                preloader: false,

                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-slide-bottom'
            });
        });
    </script>
    <!-- //magnific popup -->

    <!-- theme switch js (light and dark)-->
    <script src="Public/assets/js/theme-change.js"></script>
    <!-- //theme switch js (light and dark)-->

    <!-- MENU-JS -->
    <script>
        $(window).on("scroll", function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 80) {
                $("#site-header").addClass("nav-fixed");
            } else {
                $("#site-header").removeClass("nav-fixed");
            }
        });

        //Main navigation Active Class Add Remove
        $(".navbar-toggler").on("click", function () {
            $("header").toggleClass("active");
        });
        $(document).on("ready", function () {
            if ($(window).width() > 991) {
                $("header").removeClass("active");
            }
            $(window).on("resize", function () {
                if ($(window).width() > 991) {
                    $("header").removeClass("active");
                }
            });
        });
    </script>
    <!-- //MENU-JS -->

    <!-- disable body scroll which navbar is in active -->
    <script>
        $(function () {
            $('.navbar-toggler').click(function () {
                $('body').toggleClass('noscroll');
            })
        });
    </script>
    <!-- //disable body scroll which navbar is in active -->

    <!-- bootstrap -->
    <script src="Public/assets/js/bootstrap.min.js"></script>
    <!-- //bootstrap -->
    <!-- //Js scripts -->
</body>

</html>