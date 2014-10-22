<?php
/* Distributed under the MIT license. See the LICENSE file. */

require_once '../src/debug.php';
require_once 'person.php';

$dbh = new PDO('pgsql:host=localhost;dbname=xxx', 'xxx', 'xxx', [PDO::ATTR_PERSISTENT => true]);
$select = $dbh->prepare('SELECT * FROM persons WHERE sLastName LIKE :sLastName');
$select->execute([':sLastName' => 'M%']);

$xml = simplexml_load_file('xml.xml');
$file = fopen('text.txt', 'r');

$vars = [
  true,
  1,
  'Mein String',
  ['a', 'b', 'c'],
  ['brand' => 'Audi', 'model' => 'A8'],
  new Person('Hans', 'Meier', new DateTime('1967-03-15')),
  $select,
  $xml,
  $file
];

if (function_exists('imagecreate'))
  array_push($vars, imagecreate(100, 100));
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Variable dump</title>
  </head>
  <body>

<?php
  if (isset($_GET['pretty'])) {
    foreach ($vars as $var)
      dump($var);
  } else {
    echo '<pre>';
    foreach ($vars as $var)
      var_dump($var);
    echo '</pre>';
  }
?>

  </body>
</html>
