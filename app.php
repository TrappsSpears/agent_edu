<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <style>
      .users h2{
        font-size: 16px;
      }
      .users h3{
        font-size: 14px;
        margin-top: 10px;
      }
      .users .user-details img{
        width: 200px;
        height: 300px;
        object-fit: cover;
        margin-right: 15px;
        border-radius: 6px;
      }
      .users .user-details{
        padding: 10px;
        border-radius: 6px;
        background-color: #dddddd;
        width: fit-content;
        margin-top: 20px;
      }
      .users button{
        width: 100%;
        padding: 10px;
        font-size: 20px;
        font-weight: 600;
        background-color: #6074fc;
        border: none;
        border-radius: 6px;
        cursor: pointer;
      }
    </style>
    <title>App Dashboard</title>
</head>
<body>
  <?php
      include_once('dbh.php');
      $dbh = new Dbh();

      $selectUsers = $dbh->connect()->prepare("Select * From users");
      if (!$selectUsers->execute()) {
        echo 'Failed To Load  Posts';
    } else {
        $posts = $selectUsers->fetchAll(PDO::FETCH_ASSOC);
    }


?>
    <div class="users" style="min-height: 100vh;padding: 30px 20%;">
      <h1>Users To Attend</h1>
      <?php
      foreach($posts as $posts){ ?>
<div class="user-details">
        <h2>Name: <?= $posts["name"] ?></h2>
        <h2>Surname: <?= $posts["surname"] ?></h2>
        <h2>Phone number: <?= $posts["phone"] ?></h2>
        <h2>Choice: <?= $posts["prog_choice"] ?></h2>
        <h2>Intake: <?= $posts["intake"] ?></h2>
        <p> <?= $posts["add_info"] ?> </p>
        <div style="display: flex;">
          <div>
            <h3>Passport / Id</h3>
            <img src="assets/userpics/<?= $posts["passport"] ?>" alt="">
          </div>
          <div>
            <h3>Certificate</h3>
            <img src="assets/userpics/<?= $posts["certificate"] ?>" alt="">
          </div>
        </div>
        <div>
          <?php 
          if($posts["status"] == ""){ ?> 
          <form action="app.php" method='post'>
            <input type="hidden" name ='id' value='<?= $posts['user_id'] ?>'>
             <button name='attended'>Attended</button>
          </form>
        <?php } else echo "<button name='attended' style='background-color:green'>Done</button>";?>
          
         
        </div>
      </div>
    <?php  }  
    if(isset($_POST["attended"])){
      $id = $_POST['id'];
      $selectUsers = $dbh->connect()->prepare("UPDATE users SET status = 'done' WHERE user_id = ?");
    if (!$selectUsers->execute([$id])) {
      echo 'Failed To Load  Posts';
  } else {
      $posts = $selectUsers->fetchAll(PDO::FETCH_ASSOC);
  }
    }
    
    
    ?>
      
    </div>
    <div class="footer">
        Email: mapfumotapuwa18@gmail.com
          <div>
     <div>
         <p>All Rights Reserved 2024 prod</p>
     </div>
   </div>
     </div>
</body>
</html>