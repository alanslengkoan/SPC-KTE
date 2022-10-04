<!doctype html>
<html lang="en">

<head>
    <title>Selamat Datang Sistem Informasi Supply Chain | <?= $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Sistem Informasi Supply Chain" />
    <meta name="keywords" content="Sistem Informasi Supply Chain" />
    <meta name="author" content="Sistem Informasi Supply Chain" />

    <link rel="shortcut icon" type="image/x-icon" href="<?= assets_url() ?>page/img/favicon.ico">

    <!-- begin:: css global -->
    <link rel="stylesheet" href="<?= assets_url() ?>page/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= assets_url() ?>page/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= assets_url() ?>page/css/slicknav.css">
    <link rel="stylesheet" href="<?= assets_url() ?>page/css/flaticon.css">
    <link rel="stylesheet" href="<?= assets_url() ?>page/css/animate.min.css">
    <link rel="stylesheet" href="<?= assets_url() ?>page/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= assets_url() ?>admin/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= assets_url() ?>page/css/themify-icons.css">
    <link rel="stylesheet" href="<?= assets_url() ?>page/css/slick.css">
    <link rel="stylesheet" href="<?= assets_url() ?>page/css/style.css">
    <!-- end:: css global -->

    <!-- begin:: css local -->
    <?php empty($css) ? '' : $this->load->view($css); ?>
    <!-- end:: css local -->

    <style>
        .parsley-errors-list {
            color: red;
            list-style-type: none;
            padding: 0;
        }
    </style>

    <script src="<?= assets_url() ?>page/js/vendor/jquery-1.12.4.min.js"></script>
</head>

<body>
    <!-- begin:: preloader -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="<?= assets_url() ?>page/img/logo/loder.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- end:: preloader -->

    <!-- begin:: header -->
    <header>
        <div class="header-area">
            <div class="main-header ">
                <div class="header-top d-none d-lg-block">
                    <div class="container">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>
                                        <li>Phone: +62 852 4266 8993</li>
                                        <li>Email: resco.riskiabadi@gmail.com</li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-social">
                                        <li><a href="https://www.instagram.com/rescoriskiabadi/"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="https://www.facebook.com/rescoriskiabadi"><i class="fa fa-facebook-f"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom  header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="<?= base_url() ?>"><img src="<?= assets_url() ?>page/img/logo/logo.png" alt="logo" width="250"></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper  d-flex align-items-center justify-content-end">
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">
                                                <li>
                                                    <a href="<?= base_url() ?>">Beranda</a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>tentang">Tentang</a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>kontak">Kontak</a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url() ?>distributor">Distribusi</a>
                                                </li>
                                                <li>
                                                    <a href="<?= login_url() ?>">Login</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end:: header -->

    <!-- begin:: content -->
    <main>
        <?php $this->load->view($content); ?>
    </main>
    <!-- end:: content -->

    <!-- begin:: footer -->
    <footer>
        <div class="footer-area footer-bg">
            <div class="container">
                <div class="footer-top footer-padding">
                    <div class="row d-flex justify-content-between">
                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <!-- logo -->
                                <div class="footer-logo">
                                    <a href="index.html"><img src="<?= assets_url() ?>page/img/logo/logo.png" alt="" width="200"></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p class="info1">
                                            Jl. ABDUL KUDDUS PERUM. BAROMBONG PERMAI Bl.OK A/5
                                        </p>
                                    </div>
                                </div>
                                <div class="footer-social ">
                                    <a href="https://www.facebook.com/sai4ull"><i class="fa fa-facebook-f"></i></a>
                                    <a href=""><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-globe"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-12">
                            <div class="footer-copy-right text-center">
                                <p>
                                    Copyright &copy;
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    <a href="https://alanlengkoan.com" target="_blank">AL</a> - Sistem Informasi Supply Chain.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end:: footer -->

    <!-- begin:: scrool -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fa fa-arrow-up"></i></a>
    </div>
    <!-- begin:: scrool -->

    <!-- begin:: js global -->
    <script type="text/javascript" src="<?= assets_url() ?>page/js/vendor/modernizr-3.5.0.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/popper.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/jquery.slicknav.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/slick.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/wow.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/animated.headline.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/jquery.magnific-popup.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/jquery.sticky.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/contact.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/mail-script.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/jquery.ajaxchimp.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/plugins.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/main.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/sweetalert/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <!-- end:: js global -->

    <script>
        // untuk angka
        function justAngka(e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190, 77]) !== -1 ||
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        };
        // untuk format harga
        function autoSeparator(Num) {
            Num += '';
            Num = Num.replace('.', '');
            Num = Num.replace('.', '');
            Num = Num.replace('.', '');
            Num = Num.replace('.', '');
            Num = Num.replace('.', '');
            Num = Num.replace('.', '');
            x = Num.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1))
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            return x1 + x2;
        };
    </script>

    <!-- begin:: js local -->
    <?php empty($js) ? '' : $this->load->view($js); ?>
    <!-- end:: js local -->
</body>

</html>