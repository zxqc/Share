<?php
/**
 * Created by PhpStorm.
 * User: zxqc2018
 * Date: 2019/3/30
 * Time: 21:27
 */

namespace Share\DataStructure\Tree;

/**
 * Class Node
 * @package Share\DataStructure\Tree
 * @author zxqc2018
 */
class Node
{
    /**
     * @var node
     */
    private $parent;

    /**
     * @var node
     */
    private $left;

    /**
     * @var node
     */
    private $right;

    /**
     * @var int
     */
    private $key;

    /**
     * Node constructor.
     * @param int $key
     */
    public function __construct(int $key)
    {
        $this->setKey($key);
    }

    /**
     * @return Node|null
     * @author zxqc2018
     */
    public function getParent(): ?Node
    {
        return $this->parent;
    }

    /**
     * @param Node|null $parent
     * @return $this
     * @author zxqc2018
     */
    public function setParent(?node $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Node|null
     * @author zxqc2018
     */
    public function getLeft(): ?node
    {
        return $this->left;
    }

    /**
     * @param Node|null $left
     * @return $this
     * @author zxqc2018
     */
    public function setLeft(?node $left)
    {
        $this->left = $left;

        return $this;
    }

    /**
     * @return Node|null
     * @author zxqc2018
     */
    public function getRight(): ?node
    {
        return $this->right;
    }

    /**
     * @param Node|null $right
     * @return $this
     * @author zxqc2018
     */
    public function setRight(?node $right)
    {
        $this->right = $right;

        return $this;
    }

    /**
     * @return int
     * @author zxqc2018
     */
    public function getKey(): int
    {
        return $this->key;
    }

    /**
     * @param int $key
     * @return $this
     * @author zxqc2018
     */
    private function setKey(int $key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * 输出
     * @return string
     * @author zxqc2018
     */
    public function __toString()
    {
        return (string)$this->getKey();
    }
}