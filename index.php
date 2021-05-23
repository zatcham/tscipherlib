<html>
    <form enctype='multipart/form-data' action='' method='post'>
        <label for="todecrypt">Enter encrypted string (without square brackets) : <span style="color: red;">*</span> </label>
        <input type='text' id="todecrypt" name='todecrypt' required>
                            
        <label for="kettodecrypt">Enter key : <span style="color: red;">*</span> </label>
        <input type='text' id="kettodecrypt" name='kettodecrypt' required>
        <input type='submit' name='submit' value='Process' style="margin: 10px;">
    </form>
</html>




<?php

// Testing: 
// echo (chr(79));
// $array = "[169, 270]";
// $e = (explode(" ", $array));
// echo ($e);
// $a = [70];
//echo (decipherTs("171, 214, 95, 155", 1));
//echo decipherTs("152, 210, 77, 136, 152, 211, 78, 136, 147, 188, 246, 113, 123, 188, 247, 113, 124, 183, 223, 26, 101, 159, 223, 27, 37, 159, 218, 3, 13, 135, 193, 3, 14, 72, 193, 252, 85, 143, 10, 68, 78, 143, 201, 67, 79, 118, 176, 43, 53, 111, 176, 234, 52, 111, 151, 209, 220, 86, 143, 208, 218, 84, 143, 183, 192, 251, 117, 175, 192, 249, 115, 174, 184, 127, 186, 52, 61, 126, 184, 50, 60, 118, 158, 216, 34, 92, 156, 214, 224, 91, 148, 188, 199, 64, 122, 187, 196, 254, 121, 178, 170, 229, 95, 152, 163, 227, 29, 151, 161, 42, 100, 221, 231, 35, 99, 156, 230, 33, 73, 132, 142, 7, 66, 130, 140, 7, 65, 105", 1);

if (isset($_POST['submit'])) {
    if (!empty($_POST['kettodecrypt'])) {
        $k = ($_POST['kettodecrypt']);
        $s = ($_POST['todecrypt']);
        $x = decipherTs($s, $k);
        echo ($x);
    }
}


function encodeTs($in, $key) {
    $o = [];
    for ($i = 0; $i < strlen($in); $i++) {
        $j = ($i + 1);
        $o .= (
            (ord ($in[$i]) + scrambleTs ($j, $key)) % 255);
        //echo ($i . "<br>");
    }
    return $o;
}


function decipherTs($array, $key) {
    $o = "";
    $array = explode(",", $array);
    for ($i = 0; $i < count($array); $i++) {
        $j = ($i + 1);
        $m = (intval($array[$i]) - scrambleTs($j, $key));
        // $t = ($m % 255);
        // $a = (chr($m));
        //echo ($m . "<br>");
        $o = ($o . chr(newmod($m, 255)));
    }
    return $o;
}

function scrambleTs($iterate, $key) {
    $interim = $iterate;
    $interim += (($key % 10) * $iterate);
    $interim += (floor($iterate) / 3);
    $interim += ($iterate * 2);
    $interim += (floor(9 * sin(deg2rad($iterate * 2))));
    //echo ($interim . "<br>");
    $interim = (floor($interim));
    // echo ($interim . "<br>");
    for ($i = 0; $i < 6; $i++) {
        $interimb = (sin(deg2rad($key * 2)) * (2**32));
        $interimb = (floor($interimb));
        $interimb = (($interimb * 3) ^ ($iterate * 7));
        //echo ($interimb . "<br>");
        $interimc = $interimb >> (5);
        $interimc = $interimc << (5);
        //echo ($interimc . "<br>");
        $interimd = $interimc << (3);
        $interime = (($interimb) ^ ($interimc));
        $interime += $interimd;
        //echo ($interime . "<br>");
        $interim -= $interime;
        //echo ($interim . "<br>");
    }
    $interim = (newmod($interim, 255));
    //echo $interim. "<br>";
    //echo ($interim + 255 . "<br>");
    return ($interim + 255);
}

function newmod($a, $b) {
    return ($a - $b * floor($a / $b));
}

?>
