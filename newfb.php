<?php
    $name = $_GET['name'];
    $email = $_GET['email'];
    $feedbar = $_GET['feedbar'];

    // feedbar - txt файл, в котором будет храниться все (имя, email, сам отзыв)
    $file = fopen('feedbar.txt', 'a');
    $flag = 1;

    //проверка на корректность введенных данных (необязательно, так как легче сделать проверку на стороне клиента.)
    //ТУТ ПРОСТО ПОЛЕЗНЫЕ РЕГУЛЯРКИ, КОТОРЫЕ НАДО ИНТЕРПРЕТИРОВАТЬ НА JS

    if(!preg_match('/^[a-zа-яё]+$/ui', $name)) { //имя
        print $name . ' Имя введено неправильно <br>';
        $flag = 0;
    }

    if(!preg_match("/^([a-z0-9_-]{1,20})@([a-z]{2,5})\.([a-z]{2,4})$/i", $email)) { //email
        print $email . " email введен неправильно <br>";
        $flag = 0;
    }
    
    ///////////////

    //Проверка на занятость имени (мне кажется, можно обойтись и без этого, но вдруг)
    $arr = file('feedbar.txt');
    foreach($arr as $key => $stroka) {
        preg_match('/"name" => "[a-zA-Z\$\-\_\+\#\!0-9]+"/', $stroka, $tg);
        $tg[0] = preg_replace('/"name" => "([a-zA-Z\$\-\_\+\#\!0-9]+)"/', "$1", $tg[0]);
        print $tg[0] . '<br>';
        if ($tg[0] == $name) {
            print 'Такое имя занято <br>';
            $flag = 0;
        }
    }

    //запись в файл, если все ОК
    if ($flag) {
        $str = '"name" => "' . $name . '", "email" => "' . $email . '", "feedbar" => "' . $feedbar . '",';
        fwrite($file, $str  . PHP_EOL);
        fclose($file);
    }
    ///////////////


    /* вывод содержимого файла (потом реализовать для вывода на страницу php в фрейме)
    <?php
        $file = fopen('feedbar.txt', 'r');
        while (!feof($file)) {
            $string = fgets($file); 
            echo $string . '<br>';
        }
        fclose($file);
    ?>
    */
?>
