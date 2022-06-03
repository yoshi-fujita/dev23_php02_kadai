<?php
header('Expires: Tue, 1 Jan 2019 00:00:00 GMT');
header('Last-Modified:'. gmdate( 'D, d M Y H:i:s' ). 'GMT');
header('Cache-Control:no-cache,no-store,must-revalidate,max-age=0');
header('Cache-Control:pre-check=0,post-check=0',false);
header('Pragma:no-cache');

session_start();

//1. POSTデータ取得
$room = $_POST['room'];

//2. DB接続します
try { // ID:'root', Password: 'root'
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．データ取得SQL作成（同じroom名があった場合、最新のもの１つを取得。本来は場所も確認すべき）
$stmt = $pdo->prepare("SELECT * FROM imakoko_share_room WHERE room = :room ORDER BY room_id DESC LIMIT 1");
$stmt->bindParam(':room', $room, PDO::PARAM_STR);
$status = $stmt->execute();

//３．room の存在チェック

// 現在地、現在時刻、指定room名で有効なroomがあるかどうかを確認し、なければエラーメッセージを出してトップページに戻る。
// 有効な room があれば、ローカルストレージにその room_id を保存時して browse.php に進む



if ($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
} else {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo '<pre>';
    // var_dump($result['room_id']);
    // var_dump($result['loc_lat']);
    // var_dump($result['loc_lon']);
    // var_dump($result['radius']);
    // var_dump($result['time_start']);
    // var_dump($result['time_end']);
    // var_dump($result['room']);
    // echo '</pre>';

    $_SESSION['room_id'] = $result['room_id'];
    $_SESSION['room'] = $result['room'];
    $_SESSION['radius'] = $result['radius'];
    $_SESSION['loc_lat'] = $result['loc_lat'];
    $_SESSION['loc_lon'] = $result['loc_lon'];
    $_SESSION['time_start'] = $result['time_start'];
    $_SESSION['time_end'] = $result['time_end'];

    // 次のページへリダイレクト
    header('Location: browse.php');    
  }

?>
