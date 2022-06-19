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
      <h2>imakokoShare</h2>
      <a
        href="https://github.com/yoshi-fujita/dev23_php02_kadai/blob/main/README.md"
        target="_blank"
        >help</a
      >
    </div>

    <form method="POST" action="check.php" class="room_set">
      <input type="text" name="room" required/>
      <input type="submit" value="共有ルームに入る"></input>
    </form>
    
    <p class="room_create">
      <button id="create_page">共有ルームを作る</button>
    </p>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
      let radius = 0;
      console.log("radius=", radius);
    </script>
    <script src="js/map.js"></script>
    <script>
      $("#create_page").on("click", function () {
        window.location.href = 'create.php';
      });
    </script>
    <script
      src="https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=***********"
      async
      defer
    ></script>
</body>

</html>
