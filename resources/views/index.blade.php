@extends('template.layout')
 
@section('main')
 
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./assets/img/banner_img_01.jpg" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success"><b>Roosen</b> eCommerce</h1>
                            <h3 class="h2">Tiny and Perfect eCommerce Template</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed massa eget risus imperdiet gravida. Vivamus sed luctus nibh. Maecenas euismod metus sem, et bibendum libero rhoncus id. Suspendisse imperdiet elit aliquet finibus iaculis. <a rel="sponsored" class="text-success" href="https://stories.freepik.com/" target="_blank">Freepik Stories</a>,
                                <a rel="sponsored" class="text-success" href="https://unsplash.com/" target="_blank">Unsplash</a> and
                                <a rel="sponsored" class="text-success" href="https://icons8.com/" target="_blank">Icons 8</a>.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-0 d-flex align-items-center mt-3">
                        <a href="{{ url('/login') }}" class="btn btn-success mx-3" style="border-radius: 20px; padding: 5px 20px;">Login</a>
                        <a href="{{ url('/register') }}" class="btn btn-outline-success" style="border-radius: 20px; padding: 5px 20px;">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection