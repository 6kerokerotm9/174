<?php

/*
  Joshua Sjah
  CS 174
  This program accepts a file uploaded by the user and then finds five adjacent
  digits that when multiplied yield the largest sum. Then the function takes the 
  five digits and then finds the factorial of each digit and finds the sum of the 
  factorials. 
*/

function upload() {
    echo <<<_END
    <html><head><title>PHP Form Upload</title></head><body>
    <form method="post" action = "fileio.php" enctype="multipart/form-data">
    Select a plain text file:
    <input type="file" name="filename" size="10">
    <input type="submit" value="Upload"></form>
    _END;

    if($_FILES){ 
        $name = htmlentities($_FILES["filename"]["name"]); //sanitize the global variable
        $type = $_FILES["filename"]["type"]; 
        if($type == "text/plain"){
            $ext = "txt";
            move_uploaded_file($_FILES["filename"]["tmp_name"], $name);
            $contents = file_get_contents($name); //move the contents of the file to a variable
        }
        else { //if the file is not a txt file it is not accepted
            echo "Upload not allowed, only .txt files are allowed.";
            $contents = null;
        }

        $contents = preg_replace("/[^A-Za-z0-9 ]/", "", $contents); //clear file contents of non alphanumerics 
        if(checkFile($contents) != 0 && checkInputLength($contents) != 0) { //if one fails the file is invalid
            $largest = findLargest($contents);    
            $factorialLargest = findFactorial($largest);
            echo "Largest 5 digits when multiplied: ";
            echo $largest;
            echo "<br>Factorial: ";
            echo $factorialLargest;
        }
    }
}

function checkInputLength($input) { //checks the length of the file
    $file_size = 1000; //the exact size the file needs to be
    if($input == null) {
        return 0; //if input is not txt file error message should already be printed   
    }
    else if(strlen($input) != $file_size) { //if the file size is not the exact size discard the file
        echo "input is not 1000 characters, please try another file"; 
        return 0;
    }
    return 1; //signals that the file is appropriate to use
}

function checkFile($input) { //function checks too see if the file is only numbers
    for($i=0; $i<strlen($input); $i++) {
        if($input[$i] < "0" || $input[$i] > "9") {
            echo "file contains a non numeric character please try another file<br>";
            return 0;
        }
    }
    return 1;
}

function multiply($input) { //helper function multiplies five numbers together
    $total = 1;
    for($i=0; $i<strlen($input); $i++) {
        $total *= $input[$i];
    }
    return $total;
}

function findLargest($input) {
    $largestTotal = 0; //holds the total for the largest
    $largestFive; //holds the five numbers that make up the largest
    $temp; //holds the result of multiplcation 
    for($i=0; $i<strlen($input)-4; $i++) {
        $temp = multiply(substr($input, $i, 5));
        if($temp > $largestTotal) {
            $largestTotal = $temp; //set the new total
            $largestFive = substr($input, $i, 5); //set the new 5 digits to return
        }
    }
    return $largestFive;
}

function findFactorial($input) { //input here will be the 5 digits found in previous function
    $factorialTotal; //holds the result of the factorial being done at the moment
    $total = 0;
    for($i=0; $i<strlen($input); $i++) {
        $factorialTotal = 1; //resets for the next factorial
        for($j=2; $j<=$input[$i]; $j++) {
            $factorialTotal *= $j; 
        }
        $total += $factorialTotal;
    }
    return $total;
}

upload();

echo "</body></html>";

?>