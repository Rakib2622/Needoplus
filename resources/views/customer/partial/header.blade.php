<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Needo Plus</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/img/fav.png') }}" rel="icon" type="image/png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">

                    <a class="text-dark" href="{{ route('terms') }}">
                        FAQs
                    </a>

                    <span class="text-muted px-2">|</span>

                    <a class="text-dark" href="{{ route('settings.help') }}">
                        Help & Support
                    </a>


                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="https://www.facebook.com/needoplus">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="https://www.linkedin.com/company/needoplus/">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="https://www.instagram.com/needoplus757/">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="https://www.youtube.com/@NeedoPlus">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-primary py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="{{ route('home') }}" class="text-decoration-none d-flex align-items-center">

                    <img src="{{ asset('assets/img/fav.png') }}" alt="Needo+" style="height: 50px;">

                    <span style="color: #fefefe; font-weight: bold; font-size: 32px; margin-left: 8px;">
                        NEEDO+
                    </span>

                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">
                                <i class="fa fa-search" style="color: #ffffff;"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="" class="btn">
                    <i class="fas fa-heart" style="color: #ffffff;"></i>
                    <span class="badge text-white">0</span>
                </a>
                <a href="{{ route('cart.index') }}" class="btn">
                    <i class="fas fa-shopping-cart" style="color: #ffffff;"></i>
                    <span class="badge text-white">0</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->