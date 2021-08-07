<?
  function getGenderFromName(string $str) {
    $gender = 0;

    $name = getPartsFromFullname($str);

    $genderF = [
      mb_substr($name['surname'],-2,2) == 'ва',
      mb_substr($name['name'],-1,1) == 'а',
      mb_substr($name['patronomyc'],-3,3) == 'вна',
    ];
    $genderM = [
      mb_substr($name['surname'],-1,1) == 'в',
      mb_substr($name['name'],-1,1) == 'й' ||
      mb_substr($name['name'],-1,1) == 'н',
      mb_substr($name['patronomyc'],-2,2) == 'ич',
    ];
    foreach ($genderF as $value) {
      if ($value) {
        $gender--;
      }
    }
    foreach ($genderM as $value) {
      if ($value) {
        $gender++;
      }
    }

    return $gender <=> 0;
  }

  function getGenderDescription($arr) {
    $gendersArr = [];
    foreach ($arr as $value) {
      $gendersArr[] = getGenderFromName($value['fullname']);
    }

    function countGender($num, $gendersArr) {
      $result = count(array_filter($gendersArr, function($value) use ($num) {
        return $value == $num;
      }));
      return $result;
    }

    function percent($num, $gendersArr) {
      return round($num/count($gendersArr) * 100, 1);
    }

    $male = countGender(1, $gendersArr);
    $female = countGender(-1, $gendersArr);
    $neutral = countGender(0, $gendersArr);

    $percent = 'percent';
    $html = <<<HEREDOC
      <div>Гендерный состав аудитории:<br>
      ---------------------------<br>
      Мужчины - {$percent($male, $gendersArr)}%<br>
      Женщины - {$percent($female, $gendersArr)}%<br>
      Не удалось определить - {$percent($neutral, $gendersArr)}%</div>
HEREDOC;

    return $html;
  }
