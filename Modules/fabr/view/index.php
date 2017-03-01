<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 28.01.2017
 * Time: 21:08
 */
use Module\fabr\Model\Test;
use Library\Rights\RightsControll;




/*echo '<pre>';
print_r(Test::getproduct());
print_r(RightsControll::get_rights(1, 1));
print_r(Test::getproduct());
print_r(Test::getproduct());
print_r(Test::getproduct());
print_r(Test::getproduct());
print_r(RightsControll::get_rights(1, 1));print_r(RightsControll::get_rights(1, 1));
print_r(RightsControll::get_rights(1, 1));
print_r(RightsControll::get_rights(1, 1));
echo '</pre>';*/

?>

<h2>TEST</h2>
<?php
$z = array(10, 20,
array(10, 10, array(20)), 20
);

function ssumx($x){
	$sum = 0;
	foreach ($x as $value){
		if(is_array($value)){
			$sum += ssumx($value);
		}else{
			$sum += $value;
		}

	}
	return $sum;
}

echo ssumx($z);

?>