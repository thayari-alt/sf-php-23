<?
function getPartsFromFullname($str) {
  $arr = explode(' ', $str);
  return [
    'surname'=>$arr[0],
    'name'=>$arr[1],
    'patronomyc'=>$arr[2],
    ];
};

function getFullnameFromParts(array $arr) {
  return implode(' ', $arr);;
};

function getShortName($str) {
  $parts = getPartsFromFullname($str);
  return $parts['surname'].' '.mb_substr($parts['name'], 0, 1).'.';
};
