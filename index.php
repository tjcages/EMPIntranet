<?php

session_start();

require 'database.php';

if( isset($_SESSION['user_id']) ){

  $records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = NULL;

  if( count($results) > 0){
    $user = $results;
  }

}

if( isset($_SESSION['user_id']) ){
  header("Location: /");
}


if(!empty($_POST['email']) && !empty($_POST['password'])):
  
  $records = $conn->prepare('SELECT id,email,password FROM users WHERE email = :email');
  $records->bindParam(':email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = '';

  if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

    $_SESSION['user_id'] = $results['id'];
    header("Location: login.php");

  } else {
    ?>
    <div class="falsenews">
    <?php
    echo '<span style="color:#FF2D00;text-align:right;">Sorry, those credentials do not match</span>';
    ?>
    </div>
    <?php
  }

endif;

?>


<!DOCTYPE html>
<html>
<head>
  <title>EMP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
   <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@ViewData["Title"] - EMP</title>

    <environment names="Development">
        <link href="~/wwwroot/css/carousel.css" rel="stylesheet" />
        <link rel="stylesheet" href="~/lib/bootstrap/dist/css/bootstrap.css" />
    
        <link rel="stylesheet" href="~/css/site.css" />
    </environment>
    <environment names="Staging,Production">
        <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/bootstrap/3.3.7/css/bootstrap.min.css"
              asp-fallback-href="~/lib/bootstrap/dist/css/bootstrap.min.css"
              asp-fallback-test-class="sr-only" asp-fallback-test-property="position" asp-fallback-test-value="absolute" />

    </environment>
</head>

<body style="background-color: #F1F1F1;">


