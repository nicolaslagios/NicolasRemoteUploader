<!DOCTYPE html>
<html>
    <head>
        <title>Remote upload by Nicolas v0.1</title>
        <style>
            .forma{
                margin-top:10%;
                display: grid;
                place-items: center;
            }
            .dieythynsh{
                width: 250px;
                height: 25px;
                border-radius: 25px;
            }
            .koumpi{
                border-radius: 5px;
                height: 30px;
                background: #d800ff;
                color: white;
                font-weight: 700;
            }
            .status{
                margin-top:10%;
                border-style: dotted;
                border-width: 2px;
                max-width:600px;
                display: block;
  	            margin-left: auto;
	            margin-right: auto;
                text-align: center;
                background:#ffff007a;
            }
            .teliko{
                color:red;
                font-weight: 700;
            }
        </style>
    </head>
    <body>
        <form action="index.php" method="POST" class="forma">
            <label for="url">Παρακαλώ πληκτρολογήστε τον σύνδεσμο του απομακρυσμένου αρχείου:</label><br>
            <input class='dieythynsh' type='url' id='url' name='url' placeholder='πχ https://wordpress.org/latest.zip'>
                <br>
                <br>
            <input class="koumpi" type='submit' value="Απομακρυσμένο ανέβασμα">
        </form>
    </body>
</html>

<?php
if (empty($_POST["url"])){
    $url = NULL;
}else {
    $url = $_POST["url"];
}

//Έλεγχος για υπαρκτό αρχείο ή σύνδεσμο
function download($syndesmos){
    if (empty($syndesmos)){
        $syndesmos = "Δεν έχει γίνει δοκιμή";
    }elseif (@fopen($syndesmos, 'r')){
            $keimeno = "Tο ανέβασμα ολοκληρώθηκε";
            
            set_time_limit(0);
            $katebasma = $syndesmos;
            $file = fopen(dirname(__FILE__) . '/a.apk', 'w+');
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL            => $katebasma,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_FILE           => $file,
                CURLOPT_TIMEOUT        => 50,
                CURLOPT_USERAGENT      => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)'
            ]);
            $response = curl_exec($curl);
            if($response === false) {
                throw new \Exception('Curl error: ' . curl_error($curl));
                }
            }else {
                        $keimeno = "ΔΕΝ ΥΠΑΡΧΕΙ";
                   }

                   return $keimeno;
            }

$teliko = download($url);

echo "<div class='status'><h2>Κατάσταση</h2><br><div class='teliko'>" . $teliko . "<br><br><br></div></div>";

?>