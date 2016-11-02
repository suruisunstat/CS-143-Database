<html>
<head>
  <title>Calculator</title>
</head>
<body>
<h1>Calculator</h1>
" (Ver 1.4 09/30/2016 by Surui Sun)"
<br>
" Type an expression in the following box (e.g., 10.5+20*3/25). "
<form action='calculator.php' method="GET">
  <input type="text" name="expr">
  <input type="submit" value="Calculate">
  </form>
  <p></p>
  <ul>
    <li>Only numbers and +, -, * and / operators are allowed in the expression</li>
    <li>The evaluation follows the standard operator precedence</li>
    <li>The calculator does not support parentheses</li>
    <li>The calculator handles invalid input "gracefully". It does not output PHP error messages.</li>
  </ul>
  <h1>Result</h1>
  <h4>testing cases:</h4>
  <p></p>
  <ul>
    <li>-49 (Ans: -49)</li>
    <li>2+3+4 (Ans: 9)</li>
    <li>2*3*-4 (Ans: -24)</li>
    <li>2*-1*-2*-3 (Ans: -12)</li>
    <li>100-100/100 (Ans: 99)</li>
    <li>3/2+1/3 (Ans: close or equal to 1.833333333333)</li>
    <li>0/0 (No exception shown on the page)</li>
    <li>abcd (Invalid Expression)</li>
    <li>one/two (Invalid Expression)</li>
  </ul>
  <?php
   $expr = $_GET["expr"];
   $expr_nospace = str_replace(" ","",$expr); 
   $valid = preg_match("/^[-+*.\/, 0-9]+$/",$expr);
   $divide_by_zero = preg_match("/\/[0]/",$expr);
   if($expr_nospace==""){}  
   elseif(preg_match("/--/",$expr)){
	$temp = preg_replace("/--/","- -",$expr);
	?>
	<h2>Result</h2>
	<?php
	eval("\$ans=$temp ;");
	echo $expr . " = " . $ans;
}
   elseif(preg_match("/^[0,\.][0-9]+/",$expr)){
	?>
	<h2>Result</h2>
	<?php
	echo "Invalid Expression!";
}
   elseif($divide_by_zero){
	?>
	<h2>Result</h2>
	<?php
	echo "Division by zero error.";
}
   elseif($valid){
	?>
	<h2>Result</h2>
	<?php
	$error=@eval("\$ans=$expr;");
	if($error===false){
	echo "Invalid Expression!";
}
     else{
	echo $expr . " = " . $ans;
} 
}
   else{
	?>
	<h2>Result</h2>
<?php
	echo "Invalid Expression!";
}
?>
  </body>
  </html>
