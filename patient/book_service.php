<?php
$title = 'Bookings';
require("./partials/head.php");

unset($_SESSION["service"]);
unset($_SESSION["branch"]);
unset($_SESSION["date"]);
unset($_SESSION["time"]);

?>

<main>
  <h1 class="top-heading-text">Booking</h1>
  <p>Reserve an appointment with our doctors.</p>
  <section>
    <div class="section-content">
      <div class="booking-wrapper">
        <form method="post" action="book_branch.php">
          <div class="input-wrapper">
            <label for="service-option" class="label-text">Choose a Service:</label>
            <select name="service" id="service-option" class="booking-select-input select-input">
              <option value="clean">Oral Prophylaxis</option>
              <option value="pasta">Dental Fillings</option>
              <option value="d_crown">Tooth Jacket</option>
              <option value="wisdom">Wisdom Tooth Extraction</option>
            </select>
          </div>
          <div class="form-btn-wrapper">
            <input class="submit-btn btn" type="submit" value="Next"></input>
          </div>
        </form>
      </div>
    </div>
  </section>

  <section class="section services-section">
    <div class="section-content">
      <div id="servicesTitle" class="heading-date">Services</div>
      <div id="service1" class="service-wrapper">
        <!-----------------------------------------Service 1------------------------------------------------>
        <img src="../home/images/Oral Prophylaxis.jpg" />
        <div class="service-details">
          <h3>
            Oral Prophylaxis (cleaning)
          </h3>
          <p>
            It is called to the procedure done for the teeth
            cleaning. It removes tartar and plaque build-up from the
            surfaces of the teeth as well as those hidden in between
            and under the gums.
            Some of the benefits of having an
            oral prophylaxis are to Prevent Tooth Decay, Prevents
            Gum Disease, Prevents Bad Breath, Removes Extrinsic
            Stains, Lowers Risk for Diseases, Early detection of
            Diseases and Financial Savings. Oral prophylaxis is
            recommended to be done twice a year as a preventive
            measure but should be performed every 3-4 months for
            patients with more severe periodontal disease.
          </p>
          <!-- 


           -->
        </div>
      </div>
      <div id="service2" class="service-wrapper">
        <!-----------------------------------------Service 2------------------------------------------------>
        <img src="../home/images/Dental Fillings.jpg" />
        <div class="service-details">
          <h3>
            Dental Fillings (Pasta)
          </h3>
          <p>
            Dental filling is used to treat a small hole, or cavity,
            in a tooth. To repair a cavity, a dentist removes the
            decayed tooth tissue and then fills the space with a
            filling material. We offer several dental filling
            materials. Teeth can be filled with porcelain; silver
            amalgam (which consists of mercury mixed with silver,
            tin, zinc, and copper); or tooth-colored, plastic, and
            materials called composite resin fillings. There is also
            a material that contains glass particles and is known as
            glass ionomer. This material is used in ways like the
            use of composite resin fillings. Materials depends on
            the availability.
          </p>
        </div>
      </div>
      <div id="service3" class="service-wrapper">
        <!-----------------------------------------Service 3------------------------------------------------>
        <img src="../home/images/Tooth Jacket.jpg" />
        <div class="service-details">
          <h3>
            Tooth Jacket (Dental Crown)
          </h3>
          <p>
            A tooth jacket (also known as a dental crown) is a false
            tooth that comes in a variety of material made to be
            placed on a severely damaged tooth. Essentially, this a
            tooth jacket caps off a severely damaged tooth
            protecting it from further damage and replacing it the
            same time. How is a tooth jacket is placed on your
            teeth? To keep it simple, a dentist will file the
            affected tooth down to size. This is to make room for
            the dental crown that goes on top of the tooth. Usually,
            the dentist will give you a temporary crown or jacket to
            wear while the actual crown is being made. The waiting
            time can be from a few days all the way up to a week or
            two.
          </p>
        </div>
      </div>
      <div id="service4" class="service-wrapper">
        <!-----------------------------------------Service 4------------------------------------------------>
        <img src="../home/images/Wisdom Tooth Extraction.jpg" />
        <div class="service-details">
          <h3>
            Wisdom Tooth Extraction
          </h3>
          <p>
            Wisdom tooth extraction is a surgical procedure to
            remove one or more wisdom teeth — the four permanent
            adult teeth located at the back corners of your mouth on
            the top and bottom. If a wisdom tooth doesn't have room
            to grow (impacted wisdom tooth), resulting in pain,
            infection or other dental problems, you'll likely need
            to have it pulled. This service may be done by a dentist
            or an oral surgeon and to prevent potential future
            problems, some dentists and oral surgeons recommend
            wisdom tooth extraction even if impacted teeth aren't
            currently causing problems.
          </p>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
require("./partials/footer.php");
?>