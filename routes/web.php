<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    dd(1);
    return view('welcome');
});
Route::get('/test-email', function () {
    Mail::raw('Test email from Laravel', function ($message) {
        $message->to('your-email@example.com');
        $message->subject('Test Email');
    });

    return 'Test email sent';
});
Route::get('test', function () {
    /*$array = array(50,12, 30, 10,7, 9, 14);
    for ($i = 0; $i< count($array); $i++) {
        for ($j=0; $j< count($array)-1;$j++) {
            if ($array[$j] < $array[$j+1]) {
                $data = $array[$j+1];
                $array[$j+1] = $array[$j];
                $array[$j] = $data;
            }
        }
    }
dd($array);*/
    $str = "AMBANI";
    $count = array_sum(count_chars($str));
//    dd($count);
    for ($i = $count-1; $i>=0; $i--){
        echo $str[$i];
    }
   /* $data = ['tom', 'jerry', 'apple', 'mango'];

    $length = count($data);

    for ($i = 0; $i < count($data); $i++) {
        for ($j = 0; $j < count($data)  - 1; $j++) {
            if (strcmp($data[$j], $data[$j + 1]) > 0) {
                $temp = $data[$j];
                $data[$j] = $data[$j + 1];
                $data[$j + 1] = $temp;
            }
        }
    }

// Now $data is sorted in ascending order
    dd($data);*/

});

Route::get('', function () {
});
Route::get('test3', function () {
    $mainArray =
        [
            ['id' => 1, 'cin' => '1', 'name' => ''],
            ['id' => 2, 'cin' => '2', 'name' => ''],
            ['id' => 3, 'cin' => '3', 'name' => ''],
            ['id' => 4, 'cin' => '4', 'name' => ''],
            ['id' => 5, 'cin' => '5', 'name' => ''],
            ['id' => 6, 'cin' => '6', 'name' => ''],
            ['id' => 7, 'cin' => '7', 'name' => ''],
            ['id' => 8, 'cin' => '8', 'name' => ''],
            ['id' => 9, 'cin' => '9', 'name' => ''],
            ['id' => 10, 'cin' => '10', 'name' => '']
        ];

    $homeCompanies = [
        ['_id' => 'qwert', 'companyCin' => '1', 'other_data' => 'sdff'],
        ['_id' => 'lkjh', 'companyCin' => '2', 'other_data' => 'djbshj'],
        ['_id' => 'gfdsa', 'companyCin' => '3', 'other_data' => 'sdjkm'],
        ['_id' => 'mktdc', 'companyCin' => '4', 'other_data' => 'yuio'],
        ['_id' => 'sdstyu', 'companyCin' => '1255', 'other_data' => 'bnmc'],
    ];


// refrence of the element of array
    foreach ($mainArray as &$comp) {
        //dynamically data push in array
        $comp['value'] = false;

        foreach ($homeCompanies as $homeCompany) {
            //matching two data with flag true-false
            if ($homeCompany['companyCin'] === $comp['cin']) {
                $comp['value'] = true;
                break;
            }
        }
    }
//
    $j = json_encode($mainArray);
    dd($j);
//
//
//    dd($mainArray);
});
Route::get('test1', function () {


    //sizeof - count no of element in an array
   // Array to string
   /* $data = ['tom', 'jerry', 'Mr.bean'];
    dd(implode('', $data));*/

//   $data = array('tom', 'jerry', 'Mr.bean');


//     dd($data);
    // array_value - print ony data except key
   /* $data = array('villain'=>'tom', 'hero'=>'jerry');
    print_r(array_values($data));
    $data = array('villain'=>'tom', 'hero'=>'jerry');
    print_r(array_keys($data));
    // array_pop remove the element end of an array
    $data = array('villain'=>'tom', 'hero'=>'jerry');
    array_pop($data);
    print_r($data);*/

    //array_shift - remove the beginning of an array
//     $data = array('tom', 'jerry');
//     array_shift($data);
//     print_r($data);


    //array_unshift - added an element the beginning of an array
//    $data = array('tom', 'jerry');
//    array_unshift($data, 'mr.bean');
//    print_r($data);


    //sort - element are arrange in ascending alphabetical order.
//  $data = array('tom', 'jerry');
//    sort($data);
//   dd($data);
    // array_flip - excange the key to value and value to key
//    $data = array('villain'=>'tom', 'hero'=>'jerry');
//   dd(array_flip($data));

// order in desc
//    $data = array(5, 15, 6, 4 ,30);
//    dd(array_reverse($data));


//    $data = array(5, 15, 6, 4 ,30);
//    $data1 = array(51, 215, 16, 24 ,230);
//    dd(array_merge($data, $data1));


//    $data = array(5, 15, 6, 4 ,30);
//    /*echo "Number is ...." .*/
//    dd($data[array_rand($data)]);

//    $data =array(5, 8, 5, 4512, 785, 5, 689, 8, 4512);
//    dd(array_unique($data));
    /* function reduceBy10(&$val, $key) {
         $val -= $val * 0.1;
     }
     $data= array(5, 8, 5, 4512, 785, 5, 689, 8, 4512);
     array_walk($data,     array_walk($data, )
     )*/
//    function reduceBy10(&$val, $key) {
//        $val -= $val * 0.1;
//    }
//    $data= array(5, 8, 5, 4512, 785, 5, 689, 8, 4512);
//    array_walk($data, 'reduceBy10');
//    dd($data);




//    $str="Hello PHP";
//    echo strchr('hello', $str);














//    for ($i = 0; $i < 10; $i++) {
//        if ($i == 4) {
//            continue;
//        }
////        echo "The number is: $i <br>";
//    }
//    $x = 1;
//
//    while($x < 10) {
//        if ($x == 4) {
//            continue;
//        }
//        echo "The number is: $x <br>";
//        $x++;
//    }



$append =['full_name'];



});
Route::get('data', function () {
    $numbers = [4, 3, 4, 3, 1, 2, 1, ];
    var_export(array_keys(array_intersect(array_count_values($numbers),[1])));
});

