<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style/style.css">
</head>

<body>
  <h1 class="title">PHPで掲示板アプリ</h1>
  <hr>
  <div class="boardWrapper">
    <section>
      <article>
        <div class="wrapper">
          <div class="nameArea">
            <span>名前：</span>
            <p class="username">tee</p>
            <time>:2022/7/15</time>
          </div>
          <p class="comment">手書きのコメントです。</p>
        </div>
      </article>
    </section>
    <form class="formWrapper">
      <div>
        <input type="submit" value="書き込む">
        <label for="username">名前：</label>
        <input type="text" name="username">
      </div>
      <div>
        <textarea class="commentTextArea"></textarea>
      </div>
    </form>
  </div>
</body>

</html>