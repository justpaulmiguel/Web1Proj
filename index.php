<?php
include "php/loginCheck.php";
?>
<!DOCTYPE html>

<html>

<head>

    <link rel="stylesheet" href="bootstrap\bootstrap.min.css">
    <script src="bootstrap\bootstrap.min.js"></script>
    <link rel="stylesheet" href="homePageDesign.css">
    <!--<script src="homePageDesign.js"></script>-->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>
        Home
    </title>
    <link rel="icon" type="image/x-icon" href="logo.ico">

    <style>
        #passCheck {
            display: none;
            margin-top: -25px;
            margin-bottom: -25px;
        }

        #passCheck p {
            text-align: center;
        }

        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
            color: green;
            text-align: justify;
        }

        .valid:before {
            content: "✔    ";
        }

        /* Add a red text color and an "x" icon when the requirements are wrong */
        .invalid {
            color: red;
            text-align: justify;
        }

        .invalid:before {
            content: "✖    ";
        }

        #passCheck2 {
            display: none;
            margin-top: -25px;
            margin-bottom: -25px;
        }

        #passCheck2 p {
            text-align: center;
        }

        /* Add a green text color and a checkmark when the requirements are right */
        .valid2 {
            text-align: center;
            color: green;
        }

        .valid2:before {
            content: "✔ PASSWORD MATCHED";
        }

        /* Add a red text color and an "x" icon when the requirements are wrong */
        .invalid2 {

            color: red;
        }

        .invalid2:before {
            content: "✖ PASSWORD DOES NOT MATCH";
        }

        #passSignup,
        #passSignupConfirm {
            font-size: 14px;
            outline: none;
            border: none;
        }

        #dialCode {
            position: relative;
            top: 30px;
            right: 120px;
            font-size: 14px;
        }

        #contactSignup {
            text-indent: 20px;
        }
    </style>

</head>

