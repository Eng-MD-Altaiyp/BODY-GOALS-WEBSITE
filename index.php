

<?php

include 'connaction.php';// mysql
$dateer=$itemer="";
$unameer=$passworder="";

if(isset($_POST['submit']))
 {
  // $Total = 0;
  $Type = $_POST['Type'];
  $Total = 0;
  $uname=$_POST['uname'];
  $password=$_POST['password'];
  $date = $_POST['date'];
  $items = isset($_POST['items']) ? $_POST['items'] : [];

  $Count = count($items);
              if($Type == "Daily")
              {
                $Total = (5 * $Count)+16;
              }
   if($Type == "Weekly")
  {
    $Total = (10 * $Count)+ 25;
  }
   if($Type == "Monthly")
  {
    $Total = (20 * $Count)+45;

  }


  if(empty($date) && !empty($items))
  {
    $dateer="Plaess Choose the Date";
    $at=" <script> 
                 alert('$dateer');
                 </script>";
                 
                 echo $at;
  }
  else if(empty($items) && !empty($date))
  {
    $itemer="Plaess Choose Houre Group";
    $at=" <script> 
                 alert('$itemer');
                 </script>";
                 
                 echo $at;
  }
  else if(empty($items) && empty($date))
  {
    $itemer="Plaess Choose Houre Group";
    $dateer="Plaess Choose the Date";
    $at=" <script> 
                 alert('$itemer \n $dateer');
                 </script>";
                 
                 echo $at;
  }
  else{
    if(
      empty($uname) || 
        empty($password)
        )
     {
         if(empty($uname))
         $unameer="* User Name is Required"; 
         $at=" <script> 
         alert('$unameer');
         </script>";
         
         echo $at;
         if(empty($password))
         $passworder="* Password  is Required";
         $at=" <script> 
         alert('$passworder');
         </script>";
         
         echo $at;
     }
     else{
         $check=0;
          if($uname && !preg_match("/^[a-zA-Z]/",$uname))
          {
             $unameerer="* Make sure not to enter numbers";
             $at=" <script> 
             alert('$unameerer');
             </script>";
             echo $at;
          }

          $ti = implode(", ", array_map('htmlspecialchars', $items));
          
          $search="SELECT uname,password FROM users WHERE uname='{$uname}' and password='{$password}'";
          $res=$connect->query($search);
          if($res->num_rows>0){
            $search="SELECT date,times,type FROM strength WHERE date='{$date}' and times='{$ti}' and type='{$Type}'";
            $res=$connect->query($search);
            if($res->num_rows>0){
              $at=" <script> 
              alert('This reservation already exists');
              </script>";
              
              echo $at;
            }
            else{
              
  // 
            $insert="INSERT INTO strength SET 
            date='{$date}',
            type='{$Type}',
            cost='{$Total}',
            times='{$ti}'
            ";

              $Sql=mysqli_query($connect,$insert);
              if($Sql)
              { 
                $at=" <script> 
                 alert('Your operation was successful!');
                 </script>";
                 
                 echo $at;
                //  echo header("location: ../index.php");
             }
             else
             {
                 $at=" <script> 
                 alert('Feiled');
                 </script>";
                 echo $at;
             }
            }
            //  echo header("location: ../index.php");
          }
 
     }
  //   echo "<h2>Received Data</h2>";
  // echo "Date: " . htmlspecialchars($date) . "<br>";
  // echo "Items: " . implode(", ", array_map('htmlspecialchars', $items)) . "<br>";
  }
  // echo "Items: " . implode(", ", array_map('htmlspecialchars', $items)) . "<br>";
  // $Count = count($items);
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/styles.css" />
    <title>BODY GOALS</title>
    
  </head>
  <body>



  <div id="myModald" class="modal">

  <div class="modal-content">
    <span class="closed">&times;</span>
    <h2>Daily booking</h2>
    <form method="POST">
      <div class="form-group">
        <label for="date">Choose Date:</label>
        <input type="date" id="date" name="date">
        <p></p>
        <span>User Name</span>
        <span id="req"><?php echo $dateer; ?></span>
        <input type="text" placeholder="User Name" name="uname">
        <input   name="Type" value="Daily">
        <p></p>

            <span>Pasword</span>
            <span id="req"><?php echo $dateer; ?></span>

            <input type="password" placeholder="Password" name="password">
            <span id="req"><?php echo $passworder; ?></span>

      </div>
      <table>
        <thead>
          <tr>
            <th>Choose</th>
            <span id="req"><?php echo $itemer; ?></span>
            <th>Available times</th>     
            <th>Available hours</th>
            <th>Cost</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td><input type="checkbox" id="item1" name="items[]" value="8 - 9 AM"></td>
          <td><label for="item1">8 - 9</label></td>
          <td><label for="item1">AM</label></td>
          <td><label for="item1">$5</label></td>
          </tr>
          <tr>
          <td><input type="checkbox" id="item1" name="items[]" value="10 - 11 AM"></td>
          <td><label for="item2">10 - 11</label></td>
          <td><label for="item2">AM</label></td>
          <td><label for="item2">$5</label></td>
          </tr>
          <tr>
          <td><input type="checkbox" id="item1" name="items[]" value="2 - 3 PM"></td>
          <td><label for="item3">2 - 3</label></td>
          <td><label for="item3">PM</label></td>
          <td><label for="item3">$5</label></td>
          </tr>
          <tr>
          <td><input type="checkbox" id="item1" name="items[]" value="4 - 5 PM"></td>
          <td><label for="item3">4 - 5</label></td>
          <td><label for="item3">PM</label></td>
          <td><label for="item3">$5</label></td>
          </tr>
          <tr> 
          <td><input type="checkbox" id="item1" name="items[]" value="8 - 9 PM"></td>
          <td><label for="item3">8 - 9</label></td>
          <td><label for="item3">PM</label></td>
          <td><label for="item3">$5</label></td>
          </tr>

          <!-- يمكنك إضافة المزيد من العناصر هنا -->
        </tbody>
      </table>
      <div class="form-group">
      <h5>Subscription price : <span>$16</span></h5>
      </div>
      <div class="form-group">
        <input type="submit" name="submit" value="إرسال"></input>
      </div>
    </form>
  </div>

</div>

<div id="myModalw" class="modal">

  <div class="modal-content">
    <span class="closew">&times;</span>
    <h2>Weekly booking</h2>
    <form method="POST">
      <div class="form-group">
        <label for="date">Choose Date:</label>
        <input type="date" id="date" name="date">
        <p></p>
        <span>User Name</span>
        <span id="req"><?php echo $dateer; ?></span>
        <input type="text" placeholder="User Name" name="uname">
        <input   name="Type" value="Weekly">
        <p></p>

            <span>Pasword</span>
            <span id="req"><?php echo $dateer; ?></span>

            <input type="password" placeholder="Password" name="password">
            <span id="req"><?php echo $passworder; ?></span>
      </div>
      <table>
        <thead>
          <tr>
            <th>Choose</th>
            <span id="req"><?php echo $itemer; ?></span>
            <th>Available times</th>     
            <th>Available hours</th>
            <th>Cost</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td><input type="checkbox" id="item1" name="items[]" value="Monday - Tuesday AM"></td>
          <td><label for="item1">Monday - Tuesday	</label></td>
          <td><label for="item1">AM</label></td>
          <td><label for="item1">$10</label></td>
          </tr>
          <tr>
          <td><input type="checkbox" id="item1" name="items[]" value="Wednesday - Thursday AM"></td>
          <td><label for="item2">Wednesday - Thursday</label></td>
          <td><label for="item2">AM</label></td>
          <td><label for="item2">$10</label></td>
          </tr>
          <tr>
          <td><input type="checkbox" id="item1" name="items[]" value="Saturday - Sunday AM"></td>
          <td><label for="item3">Saturday - Sunday	</label></td>
          <td><label for="item3">AM</label></td>
          <td><label for="item3">$10</label></td>
          </tr>
          <tr>
          <td><input type="checkbox" id="item1" name="items[]" value="Monday - Tuesday PM"></td>
          <td><label for="item1">Monday - Tuesday	</label></td>
          <td><label for="item1">PM</label></td>
          <td><label for="item1">$10</label></td>
          </tr>
          <tr>
          <td><input type="checkbox" id="item1" name="items[]" value="Wednesday - Thursday PM"></td>
          <td><label for="item2">Wednesday - Thursday</label></td>
          <td><label for="item2">PM</label></td>
          <td><label for="item2">$20</label></td>
          </tr>
          <tr>
          <td><input type="checkbox" id="item1" name="items[]" value="Saturday - Sunday PM"></td>
          <td><label for="item3">Saturday - Sunday	</label></td>
          <td><label for="item3">PM</label></td>
          <td><label for="item3">$10</label></td>
          </tr>
          

          <!-- يمكنك إضافة المزيد من العناصر هنا -->
        </tbody>
      </table>
      <div class="form-group">
      <h5>Subscription price : <span>$25</span></h5>
      </div>
      <div class="form-group">
        <input type="submit" name="submit" value="إرسال"></input>
      </div>
    </form>
  </div>

</div>


<div id="myModalm" class="modal">

  <div class="modal-content">
    <span class="closem">&times;</span>
    <h2>Monthly Reservation</h2>
    <form method="POST">
      <div class="form-group">
        <label for="date">Choose Date:</label>
        <input type="date" id="date" name="date">
        <p></p>
        <span>User Name</span>
        <span id="req"><?php echo $dateer; ?></span>
        <input type="text" placeholder="User Name" name="uname">
        <input   name="Type" value="Monthly">
        <p></p>

            <span>Pasword</span>
            <span id="req"><?php echo $dateer; ?></span>

            <input type="password" placeholder="Password" name="password">
            <span id="req"><?php echo $passworder; ?></span>

      </div>
      <table>
        <thead>
          <tr>
            <th>Choose</th>
            <span id="req"><?php echo $itemer; ?></span>
            <th>Available times</th>     
            <th>Available hours</th>
            <th>Cost</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td><input type="checkbox" id="item1" name="items[]" value="Daily AM"></td>
          <td><label for="item1">Daily</label></td>
          <td><label for="item1">AM</label></td>
          <td><label for="item1">$20</label></td>
          </tr>
          <tr>
          <td><input type="checkbox" id="item1" name="items[]" value="in interrupted form AM"></td>
          <td><label for="item2">in interrupted form</label></td>
          <td><label for="item2">AM</label></td>
          <td><label for="item2">$20</label></td>
          </tr>
          <tr>
          <td><input type="checkbox" id="item1" name="items[]" value="Daily PM"></td>
          <td><label for="item3">Daily</label></td>
          <td><label for="item3">PM</label></td>
          <td><label for="item3">$20</label></td>
          </tr>
          <tr>
          <td><input type="checkbox" id="item1" name="items[]" value="in interrupted form PM"></td>
          <td><label for="item3">in interrupted form</label></td>
          <td><label for="item3">PM</label></td>
          <td><label for="item3">$20</label></td>
          </tr>

          <!-- يمكنك إضافة المزيد من العناصر هنا -->
        </tbody>
      </table>
      <div class="form-group">
      <h5>Subscription price : <span>$45</span></h5>
      </div>
      <div class="form-group">
        <input type="submit" name="submit" value="إرسال"></input>
      </div>
    </form>
  </div>

</div>





    <nav>
      <div class="nav__logo">
        <a href="#"><img src="assets/logo.jpeg" alt="logo" /></a>
      </div>
      <ul class="nav__links">
        <li class="link"><a href="#">Home</a></li>
        <li class="link"><a href="#Program">Program</a></li>
        <li class="link"><a href="#Service">Service</a></li>
        <li class="link"><a href="#">About</a></li>
        <li class="link"><a href="#">Community</a></li>
      </ul>
      <a href="Log-sing/Log.php"><button class="btn">Log In</button></a>
    </nav>
    <header class="section__container header__container">
      <div class="header__content">
        <span class="bg__blur"></span>
        <span class="bg__blur header__blur"></span>
        <h1>ACHIEVE YOUR GOALS WITH <span>BODY GOALS</span></h1>
        <button class="btn">Get Started</button>
      </div>
      <div class="header__image">
        <img src="assets/header.png" alt="header" />
      </div>
    </header>

    <section class="section__container explore__container" id="Program">
      <div class="explore__header">
        <h2 class="section__header">EXPLORE OUR PROGRAM</h2>
        <div class="explore__nav">
          <span><i class="ri-arrow-left-line"></i></span>
          <span><i class="ri-arrow-right-line"></i></span>
        </div>
      </div>
      <div class="explore__grid">
        <div class="explore__card">
          <span><i class="ri-boxing-fill"></i></span>
          <h4>Strength</h4>
          <p>
            Embrace the essence of strength as we delve into its various
            dimensions physical, mental, and emotional.
          </p>
          <a href="Strength.php">Join Now <i class="ri-arrow-right-line"></i></a>
        </div>
        <div class="explore__card">
          <span><i class="ri-heart-pulse-fill"></i></span>
          <h4>Physical Fitness</h4>
          <p>
            It encompasses a range of activities that improve health, strength,
            flexibility, and overall well-being.
          </p>
          <a href="Physical Fitness.php">Join Now <i class="ri-arrow-right-line"></i></a>
        </div>
        <div class="explore__card">
          <span><i class="ri-run-line"></i></span>
          <h4>Fat Lose</h4>
          <p>
            Through a combination of workout routines and expert guidance, we'll
            empower you to reach your goals.
          </p>
          <a href="Fat Lose.php">Join Now <i class="ri-arrow-right-line"></i></a>
        </div>
        <div class="explore__card">
          <span><i class="ri-shopping-basket-fill"></i></span>
          <h4>Weight Gain</h4>
          <p>
            Designed for individuals, our program offers an effective approach
            to gaining weight in a sustainable manner.
          </p>
          <a href="Weight Gain.php">Join Now <i class="ri-arrow-right-line"></i></a>
        </div>
      </div>
    </section>

    <section class="section__container class__container">
      <div class="class__image">
        <span class="bg__blur"></span>
        <img src="assets/class-1.jpg" alt="class" class="class__img-1" />
        <img src="assets/class-2.jpg" alt="class" class="class__img-2" />
      </div>
      <div class="class__content">
        <h2 class="section__header">THE CLASS YOU WILL GET HERE</h2>
        <p>
          Led by our team of expert and motivational instructors, "The Class You
          Will Get Here" is a high-energy, results-driven session that combines
          a perfect blend of cardio, strength training, and functional
          exercises. Each class is carefully curated to keep you engaged and
          challenged, ensuring you never hit a plateau in your fitness
          endeavors.
        </p>
        <a href="#Program"><button class="btn">Book A Class</button></a>
      </div>
    </section>

    <section class="section__container join__container" >
      <h2 class="section__header">WHY JOIN US ?</h2>
      <p class="section__subheader">
        Our diverse membership base creates a friendly and supportive
        atmosphere, where you can make friends and stay motivated.
      </p>
      <div class="join__image">
        <img src="assets/join.jpg" alt="Join" />
        <div class="join__grid">
          <div class="join__card">
            <span><i class="ri-user-star-fill"></i></span>
            <div class="join__card__content">
              <h4>Personal Trainer</h4>
              <p>Unlock your potential with our expert Personal Trainers.</p>
            </div>
          </div>
          <div class="join__card">
            <span><i class="ri-vidicon-fill"></i></span>
            <div class="join__card__content">
              <h4>Practice Sessions</h4>
              <p>Elevate your fitness with practice sessions.</p>
            </div>
          </div>
          <div class="join__card">
            <span><i class="ri-building-line"></i></span>
            <div class="join__card__content">
              <h4>Good Management</h4>
              <p>Supportive management, for your fitness success.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section__container price__container" id="Service">
      <h2 class="section__header">OUR PRICING PLAN</h2>
      <p class="section__subheader">
        Our pricing plan comes with various membership tiers, each tailored to
        cater to different preferences and fitness aspirations.
      </p>
      <div class="price__grid">
        <div class="price__card">
          <div class="price__card__content">
            <h4>Basic Plan</h4>
            <h3>$16</h3>
            <p>
              <i class="ri-checkbox-circle-line"></i>
              Smart workout plan
            </p>
            <p>
              <i class="ri-checkbox-circle-line"></i>
              At home workouts
            </p>
          </div>
          <a id="openModalBtnd"><button class="btn price__btn">Join Now</button></a>
        </div>
        <div class="price__card">
          <div class="price__card__content">
            <h4>Weekly Plan</h4>
            <h3>$25</h3>
            <p>
              <i class="ri-checkbox-circle-line"></i>
              PRO Gyms
            </p>
            <p>
              <i class="ri-checkbox-circle-line"></i>
              Smart workout plan
            </p>
            <p>
              <i class="ri-checkbox-circle-line"></i>
              At home workouts
            </p>
          </div>
          <a id="openModalBtnw"><button class="btn price__btn">Join Now</button></a>
        </div>
        <div class="price__card">
          <div class="price__card__content">
            <h4>Monthly Plan</h4>
            <h3>$45</h3>
            <p>
              <i class="ri-checkbox-circle-line"></i>
              ELITE Gyms & Classes
            </p>
            <p>
              <i class="ri-checkbox-circle-line"></i>
              PRO Gyms
            </p>
            <p>
              <i class="ri-checkbox-circle-line"></i>
              Smart workout plan
            </p>
            <p>
              <i class="ri-checkbox-circle-line"></i>
              At home workouts
            </p>
            <p>
              <i class="ri-checkbox-circle-line"></i>
              Personal Training
            </p>
          </div>
          <a id="openModalBtnm"><button class="btn price__btn">Join Now</button></a>
        </div>
      </div>
    </section>

   
    <script>
    // Get the modal element
    var modald = document.getElementById("myModald");
    var modalw = document.getElementById("myModalw");
    var modalm = document.getElementById("myModalm");

    var btnd = document.getElementById("openModalBtnd");
    var btnw = document.getElementById("openModalBtnw");
    var btnm = document.getElementById("openModalBtnm");

    var spand = document.getElementsByClassName("closed")[0];
    var spanw = document.getElementsByClassName("closew")[0];
    var spanm = document.getElementsByClassName("closem")[0];

    // When the user clicks the button, open the modal
    btnd.onclick = function() {
        modald.style.display = "block";
    }
    btnw.onclick = function() {
        modalw.style.display = "block";
    }
    btnm.onclick = function() {
        modalm.style.display = "block";
    }
    // When the user clicks on the close button (x), close the modal
    spand.onclick = function() {
        modald.style.display = "none";
    }
    spanw.onclick = function() {
        modalw.style.display = "none";
    }
    spanm.onclick = function() {
        modalm.style.display = "none";
    }

    // Show alert based on query parameter
    // document.addEventListener("DOMContentLoaded", function() {
    //     const urlParams = new URLSearchParams(window.location.search);
    //     const success = urlParams.get('success');

    //     if (success === 'true') {
    //         document.getElementById("successAlert").style.display = 'block';
    //     } else if (success === 'false') {
    //         document.getElementById("errorAlert").style.display = 'block';
    //     }
    // });
</script>
  </body>
</html>
