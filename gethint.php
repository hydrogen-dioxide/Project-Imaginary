<?php
// Array with names
// https://www.w3schools.com/js/js_ajax_php.asp
$a[] = "X0000";
$a[] = "β001";
$a[] = "β002";
$a[] = "β003";
$a[] = "β004";
$a[] = "β005";
$a[] = "β006";
$a[] = "SAMPLE";
$a[] = "Printing Pages";
$a[] = "Cereal Meal";
$a[] = "Circle, circle everywhere";
$a[] = "Make 24";
$a[] = "NFT Trader";
$a[] = "Text justifier";
$a[] = "Multiple Choice";
$a[] = "Midnight";

$b[] = "X0000";
$b[] = "β001";
$b[] = "β002";
$b[] = "β003";
$b[] = "β004";
$b[] = "β005";
$b[] = "β006";
$b[] = "SAMPLE";
$b[] = "X0000";
$b[] = "β001";
$b[] = "β002";
$b[] = "β003";
$b[] = "β004";
$b[] = "β005";
$b[] = "β006";
$b[] = "SAMPLE";

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  for($i = 0; $i < count($a); $i++) {
    if (stristr($q, substr($a[$i], 0, $len))) {
      $hint .= "<button onclick=\"showProblem('".$b[$i]."')\"> $a[$i] </button>";
    }
  }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;
?>