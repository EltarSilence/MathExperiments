<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php

	#FUNZIONI BASSO LIVELLO

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

	#FUNZIONI DI SUCCESSIONI

	function fibonacci($n){
	    return round(((5 ** .5 + 1) / 2) ** $n / 5 ** .5);
	}

	function padovan($n) {
	    if($n==0) return 0;
	    if ($n < 4) { 
	    	return 1;
	    }
	    else return padovan($n - 2) + padovan($n - 3); 
	}

	#SUCCESSIONI DI INTERI

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

	function isRefactorable($n){
		$n_div = count(getDivisors($n, 'DEFAULT'));
		return ($n%$n_div==0)?true:false;
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

	function isDeficient($n) {
		return ($n > getSumOfDivisors($n))?true:false;
	}	

	function isPerfect($n) {
		return ($n==getSumOfDivisors($n))?true:false;
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

	# ALGORITMI DI RICERCA
	/* RICERCA LINEARE
		Complessita: O(n)
	*/
	function linearSearch($arr, $x) { 
	    for ($i = 0; $i < count($arr); $i++) 
	        if ($arr[$i] == $x) 
	        return $i; 
	    return -1; 
	}

	/* RICERCA BINARIA
		Complessita: O(log(n))		
	*/
	function binarySearch($arr, $l=0, $x) {
		$r = count($arr)-1;
		if ($r >= $l) { 
	        $mid = $l + ($r - $l) / 2; 
	  
	        if ($arr[$mid] == $x)  
	            return floor($mid); 
	  
	        if ($arr[$mid] > $x)  
	            return binarySearch($arr, $l, $mid - 1, $x); 
	  
	        return binarySearch($arr, $mid + 1, $r, $x); 
		} 
		return -1; 
	} 

	/* RICERCA A SALTI
		Complessita: O(sqrt(n))
	*/
	function jumpSearch($arr, $x) { 
		$n = sizeof($arr) / sizeof($arr[0]);
	    $step = sqrt($n); 
	    $prev = 0; 
	    while ($arr[min($step, $n)-1] < $x) { 
	        $prev = $step; 
	        $step += sqrt($n); 
	        if ($prev >= $n) 
	            return -1; 
	    } 
	    while ($arr[$prev] < $x) { 
	        $prev++; 
	  
	        if ($prev == min($step, $n)) 
	            return -1; 
	    } 
	    if ($arr[$prev] == $x) 
	        return $prev; 
	  
	    return -1; 
	} 

	#ALGORITMI DI ORDINAMENTO

	function isSorted ($arr) {
		return ($arr==sort($arr)?true:false);
    }

	/* BUBBLE SORT
		Complessita: O(n^2)
	*/
	function bubbleSort(&$arr) { 
	    $n = sizeof($arr);
	    for($i = 0; $i < $n; $i++) { 
	        for ($j = 0; $j < $n - $i - 1; $j++) { 
	            if ($arr[$j] > $arr[$j+1]) { 
	                $t = $arr[$j]; 
	                $arr[$j] = $arr[$j+1]; 
	                $arr[$j+1] = $t; 
	            } 
	        } 
	    }
	    return $arr; 
	} 

	/* INSERTION SORT
		Complessita: O(2n)
	*/
	function insertionSort(&$arr) {
		$n = sizeof($arr); 
	    for ($i = 1; $i < $n; $i++) 
	    { 
	        $key = $arr[$i]; 
	        $j = $i-1;
	        while ($j >= 0 && $arr[$j] > $key) 
	        { 
	            $arr[$j + 1] = $arr[$j]; 
	            $j = $j - 1; 
	        } 
	        $arr[$j + 1] = $key; 
	    }
	    return $arr;
	} 

	/* STUPID SORT
		Complessita: O(n*n!)
	*/
	function stupidSort($arr){
		while(!isSorted($arr)){
			$arr=shuffle($arr);
		}
		return $arr;
	}
#----------

for ($i=1; $i <= 5000; $i++) { 
	echo $i.' -> '.($i).'<br>';
}
	

?>
</body>
</html>
