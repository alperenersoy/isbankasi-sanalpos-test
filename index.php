<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İş Bankası Sanal Pos Test</title>
    <style>
        input {
            height: 20px;
            width: 100%;
        }

        div,
        button {
            margin-top: 10px;
        }

        input[readonly] {
            background: #ededed;
        }
    </style>
</head>

<body>
    <?php
    $clientId = '700655000100';

    $oid = uniqid(); //Sipariş referansı, ödeme id gibi biricik ve saklayacağanız bir veri olmalı. Daha sonra yapacağınız iptal veya iade gibi işlemler için bu id kullanılacak.

    $amount = "1000";

    $okUrl = 'http://127.0.0.1:8000/response.php';

    $failUrl = 'http://127.0.0.1:8000/response.php';

    $rnd = substr(md5(uniqid()), 0, 20);

    $storekey = 'TRPS0100';

    $taksit = '2';

    $islemtipi = 'Auth';

    $hashStr = $clientId . $oid . $amount . $okUrl . $failUrl . $islemtipi . $taksit . $rnd . $storekey;

    echo "HASH PARAMS: 
    <span style='color: red;'>clientId</span>
    + <span style='color: green;'>oid</span>
    + <span style='color: blue;'>amount</span>
    + <span style='color: yellowgreen;'>okUrl</span>
    + <span style='color: deeppink;'>failUrl</span>
    + <span style='color: purple;'>islemtipi</span>
    + <span style='color: darkcyan;'>taksit</span>
    + <span style='color: orange;'>rnd</span>
    + <span style='color: gray;'>storekey</span><br><br>";

    echo "HASH VALUES: 
    <span style='color: red;'>$clientId</span>
    + <span style='color: green;'>$oid</span>
    + <span style='color: blue;'>$amount</span>
    + <span style='color: yellowgreen;'>$okUrl</span>
    + <span style='color: deeppink;'>$failUrl</span>
    + <span style='color: purple;'>$islemtipi</span>
    + <span style='color: darkcyan;'>$taksit</span>
    + <span style='color: orange;'>$rnd</span>
    + <span style='color: gray;'>$storekey</span><br><br>";

    echo "BEFORE HASH: <span style='color: red;'>$clientId</span><span style='color: green;'>$oid</span><span style='color: blue;'>$amount</span><span style='color: yellowgreen;'>$okUrl</span><span style='color: deeppink;'>$failUrl</span><span style='color: purple;'>$islemtipi</span><span style='color: darkcyan;'>$taksit</span><span style='color: orange;'>$rnd</span><span style='color: gray;'>$storekey</span><br><br>";

    $hash = base64_encode(pack('H*', sha1($hashStr)));

    echo "HASH: $hash<br><br>";
    ?>

    <form action="https://entegrasyon.asseco-see.com.tr/fim/est3Dgate" method="POST">
        <div>
            <label>clientid</label>
            <input name="clientid" value="<?= $clientId ?>" readonly />
        </div>
        <div>
            <label>storetype</label>
            <input name="storetype" value="3d_pay_hosting" />
            <small>3d_pay, 3d_pay_hosting</small>
        </div>
        <div>
            <label for="">hash</label>
            <input name="hash" value="<?= $hash ?>" readonly />
        </div>
        <div>
            <label for="">islemtipi</label>
            <input name="islemtipi" value="<?= $islemtipi ?>" readonly />
        </div>
        <div>
            <label for="">amount</label>
            <input name="amount" value="<?= $amount ?>" readonly />
        </div>
        <div>
            <label for="">currency</label>
            <input name="currency" value="949" />
            <small><a href="https://tr.wikipedia.org/wiki/ISO_4217">https://tr.wikipedia.org/wiki/ISO_4217</a></small>
        </div>
        <div>
            <label for="">oid</label>
            <input name="oid" value="<?= $oid ?>" readonly />
        </div>
        <div>
            <label for="">okUrl</label>
            <input name="okUrl" value="<?= $okUrl ?>" readonly />
        </div>
        <div>
            <label for="">failUrl</label>
            <input name="failUrl" value="<?= $failUrl ?>" readonly />
        </div>
        <div>
            <label for="">lang</label>
            <input name="lang" value="tr" />
        </div>
        <div>
            <label for="">taksit</label>
            <input name="taksit" value="<?= $taksit ?>" readonly />
        </div>
        <div>
            <label for="">rnd</label>
            <input name="rnd" value="<?= $rnd ?>" readonly />
        </div>
        <div>
            <label for="">pan</label>
            <input name="pan" value="4508034508034509" />
            <small>3d_pay_hosting için boş gönderilebilir.</small>
        </div>
        <div>
            <label for="">cv2</label>
            <input name="cv2" value="000" />
            <small>3d_pay_hosting için boş gönderilebilir.</small>
        </div>
        <div>
            <label for="">Ecom_Payment_Card_ExpDate_Year</label>
            <input name="Ecom_Payment_Card_ExpDate_Year" value="26" />
            <small>3d_pay_hosting için boş gönderilebilir.</small>
        </div>
        <div>
            <label for="">Ecom_Payment_Card_ExpDate_Month</label>
            <input name="Ecom_Payment_Card_ExpDate_Month" value="12" />
            <small>3d_pay_hosting için boş gönderilebilir.</small>
        </div>
        <button type="submit">Test</button>
    </form>
</body>

</html>