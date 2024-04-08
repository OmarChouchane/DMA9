<?php
session_start();



include 'server/connection.php';


include('layouts/header.php'); 


 ?>








    <!--Contact-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Contact Us</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="contact-form" method="POST" action="sendemail.php">
                
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                </div>
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control"  id="message" name="message" placeholder="Leave a message"required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="send" class="btn" id="send-btn" value="Send">
                </div>
                
            </form>
        </div>
    </section>





<?php include('layouts/footer.php'); ?>