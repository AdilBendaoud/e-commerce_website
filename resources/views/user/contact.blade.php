@extends('layouts.user')

@section('content')
<section class="bg-success py-5">
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
<div class="contact-us">
  <div class="containerr">
    <div class="contentt">
      <div class="left-sidee">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-onee">Surkhet, NP12</div>
          <div class="text-twoo">Birendranagar 06</div>
        </div>
        <div class="phone detailss">
          <i class="fas fa-phone-alt"></i>
          <div class="topicc">Phone</div>
          <div class="text-onee">+0098 9893 5647</div>
          <div class="text-twoo">+0096 3434 5678</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-onee">codinglab@gmail.com</div>
          <div class="text-twoo">info.codinglab@gmail.com</div>
        </div>
      </div>
      <div class="right-sidee">
        <div class="topic-textt">Send us a message</div>
        <p>If you have any work from me or any types of quries related to my tutorial, you can send me message from here. It's my pleasure to help you.</p>
      <form action="#">
        <div class="input-boxx">
          <input type="textt" placeholder="Enter your name">
        </div>
        <div class="input-boxx">
          <input type="textt" placeholder="Enter your email">
        </div>
        <div class="input-box message-box">
          
        </div>
        <div class="buttonn">
          <input type="buttonn" value="Send Now" >
        </div>
      </form>
    </div>
    </div>
  </div>
  </div>
@endsection

@section('script')
@endsection