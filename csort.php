<?php


function countingSort($dataset)
{
    $size = count($dataset);
    $max = 0;
    for ($i = 0; $i < $size; $i++) {
        if ($max < $dataset[$i]) {
            $max = $dataset[$i];
        }
    }
    $freq = [];
    for ($i = 0; $i < $max + 1; $i++) {
        $freq[$i] = 0;
    }
    for ($i = 0; $i < $size; $i++) {
        $freq[$dataset[$i]]++;
    }

    for ($i = 0, $j = 0; $i <= $max; $i++) {
        while ($freq[$i] > 0) {
            $dataset[$j] = $i;
            $j++;
            $freq[$i]--;
        }
    }

    return $dataset;
}

function printResult($dataset){
    $size = count($dataset);
    for ($i = 0; $i < $size; $i++)
        echo $dataset[$i]." ";
    echo "\n";
}

$dataset = [];
$datasetSize = 100;
for ($i = 0; $i < $datasetSize; $i++){
    $dataset[] = random_int(0, 10);
}


print_r("Initial dataset\n");
printResult($dataset);
print_r("Sorted dataset\n");
printResult(countingSort($dataset));
