<!-- begin:: breadcumb -->
<div class="slider-area ">
    <div class="single-slider hero-overly slider-height2 d-flex align-items-center" data-background="<?= assets_url() ?>page/img/hero/about.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap">
                        <h2><?= $title ?></h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>kontak"><?= $title ?></a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: breadcumb -->

<!-- begin:: body -->
<section class="mt-5 mb-5">
    <div class="container">
        <div class="row">
            <?php foreach ($data->result() as $key => $value) { ?>
                <div class="col-lg-6">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $value->nama ?></h5>
                            <div class="media contact-info">
                                <span class="contact-info__icon"><i class="ti-home"></i></span>
                                <div class="media-body">
                                    <h3><?= $value->alamat ?></h3>
                                    <p>Indonesia</p>
                                </div>
                            </div>
                            <div class="media contact-info">
                                <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                                <div class="media-body">
                                    <h3><?= $value->alamat ?></h3>
                                    <p>Senin - Jumat 9am to 6pm</p>
                                </div>
                            </div>
                            <div class="media contact-info">
                                <span class="contact-info__icon"><i class="ti-email"></i></span>
                                <div class="media-body">
                                    <h3><?= $value->email ?></h3>
                                    <p>Send us your query anytime!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- end:: body -->

<script>
    function initMap() {
        var uluru = {
            lat: -25.363,
            lng: 131.044
        };
        var grayStyles = [{
                featureType: "all",
                stylers: [{
                        saturation: -90
                    },
                    {
                        lightness: 50
                    }
                ]
            },
            {
                elementType: 'labels.text.fill',
                stylers: [{
                    color: '#ccdee9'
                }]
            }
        ];
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: -31.197,
                lng: 150.744
            },
            zoom: 9,
            styles: grayStyles,
            scrollwheel: false
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&amp;callback=initMap"></script>