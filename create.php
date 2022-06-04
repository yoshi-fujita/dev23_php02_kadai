<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="G'sアカデミー課題 PHP" />
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" type="image/png" href="image/mappin.png" />
    <title>imakokoShare</title>
  </head>
  <body>
    <div id="myMap" style="width: 100vw; height: 100vh"></div>

    <div class="title_area">
      <a href="index.php"><img src="image/mappin.png" alt="アイコン" /></a>
      <h2>imakokoShare　共有ルームをつくる</h2>
      <a
        href="https://github.com/yoshi-fujita/dev23_php02_kadai/blob/main/README.md"
        target="_blank"
        >help</a
      >
    </div>

    <?php
      date_default_timezone_set('Asia/Tokyo');
      $h_start = date("H:i");
    ?>

    <form action="create_set.php" method="post" class="new_room">
      <p>room名&nbsp; <input type="text" name="room" required/></p>
      <p>半径 (m) <input type="number" name="radius" value="50" required/></p>
      <p>開始時刻 <input type="time" name="start" value=<?php echo $h_start; ?> required/></p>
      <p>終了時刻 <input type="time" name="end" value="00:00" required/></p>
      <input type="submit" value="共有ルームをつくる"/>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
      let radius = 0;
      console.log("radius=", radius);
    </script>
    <script src="js/map.js"></script>
    <script
      src="https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AlA_wWmDq6XGusZi013gjk7RqViYPAU2gsbcoYc9TilhoGqBMZAvZl2-ySPbpD2m"
      async
      defer
    ></script>
  </body>

</html>
