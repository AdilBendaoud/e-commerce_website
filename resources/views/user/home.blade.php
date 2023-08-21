@extends('layouts.user')

@section('content')
    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="images/backgr5.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text"><b>Oriental</b>Group
                                    </h1>
                                <h3 class="h2">Tiny and Perfect eCommerce Template</h3>
                                <p>
                                    Oriental Group offers a 100% branding service for the customers planning to penetrate their local markets using their own custom label… <a rel="sponsored" class="Linkss" href="https://templatemo.com" target="_blank">TemplateMo</a> website. 
                                    Image credits go to <a rel="sponsored" class="Linkss" href="https://stories.freepik.com/" target="_blank">Freepik Stories</a>,
                                    <a rel="sponsored" class="Linkss" href="https://unsplash.com/" target="_blank">Unsplash</a> and
                                    <a rel="sponsored" class="Linkss" href="https://icons8.com/" target="_blank">Icons 8</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="images/backgr3.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Proident occaecat</h1>
                                <h3 class="h2">Aliquip ex ea commodo consequat</h3>
                                <p>
                                    You are permitted to use this Zay CSS template for your commercial websites. 
                                    You are <strong>not permitted</strong> to re-distribute the template ZIP file in any kind of template collection websites.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="images/backgr6.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Repr in voluptate</h1>
                                <h3 class="h2">Ullamco laboris nisi ut </h3>
                                <p>
                                    We bring you 100% free CSS templates for your websites. 
                                    If you wish to support TemplateMo, please make a small contribution via PayPal or tell your friends about our website. Thank you.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="template-mo-zay-hero-carousel" class="carousel">
            <!-- Carousel slides go here -->
        </div>
    
        <a class="carousel-control-prev text-decoration-none w-auto ps-3 hidden" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3 hidden" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->



    <!-- Start Categories of The Month -->
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Categories of The Month</h1>
                <p>
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 p-5 mt-3 category-item">
                <a href="#"><img src="images/phpfWbfVO.jpg" class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3">Huiles Essentielles</h5>
                <p class="text-center"><a class="btn" id="Goshop">Go Shop</a></p>
            </div>
            <div class="col-12 col-md-4 p-5 mt-3 category-item">
                <a href="#"><img src="images/bestcat-1.jpg" class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Huiles Essentielles</h2>
                <p class="text-center"><a class="btn" id="Goshop">Go Shop</a></p>
            </div>
            <div class="col-12 col-md-4 p-5 mt-3 category-item">
                <a href="#"><img src="images/bestcat-2.jpg" class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Huiles Essentielles</h2>
                <p class="text-center"><a class="btn" id="Goshop">Go Shop</a></p>
            </div>
        </div>
    </section>
    <!-- End Categories of The Month -->


    <!-- Start Featured Product -->
    <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Featured Product</h1>
                    <p>
                        Reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident.
                    </p>
                </div>
            </div>
             
            <div class="row gap-3 justify-content-center" >
                @foreach($products as $product)
                    <x-product :product="$product" />
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Featured Product -->
    
    <!-- Start FAQ section -->
    <section>
        <div class="container faq-section py-5">
            <h1 class="h1 text-center" style="margin: 2rem 0rem;">Frequently Asked Questions</h1>
            <div class="faq">
                <div class="question">
                    <h3>How can I get some samples?</h3>
                    <i class="fa-solid fa-plus" style="color:var(--primary);font-size:20px"></i>
                </div>
                <div class="answer">
                    <p>
                        We are honoured to offer you samples. New clients are expected to pay for the courier cost, 
                        the samples are free for you, 
                        and this charge will be deducted from the payment for formal order.

                        Regarding the courier cost: You can arrange a RPI (remote pick-up) 
                        service upon FedEx, UPS, DHL, TNT, etc. To have the samples collected; or inform us your DHL collection account.
                        Then you can pay the freight direct to your local carrier company.
                    </p>
                </div>
            </div>
            
            <div class="faq">
                <div class="question">
                    <h3>How does your Certified Virgin Argan Oil Company do regarding quality control?</h3>
                    <i class="fa-solid fa-plus" style="color:var(--primary);font-size:20px"></i>
                </div>
                <div class="answer">
                    <p>
                        Quality is priority! Every worker keeps the QC from the very beginning to the very end:
                        <br>
                        <span class="pl-3">
                            <span class="font-weight-bold">1- </span>All raw material we used are environmental-friendly.
                        </span>
                        <br>
                        <span class="pl-3">
                            <span class=" font-bold">2- </span>Skilful workers care every detail in handing the stamping, printing, stitching, packing process.
                        </span>
                        <br>
                        <span class="pl-3">
                            <span class="font-weight-bold">3- </span>Quality control department especially responsible for quality checking in each process.
                        </span>
                    </p>
                </div>
            </div>

            <div class="faq">
                <div class="question">
                    <h3>Can your factory print or emboss my logo on the goods?</h3>
                    <i class="fa-solid fa-plus" style="color:var(--primary);font-size:20px"></i>
                </div>
                <div class="answer">
                    <p>
                        Yes, we can print your logo on the goods or their packing box, for patent protection purpose, 
                        a letter of attorney (letter of authorization) shall be provided for the logo.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End FAQ section -->

@endsection

@section('script')
<script>
    const faqs = document.getElementsByClassName('faq');
    for (let index = 0; index < faqs.length; index++) {
        faqs[index].addEventListener("click",()=>{
            faqs[index].classList.toggle("active");
        });
    }
</script>
@endsection