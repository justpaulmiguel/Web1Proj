<?php
	session_start();
	if(isset($_SESSION["emailLogin"]) && isset($_SESSION["passLogin"])){
		header('Location: menu.php');
		exit();
	}
?>

<!DOCTYPE html>

<html>

<head>

    <link rel="stylesheet" href="bootstrap\bootstrap.min.css">
    <script src="bootstrap\bootstrap.min.js"></script>
    <link rel="stylesheet" href="homePageDesign.css">
    <!--<script src="homePageDesign.js"></script>-->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">


    <title>
        Home
    </title>
</head>

<body>

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
                        <img src="home\images\img (1).jpg" class="d-block w-100"
                            alt="Front of Joseph Galang Dental Clinic">
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
        <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div id="modalLogIn" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <!--------------------------------------Form for Log in start-------------------------------------------------->
                        <!---------------change the action="" when doing the actual--------------->
                        <form class="formLayout" action="php/login.php" method="post">

                            <?php if(isset($_GET['error'])) { ?>
                                <p class"error"> <?php echo $_GET['error']; ?></p>
                            <?php } ?>

                            <div class="mb-3">
                                <label for="emailLogIn">Email</label>
                                <input type="email" class="form-control" name="emailLogin" id="email"
                                    placeholder="Enter Email">
                                    <!-- add required in email when doing the actual-->
                                <div class="formBorder"></div>
                            </div>

                            <div class="mb-3">
                                <label for="passLogIn">Password</label>
                                <input type="password" class="form-control" name="passLogin" id="pass"
                                    placeholder="Enter Password" >
                                    <!-- add required in password when doing the actual-->
                                <div class="formBorder"></div>
                            </div>

                            <div class="mb-3">
                                <input type="checkbox" class="form-check-input" name="remLogIn">
                                <label for="remLogIn">Remember me</label>
                            </div>

                            <div id="submitLogin" class="mb-3">
                                <input type="submit" name="submitLogIn" id="submit" value="L O G I N"></input>
                            </div>
                            <div id="submitLogin" class="mb-3">
                                Don't have an account?
                                <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal"
                                    data-bs-target="#modalSignUp"> Sign Up</a>
                            </div>
                            <!--------------------------------------Form end-------------------------------------------------->
                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!---------------------------------------------------Log in ends here------------------------------------------->



        <!-----------------------------------------------------Modal SIGN UP HERE------------------------------------------------>
        <!-------------------------------------- Modal Sign for pop-up login---------------------------------->
        <div class="modal fade modal-lg" id="modalSignUp" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div id="modalSignUp" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Sign Up</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <!------------------------------------------Form for Sign Up start---------------------------------------------->
                        <form class="formLayout" action="#">
                            <div class="row">

                                <div class="container-fluid col-6">
                                    <div class="mb-3">
                                        <label for="nameSignUp">Name</label>
                                        <input type="text" class="form-control" name="nameSignUp" id="nameSignUp"
                                            placeholder="Enter Name" required>
                                        <div class="formBorder"></div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="addSignUp">Address</label>
                                        <input type="text" class="form-control" name="addSignUp" id="addSignUp"
                                            placeholder="Enter Address" required>
                                        <div class="formBorder"></div>
                                    </div>
                                </div>

                                <div class="container-fluid col-6">
                                    <div class="mb-3">
                                        <label for="emailLogIn">Email</label>
                                        <input type="email" class="form-control" name="emailLogin" id="email"
                                            placeholder="Enter Email" required>
                                        <div class="formBorder"></div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="passLogIn">Password</label>
                                        <input type="password" class="form-control" name="passLogin" id="pass"
                                            placeholder="Enter Password" required>
                                        <div class="formBorder"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <form>
                                        <label for="terms">
                                            <input type="checkbox" class="form-check-input" name="terms">
                                            I agree to the</label> <a href="#"> Terms and Condition</a>
                                    </form>
                                </div>

                                <div id="submitLogin">
                                    <input type="submit" name="submitLogIn" id="submit" value="S I G N U P">
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

                    <iframe id="gmap_canvas"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3853.652695491258!2d120.774648150173!3d15.011972389490262!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396f8e1a0ff9e73%3A0xde5f417558a19af!2sJoseph%20Galang%20Dental%20Clinic!5e0!3m2!1sen!2sph!4v1668075967194!5m2!1sen!2sph"
                        allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
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