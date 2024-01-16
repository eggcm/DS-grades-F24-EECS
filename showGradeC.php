<html>
<head>
<meta http-equiv="Content-Language" content="zh-tw">
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>Show Course Grade</title>
</head>
<body>
<?
  // open the data file
  $fp = fopen("DS-grades-F23u-Eng.csv", "r");
  $row = 1;

  // retrieve the first record (row) of the table
  $header = fgetcsv($fp, 512, ",");
  //$weight = fgetcsv($fp, 512, ",");
  $passwd=$_POST['passwd'];

  // set the flag as the record NOT found
  $find = false;

  // search each record $data
  while($data = fgetcsv($fp, 512, ","))
 {
	$row++;
	// assume that the password is stored $data[0]
	// if the user enter valid password";
	if($passwd != "" and $data[0] == $passwd)
	{
		// conut $num fields in header row
		$n = count ($header);
		
		echo "<table border=1 cellpadding=1>";
		echo "<tr>";
		for ($i=1; $i < $n; $i++)
			echo "<th  align=center> $header[$i] </th>";
		echo "</tr>\n";
		
		//echo "<tr>";
		//for ($i=1; $i < $n; $i++)
		//	echo "<th  align=center> $weight[$i] </th>";
		//echo "</tr>\n";
		
		$num = count ($data);
		
		echo "<tr>";
		for ($c=1; $c < $num; $c++) {
			echo "<td  align=center bgcolor=#FFFF00> $data[$c] </td>";
		}
		echo "</tr>\n";
		
		$find = true;  // set the flag as the record found
        //    break;         // stop the search
	} // end of if
	
	// print the footer of the table
	if($find and $data[0] == "")
	{
		// print each field in the footer
		echo "<tr>";
		for ($c=1; $c < $num; $c++) {
			echo "<td  align=\"center\"> $data[$c] </td>";
		}
		echo "</tr>\n";
	}
  } // end of while

  if ($find)
	print "</table>\n";

  // if the user enter invalid password
  if (!$find)
	echo "<p><font size=\"3\" face=\"Arial\">Invalid Password</font></p>";
else {
    echo"<p>The grade is determined by the following rule: (H1+H2+H3+H4+H5+H6)/6*0.4+(Mid+10)*0.25+FIN*0.35+CPE</p>"; 
    echo"<p><b>Mid:</b> the grade of midterm exam</p>";
    echo"<p><b>Fin:</b> the grade of final exam</p>";
    echo"<p><b>SEM:</b> the grade of this course in this semester</p>";
    echo"<p><b>Note that </b> the highest grade of this course is 99. If your final grade is higher than 99, then you will get 99 at most.</p>";
}
fclose ($fp);
?>
</body>
</html>