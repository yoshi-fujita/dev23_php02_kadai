let lat_me;
let lon_me;
let map;

//1．位置情報の取得に成功した時の処理
function mapsInit(position) {
  //lat=緯度、lon=経度 を取得
  lat_me = position.coords.latitude;
  lon_me = position.coords.longitude;
  console.log("自分", "lat=", lat_me, "lon=", lon_me);

  map = new Microsoft.Maps.Map("#myMap", {
    center: new Microsoft.Maps.Location(lat_me, lon_me), //Location center position
    mapTypeId: Microsoft.Maps.MapTypeId.load, //Type: [load, aerial,canvasDark,canvasLight,birdseye,grayscale,streetside]
    zoom: 17, //Zoom:1=zoomOut, 20=zoomUp[ 1~20 ]
  });

  map.setOptions({
    maxZoom: 20,
    minZoom: 1,
  });

  mapPushpin(map, lat_me, lon_me, "image/mappin.png", 8, 38);

  if(radius){
    const rad = radius * 360 / 40000000;
    console.log("rad=", rad);
    let polygon = new Microsoft.Maps.Polygon([
      new Microsoft.Maps.Location(lat_me - rad, lon_me - rad),
      new Microsoft.Maps.Location(lat_me + rad, lon_me - rad),
      new Microsoft.Maps.Location(lat_me + rad, lon_me + rad),
      new Microsoft.Maps.Location(lat_me - rad, lon_me + rad)], null);
    map.entities.push(polygon);
  }

  // create.php で座標の確定を待って座標を渡すためにここに入れる
  const html = `
    <input type="hidden" name="lat" value="${lat_me}"/>
    <input type="hidden" name="lon" value="${lon_me}"/>
  `;
  console.log(lat_me, lon_me, html);

  let container = $(".new_room");
  container.append(html);
}

//2． 位置情報の取得に失敗した場合の処理
function mapsError(error) {
  let e = "";
  if (error.code == 1) {
    //1＝位置情報取得が許可されてない（ブラウザの設定）
    e = "位置情報が許可されてません";
  }
  if (error.code == 2) {
    //2＝現在地を特定できない
    e = "現在位置を特定できません";
  }
  if (error.code == 3) {
    //3＝位置情報を取得する前にタイムアウトになった場合
    e = "位置情報を取得する前にタイムアウトになりました";
  }
  alert("エラー：" + e);
}

//3.位置情報取得オプション
const set = {
  enableHighAccuracy: true, //より高精度な位置を求める
  maximumAge: 200000, //最後の現在地情報取得が20秒以内であればその情報を再利用する設定
  timeout: 10000, //10秒以内に現在地情報を取得できなければ、処理を終了
};

//Main:位置情報を取得する処理 //getCurrentPosition :or: watchPosition
function GetMap() {
  navigator.geolocation.getCurrentPosition(mapsInit, mapsError, set);
}

function mapPushpin(map, lat, lon, imgURL, x_offset, y_offset) {
  const location = new Microsoft.Maps.Location(lat, lon);
  //Create custom Pushpin
  let pin = new Microsoft.Maps.Pushpin(location, {
    icon: imgURL, //base64,SVG,canvas,iframe
    width: "20px",
    hight: "20px",
    anchor: new Microsoft.Maps.Point(x_offset + 24, y_offset + 24), //position move
  });

  map.entities.push(pin);
}
