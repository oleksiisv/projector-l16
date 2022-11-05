<?php
declare(strict_types=1);
require 'src/Tree.php';
try {
    $tree = new Tree;
    //Create root
    $tree->insert(512);
    populateTree($tree, 100);
} catch (\Exception $e) {
    file_put_contents('exception.log', $e->getMessage(), FILE_APPEND);
}
/**
 * @param Tree $tree
 * @param int $items
 * @param int $rangeFrom
 * @param int $rangeTo
 *
 * @return array
 * @throws Exception
 */
function populateTree(Tree $tree, int $items = 100, int $rangeFrom = 0, int $rangeTo = 1000)
{
    $result = [];
    for ($i = 0; $i < $items; $i++) {
        $tree->insert(random_int($rangeFrom, $rangeTo));
    }

    return $result;
}
