@extends('layouts.user')

@section('content')
<section class="bgg-success py-5">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-md-8 text-white">
                    <h1>Contact Us</h1>
                    <p>If you have any questions, suggestions, or feedback, we'd love to hear from you. 
                      Our team is here to assist you in any way we can. 
                      Please feel free to reach out to us using the contact form below, and we'll get back to you as soon as possible. 
                      Alternatively, you can also contact us directly via email or phone, or visit our office in person. We look forward to connecting with you!</p>
                </div>
                <div class="col-md-4">
                    <img src="images/contact.png" alt="About Hero">
                </div>
            </div>
        </div>
    </section>
    <!-- Contact form -->
  <div class="my-body">
  <div class="my-container my-4">
    <div class="my-content">
      <div class="my-left-side">
        <div class="my-address my-details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="my-topic">Address</div>
          <div class="my-text-one">
            ORIENTAL GROUP N ° 200 Lot El Massar, Sidi Ghanem Industrial Estate. 
            Route de Safi 40 100 Marrakech MOROCCO
          </div>
        </div>
        <div class="my-phone my-details">
          <i class="fas fa-phone-alt"></i>
          <div class="my-topic">Phone</div>
          <div class="my-text-one">+212 524 335 449</div>
        </div>
        <div class="my-email my-details">
          <i class="fas fa-envelope"></i>
          <div class="my-topic">Email</div>
          <div class="my-text-one">contact@group-oriental.com</div>
        </div>
      </div>
      <div class="my-right-side">
        <div class="my-topic-text">Send us a message</div>
        <form action="#">
          <div class="my-input-box">
            <input type="text" placeholder="Enter your name">
          </div>
          <div class="my-input-box">
            <input type="text" placeholder="Enter your email">
          </div>
          <div class="my-input-box my-message-box">
            <textarea placeholder="Your message"></textarea>
          </div>
          <div class="my-button">
            <input type="button" value="Send Now">
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
@endsection

@section('script')
@endsection