<?php if(!empty($message)): ?>
    <p><?= $message ?></p>
  <?php endif; ?>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a asp-area="" asp-controller="Home" href="/" class="navbar-brand">EMP</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a asp-area="" asp-controller="Home" href="/">Home</a></li>
                <li><a asp-area="" asp-controller="Home" asp-action="about.php" href="about.php">About</a></li>
                <li><a asp-area="" asp-controller="Home" asp-action="contact.php" href="contact.php">Contact</a></li>
                <li><a asp-area="" asp-controller="Home" href="register.php">Register</a></li>
              </ul>
              <div id="navbar" class="navbar-collapse collapse">
                <form class="navbar-form navbar-right" method="POST">
                  <div class="form-group">
                    <input type="text" name="email" placeholder="Employee Number" class="form-control" style="margin-top: -10px; margin-bottom: -8px;">
                  </div>
                  <div class="form-group">
                    <input action="login.php" type="password"  name="password" placeholder="Password" class="form-control" style="margin-top: -10px; margin-bottom: -8px;">
                  </div>
                    <button type="submit" class="btn-primary btn-md" style="width: 75px; margin-right: 20px; margin-top: 2px;">Sign in</button>
                </form>
              </div><!--/.navbar-collapse -->
            </div>
          </div>
        </nav>


  <div class="jumbotron vertical-center" style="box-shadow: 0.75px 0.75px 0.75px #959499;">
      <div class="container">
        <h1 class="scriptfont" style="text-shadow: 1px 1px 1px #000; font-size: 68px; font-weight: 700; font-family: 'Roboto-MediumItalic', Helvetica, Arial, sans-serif; color: #FFF">Electro-Mechanical Products<br>Employee Guide<br></h1>


   <p class="error-message"></br></p>

        <p><a class="btn btn-primary btn-lg" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" id="accordion">Learn More</a></p>
            <div class="panel-default">
        <div id="collapse1" class="panel-collapse collapse">
         <div class="panel-body" style="font-family: 'Roboto-MediumItalic', Helvetica, Arial, sans-serif; background-color: #333; color: #FFF;">Electro-Mechanical Products, Inc. (EMP) is a leading manufacturer of precision machined components, thermal management solutions, and mechanical and electrical subassemblies used by technology-driven industries worldwide. For more than 40 years, we have upheld an impeccable safety record while custom-designing innovative manufacturing solutions for the semiconductor, medical, laser, aerospace, commercial and high-tech business sectors.
                <br><br>With a dedicated team of engineers on staff, no design is too complex and no project too tedious. We have a strong affinity for taking on challenging-to-produce designs, and we pride ourselves on delivering quality components that make a difference, giving our customers the confidence and value they can depend on.
                <br><br>In addition to our technical expertise, safety is another industry differentiator for EMP. In the 2016 NCCI (National Council on Compensation Insurance) rating, EMP earned a 0.77 EMOD (Experience Modification Rate) and has consistently ranked well below the 1.0 industry average for the past 10 years. The EMOD is a rating factor used in the insurance industry to compare employers’ historical claims and payroll data to their peers in similar business operations.
                <br><br>EMP is committed to safely manufacture your product at a competitive cost, with exceptional quality and deliver it on-time to give you a sustained competitive advantage in today’s global economy.
    </div>
    </div>
      </div>
    </div>
  </div>


    <div class="container" style="color: #333;">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4" style="background-color: #FFF; box-shadow: 0.75px 0.75px 0.75px #959499; font-family: 'Roboto-MediumItalic', Helvetica, Arial, sans-serif;">
          <h2>Additional Guides</h2>
          <p>Comprehensive guides to all of EMP's safety regulations and procedures. We take great pride in correctly training our employees of proper use when handling all of the machining equipment.</p>
          <br>
          <p><a class="btn btn-default btn-md" role="button" href="guides.php" >Expand &raquo;</a></p>
          </div>
        <div class="col-md-4" style="background-color: #FFF; box-shadow: 0.75px 0.75px 0.75px #959499; font-family: 'Roboto-MediumItalic', Helvetica, Arial, sans-serif;">
          <h2>Video Tutorials</h2>
          <p>Broad video tutorials that cover all the basics of the machine shop, jitterbug, epoxy, and deburr stations. You will learn some of the skills needed to opperate, as well as safety training.</p>
          <br>
      <p><a class="btn btn-default" href="video.php" role="button">Expand &raquo;</a></p>
       </div>
        <div class="col-md-4" style="background-color: #FFF; box-shadow: 0.75px 0.75px 0.75px #959499; font-family: 'Roboto-MediumItalic', Helvetica, Arial, sans-serif;">
          <h2>Part Index</h2>
          <p>Extensive list of all EMP manufactured parts and files associated. These includes pertinent background information and the electronic drawings/prints.</p>
          <br>
          <br>
      <p><a class="btn btn-default" href="parts.php" role="button">Expand &raquo;</a></p>
        </div>
      </div>

       <!-- START THE FEATURETTES -->

  <br>
      <hr class="featurette-divider">

      <div class="row featurette" style="background-color: #FFF; box-shadow: 0.75px 0.75px 0.75px #959499; font-family: 'Roboto-MediumItalic', Helvetica, Arial, sans-serif;">
        <div class="col-md-7">
          <h2 class="active"><a class="featurette-heading" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" id="accordion">Leak Detection Procedures.</a><span class="text-muted">&nbsp;Pressure & Flow.</span></h2>
            <p class="lead">EMP takes great care in ensuring that all of its products are air tight before shipping to customers. This is through comprehensive pressure tests in water with either pressurized air or nitrogen.</br></p>
      <div id="collapse2" class="panel-collapse collapse">
                <div class="lead">Electro-Mechanical Products, Inc. (EMP) is a leading manufacturer of precision machined components, thermal management solutions, and mechanical and electrical subassemblies used by technology-driven industries worldwide. For more than 40 years, we have upheld an impeccable safety record while custom-designing innovative manufacturing solutions for the semiconductor, medical, laser, aerospace, commercial and high-tech business sectors.
                <br><br>With a dedicated team of engineers on staff, no design is too complex and no project too tedious. We have a strong affinity for taking on challenging-to-produce designs, and we pride ourselves on delivering quality components that make a difference, giving our customers the confidence and value they can depend on.
                <br><br>In addition to our technical expertise, safety is another industry differentiator for EMP. In the 2016 NCCI (National Council on Compensation Insurance) rating, EMP earned a 0.77 EMOD (Experience Modification Rate) and has consistently ranked well below the 1.0 industry average for the past 10 years. The EMOD is a rating factor used in the insurance industry to compare employers’ historical claims and payroll data to their peers in similar business operations.
                <br><br>EMP is committed to safely manufacture your product at a competitive cost, with exceptional quality and deliver it on-time to give you a sustained competitive advantage in today’s global economy
          </div>
      </div>
    </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" vspace="25" style= "background-color: #FFF; box-shadow: 0.75px 0.75px 0.75px #959499; width: 400px; display: block; margin-bottom: 20px;" src="http://electromechanicalproducts.com/wp-content/uploads/2016/03/382.jpg" alt="Generic placeholder image">
        </div>
      </div>
      
      <hr class="featurette-divider">

    <div class="row featurette" style="background-color: #FFF; box-shadow: 0.75px 0.75px 0.75px #959499; font-family: 'Roboto-MediumItalic', Helvetica, Arial, sans-serif;">
        <div class="col-md-7 col-md-push-5">
          <h2 class="active"><a class="featurette-heading" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" id="accordion">Epoxy Procedures.</a><span class="text-muted">&nbsp;Mixing & Application.</span></h2>
            <p class="lead">Epoxies are vital in the manufacturing process of many EMP thermal management parts. They form the connecting layer between the tubing and the plating it is pressed into. The purpose of epoxy is twofold: 1) form a seamless interface for heat to discharge into the tubing and 2) hold the tubing in place. This allows EMP’s products to properly dissipate heat. If there are any gaps in the epoxy, a thermal short will occur and heat will not flow properly to the tubing. This may result in a failure of the system the part aims to protect.</p>
    </div>
    <div class="col-md-5 col-md-pull-7">
            <img class="featurette-image img-responsive center-block" vspace="25" style= "background-color: #FFF; box-shadow: 0.75px 0.75px 0.75px #959499; width: 400px; display: block; margin-bottom: 20px;" src="http://electromechanicalproducts.com/wp-content/uploads/2016/03/46.jpg" alt="Generic placeholder image">
        </div>
    <div id="collapse3" class="panel-collapse collapse">
            <div class="col-md-7 col-md-push-5">
        <div class="lead">The thickness of the epoxy layer also plays an important role in the heat dissipation performance for a part. Because the epoxy has much less thermal conductivity than the surrounding metal, the layer must be extremely thin to allow heat to easily discharge between the metals. If it is too thick then the heat won’t sufficiently transfer into the tube and it can cause failure to the system. Most customers require a thickness no larger than one thou of an inch.</div>
      </div>
      <div class="col-md-5 col-md-pull-7">
                <img class="featurette-image img-responsive center-block" vspace="25" style= "background-color: #FFF; box-shadow: 0.75px 0.75px 0.75px #959499; width: 400px; display: block; margin-bottom: 20px;" src="https://lh5.googleusercontent.com/0qx_y6zKpwTYqGNR3L-S3gQzoADCXtL0vhOFVokS2Lio-bYbSHpUAWV43xCjpI2EtOSM2t2gQR6n9KUkpdIhOGePj6cCDX_Wr5NmCdtyY_Yi2Ro0ZdF0AOJPOm49kIhq9QSiYmHj" alt="Generic placeholder image"> 
            </div>
      <div class="col-md-12">
          <h2 class="featurette-heading">Parameters of Epoxy:</h2> 
          <div class="lead"><br>Different epoxies have different traits that can affect how they are used in industry. For the epoxies used at EMP, it is important to consider the thermal conductivity, viscosity, pot and shelf life, and curing time and conditions.<br>
                                  <br>In general, the term thermal conductivity describes the rate at which heat will transfer through a material. The higher the thermal conductivity of a material, the better the part will perform in removing heat from a system.The difference between an aluminum infused epoxy and a typical epoxy is in the thermal conductivity that the aluminum infused epoxy provides. Although standard epoxy would be sufficient in holding the tubing in place, it would rather insulate the tubing when exposed to high temperatures, thus will generally fail in the system. When we say thermally conducting we mean that the epoxy will allow heat to transfer through it, provided the layer is thin enough.<br> 
                                  <br>Viscosity is a measurement of the consistency of the epoxy. The viscosity of the epoxy determines how easily the epoxies can be applied to a part. A low viscosity fluid will flow and spread very easily, whereas a high viscosity fluid will be more difficult to spread. Some of the epoxies that EMP use are easy to manipulate into the tube track to achieve the thin layer, whereas others may be much thicker like putty and be difficult to spread.<br>
                                  <br>Pot life, or working time, of an epoxy is how long an epoxy can be used after it has been mixed. It is important not to use a mixed epoxy after its specified pot life. At this point, the epoxy has cured too much, and attempting to use it can break the bonds and result in poor performance. Additionally, heat accelerates the curing process, and on hot days the epoxy may expire before the pot life has been reached. If the epoxy begins to thicken early, it is important to replace the batch before continuing.<br></div>
      </div>
        <div class="col-md-12">
          <h2 class="featurette-heading">Types of Epoxies:</h2>
          <p class="lead"><br>EMP uses five different epoxies that consist of a combination of resin and hardener. Each of these epoxies offer different properties that can be favorable for different parts.</p>
        </div>
            <div class="col-container">
      <div class="col-md-4">
                <img class="featurette-image img-responsive center-block" vspace="25" style= "background-color: #FFF; box-shadow: 0.75px 0.75px 0.75px #959499; width: 400px; display: block; margin-bottom: 20px;" src="https://lh5.googleusercontent.com/uVg2nXTUt5lwG-Nttck6F-sPxDxxtoYxznUV33mZ_X2i7zXhScH_-ajG8GxOtO0-ese3c-emXwljBUae7rnjD-VWUD7-W3s0vaJQOKv-B0lqTCYM1RdSqCm3H2jluuo5XlTd3XXA" alt="Generic placeholder image"> 
      </div>
      <div class="col-md-4">
                <img class="featurette-image img-responsive center-block" vspace="25" style= "background-color: #FFF; box-shadow: 0.75px 0.75px 0.75px #959499; width: 400px; display: block; margin-bottom: 20px;" src="https://lh5.googleusercontent.com/J3aWKWQZq-UYBiJSJJME0vgs5Afsu8GqywiN9rtThKoy550hognwpRlWF_f6eMpNIkGM55oCKCboMRWXozYflGwpgG_N_LH6d0Nfroa_AVXotf8uh9GixpmkT2kPu57KR7oMWgvS" alt="Generic placeholder image"> 
      </div>
      <div class="col-md-4">
        <h2 class="featurette-heading"><br>Cast-Coat</h2>
                <p class="lead"><br>Thermal Conductivity: 4.54 W/m*K
                    <br>Viscosity: 6.5 Pa*s
                                <br>Mix Ratio: 100:10.4
                                <br>Pot Life: ~45 min
                                <br>Shelf Life: 12 months
                                <br>Curing Time: 16 hrs &#64; Room Temp.</p>
      </div>
      </div>
        </div>
  </div>

      <hr class="featurette-divider">

      <div class="row featurette" style="background-color: #FFF; box-shadow: 0.75px 0.75px 0.75px #959499; font-family: 'Roboto-MediumItalic', Helvetica, Arial, sans-serif;">
        <div class="col-md-7">
          <h2 class="active"><a class="featurette-heading" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" id="accordion">Jitterbug Procedures.</a><span class="text-muted">&nbsp;Standard & Wet.</span></h2>
            <p class="lead">Jitterbugging is a type of orbital sanding technique that is used to remove surface impurities and create a homogeneous, cosmetic finish. The jitterbug is a handheld device with a sanding tool on the face that vibrates rapidly in a circle. When an outside force, such as the pressure from a person, is applied downward, the jitterbug removes scratches, dents and burrs created during previous manufacturing processes to reveal a uniform, matte finish. The two main types of jitterbug processes are known as standard and wet.</p>
            <div id="collapse4" class="panel-collapse collapse">
                <div class="lead">
            
                </div>
            </div>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" vspace="25" style= "background-color: #FFF; box-shadow: 0.75px 0.75px 0.75px #959499; width: 400px; display: block; margin-bottom: 20px;" src="http://electromechanicalproducts.com/wp-content/uploads/2016/03/June-20-2014__5928.jpg" alt="Generic placeholder image">
        </div>
      </div>
      </div>




