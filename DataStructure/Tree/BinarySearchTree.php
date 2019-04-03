<?php
/**
 * Created by PhpStorm.
 * User: zxqc2018
 * Date: 2019/3/30
 * Time: 21:27
 */

namespace Share\DataStructure\Tree;


class BinarySearchTree
{
    /**
     * @var Node
     */
    private $root;

    /**
     * @return Node
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * 插入节点key
     * @param int $key
     * @return Node
     * @author zxqc2018
     */
    public function insert(int $key)
    {
        $x = $this->getRoot();
        $y = null;
        $z = new Node($key);

        while (!is_null($x)) {
            $y = $x;
            if ($key < $x->getKey()) {
                $x = $x->getLeft();
            } else {
                $x = $x->getRight();
            }
        }

        //设置插入节点的父节点
        $z->setParent($y);

        //假如树还没根节点
        if (is_null($y)) {
            $this->root = $z;
        } else if ($key < $y->getKey()) {
            $y->setLeft($z);
        } else {
            $y->setRight($z);
        }

        return $z;
    }

    /**
     * 遍历节点,获取key数组
     * @param Node $node 节点
     * @param int $type 遍历类型 0 中序 1 前序 2 后序
     * @return array
     * @author zxqc2018
     */
    public function walkTree(Node $node, int $type = 0)
    {
        $keyArr = [];
        $walkTreeFunc = function (?Node $node) use (&$keyArr, &$walkTreeFunc, $type){
            if (!is_null($node)) {
                if ($type === 1) {
                    $keyArr[] = $node->getKey();
                    $walkTreeFunc($node->getLeft());
                    $walkTreeFunc($node->getRight());
                }  else if ($type == 2) {
                    $walkTreeFunc($node->getLeft());
                    $walkTreeFunc($node->getRight());
                    $keyArr[] = $node->getKey();
                } else {
                    $walkTreeFunc($node->getLeft());
                    $keyArr[] = $node->getKey();
                    $walkTreeFunc($node->getRight());
                }
            }
        };

        $walkTreeFunc($node);

        return $keyArr;
    }

    /**
     * 输出整棵树
     * @param string $newLineChar 换行符
     * @param int $inc 每层空格增量
     * @author zxqc2018
     */
    public function showTree($newLineChar = "\n", int $inc = 10)
    {

        $showTreeFunc = function (?Node $node, int $space) use ($newLineChar, $inc, &$showTreeFunc) {
            if (is_null($node)) {
                return;
            }

            $space += $inc;

            $showTreeFunc($node->getRight(), $space);

            echo $newLineChar;

            echo str_repeat(" ", $space - $inc);

            echo $node->getKey();

            echo $newLineChar;


            $showTreeFunc($node->getLeft(), $space);
        };

        $showTreeFunc($this->getRoot(), 0);
    }

    /**
     * 根据key, 查找节点
     * @param int $key
     * @param Node|null $node
     * @return Node|null
     * @author zxqc2018
     */
    public function search(int $key, Node $node = null)
    {
        if (is_null($node)) {
            $node = $this->getRoot();
        }

        while (!is_null($node) && $key != $node->getKey()) {
            if ($key < $node->getKey()) {
                $node = $node->getLeft();
            } else {
                $node = $node->getRight();
            }
        }

        return $node;
    }

    /**
     * 根据key, 查找节点
     * @param int $key
     * @param Node|null $node
     * @return mixed
     * @author zxqc2018
     */
    public function searchRecursion(int $key, Node $node = null)
    {
        if (is_null($node)) {
            $node = $this->getRoot();
        }

        $recursionFunc = function ($key, Node $node) use (&$recursionFunc) {
            if (is_null($node) || $node->getKey() == $key) {
                return $node;
            }

            if ($key < $node->getKey()) {
                return $recursionFunc($key, $node->getLeft());
            } else {
                return $recursionFunc($key, $node->getRight());
            }
        };
        return $recursionFunc($key, $node);
    }

    /**
     * 查找最小节点
     * @param Node|null $node
     * @return Node|null
     * @author zxqc2018
     */
    public function findMinNode(Node $node)
    {
        if (!is_null($node)) {
            while (!is_null($node->getLeft())) {
                $node = $node->getLeft();
            }
        }
        return $node;
    }

    /**
     * 查找最大节点
     * @param Node|null $node
     * @return Node|null
     * @author zxqc2018
     */
    public function findMaxNode(Node $node)
    {
        if (!is_null($node) && !is_null($node->getRight())) {
            $node = $this->findMaxNode($node->getRight());
        }
        return $node;
    }

    /**
     * 获取节点的后继
     * @param Node $node
     * @return Node|null
     * @author zxqc2018
     */
    public function getSuccessor(Node $node)
    {
        //是否有右孩子
        if (!is_null($node->getRight())) {
            return $this->findMinNode($node->getRight());
        }

        $y = $node->getParent();

        //向上逐层判断是否为祖先的右孩子
        while (!is_null($y) && $node === $y->getRight()) {
            $node = $y;
            $y = $y->getParent();
        }

        return $y;
    }

    /**
     * 获取节点的前驱
     * @param Node $node
     * @return Node|null
     * @author zxqc2018
     */
    public function getPredecessor(Node $node)
    {
        //是否有左孩子
        if (!is_null($node->getLeft())) {
            return $this->findMaxNode($node->getLeft());
        }

        $y = $node->getParent();

        //向上逐层判断是否为祖先的左孩子
        while (!is_null($y) && $node === $y->getLeft()) {
            $node = $y;
            $y = $y->getParent();
        }

        return $y;
    }

    /**
     * 移动节点
     * @param Node $src 源节点
     * @param Node $dst 目标节点
     * @author zxqc2018
     */
    protected function transplantNode(?Node $src, Node $dst)
    {
        if (is_null($dst->getParent())) {
            $this->root = $src;
        }else if ($dst === $dst->getParent()->getLeft()) {
            $dst->getParent()->setLeft($src);
        } else {
            $dst->getParent()->setRight($src);
        }

        //源节点不空,则把源节点父节点指向目标节点的父节点
        if (!is_null($src)) {
            $src->setParent($dst->getParent());
        }
    }

    /**
     * 删除节点
     * @param Node $node
     * @author zxqc2018
     */
    public function delete(Node $node)
    {
         if (is_null($node->getLeft())) {
            $this->transplantNode($node->getRight(), $node);
        } else if (is_null($node->getRight())) {
            $this->transplantNode($node->getLeft(), $node);
        } else {
            $successorNode = $this->getSuccessor($node);
            //删除节点的右孩子不是后继节点,则做相应转换
            if ($node->getRight() !== $successorNode) {
                //后继节点的右孩子替换后继节点
                $this->transplantNode($successorNode->getRight(), $successorNode);
                //设置删除节点的右孩子为后继节点的右孩子
                $successorNode->setRight($node->getRight());
                //删除节点的右孩子的父节点改为后继节点
                $successorNode->getRight()->setParent($successorNode);
            }

            //后继节点替换删除节点
            $this->transplantNode($successorNode, $node);
            //设置删除节点的左孩子为后继节点的左孩子
            $successorNode->setLeft($node->getLeft());
            //删除节点的左孩子的父节点改为后继节点
            $successorNode->getLeft()->setParent($successorNode);
        }
    }
}