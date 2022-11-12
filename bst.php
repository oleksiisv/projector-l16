<?php
declare(strict_types=1);
require 'src/Tree.php';
try {
    process();
} catch (\Exception $e) {
    file_put_contents('exception.log', $e->getMessage(), FILE_APPEND);
}
/**
 * @param int $items
 * @param int $rangeFrom
 * @param int $rangeTo
 *
 * @return array
 * @throws Exception
 */
function generateDataset(int $items = 100, int $rangeFrom = 0, int $rangeTo = 1000)
{
    $list = [];
    for ($i = 0; $i < $items; $i++) {
        $list[] = random_int($rangeFrom, $rangeTo);
    }
    sort($list);

    return $list;
}

/**
 * @return void
 * @throws Exception
 */
function process()
{
    $case = 'find';
    $tree = new Tree;
    for ($i = 1; $i <= 100; $i++) {
        $multiplier = 10;
        $items = 10 * $i * $multiplier;
        $rangeFrom = $i * $multiplier;
        $rangeTo = 1000 * $i * $multiplier;
        $dataset = generateDataset($items, $rangeFrom, $rangeTo);
        switch ($case) {
            case 'insert':
                $start = microtime(true);
                $tree->balance($dataset);
                $delta = microtime(true) - $start;
                print_r($delta . "\n");
                break;
            case 'find':
                $tree->balance($dataset);
                $start = microtime(true);
                foreach ($dataset as $value) {
                    $tree->find($value);
                }
                $delta = microtime(true) - $start;
                print_r($delta . "\n");
                break;
            case 'delete':
                $tree->balance($dataset);
                $start = microtime(true);
                foreach ($dataset as $value) {
                    $tree->delete($value);
                }
                $delta = microtime(true) - $start;
                print_r($delta . "\n");
                $tree->balance($dataset);
        }
    }
}

