<?php
session_start();



include 'server/connection.php';



include('layouts/header.php'); 



 ?>


<div id="banner-bg">

<section class="py-5" id="contact-us">
            <div class="container" data-aos="zoom-in-up" data-aos-duration="1000">
                <div class="body">
                <div class="row justify-content-center text-center mb-lg-5">
                    <div class="col-lg-8 col-xxl-7">
                    <div class="container text-center mt-5"  data-aos="fade-up" data-aos-duration="1000">
                            <h3>Contact Us</h3>
                            <hr class="mx-auto">
                            <!--<p>Here you can check out our featured products</p>-->
                        </div>
                    </div>
                </div>
                <div class="row pb-5 ">
                    
                        <div class="col-md-6 map" data-aos="zoom-in-up" data-aos-duration="1000">
                        
                        
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10739.607942007151!2d10.19700484579142!3d36.8447621029688!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fd34c6d1e93bef%3A0x4153c4733f285343!2sNational%20Institute%20of%20Applied%20Science%20and%20Technology!5e0!3m2!1sen!2stn!4v1715343618339!5m2!1sen!2stn" width="100%" height="340" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  
                        
                    </div>

                    <div class="col-md-6" data-aos="zoom-in-up" data-aos-duration="1000">
                    
                        <form>
                            <div class="row text-center">
                            
                                <div class="col-12">
                                
                                    <div class="mb-3">
                                        <input class="form-control bg-light" placeholder="Full name" type="text">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <input class="form-control bg-light" placeholder="Email address" type="email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <textarea class="form-control bg-light" placeholder="Your message" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 send">
                                    <div class="">
                                        <button class="btn btn-primary submit" type="submit">Send message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </section>
    



        </div>

<?php include('layouts/footer.php'); ?>