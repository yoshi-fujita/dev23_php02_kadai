# 課題：PHP, MySQLを使う

## ① 時空間を共有する人たちだけで写真・動画・ファイルを交換する - imakokoShare
- 結婚式、同窓会、運動会、スポーツの試合などで撮りまくった写真などを気軽に他の参加者と交換したいが、
  - LINEアルバム、クラウドファイル共有なので、友達になったりアカウント交換するのは面倒（そこまでの知り合いではない）
  - とはいえ、不特定多数の人が参加できる場所に、運動会の子供の写真や結婚式のプライベートの写真などを置くのは抵抗がある
  - 解決策 ⇒ 位置情報を利用して、時空間を共有し、かつ合言葉（room名）を共有している人だけが参加できる場を作る

## ② 工夫した点・こだわった点
- Bing MAP APIとFirebaseを使って、多人数で利用できるように作った

## ③ 質問・疑問（あれば）
- dbをroomごとに分けたかったが、"chat"以外にして使い分ける方法が分からなかった
- script type="module"　のスクリプトを別ファイルにする方法をまだ試せていない
- Bing MAP のロードに時間がかかり、それを待ってから行う処理がうまく記述できない。waitを入れたりしているが、タイミングによってはときどき動作がおかしくなる。
  
## ④ その他（感想、シェアしたいことなんでも）
- APIやFirebaseを使うと、思いの外簡単にアプリが作れて感動した。
- 退出機能まで手が回らなかった
- アバターが重ならないように配置したかったが、そこまで手が回っていないので、重なってしまう
- ブラウザによる位置情報取得を許可する必要がある
