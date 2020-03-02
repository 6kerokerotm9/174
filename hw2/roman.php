<?php
    /*
      Joshua Sjah
      CS 174
      This program takes a number written in Roman Numerals and converts the value into
      a decimal value. 
    */

    function romanToArabic($input) {
        if(testInput($input) == 0) {
            return;
        }
        $input = strtoupper($input); //set input to upper 
        $romanConv = array('I' => 1, //map where key is the roman numeral and the value is the data
                        'V' => 5,
                        'X' => 10,
                        'L' => 50,
                        'C' => 100,
                        'D' => 500,
                        'M' => 1000);
        $total = $romanConv[$input[0]];                 
        
        //loop checks the string character by character to convert roman numerals
        for($i=1; $i<strlen($input); $i++) { 
            if($romanConv[$input[$i]] > $romanConv[$input[$i-1]]) { //use the map to convert the character to the respective value
                $total -= $romanConv[$input[$i-1]]; //subtract previous as it will just be added in a previous iteration
                $total += $romanConv[$input[$i]] - $romanConv[$input[$i-1]];
            }
            else {
                $total += $romanConv[$input[$i]]; //add on the value regardless if it is a prefix for another value
            }
        }
        echo $total;                
    }
    
    function testInput($input) {
        $validInputs = array("I", "V", "X", "L", "C", "D", "M"); //array that holds the valid digits for roman numerals
        $input = strtoupper($input);
        if(gettype($input) != 'string') { //check to see if the input is of the type string
            echo "Input not valid";
            return 0;
        }
        for($i=0; $i<strlen($input); $i++) { //check each char of the string to see if it is in the array
          if(!(in_array($input[$i], $validInputs))) { 
              echo "Input not valid";
              return 0;
          }
        }
        return 1; //if all the cases pass then the input is valid
    }
    
    function main() {
        echo "Output: ";
        romanToArabic('Vi');
        echo "<br>Expected: 6<br><br>";
        echo "Output: ";
        romanToArabic("iv");
        echo "<br>Expected: 4<br><br>";
        echo "Output: ";
        romanToArabic('MCMXC');
        echo "<br>Expected: 1990<br><br>";
        echo "Output: ";
        romanToArabic('iX');
        echo "<br>Expected: 9<br><br>";
        echo "Output: ";
        romanToArabic('MCMXLVIII'); 
        echo "<br>Expected: 1948<br><br>";
        echo "Output: ";
        romanToArabic('Pearl'); 
        echo "<br>Expected: Input not valid<br><br>";
        echo "Output: ";
        romanToArabic(15);
        echo "<br>Expected: Input not valid<br><br>";
    }
    
    main();
?>