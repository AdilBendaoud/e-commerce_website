@extends('layouts.user')

@section('content')

    <section class="bgg-success py-5">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-md-8 text-white">
                    <h1>About Us</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>
                <div class="col-md-4">
                    <img src="images/about-us.webp" alt="About Hero">
                </div>
            </div>
        </div>
    </section>
    <!-- Close Banner -->

    <!-- Start Section -->
    <section class="container py-5">
        <div class="row text-center pt-5 pb-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Our Services</h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    Lorem ipsum dolor sit amet.
                </p>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-truck fa-lg"></i></div>
                    <h2 class="h5 mt-4 text-center">Delivery Services</h2>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fas fa-exchange-alt"></i></div>
                    <h2 class="h5 mt-4 text-center">Shipping & Return</h2>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-percent"></i></div>
                    <h2 class="h5 mt-4 text-center">Promotion</h2>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-user"></i></div>
                    <h2 class="h5 mt-4 text-center">24 Hours Service</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->

    <!-- Start certification section -->
    <section class="bg-white pb-5">
        <div class="container py-5">
            <div class="row text-center py-5">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Our certifications</h1>
                    <p>
                        To offer you our organic products, Oriental Group collaborates with four certifying bodies:
                    </p>
                </div>
            </div>
            <div class="row row-cols-2 row-cols-md-4 g-3">
                <div class="col flex align-items-center justify-content-center p-0">
                    <a href="https://www.ccpb.it/en/">
                        <img src="images/ccpb.jpg" alt="CCPB" class="rounded-circle img-fluid border border-secondary" style="width: 175px;">
                    </a>
                </div>

                <div class="col flex align-items-center justify-content-center p-0">
                    <a href="https://www.usda.gov/topics/organic">
                        <img src="images/usda.jpg" alt="USDA" class="rounded-circle img-fluid border border-secondary" style="width: 180px;">
                    </a>
                </div>

                <div class="col flex align-items-center justify-content-center p-0">
                    <a href="https://www.fda.gov/">
                        <img src="images/fda.png" alt="FDA" class="rounded-circle img-fluid border border-secondary" style="width: 180px;">
                    </a>
                </div>

                <div class="col flex align-items-center justify-content-center p-0">
                    <a href="https://www.ecocert.com/en/certification-detail/natural-and-organic-cosmetics-cosmos">
                        <img src="images/ecocert.jpg" alt="ECOCERT" class="rounded-circle img-fluid border border-secondary" style="width: 180px;">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End cetification section -->

    <!-- Start Brands -->
    <section class="bg-light py-5">
        <div class="container my-4">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Partenaires</h1>
                    <p>
                        Nous sommes fiers d’appartenir à:
                        
                    </p>
                </div>
                <div class="col-lg-9 m-auto tempaltemo-carousel">
                    <div class="row d-flex flex-row">
                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="prev">
                                <i class="text-light fas fa-chevron-left"></i>
                            </a>
                        </div>
                        <!--End Controls-->

                        <!--Carousel Wrapper-->
                        <div class="col">
                            <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="templatemo-slide-brand" data-bs-ride="carousel">
                                <!--Slides-->
                                <div class="carousel-inner product-links-wap" role="listbox">

                                    <!--First slide-->
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-3 p-md-10">
                                                <a href="#"><img class="img-fluid brand-img" src="images/Logo_Asmex.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-10">
                                                <a href="#"><img class="img-fluid brand-img" src="images/Logo-FIMABIO-400-FondTransparent.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-10">
                                                <a href="#"><img class="img-fluid brand-img" src="images/maroc_ep.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-10">
                                                <a href="#"><img class="img-fluid brand-img" src="images/LOGO_CGEM.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End First slide-->

                                    <!--Second slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-3 p-md-10">
                                                <a href="#"><img class="img-fluid brand-img" src="images/Logo_Asmex.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-10">
                                                <a href="#"><img class="img-fluid brand-img" src="images/Logo-FIMABIO-400-FondTransparent.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-10">
                                                <a href="#"><img class="img-fluid brand-img" src="images/maroc_ep.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-10">
                                                <a href="#"><img class="img-fluid brand-img" src="images/LOGO_CGEM.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Second slide-->

                                    <!--Third slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-3 p-md-10">
                                                <a href="#"><img class="img-fluid brand-img" src="images/Logo_Asmex.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-10">
                                                <a href="#"><img class="img-fluid brand-img" src="images/Logo-FIMABIO-400-FondTransparent.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-10">
                                                <a href="#"><img class="img-fluid brand-img" src="images/maroc_ep.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-10">
                                                <a href="#"><img class="img-fluid brand-img" src="images/LOGO_CGEM.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Third slide-->

                                </div>
                                <!--End Slides-->
                            </div>
                        </div>
                        <!--End Carousel Wrapper-->

                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="next">
                                <i class="text-light fas fa-chevron-right"></i>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Brands-->
@endsection

@section('script')
@endsection