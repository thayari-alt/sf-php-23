<?

function getPerfectPartner($surname, $name, $patronomyc, $data) {
  function getPartner($gender, $data) {
    $match = false;
    while ($match == false) {
      $partner = $data[mt_rand(0, count($data) - 1)];
      if (getGenderFromName($partner['fullname']) == $gender * -1) {
        $match = true;
        return $partner['fullname'];
      } else {
        continue;
      }
    }
  }

  $surname = mb_convert_case($surname, MB_CASE_TITLE, "UTF-8");
  $name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
  $patronomyc = mb_convert_case($patronomyc, MB_CASE_TITLE, "UTF-8");

  $fullname = getFullnameFromParts([$surname, $name, $patronomyc]);

  $gender = getGenderFromName($fullname);

  $partner = getPartner($gender, $data);

  $getShortName = 'getShortName';

  $randNum = mt_rand(50, 99).'.'.mt_rand(1, 99);

  $html = <<<HEREDOC
    <div>{$getShortName($fullname)} + {$getShortName($partner)} =<br>
    ♡ Идеально на {$randNum}% ♡</div>
HEREDOC;

  return $html;

}