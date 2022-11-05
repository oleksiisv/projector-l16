<?php
declare(strict_types=1);

class Node
{
    public $left;
    public $right;
    public $data;

    public function __construct($data = null)
    {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }

    /**
     * @return Node
     */
    public function min(): Node
    {
        $node = $this;
        while ($node->left) {
            if (!$node->left) {
                break;
            }
            $node = $node->left;
        }

        return $node;
    }

    /**
     * @return Node
     */
    public function max(): Node
    {
        $node = $this;
        while ($node->right) {
            if (!$node->right) {
                break;
            }
            $node = $node->right;
        }

        return $node;
    }
}