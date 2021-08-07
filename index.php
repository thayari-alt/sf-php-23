<?
include 'data.php';
include 'names.php';
include 'gender.php';
include 'partner.php';

echo getGenderDescription($example_persons_array);
echo '<hr />';
echo getPerfectPartner('Достоевский', 'Федор', 'Михайлович', $example_persons_array);
