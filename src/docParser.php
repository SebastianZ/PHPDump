<?php
/* Version 0.1 - Sebastian Zartner
 *
 * Distributed under the MIT license. See the LICENSE file.
 */

class DocParser {
  private $doc;

  function __construct() {
    $this->doc = [
      'shortDesc' => '',
      'longDesc' => '',
      'tags' => []
    ];
  }

  private function stripJunk($docString) {
    return trim(preg_replace('/^[\t ]*(\/\*)?\*[\t ]*\/?/m', '', $docString));
  }

  private function parseReturn($returnTagString) {
  	preg_match('/^@return\s+(\S+)(\s+(.*))?$/i', $returnTagString, $returnTagParts);
  	return ['type' => $returnTagParts[1], 'desc' => $returnTagParts[2]];
  }

  function parse($docString) {
     $strippedDocString = $this->stripJunk($docString);
     $lines = preg_split('/\r\n|\r|\n/', $strippedDocString);

     $i = 0;
     do {
       $this->doc['shortDesc'] .= $lines[$i];
       $i++;
     } while ($lines[$i] !== '' && $lines[$i][0] !== '@');

     while ($i < count($lines) && ($lines[$i] === '' || $lines[$i][0] !== '@')) {
     	 $this->doc['longDesc'] .= $lines[$i];
       $i++;
     }
     $this->doc['longDesc'] = trim($this->doc['longDesc']);

     while ($i < count($lines)) {
     	 switch (preg_match('/^@\S+/', $lines[$i], $matches) === 1) {
     	 	 case '@return':
     	 	 	 $this->doc['tags']['return'] = $this->parseReturn($lines[$i]);
     	 	 	 break;
     	 }
       $i++;
     }
     $this->doc['rest'] = $lines;
  }

  function getTags() {
  	return $this->doc['tags'];
  }

  function getTag($tagName) {
  	foreach ($this->doc['tags'] as $tag => $tagParts) {
  		if ($tag === $tagName)
  			return $tagParts;
  	}
  	return [];
  }

  function getShortDesc() {
    return $this->doc['shortDesc'];
  }

  function getLongDesc() {
  	return $this->doc['longDesc'];
  }

  function getDesc() {
  	return $this->doc['shortDesc'] . chr(10) . chr(10) . $this->doc['longDesc'];
  }
}
?>