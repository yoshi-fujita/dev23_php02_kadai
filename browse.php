<?php
session_start();

$room_id = $_SESSION['room_id'];
$room = $_SESSION['room'];
$radius = $_SESSION['radius'];
$loc_lat = $_SESSION['loc_lat'];
$loc_lon = $_SESSION['loc_lon'];
$time_start = $_SESSION['time_start'];
$time_end = $_SESSION['time_end'];

// echo '<pre>';
// var_dump($room);
// var_dump($radius);
// var_dump($loc_lat);
// var_dump($loc_lon);
// var_dump($time_start);
// var_dump($time_end);
// echo '</pre>';

// bd 接続
try { // ID:'root', Password: 'root'
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

// 画像がポストされたら登録する
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $countfiles = count($_FILES['file']['name']);

  for( $i=0; $i<$countfiles; $i++ ) {
    $name = $_FILES['file']['name'][$i];
    $type = $_FILES['file']['type'][$i];
    $img = file_get_contents($_FILES['file']['tmp_name'][$i]);
    $size = $_FILES['file']['size'][$i];

    $stmt = $pdo->prepare('INSERT INTO imakoko_share_data(data_id, type, data, room_id, date) VALUES(NULL, :type, :data, :room_id, sysdate())');
    $stmt->bindValue(':type', 'image', PDO::PARAM_STR);
    $stmt->bindValue(':data', $img, PDO::PARAM_STR);
    $stmt->bindValue(':room_id', $room_id, PDO::PARAM_STR);
    $status = $stmt->execute();

    // echo '<pre>';
    // var_dump($size);
    // echo '</pre>';

    //４．データ登録処理後
    if($status === false){
      //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
      $error = $stmt->errorInfo();
      exit('ErrorMessage:'.$error[2]);
    }
  }
  header('Location: browse.php'); // POST をクリアするためにリロードする
}
?>

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
    <div id="myMap" style="width: 100vw; height: 30vh"></div>

    <div class="title_area">
      <a href="index.php"><img src="image/mappin.png" alt="アイコン" /></a>
      <h2>imakokoShare</h2>
    </div>
    <?php echo "<h3>$room &nbsp;" . substr($time_start, 0, 5) . "〜" . substr($time_end, 0, 5) . "</h3>" ?>

    <form method="post" enctype="multipart/form-data" id="photo_select">
      <input type="file" name="file[]" id="upload" accept="image/*" required multiple>
      <button type="submit" id="photo_submit">送信する</button>
    </form>
    <div id="preview"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
      let radius = <?php echo $radius ?>;
      console.log("radius=", radius);
    </script>
    <script src="js/map.js"></script>
    <script
      src="https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AlA_wWmDq6XGusZi013gjk7RqViYPAU2gsbcoYc9TilhoGqBMZAvZl2-ySPbpD2m"
      async
      defer
    ></script>
    <script src="js/photo.js"></script>

    <?php
    // SQL 上の画像を表示する
    $stmt = $pdo->prepare("SELECT * FROM imakoko_share_data WHERE room_id = :room_id ORDER BY data_id DESC");
    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_STR);
    $status = $stmt->execute();

    if ($status==false) {
      //execute（SQL実行時にエラーがある場合）
      $error = $stmt->errorInfo();
      exit("ErrorQuery:".$error[2]);
    } else {
      echo '<br />';
      echo '<div id="album">';
      while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $img = base64_encode($result['data']);
        echo "<img src=data:" . $result['type'] . ";base64," . $img . ">";
      }
      echo '</div>';
    }

    ?>

  </body>

</html>
