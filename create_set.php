<?php
header('Expires: Tue, 1 Jan 2019 00:00:00 GMT');
header('Last-Modified:'. gmdate( 'D, d M Y H:i:s' ). 'GMT');
header('Cache-Control:no-cache,no-store,must-revalidate,max-age=0');
header('Cache-Control:pre-check=0,post-check=0',false);
header('Pragma:no-cache');

session_start();

// POSTデータ取得
$room = $_POST['room'];
$radius = $_POST['radius'];
$loc_lat = $_POST['lat'];
$loc_lon = $_POST['lon'];
$time_start = $_POST['start'];
$time_end = $_POST['end'];

// echo '<pre>';
// var_dump($room);
// var_dump($radius);
// var_dump($loc_lat);
// var_dump($loc_lon);
// var_dump($time_start);
// var_dump($time_end);
// echo '</pre>';

$_SESSION['room'] = $room;
$_SESSION['radius'] = $radius;
$_SESSION['loc_lat'] = $loc_lat;
$_SESSION['loc_lon'] = $loc_lon;
$_SESSION['time_start'] = $time_start;
$_SESSION['time_end'] = $time_end;

// DB接続
try { // ID:'root', Password: 'root'
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

// データ登録
$stmt = $pdo->prepare('INSERT INTO imakoko_share_room(room_id, loc_lat, loc_lon, radius, time_start, time_end, room, date) VALUES(NULL, :loc_lat, :loc_lon, :radius, :time_start, :time_end, :room, sysdate())');
$stmt->bindValue(':room', $room, PDO::PARAM_STR);
$stmt->bindValue(':radius', $radius, PDO::PARAM_INT);
$stmt->bindValue(':loc_lat', $loc_lat, PDO::PARAM_STR);
$stmt->bindValue(':loc_lon', $loc_lon, PDO::PARAM_STR);
$stmt->bindValue(':time_start', $time_start, PDO::PARAM_STR);
$stmt->bindValue(':time_end', $time_end, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if($status === false){
  // SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{
  // room_id を取得
  $stmt = $pdo->prepare("SELECT * FROM imakoko_share_room WHERE room = :room ORDER BY room_id DESC LIMIT 1");
  $stmt->bindValue(':room', $room, PDO::PARAM_STR);
  $status = $stmt->execute();
  if($status === false){
    // SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit('ErrorMessage:'.$error[2]);
  }else{
    // room_id をセッション変数にセット
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['room_id'] = $result['room_id'];
  }
  // 次のページへリダイレクト
  header('Location: browse.php');
}
