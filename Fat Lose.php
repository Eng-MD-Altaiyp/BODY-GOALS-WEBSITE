
<?php

include 'connaction.php';
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
                $Total = (5 * $Count);
              }
   if($Type == "Weekly")
  {
    $Total = (10 * $Count);
  }
   if($Type == "Monthly")
  {
    $Total = (20 * $Count);
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
    <style>
    
    .modal-content {
      background-color: var(--primary-color-light);
      color: var(--text-light);
      margin: 5% auto;
      padding: 30px 25px;
      border-radius: 15px;
      width: 90%;
      max-width: 600px;
      box-shadow: 0 0 15px rgba(0,0,0,0.4);
      animation: slideIn 0.5s ease;
      position: relative;
    }

    .closew {
      color: var(--secondary-color);
      position: absolute;
      top: 15px;
      right: 20px;
      font-size: 24px;
      font-weight: bold;
      cursor: pointer;
    }

    .closew:hover {
      color: var(--secondary-color-dark);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: var(--secondary-color);
    }

    .form-group {
      margin-bottom: 20px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    input[type="text"],
    input[type="date"],
    input[type="password"] {
      padding: 10px;
      border: none;
      border-radius: 8px;
      background-color: var(--primary-color-extra-light);
      color: var(--text-light);
    }

    input[type="submit"] {
      background-color: var(--secondary-color);
      color: var(--white);
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: var(--secondary-color-dark);
    }

    .error {
      color: #ff6666;
      font-size: 13px;
    }

    .table-container {
      overflow-x: auto;
      margin-top: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: var(--primary-color-extra-light);
      color: var(--text-light);
      border-radius: 10px;
      overflow: hidden;
    }

    table th, table td {
      padding: 12px 15px;
      text-align: left;
    }

    table th {
      background-color: var(--primary-color);
      color: var(--secondary-color);
    }

    table tr:nth-child(even) {
      background-color: var(--primary-color-light);
    }

    @keyframes slideIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
  </head>
  <body>
  
  

  <div id="myModald" class="modal">

  <div class="modal-content" id="modalBox">
  <span class="closew" id="closeModal">&times;</span>
  <h2>Weekly Booking</h2>
  <form method="POST">
    <div class="form-group">
      <label for="date">Choose Date:</label>
      <input type="date" id="date" name="date">

      <label for="uname">User Name</label>
      <span class="error"><?php echo $dateer; ?></span>
      <input type="text" id="uname" placeholder="User Name" name="uname">

      <input type="hidden" name="Type" value="Weekly">

      <label for="password">Password</label>
      <span class="error"><?php echo $passworder; ?></span>
      <input type="password" id="password" placeholder="Password" name="password">
    </div>

    <div class="table-container">
      <span class="error"><?php echo $itemer; ?></span>
      <table>
        <thead>
          <tr>
            <th>Choose</th>
            <th>Available Days</th>
            <th>Time</th>
            <th>Cost</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="checkbox" id="item1" name="items[]" value="Monday - Tuesday AM"></td>
            <td><label for="item1">Monday - Tuesday</label></td>
            <td><label for="item1">AM</label></td>
            <td><label for="item1">$10</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="item2" name="items[]" value="Wednesday - Thursday AM"></td>
            <td><label for="item2">Wednesday - Thursday</label></td>
            <td><label for="item2">AM</label></td>
            <td><label for="item2">$10</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="item3" name="items[]" value="Saturday - Sunday AM"></td>
            <td><label for="item3">Saturday - Sunday</label></td>
            <td><label for="item3">AM</label></td>
            <td><label for="item3">$10</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="item4" name="items[]" value="Monday - Tuesday PM"></td>
            <td><label for="item4">Monday - Tuesday</label></td>
            <td><label for="item4">PM</label></td>
            <td><label for="item4">$10</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="item5" name="items[]" value="Wednesday - Thursday PM"></td>
            <td><label for="item5">Wednesday - Thursday</label></td>
            <td><label for="item5">PM</label></td>
            <td><label for="item5">$20</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="item6" name="items[]" value="Saturday - Sunday PM"></td>
            <td><label for="item6">Saturday - Sunday</label></td>
            <td><label for="item6">PM</label></td>
            <td><label for="item6">$10</label></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="form-group">
      <input type="submit" name="submit" value="إرسال">
    </div>
  </form>
</div>

<script>
  // JavaScript to close the modal
  document.getElementById("closeModal").addEventListener("click", function () {
    document.getElementById("modalBox").style.display = "none";
  });
</script>




</div>

<div id="myModalw" class="modal">

<div class="modal-content" id="modalBox">
  <span class="closew" id="closeModal">&times;</span>
  <h2>Weekly Booking</h2>
  <form method="POST">
    <div class="form-group">
      <label for="date">Choose Date:</label>
      <input type="date" id="date" name="date">

      <label for="uname">User Name</label>
      <span class="error"><?php echo $dateer; ?></span>
      <input type="text" id="uname" placeholder="User Name" name="uname">

      <input type="hidden" name="Type" value="Weekly">

      <label for="password">Password</label>
      <span class="error"><?php echo $passworder; ?></span>
      <input type="password" id="password" placeholder="Password" name="password">
    </div>

    <div class="table-container">
      <span class="error"><?php echo $itemer; ?></span>
      <table>
        <thead>
          <tr>
            <th>Choose</th>
            <th>Available Days</th>
            <th>Time</th>
            <th>Cost</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="checkbox" id="item1" name="items[]" value="Monday - Tuesday AM"></td>
            <td><label for="item1">Monday - Tuesday</label></td>
            <td><label for="item1">AM</label></td>
            <td><label for="item1">$10</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="item2" name="items[]" value="Wednesday - Thursday AM"></td>
            <td><label for="item2">Wednesday - Thursday</label></td>
            <td><label for="item2">AM</label></td>
            <td><label for="item2">$10</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="item3" name="items[]" value="Saturday - Sunday AM"></td>
            <td><label for="item3">Saturday - Sunday</label></td>
            <td><label for="item3">AM</label></td>
            <td><label for="item3">$10</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="item4" name="items[]" value="Monday - Tuesday PM"></td>
            <td><label for="item4">Monday - Tuesday</label></td>
            <td><label for="item4">PM</label></td>
            <td><label for="item4">$10</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="item5" name="items[]" value="Wednesday - Thursday PM"></td>
            <td><label for="item5">Wednesday - Thursday</label></td>
            <td><label for="item5">PM</label></td>
            <td><label for="item5">$20</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="item6" name="items[]" value="Saturday - Sunday PM"></td>
            <td><label for="item6">Saturday - Sunday</label></td>
            <td><label for="item6">PM</label></td>
            <td><label for="item6">$10</label></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="form-group">
      <input type="submit" name="submit" value="إرسال">
    </div>
  </form>
</div>

<script>
  // JavaScript to close the modal
  document.getElementById("closeModal").addEventListener("click", function () {
    document.getElementById("modalBox").style.display = "none";
  });
</script>



</div>


<div id="myModalm" class="modal">

<div class="modal-content" id="modalBox">
  <span class="closew" id="closeModal">&times;</span>
  <h2>Weekly Booking</h2>
  <form method="POST">
    <div class="form-group">
      <label for="date">Choose Date:</label>
      <input type="date" id="date" name="date">

      <label for="uname">User Name</label>
      <span class="error"><?php echo $dateer; ?></span>
      <input type="text" id="uname" placeholder="User Name" name="uname">

      <input type="hidden" name="Type" value="Weekly">

      <label for="password">Password</label>
      <span class="error"><?php echo $passworder; ?></span>
      <input type="password" id="password" placeholder="Password" name="password">
    </div>

    <div class="table-container">
      <span class="error"><?php echo $itemer; ?></span>
      <table>
        <thead>
          <tr>
            <th>Choose</th>
            <th>Available Days</th>
            <th>Time</th>
            <th>Cost</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="checkbox" id="item1" name="items[]" value="Monday - Tuesday AM"></td>
            <td><label for="item1">Monday - Tuesday</label></td>
            <td><label for="item1">AM</label></td>
            <td><label for="item1">$10</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="item2" name="items[]" value="Wednesday - Thursday AM"></td>
            <td><label for="item2">Wednesday - Thursday</label></td>
            <td><label for="item2">AM</label></td>
            <td><label for="item2">$10</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="item3" name="items[]" value="Saturday - Sunday AM"></td>
            <td><label for="item3">Saturday - Sunday</label></td>
            <td><label for="item3">AM</label></td>
            <td><label for="item3">$10</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="item4" name="items[]" value="Monday - Tuesday PM"></td>
            <td><label for="item4">Monday - Tuesday</label></td>
            <td><label for="item4">PM</label></td>
            <td><label for="item4">$10</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="item5" name="items[]" value="Wednesday - Thursday PM"></td>
            <td><label for="item5">Wednesday - Thursday</label></td>
            <td><label for="item5">PM</label></td>
            <td><label for="item5">$20</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="item6" name="items[]" value="Saturday - Sunday PM"></td>
            <td><label for="item6">Saturday - Sunday</label></td>
            <td><label for="item6">PM</label></td>
            <td><label for="item6">$10</label></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="form-group">
      <input type="submit" name="submit" value="إرسال">
    </div>
  </form>
</div>

<script>
  // JavaScript to close the modal
  document.getElementById("closeModal").addEventListener("click", function () {
    document.getElementById("modalBox").style.display = "none";
  });
</script>



</div>




    <nav>
      <div class="nav__logo">
        <a href="#"><img src="assets/logo.jpeg" alt="logo" /></a>
      </div>
      <ul class="nav__links">
        <li class="link"><a href="index.php">Home</a></li>
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
        <h1>Fat Lose</h1>
      </div>
      <div class="header__image">
        <img src="assets/22.png" alt="header" />
      </div>
    </header>

    <section class="section__container explore__container" id="Program">
      <div class="explore__header">
        <h2 class="section__header">SUBTYPE</h2>
      </div>
      <div class="explore__grid">
        <div class="explore__card">
          <span><i class="ri-boxing-fill"></i></span>
          <h4>daily</h4>
          <p>
            Embrace the essence of strength as we delve into its various
            dimensions physical, mental, and emotional.
          </p>
          <a id="openModalBtnd">Join Now <i class="ri-arrow-right-line"></i></a>
          <!-- <button id="openModalBtn" class="ri-arrow-right-line">Join Now</button> -->

        </div>
        <div class="explore__card">
          <span><i class="ri-heart-pulse-fill"></i></span>
          <h4>weekly</h4>
          <p>
            It encompasses a range of activities that improve health, strength,
            flexibility, and overall well-being.
          </p>
          <a id="openModalBtnw">Join Now <i class="ri-arrow-right-line"></i></a>
        </div>
        <div class="explore__card">
          <span><i class="ri-run-line"></i></span>
          <h4>Monthly</h4>
          <p>
            Through a combination of workout routines and expert guidance, we'll
            empower you to reach your goals.
          </p>
          <a id="openModalBtnm">Join Now <i class="ri-arrow-right-line"></i></a>
        </div>
        <!-- <div class="explore__card">
          <span><i class="ri-shopping-basket-fill"></i></span>
          <h4>Weight Gain</h4>
          <p>
            Designed for individuals, our program offers an effective approach
            to gaining weight in a sustainable manner.
          </p>
          <a href="#">Join Now <i class="ri-arrow-right-line"></i></a>
        </div> -->
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
