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
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Variable dump</title>
  </head>
  <body>

<?php
  if (isset($_GET['ugly'])) {
    echo '<pre>';
    foreach ($vars as $var)
      var_dump($var);
    echo '</pre>';
  } else {
    foreach ($vars as $var)
      dump($var);
  }
?>

  </body>
</html>
