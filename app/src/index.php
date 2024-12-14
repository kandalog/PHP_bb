<?php
// dateで生成される時間のTimeZoneを設定
date_default_timezone_set("Asia/Tokyo");

$comment_array = array();
$error_messages = array();

// DB接続
try {
  $pdo = new PDO('mysql:host=db;dbname=bb', 'root', 'root');
} catch (PDOException $e) {
  echo $e->getMessage();
}

// ボタンを推したとき
if (!empty($_POST['submitButton'])) {
  $postDate = date("Y-m-d H:i:s");

  // validation
  if (empty($_POST["username"])) {
    $error_messages["username"] = "名前を入力してください";
  }

  if (empty($_POST["comment"])) {
    $error_messages["comment"] = "コメントを入力してください";
  }

  if (empty($error_messages)) {
    try {
      $stmt = $pdo->prepare("INSERT INTO `bb-table` (`username`, `comment`, `postDate`) VALUES (:username, :comment, :postDate)");
      $stmt->bindParam(':username', $_POST["username"], PDO::PARAM_STR);
      $stmt->bindParam(':comment', $_POST["comment"],  PDO::PARAM_STR);
      $stmt->bindParam(':postDate', $postDate,  PDO::PARAM_STR);

      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}


// DBからコメントデータを取得する
$sql = "SELECT * FROM `bb-table`";
$comment_array = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style/style.css">
</head>

<body>
  <?php foreach ($error_messages as $message) : ?>
    <p><?php echo $message ?></p>
  <?php endforeach ?>
  <h1 class="title">PHPで掲示板アプリ</h1>
  <hr>
  <div class="boardWrapper">
    <section>
      <?php foreach ($comment_array as $comment) : ?>
        <article>
          <div class="wrapper">
            <div class="nameArea">
              <span>名前：</span>
              <p class="username"><?php echo $comment["username"] ?></p>
              <time><?php echo $comment["postDate"] ?></time>
            </div>
            <p class="comment"><?php echo $comment["comment"] ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </section>
    <form class="formWrapper" method="POST">
      <div>
        <input type="submit" value="書き込む" name="submitButton">
        <label for="username">名前：</label>
        <input type="text" name="username">
      </div>
      <div>
        <textarea class="commentTextArea" name="comment"></textarea>
      </div>
    </form>
  </div>
</body>

</html>