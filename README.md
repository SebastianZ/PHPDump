# PHPDump

PHP version of [ColdFusion's `<cfdump>`](https://wikidocs.adobe.com/wiki/display/coldfusionen/cfdump).

# Usage

You just need to include the debug.php file:

```
include_once 'debug.php';
```

When that is done you can output a variable like this:

```
dump($variable);
```

# Examples
## Indexed array
Code:
```
$arr = ['a', 'b', 'c'];
dump($arr);
```

Output:

![Dump of an indexed array](https://cloud.githubusercontent.com/assets/958943/4642523/271b87c4-5446-11e4-82d7-63d6fcee82fc.png)

## Associative array
Code:
```
$arr = ['brand' => 'Audi', 'model' => 'A8'];
dump($arr);
```

Output:

![Dump of an associative array](https://cloud.githubusercontent.com/assets/958943/4642532/32a1833c-5446-11e4-8946-c49c09f3359d.png)

## Object
Code:
```
class SimpleClass {
  private $property;

  function __construct($property) {
    $this->property = $property;
  }

  function outputProperty() {
    echo $property;
  }
}

dump(new SimpleClass('value'));
```

Output:

![Dump of an object](https://cloud.githubusercontent.com/assets/958943/4642630/6b644ad2-5447-11e4-9cb3-79e0561af016.png)

## Database query result (PDO)
Code:
```
$db = new PDO('pgsql:host=localhost;dbname=mydb', 'user', 'password');
$select = $db->prepare('SELECT *
                        FROM persons
                        WHERE LastName LIKE :LastName
                        ORDER BY LastName ASC');
$select->execute([':LastName' => 'M%']);

dump($select);
```

Output:

![Dump of a query result](https://cloud.githubusercontent.com/assets/958943/4642926/3a28adfc-544a-11e4-9c77-fc2e7372c7ba.png)


## XML (SimpleXML)
Code:
```
$xml = simplexml_load_file('XMLFile.xml');
dump($xml);
```

Output:

![Dump of an XML](https://cloud.githubusercontent.com/assets/958943/4642998/0e97fb10-544b-11e4-921b-d99474e7c40c.png)
