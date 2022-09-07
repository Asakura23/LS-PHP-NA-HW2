<?php

function task7()
{
    $names=array("Peter", "Boris", "Dmitrii", "Gleb", "Ivan");
    for ($i = 0; $i < 50;){
        $nameKey = array_rand($names);
        $age = mt_rand(18,45);
        $users[$i] = [
            "id" => $i,
            "name" =>$names[$nameKey],
            "age" => $age
        ];
        $i++;
    }

    file_put_contents('users.json',json_encode($users));
    $usersJson=file_get_contents('users.json');
    $users=json_decode($usersJson,true);

    foreach ($names as $name){
        $k=0;
        foreach ($users as $key){
            if(in_array($name,$key)){
                $k++;
            }
        }
        if ($k==1){
            echo (PHP_EOL."$k пользователь с именем '$name'");
        }elseif ($k==2 || $k==3){
            echo (PHP_EOL."$k пользователя с именем '$name'");
        }else {
            echo(PHP_EOL . "$k пользователей с именем '$name'");
        }
    }

    $ageUsers=[];
    foreach ($users as $user){
        $ageUsers[]=$user['age'];
    }
    $averageAge=array_sum($ageUsers)/50;
    echo (PHP_EOL.'Средний возраст пользователей '.$averageAge);
}
