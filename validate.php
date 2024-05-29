<?php
class validate
{

  public function checkEmpty($data)
  {
    $msg = null;
    foreach ($data as $key => $value) {
      if (empty($value)&&$value!=0) {
        $msg .= '<p  class="alert alert-warning" role="alert">'.$key.' field empty</p>';
      }
    }
    return $msg;
  }
  // check our age field
  public function validOnlyDigits($value)
  {
    //check to see if the age is between 1 to 100
    if (preg_match("/^[0-9]+$/", $value)) {
      return true;
    }
    return false;
  }
  public function validateDateInterval($dateStart, $dateEnd)
  {
    $date1 = date($dateStart);
    $date2 = date( $dateEnd);
    return $date1< $dateEnd;
  }
  public function validateDate($date)
  {
    // Example pattern for YYYY-MM-DD 
    $pattern = '/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/';
    return preg_match($pattern, $date) === 1;
  }
}
