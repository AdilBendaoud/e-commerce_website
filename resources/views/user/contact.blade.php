@extends('layouts.user')

@section('content')
<section class="bgg-success py-5">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-md-8 text-white">
                    <h1>Contact Us</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>
                <div class="col-md-4">
                    <img src="images/contact.png" alt="About Hero">
                </div>
            </div>
        </div>
    </section>
    <!-- Contact form -->
  <div class="my-body">
  <div class="my-container">
    <div class="my-content">
      <div class="my-left-side">
        <div class="my-address my-details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="my-topic">Address</div>
          <div class="my-text-one">Surkhet, NP12</div>
          <div class="my-text-two">Birendranagar 06</div>
        </div>
        <div class="my-phone my-details">
          <i class="fas fa-phone-alt"></i>
          <div class="my-topic">Phone</div>
          <div class="my-text-one">+0098 9893 5647</div>
          <div class="my-text-two">+0096 3434 5678</div>
        </div>
        <div class="my-email my-details">
          <i class="fas fa-envelope"></i>
          <div class="my-topic">Email</div>
          <div class="my-text-one">codinglab@gmail.com</div>
          <div class="my-text-two">info.codinglab@gmail.com</div>
        </div>
      </div>
      <div class="my-right-side">
        <div class="my-topic-text">Send us a message</div>
        <p>If you have any work for me or any types of queries related to my tutorial, you can send me a message from here. It's my pleasure to help you.</p>
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