<body>

    <div id="response" style="display: none;"></div>

    <!---------------------------------------------------Top Bar Start------------------------------------------------------>
    <div class="row">
        <div class="container-fluid col-12" id="brandTitle">
            <div class="topnav">
                <a href="#home"><img src="logo.png"></a>
                <a href="#home">Home</a>
                <a href="#services">Services</a>
                <a href="#aboutUs">About Us</a>
                <a href="#contactUs">Contact Us</a>
                <div class="split">
                    <a href="login.html" data-bs-toggle="modal" data-bs-target="#modalId">Login</a>
                </div>
            </div>
        </div>
    </div>
    <!---------------------------------------------------Top Bar End------------------------------------------------------>



    <!----------------------------------------HOME STARTS HERE---------------------------------------->
    <div onclick="sidebarf2()">
        <div class="row" id="home">
            <div id="homePage" class="container-fluid">
                <div class="titleHome">
                    JOSEPH GALANG DENTAL CLINIC<br>
                    OFFERING THE BEST DENTAL CARE
                    <br>
                    <!--------------------------BOOK NOW BUTTON------------------------------>
                    <a type="button" id="bookButton" data-bs-toggle="modal" data-bs-target="#modalId">
                        Book Now
                    </a>

                </div>
            </div>


            <!----------------------------------------CAROUSEL PICS STARTS HERE---------------------------------------->
            <div id="myCarousel" class="carousel col-12 slide d-block 2-100" data-bs-ride="carousel">

                <!----------------------------------------carousel indicators here---------------------------------------->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
                </div>

                <!----------------------------------------carousel images---------------------------------------->


                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="home\images\img (1).jpg" class="d-block w-100" alt="Front of Joseph Galang Dental Clinic">
                    </div>

                    <div class="carousel-item">
                        <img src="home\images\img (2).jpg" class="d-block w-100" alt="...">
                    </div>

                    <div class="carousel-item">
                        <img src="home\images\img (3).jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal trigger button -->


        <!----------------------------------------CAROUSEL ENDS HERE---------------------------------------->
        <!----------------------------------------HOME ENDS HERE---------------------------------------->




        <!----------------------------------------LOGIN/SIGNUP STARTS HERE---------------------------------------->

        <!---------------------------------------------------Log in starts here------------------------------------------->
        <!-------------------------------------- Modal Login for pop-up login---------------------------------->
        <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div id="modalLogIn" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <!--------------------------------------Form for Log in start-------------------------------------------------->
                        <!---------------change the action="" when doing the actual--------------->
                        <form class="formLayout" action="php/login.php" method="post" id="formLogin">

                            <div class="mb-3">
                                <label for="emailLogIn">Email</label>
                                <input type="email" class="form-control" name="emailLogin" id="email" placeholder="Enter Email" required>
                                <!-- add required in email when doing the actual-->
                                <div class="formBorder"></div>
                            </div>

                            <div class="mb-3">
                                <label for="passLogIn">Password</label>
                                <input type="password" class="form-control" name="passLogin" id="pass" placeholder="Enter Password" required>
                                <!-- add required in password when doing the actual-->
                                <div class="formBorder"></div>
                            </div>

                            <div id="submitLogin" class="mb-3">
                                <input type="submit" name="submitLogIn" id="submit" value="L O G I N"></input>
                            </div>
                            <div id="submitLogin" class="mb-3">
                                Don't have an account?
                                <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalSignUp"> Sign Up</a>
                            </div>
                            <!--------------------------------------Form end-------------------------------------------------->
                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!---------------------------------------------------Log in ends here------------------------------------------->

        <script>
            var form = document.getElementById("formLogin");

            $(document).ready(function() {
                $(form).submit(function(event) {
                    event.preventDefault()

                    $.post($(form).attr("action"),
                        $(form).serializeArray(),
                        function(info) {

                            $("#response").empty();
                            $("#response").html(info);

                        });

                })
            })
        </script>
        <!-----------------------------------------------------Modal SIGN UP HERE------------------------------------------------>
        <!-------------------------------------- Modal Sign for pop-up login---------------------------------->
        <div class="modal fade modal-lg" id="modalSignUp" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div id="modalSignUp" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Sign Up</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <!------------------------------------------Form for Sign Up start---------------------------------------------->
                        <form class="formLayout" action="php/register_process.php" method="post" id="formSignup">
                            <div class="row">

                                <div class="container-fluid col-6">
                                    <div class="mb-3">
                                        <label for="fnameSignUp">First Name</label>
                                        <input type="text" class="form-control" name="fnameSignup" id="fnameSignup" placeholder="Enter First Name" required>
                                        <div class="formBorder"></div>
                                    </div>
                                </div>


                                <div class="container-fluid col-6">
                                    <div class="mb-3">
                                        <label for="lnameSignup">Last Name</label>
                                        <input type="text" class="form-control" name="lnameSignup" id="lnameSignup" placeholder="Enter Last Name" required>
                                        <div class="formBorder"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="emailSignup">Email</label>
                                    <input type="email" class="form-control" name="emailSignup" id="emailSignup" placeholder="Enter Email" required>
                                    <div class="formBorder"></div>
                                </div>

                                <div class="container-fluid col-6">
                                    <div class="mb-3">
                                        <label for="passSignUp">Password</label>
                                        <input type="password" class="form-control" name="passSignup" id="passSignup" placeholder="Enter Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                        <div class="formBorder"></div>
                                    </div>
                                </div>


                                <div class="container-fluid col-6">
                                    <div class="mb-3">
                                        <label for="passSignupConfirm">Confirm Password</label>
                                        <input type="password" class="form-control" name="passSignupConfirm" id="passSignupConfirm" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                        <div class="formBorder"></div>
                                    </div>
                                </div>

                                <div id="passCheck" display="none">
                                    <div role="alert">
                                        <p id="passInput" class="invalid">Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</p>
                                    </div>
                                </div>

                                <div id="passCheck2" display="none">
                                    <div role="alert">
                                        <p id="passInput2" class="invalid2"></p>
                                    </div>
                                </div>

                                <script type="text/javascript">
                                    var pass = document.getElementById("passSignup");
                                    var passConf = document.getElementById("passSignupConfirm");
                                    var passInput = document.getElementById("passInput");
                                    var passInput2 = document.getElementById("passInput2");
                                    var upper = false;
                                    var lower = false;
                                    var number = false;
                                    var length = false;

                                    passConf.onkeyup = function() {
                                        if (pass.value == passConf.value) {
                                            passInput2.classList.remove("invalid2");
                                            passInput2.classList.add("valid2");
                                        } else {
                                            passInput2.classList.remove("valid2");
                                            passInput2.classList.add("invalid2");
                                        }
                                    }

                                    // When the user starts to type something inside the password field
                                    pass.onfocus = function() {
                                        document.getElementById("passCheck").style.display = "block";
                                    }

                                    // When the user clicks outside of the password field, hide the message box
                                    pass.onblur = function() {
                                        document.getElementById("passCheck").style.display = "none";
                                    }

                                    // When the user starts to type something inside the password field
                                    passConf.onfocus = function() {
                                        document.getElementById("passCheck2").style.display = "block";
                                    }

                                    // When the user clicks outside of the password field, hide the message box
                                    passConf.onblur = function() {
                                        document.getElementById("passCheck2").style.display = "none";
                                    }

                                    // When the user starts to type something inside the password field
                                    pass.onkeyup = function() {
                                        // Validate lowercase letters
                                        var lowerCaseLetters = /[a-z]/g;
                                        if (pass.value.match(lowerCaseLetters)) {
                                            lower = true;
                                        } else {
                                            lower = false;
                                        }

                                        // Validate capital letters
                                        var upperCaseLetters = /[A-Z]/g;
                                        if (pass.value.match(upperCaseLetters)) {
                                            upper = true;
                                        } else {
                                            upper = false;
                                        }

                                        // Validate numbers
                                        var numbers = /[0-9]/g;
                                        if (pass.value.match(numbers)) {
                                            number = true;
                                        } else {
                                            number = false;
                                        }

                                        // Validate length
                                        if (pass.value.length >= 8) {
                                            length = true;
                                        } else {
                                            length = false;
                                        }

                                        if (lower && upper && number && length) {
                                            passInput.classList.remove("invalid");
                                            passInput.classList.add("valid");
                                        } else {
                                            passInput.classList.remove("valid");
                                            passInput.classList.add("invalid");
                                        }
                                    }
                                </script>

                                <div div class="mb-3">
                                    <label for="contactSignup">Contact Number</label>
                                    <label id="dialCode" for="contactSignup">+63</label>
                                    <input type="text" class="form-control" name="contactSignup" id="contactSignup" placeholder="9876543210" pattern="[0-9]{10}" maxlength="10" required>
                                    <div class="formBorder"></div>
                                </div>

                                <div class="mb-3">
                                    <form>
                                        <label for="terms">
                                            <input type="checkbox" class="form-check-input" name="terms" required>
                                            I agree to the</label> <a href="#"> Terms and Condition</a>
                                    </form>
                                </div>

                                <div id="submitLogin">
                                    <input type="submit" name="submitSignup" id="submit" value="S I G N U P">
                                </div>

                                <div id="submitLogin" class="mb-3">
                                    Already have an account?
                                    <a href="#home" data-bs-toggle="modal" data-bs-target="#modalId"> Log In</a>
                                </div>

                            </div>
                        </form>


                        <!------------------------------------------Form for Sign Up end---------------------------------------------->
                    </div>

                </div>
            </div>
        </div>



        <!----------------------------------------LOGIN SIGNUP ENDS HERE---------------------------------------->

        <script>
            var form2 = document.getElementById("formSignup");
            var pass = document.getElementById("passSignup");
            var passConf = document.getElementById("passSignupConfirm");

            $(document).ready(function() {
                $(form2).submit(function(event) {
                    if (pass.value != passConf.value) {
                        passConf.focus();
                        event.preventDefault();
                    } else {
                        event.preventDefault()

                        $.post($(form2).attr("action"),
                            $(form2).serializeArray(),
                            function(info) {

                                $("#response").empty();
                                $("#response").html(info);

                            });
                    }
                })
            })
        </script>

        <!----------------------------------------SERVICES STARTS HERE---------------------------------------->

        <div class="row" id="services">
            <div class="container-fluid">
                <div id="servicesTitle">Services</div>
                <div id="servicesContent">

                    <div class="theService1">
                        <div class="row">

                            <div id="service1" class="container-fluid col-sm-3">

                                <!-----------------------------------------Service 1------------------------------------------------>
                                <h3 style="text-align: center;">Oral Prophylaxis <br>(cleaning)</h3>
                                <p>
                                    <img src="home/images/Oral Prophylaxis.jpg"><br>
                                    It is called to the procedure done for the teeth cleaning. It removes tartar and
                                    plaque build-up from the
                                    surfaces of the teeth as well as those hidden in between and under the gums. Some of
                                    the benefits of
                                    having an oral prophylaxis are to Prevent Tooth Decay, Prevents Gum Disease,
                                    Prevents Bad Breath,
                                    Removes Extrinsic Stains, Lowers Risk for Diseases, Early detection of Diseases and
                                    Financial Savings. Oral
                                    prophylaxis is recommended to be done twice a year as a preventive measure but
                                    should be performed
                                    every 3-4 months for patients with more severe periodontal disease.
                                </p>
                            </div>
                            <div id="service2" class="container-fluid col-sm-3">

                                <!-----------------------------------------Service 2------------------------------------------------>
                                <h3 style="text-align: center;">The Dental Fillings <br>(pasta)</h3>
                                <p>
                                    <img src="home/images/Dental Fillings.jpg"><br>
                                    Dental filling is used to treat a small hole, or cavity, in a tooth. To repair a
                                    cavity, a dentist removes the
                                    decayed tooth tissue and then fills the space with a filling material. We offer
                                    several dental filling
                                    materials. Teeth can be filled with porcelain; silver amalgam (which consists of
                                    mercury mixed with silver,
                                    tin, zinc, and copper); or tooth-colored, plastic, and materials called composite
                                    resin fillings. There is also
                                    a material that contains glass particles and is known as glass ionomer. This
                                    material is used in ways like
                                    the use of composite resin fillings. Materials depends on the availability.
                                </p>
                            </div>
                            <div id="service3" class="container-fluid col-sm-3">

                                <!-----------------------------------------Service 3------------------------------------------------>
                                <h3 style="text-align: center;">Tooth Jacket <br>(Dental Crown)</h3>
                                <p>
                                    <img src="home/images/Tooth Jacket.jpg"><br>
                                    A tooth jacket (also known as a dental crown) is a false tooth that comes in a
                                    variety of material made to
                                    be placed on a severely damaged tooth. Essentially, this a tooth jacket caps off a
                                    severely damaged tooth
                                    protecting it from further damage and replacing it the same time. How is a tooth
                                    jacket is placed on your
                                    teeth? To keep it simple, a dentist will file the affected tooth down to size. This
                                    is to make room for the
                                    dental crown that goes on top of the tooth. Usually, the dentist will give you a
                                    temporary crown or jacket
                                    to wear while the actual crown is being made. The waiting time can be from a few
                                    days all the way up to
                                    a week or two.
                                </p>
                            </div>
                            <div id="service4" class="container-fluid col-sm-3">

                                <!-----------------------------------------Service 4------------------------------------------------>
                                <h3 style="text-align: center;">Wisdom Tooth <br>Extraction</h3>
                                <p>
                                    <img src="home/images/Wisdom Tooth Extraction.jpg"><br>
                                    Wisdom tooth extraction is a surgical procedure to remove one or more wisdom teeth —
                                    the four
                                    permanent adult teeth located at the back corners of your mouth on the top and
                                    bottom. If a wisdom
                                    tooth doesn't have room to grow (impacted wisdom tooth), resulting in pain,
                                    infection or other dental
                                    problems, you'll likely need to have it pulled. This service may be done by a
                                    dentist or an oral surgeon and
                                    to prevent potential future problems, some dentists and oral surgeons recommend
                                    wisdom tooth
                                    extraction even if impacted teeth aren't currently causing problems.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!----------------------------------------SERVICES ENDS HERE---------------------------------------->


    <!----------------------------------------ABOUT US STARTS HERE---------------------------------------->
    <div class="row" id="aboutUs">
        <div class="container-fluid col-sm-12">
            <div id="aboutUsTitle">About Us</div>
            <div id="aboutUsContent">
                Since 1979, we’ve provided and practiced quality dentistry in Joseph Galang Dental Clinic.
                <br><br>
                With our caring and dedicated staff, we strive to provide you with the most comfortable and relaxed
                dental experience anywhere. Our state-of-the-art facility affords us the opportunity to provide for you,
                your family, and friends the best that modern dentistry has to offer. Visit us on the web, then call and
                talk
                to the warm friendly people that will ensure your first and subsequent visits are always pleasant ones.
                <br><br>
                The care we provide is comfortable, attentive, and anything but typical – so
                why not experience it for yourself? You may see the details below on how to contact us, to set a
                schedule
                or an initial consultation, or simply to learn more about what sets us apart if you’d like to.
                <br>
                We hope to see you soon!
            </div>
        </div>
    </div>
    <!----------------------------------------ABOUT US ENDS HERE---------------------------------------->


    <!----------------------------------------CONTACT US STARTS HERE---------------------------------------->
    <div class="row" id="contactUs">
        <div class="container-fluid col-sm-12">
            <div id="contactUsTitle">Contact Us</div>
            <div id="contactUsContent">
                <div class="address">

                    <iframe id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3853.652695491258!2d120.774648150173!3d15.011972389490262!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396f8e1a0ff9e73%3A0xde5f417558a19af!2sJoseph%20Galang%20Dental%20Clinic!5e0!3m2!1sen!2sph!4v1668075967194!5m2!1sen!2sph" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <br><br>
                Address: San Simon, Pampanga <br>
                <a href="mailto:"> Email Us </a><br>
                <a href="tel:">Call Us: +639xxxxxxxxx</a><br>
                <a href="#"> Facebook </a>
            </div>
        </div>
    </div>
    <!--ABOUT US ENDS HERE-->
    </div>
</body>

</html>