<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet" />
    <title>質問</title>
  </head>
  <body class="question">
    <section>
      <div class="title_wrapper">
        <h1>理想のお相手診断テスト</h1>
      </div>
      <div class="desc_wrapper">
        <p>
          この質問に答えるとあなたの理想の異性が分かる！<br>
          質問は全部10個<br>
          1番あなたの考えに近い答えを回答してね
        </p>
      </div>
      <form class="form_wrapper" action="result.php?id=<?= $_GET['id']; ?>" method="post">
        <div id="form_1" class="form_item">
          <h2 class="form_title">QUESTION 1</h2>
          <p class="form_question">
            あなたは記念日にサプライズで恋人からアクセサリーのプレゼントをもらいました。さて、それは次のうちどれだった？
          </p>
          <div class="form-group form_answer">
            <div class="custom-control custom-radio">
              <input data-number="btn_1" type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio1">イヤリング・ピアス</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_1" type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio2">ネックレス</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_1" type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio3">リング</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_1" type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio4">ブレスレット</label>
            </div>
          </div>
          <div class="form_btn">
            <!-- <button type="button" class="btn prev">前へ</button> -->
            <button type="button" id="btn_1" class="btn next">次へ</button>
          </div>
        </div>


        <div id="form_2" class="form_item">
          <h2 class="form_title">QUESTION 2</h2>
          <p class="form_question">
          あなたは恋人と2人きりでカフェに入りました。オーダーの際、一番初めに頼むドリンクは次のうちどれ？
          </p>
          <div class="form-group form_answer">
            <div class="custom-control custom-radio">
              <input data-number="btn_2" type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio5">カフェラテ</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_2" type="radio" id="customRadio6" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio6">ソーダ水</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_2" type="radio" id="customRadio7" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio7">ハーブティー</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_2" type="radio" id="customRadio8" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio8">フルーツジュース</label>
            </div>
          </div>
          <div class="form_btn">
            <button type="button" class="btn prev">前へ</button>
            <button type="button" id="btn_2" class="btn next">次へ</button>
          </div>
        </div>


        <div id="form_3" class="form_item">
          <h2 class="form_title">QUESTION 3</h2>
          <p class="form_question">
            バニラアイスにトッピングするなら次のうちどれ？
          </p>
          <div class="form-group form_answer">
            <div class="custom-control custom-radio">
              <input data-number="btn_3" type="radio" id="customRadio9" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio9">イチゴジャム</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_3" type="radio" id="customRadio10" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio10">抹茶シロップ</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_3" type="radio" id="customRadi11" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi11">ナッツ&ドライフルーツ</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_3" type="radio" id="customRadi12" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi12">何もかけない</label>
            </div>
          </div>
          <div class="form_btn">
            <button type="button" class="btn prev">前へ</button>
            <button type="button" id="btn_3" class="btn next">次へ</button>
          </div>
        </div>


        <div id="form_4" class="form_item">
          <h2 class="form_title">QUESTION 4</h2>
          <p class="form_question">
            あなたは寿司屋さんに来ています。この中でまず初めに頼むネタは？
          </p>
          <div class="form-group form_answer">
            <div class="custom-control custom-radio">
              <input data-number="btn_4" type="radio" id="customRadio13" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio13">マグロ</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_4" type="radio" id="customRadio14" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio14">タイ</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_4" type="radio" id="customRadi15" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi15">サーモン</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_4" type="radio" id="customRadi16" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi16">ウニ</label>
            </div>
          </div>
          <div class="form_btn">
            <button type="button" class="btn prev">前へ</button>
            <button type="button" id="btn_4" class="btn next">次へ</button>
          </div>
        </div>


        <div id="form_5" class="form_item">
          <h2 class="form_title">QUESTION 5</h2>
          <p class="form_question">
          急な通り雨。あなたは傘を持たずに雨宿りをしています。しばらくして雨が止むと……そこには何が目に入った？
          </p>
          <div class="form-group form_answer">
            <div class="custom-control custom-radio">
              <input data-number="btn_5" type="radio" id="customRadio17" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio17">濡れた子犬</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_5" type="radio" id="customRadio18" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio18">水たまり</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_5" type="radio" id="customRadi19" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi19">空にかかる虹</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_5" type="radio" id="customRadi20" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi20">傘を持った恋人</label>
            </div>
          </div>
          <div class="form_btn">
            <button type="button" class="btn prev">前へ</button>
            <button type="button" id="btn_5" class="btn next">次へ</button>
          </div>
        </div>


        <div id="form_6" class="form_item">
          <h2 class="form_title">QUESTION 6</h2>
          <p class="form_question">
          あなたは、猫を飼っています。その猫は、普段おうちのどこで寝ている？
          </p>
          <div class="form-group form_answer">
            <div class="custom-control custom-radio">
              <input data-number="btn_6" type="radio" id="customRadio21" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio21">寝室ではない別の部屋で眠っている。</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_6" type="radio" id="customRadio22" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio22">あなたの寝室で眠っている。</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_6" type="radio" id="customRadi23" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi23">ソファでもベッドでも。いつでもあなたのすぐそばで眠っている。</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_6" type="radio" id="customRadi24" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi24">特に決まっていない。自由な場所で眠っている。</label>
            </div>
          </div>
          <div class="form_btn">
            <button type="button" class="btn prev">前へ</button>
            <button type="button" id="btn_6" class="btn next">次へ</button>
          </div>
        </div>


        <div id="form_7" class="form_item">
          <h2 class="form_title">QUESTION 7</h2>
          <p class="form_question">
            恋人と一緒に来た遊園地で楽しみたいアトラクションは？
          </p>
          <div class="form-group form_answer">
            <div class="custom-control custom-radio">
              <input data-number="btn_7" type="radio" id="customRadio25" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio25">バンジージャンプ</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_7" type="radio" id="customRadio26" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio26">レーシングカート</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_7" type="radio" id="customRadi27" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi27">観覧車</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_7" type="radio" id="customRadi28" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi28">ジェットコースター</label>
            </div>
          </div>
          <div class="form_btn">
            <button type="button" class="btn prev">前へ</button>
            <button type="button" id="btn_7" class="btn next">次へ</button>
          </div>
        </div>


        <div id="form_8" class="form_item">
          <h2 class="form_title">QUESTION 8</h2>
          <p class="form_question">
          山道で突然の雨。幸いなことに、傘を貸してくれる人が。それはどんな傘？
          </p>
          <div class="form-group form_answer">
            <div class="custom-control custom-radio">
              <input data-number="btn_8" type="radio" id="customRadio29" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio29">チェックの柄の傘</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_8" type="radio" id="customRadio30" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio30">無地のシンプルなジャンプ傘</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_8" type="radio" id="customRadi31" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi31">ブランド物や柄の部分がしゃれている高そうな傘</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_8" type="radio" id="customRadi32" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi32">コンビニで売っているようなビニール傘</label>
            </div>
          </div>
          <div class="form_btn">
            <button type="button" class="btn prev">前へ</button>
            <button type="button" id="btn_8" class="btn next">次へ</button>
          </div>
        </div>


        <div id="form_9" class="form_item">
          <h2 class="form_title">QUESTION 9</h2>
          <p class="form_question">
            夢の中で、あなたはある動物にまたがっています。それは次のうちどれ？
          </p>
          <div class="form-group form_answer">
            <div class="custom-control custom-radio">
              <input data-number="btn_9" type="radio" id="customRadio33" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio33">らくだ</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_9" type="radio" id="customRadio34" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio34">バッファロー</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_9" type="radio" id="customRadi35" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi35">白馬</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_9" type="radio" id="customRadi36" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi36">ゾウ</label>
            </div>
          </div>
          <div class="form_btn">
            <button type="button" class="btn prev">前へ</button>
            <button type="button" id="btn_9" class="btn next">次へ</button>
          </div>
        </div>


        <div id="form_10" class="form_item">
          <h2 class="form_title">QUESTION 10</h2>
          <p class="form_question">
          恋人からアナタをイメージしたケーキをもらいました。それはどんなケーキ？
          </p>
          <div class="form-group form_answer">
            <div class="custom-control custom-radio">
              <input data-number="btn_10" type="radio" id="customRadio37" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio37">チーズケーキ</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_10" type="radio" id="customRadio38" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio38">レモンパイ</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_10" type="radio" id="customRadi39" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi39">シンプルなショートケーキ</label>
            </div>
            <div class="custom-control custom-radio">
              <input data-number="btn_10" type="radio" id="customRadi40" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadi40">チョコケーキ</label>
            </div>
          </div>
          <div class="form_btn">
            <button type="button" class="btn prev">前へ</button>
            <button type="button" id="btn_10" class="btn next">次へ</button>
          </div>
        </div>

        <div class="form_item">
          <h2 class="form_title">QUESTION</h2>
          <p class="form_question">
          お疲れ様でした。<br>
          これで「理想のお相手診断テスト」は終了です。
          </p>
          <div class="form_btn form_answer">
            <input type="hidden" name="id" value=<?= $_GET['id']; ?>>
            <button type="button" class="btn prev">前へ</button>
            <input class="btn next" type="submit" name="btn_submit" value="結果を見る">
          </div>
        </div>
      </form>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>
  </body>
</html>