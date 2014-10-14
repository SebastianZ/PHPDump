<?php
/* Distributed under the MIT license. See the LICENSE file. */

class Person {
  private $firstName;
  private $lastName;
  private $dateOfBirth;

  function __construct($firstName, $lastName, $dateOfBirth) {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->dateOfBirth = $dateOfBirth;
  }

  function __set($name, $value) {
    $this->$name = $value;
  }

  function __get($name) {
    return $this->$name;
  }

  /**
   * Returns the person's age
   *
   * Calculates the person's age from his/her date of birth
   *
   * @return Integer Age of the person
   */
  function getAge() {
    return $this->dateOfBirth->diff(new DateTime())->format('%Y');
  }
}
?>