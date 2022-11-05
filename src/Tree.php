<?php
declare(strict_types=1);
require 'Node.php';

class Tree
{
    private $root;

    public function __construct()
    {
        $this->root = null;
    }

    /**
     * @param int $value
     *
     * @return null
     * @throws Exception
     */
    public function find(int $value)
    {
        $this->isEmpty();
        if ($value === $this->root->data) {
            return $this->root;
        }
        $node = $this->root;
        while ($node) {
            if ($value > $node->data) {
                $node = $node->right;
            } elseif ($value < $node->data) {
                $node = $node->left;
            } else {
                break;
            }
        }

        return $node;
    }

    /**
     * @param int $value
     *
     * @return bool|Node
     */
    public function insert(int $value)
    {
        $node = $this->root;
        if (!$node) {
            return $this->root = new Node($value);
        }
        while ($node) {
            if ($value < $node->data) {
                if ($node->left) {
                    $node = $node->left;
                } else {
                    $node = $node->left = new Node($value);
                    break;
                }
            } elseif ($value > $node->data) {
                if ($node->right) {
                    $node = $node->right;
                } else {
                    $node = $node->right = new Node($value);
                    break;
                }
            } else {
                break;
            }
        }

        return $node;
    }

    /**
     * @throws Exception
     */
    private function isEmpty()
    {
        if ($this->root === null) {
            throw new Exception('Tree is empty');
        }
    }

    /**
     * @return Node
     * @throws Exception
     */
    public function min(): Node
    {
        $this->isEmpty();
        $node = $this->root;

        return $node->min();
    }

    /**
     * @return Node
     * @throws Exception
     */
    public function max(): Node
    {
        $this->isEmpty();
        $node = $this->root;

        return $node->max();
    }

    /**
     * @param int|Node $value
     *
     * @return bool|void
     * @throws Exception
     */
    public function delete($value)
    {
        $this->isEmpty();
        /** @var Node $node */
        $node = is_int($value) ? $this->find($value) : $value;
        /** @var Node $parent */
        $parent = $this->findParent($node->data);
        if ($node->left && $node->right) {

            $min = $node->right->min();
            $this->delete($min);
            $node->data = $min->data;

            return true;
        } elseif ($node->left) {
            if (!$parent) {
                return false;
            }
            if ($parent->left === $node) {
                $parent->left = $node->left;
            }
            if ($parent->right === $node) {
                $parent->right = $node->left;
            }
            $node->left = null;
        } elseif ($node->right) {
            if (!$parent) {
                return false;
            }
            if ($parent->left === $node) {
                $parent->left = $node->right;
            }
            if ($parent->right === $node) {
                $parent->right = $node->right;
            }
            $node->right = null;
        } else {
            if ($parent->right === $node) {
                $parent->right = null;
            }
            if ($parent->left === $node) {
                $parent->left = null;
            }
        }

        return true;
    }

    /**
     * @param $value
     *
     * @return false
     */
    public function findParent($value)
    {
        //if value equals root -- no parent
        if ($value === $this->root->data) {
            return false;
        }
        $node = $this->root;
        $result = false;
        while ($node) {
            if ($value > $node->data) {
                $result = $node;
                $node = $node->right;
            } elseif ($value < $node->data) {
                $result = $node;
                $node = $node->left;
            } else {
                break;
            }
        }

        return $result;
    }
}