<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php

	function containsDecimal($value) {
	    return ((strpos($value, ".")!==false))?true:false;
	}

	function getFactorial($n) { 
	    return ($n == 1 || $n == 0)?1:$n * getFactorial($n - 1);
	} 
	
	function isPrime($n) {
	    if ($n <= 1) {
	        return false;
	    }
	    $isPrime = true;
	    for ($i = 2; $i < $n ; $i++) {
	        if (is_integer($n / $i)) {
	            $isPrime = false;
	            break;
	        }
	    }
	    return $isPrime;
	}

	function getDivisors($n, $mode) {
		//MODE
		// -> NO_SAME non considera il numero stesso
		// -> * restituisce anche se stesso
		switch ($mode) {
			case 'NO_SAME':
				$divisors = array();
			    for($i=1; $i<$n; $i++) {
			        if ($n % $i == 0) {
			            array_push($divisors, $i);
			        }
			    }
			    return $divisors;
				break;
			
			default:
				$divisors = array();
			    for($i = 1; $i <= $n; $i ++) {
			        if ($n % $i == 0) {
			            array_push($divisors, $i);
			        }
			    }
			    return $divisors;
				break;
		}
		
	}

	function getSumOfDivisors($n) {
		$divisors = getDivisors($n, 'NO_SAME'); $sum = 0;
		for ($a=0;$a<count($divisors);$a++){
			$sum += $divisors[$a];
		}
		return $sum;
	}

	function isPSquare ($n) {
		return (!containsDecimal(sqrt($n)))?true:false;
	}

	function isPCube ($n) {
		return (!containsDecimal(pow($n, 1/3)))?true:false;
	}

	function orderSqrt($n, $order) {
		if ($order == 0){
			return false;
		}
		return pow($n, 1/$order);
	}

	function isBlumInt($n) { 
		$prime = array_fill(0, $n + 1, true); 

		for ($i = 2; $i * $i <= $n; $i++) { 
			if ($prime[$i] == true) { 
				for ($j = $i * 2; $j <= $n; $j += $i) 
					$prime[$j] = false; 
			} 
		} 

		for ($i = 2; $i <= $n; $i++) { 
			if ($prime[$i]) {  
				if (($n % $i == 0) && (($i - 3) % 4) == 0) { 
					$q = (int)$n / $i; 
					return ($q != $i && $prime[$q] && ($q - 3) % 4 == 0); 
				} 
			} 
		} 
		return false; 
	} 

	function areAmicable($n, $m) {
		$N_Qdivisors = getSumOfDivisors($n);
		$M_Qdivisors = getSumOfDivisors($m);
		return ($N_Qdivisors == $m && $M_Qdivisors == $n)?"true":"false";
	}

	function isRepeatable($n) {
		$digits = str_split($n);
		$key = $digits[0];
		for ($i=1; $i < count($digits); $i++) {
			if ($digits[$i] != $key){
				return false;
			} 
		}
		return true;
	}

	function isAbundant($n) {
		return ($n < getSumOfDivisors($n))?true:false;
	}


	/* BUGGED */ function isHighlyComposite($n) {
		if ($n > 0){
			for ($i=1; $i <= $n; $i++) { 
				$i_div = count(getDivisors($i, 'DEFAULT'));
				if ($i_div > count(getDivisors($n, 'DEFAULT'))){
					return false; 
				}
			}
		}
		return true;
	}


	function numSquareSum($n) { 
	    $squareSum = 0; 
	    while ($n) { 
	        $squareSum += ($n % 10) * ($n % 10); 
	        $n /= 10; 
	    } 
	    return $squareSum; 
	} 
  

	function isHappy($n) { 
	    $slow; $fast; 
	    $slow = $n; 
	    $fast = $n; 
	    do { 
	        $slow = numSquareSum($slow); 
	        $fast = numSquareSum(numSquareSum($fast));
	    } 
	    while ($slow != $fast); 
	    return ($slow == 1); 
	} 

	function isPowerful($n) { 
	    while ($n % 2 == 0) { 
	        $power = 0; 

	        while ($n % 2 == 0) { 
	            $n /= 2; 
	            $power++; 
	        } 

	        if ($power == 1) 
	        return false; 
	    } 
	  
	    for ($factor = 3; $factor <= sqrt($n); $factor += 2) { 
	        $power = 0; 
	        while ($n % $factor == 0) { 
	            $n = $n / $factor; 
	            $power++; 
	        } 
	        if ($power == 1) 
	        return false; 
	    } 
	    return ($n == 1); 
	} 

	function printConsecutive($last, $first) { 
	    echo $first++; 
	    for ($x = $first; $x<= $last; $x++) echo " + " , $x;
	    echo '<br>';
	} 

	function findConsecutive($n) { 
	    for ($last = 1; $last < $n; $last++) { 
	        for ($first = 0; $first < $last; $first++) { 
	            if (2 * $n == ($last - $first) * ($last + $first + 1)) { 
	                 echo $n , " = "; 
	                printConsecutive($last, $first + 1); 
	                return; 
	            } 
	        } 
	    } 
	    return false; 
	} 

#----------
for ($i=1; $i < 100; $i++) { 
	echo $i.' -> '.insert_function_here($i).'<br>';
}
	

?>
</body>
</html>
