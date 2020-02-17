<?php
    /*
    Joshua Sjah
    CS 174
    This program describes two functions, a function that finds primes up to the input and 
    a second function that tests the first by printing the output and the expected. 
    */

    function prime($input) {
        $startOfPrimes = 2; //primes start at 2 so start testing from the number 2
        for($i=$startOfPrimes; $i<$input; $i++) { 
            $isPrime = true;
            for($j=2; $j<=$i/2; $j++) { //the loop only needs to check half the numbers to the input
                if($i % $j == 0) {
                    $isPrime = false;
                }
            }
            if($isPrime == true) {
                if($i != $startOfPrimes) {
                    echo ", ";
                }
                echo $i;
            }
        }
        echo "<br>";
    }

    function tester() {
        echo "output: ";
        prime(10);
        echo "expected: 2, 3, 5, 7<br>";
        
        echo "<br>output: ";
        prime(0);
        echo "expected: <br>";
        
        echo "<br>output: ";
        prime(33);
        echo "expected: 2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31<br>";
        
        echo "<br>output: ";
        prime(69);
        echo "expected: 2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67<br>";

        echo "<br>output: ";
        prime(100);
        echo "expected: 2, 3, 5, 7, 11, 13, 17,
              19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97<br>";
    } 

    tester();
?>