<!-- Logging In: -->

        <hr />
      <footer style="background-color: #FFF; box-shadow: 0.75px 0.75px 0.75px #959499; font-family: 'Roboto-MediumItalic', Helvetica, Arial, sans-serif; margin-left: 20px; margin-right: 20px;">
        <p class="pull-right" style="margin-right: 20px;"><a href="#"></br>Back to top&nbsp;&nbsp;&nbsp;</a></p>
        <p style="color: #333; margin-left: 20px;"></br>&copy; 2017 EMP, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </br>
      </footer>

    <environment names="Development">
        <script src="~/lib/jquery/dist/jquery.js"></script>
        <script src="~/lib/bootstrap/dist/js/bootstrap.js"></script>
        <script src="~/js/site.js" asp-append-version="true"></script>
    </environment>
    <environment names="Staging,Production">
        <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-2.2.0.min.js"
                asp-fallback-src="~/lib/jquery/dist/jquery.min.js"
                asp-fallback-test="window.jQuery"
                crossorigin="anonymous"
                integrity="sha384-K+ctZQ+LL8q6tP7I94W+qzQsfRV2a+AfHIi9k8z8l9ggpc8X+Ytst4yBo/hH+8Fk">
        </script>
        <script src="https://ajax.aspnetcdn.com/ajax/bootstrap/3.3.7/bootstrap.min.js"
                asp-fallback-src="~/lib/bootstrap/dist/js/bootstrap.min.js"
                asp-fallback-test="window.jQuery && window.jQuery.fn && window.jQuery.fn.modal"
                crossorigin="anonymous"
                integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa">
        </script>
        <script src="~/js/site.min.js" asp-append-version="true"></script>
    </environment>



</body>
</html>