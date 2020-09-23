<?php

return [
    
  "driver" => env('MAIL_DRIVER','sendmail'),
  "host" => "smtp.mailtrap.io",
  "port" => 2525,
  'from' => [
    'address' => env('MAIL_FROM_ADDRESS', 'votremail@votredomaine.fr'),
    'name' => env('MAIL_FROM_NAME', 'Nom de l\'expéditeur'),
],

  "username" => "3b03daa875debf",
  "password" => "25de1847366c54",
  "sendmail" => "/usr/sbin/sendmail -bs"
];