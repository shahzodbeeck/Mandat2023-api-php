<?php

define("DB_SERVER", "localhost"); // Tegilmaydi
define("DB_USERNAME", "shahzodbek_mandat"); // Mysql baza nomi
define("DB_PASSWORD", "mandat2023"); // Mysql baza paroli
define("DB_NAME", "shahzodbek_mandat"); // Mysql baza nomi

$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($db, "utf8mb4");
if($db){
    echo "Ulandi";
}else{
    echo "Ulanmadi";
}


?>