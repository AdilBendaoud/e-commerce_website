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
    <section class="my-body py-5">
    <div class="my-container">
        <div class="my-content">
            <div class="my-left-side">
                <div class="my-details">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="my-topic">Address</div>
                    <div class="my-text-one">ORIENTAL GROUP N ° 200 Lot El Massar, Sidi Ghanem Industrial Estate</div>
                    <div class="my-text-two">Route de Safi 40 100 Marrakech MOROCCO</div>
                </div>
                <div class="my-details">
                    <i class="fas fa-phone-alt"></i>
                    <div class="my-topic">Phone</div>
                    <div class="my-text-one">+212 524 335 449</div>
                    <div class="my-text-two">+212 600 604 387</div>
                </div>
                <div class="my-details">
                    <i class="fas fa-envelope"></i>
                    <div class="my-topic">Email</div>
                    <div class="my-text-one">contact@group-oriental.com</div>
                    <div class="my-text-two">contact@bioprogreen.com</div>
                </div>
            </div>
            <div class="my-right-side">
                <div class="my-topic-text">Send us a message</div>
                <p>If you have any work from me or any types of queries related to my tutorial, you can send me a message from here. It's my pleasure to help you.</p>
                <form action="{{ route('send.email') }}" class="my-form validate-form" method="post">
                    @csrf
                    <div class="my-input-box validate-input" data-validate="Name is required">
                        <input type="text" placeholder="Enter your name" name="name">
                        <span class="focus-input100"></span>
                        @error('name')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="my-input-box validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input type="text" placeholder="Enter your email" type="text" name="email">
                        <span class="focus-input100"></span>
                        @error('email')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="my-input-box" data-validate="Subject is required">
                        <input type="text" placeholder="Enter the subject" name="subject">
                        @error('subject')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="my-input-box my-message-box" data-validate="Message is required">
                        <textarea placeholder="Your message" name="content"></textarea>
                        @error('content')
                        <span class="text-danger error-message"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="my-button">
                        <input type="submit" value="Send Now" class="my-send-button">
                    </div>
                </form>
            </div>
        </div>
    </div>
	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>
<script>
  $(document).ready(function() {
  // Cacher tous les messages d'erreur au départ
  $('.error-message').hide();

  // Lorsqu'un champ d'entrée est modifié
  $('input[name="name"], input[name="email"]').on('input', function() {
    // Cacher le message d'erreur si le champ est en train d'être modifié
    $(this).siblings('.error-message').hide();
  });

  // Cela pourrait nécessiter d'autres gestionnaires d'événements ou de validation en fonction de votre logique de formulaire
});

</script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
@endsection