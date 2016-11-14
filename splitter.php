<?php
// Use $argv variable.
$full_csv_file = $argv[1];
$output = $argv[2];
$header = $argv[3]
$extension = $argv[4];
$limit = $argv[5];

// Just a simple validation for file output.
if (empty($output)) {
  die('Please output file parameter');
}

$handle = fopen($full_csv_file, "r");
if ($handle) {
  $limit = !empty($limit) ? $limit : 1000;
  $extension = !empty($extension) ? $extension : '.csv';
  $index = 0;
  $loop = 0;
  $i = 0;
  while (($line = fgets($handle)) !== false) {
    if ($index == 0 || $loop == $limit) {
      $index++;
      $loop = 0;
    }
    $file = $output . _ . $index . $extension;
    if (file_exists($file)) {
      $fh = fopen($file, 'a');
    } else {
      $fh = fopen($file, 'w');
      fwrite($fh, $header);
    }
    fwrite($fh, $line);
    fclose($fh);
    $loop++;
    $i++;
  }

  fclose($handle);
  echo "Total rows : " . $i . "\n";
  echo "Total files created : " . $index . "\n";
}
else {
  die('Cannot open file.');
}
