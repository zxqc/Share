<?php
/**
 * Created by PhpStorm.
 * User: zxqc2018
 * Date: 2019/3/31
 * Time: 22:32
 */

namespace Share\DataStructure\Tree\Tests;


use PHPUnit\Framework\TestCase;
use Share\DataStructure\Tree\BinarySearchTree;
use Share\DataStructure\Tree\Node;

class Tree extends TestCase
{
    public function testBinarySearchTree()
    {
        $tree = new BinarySearchTree();
        $node[] = $tree->insert(110);
        $node[] = $tree->insert(5);
//        $node[] = $tree->insert(1);
//        $node[] = $tree->insert(4);
//        $node[] = $tree->insert(4);
//        $node[] = $tree->insert(4);
        $node[] = $tree->insert(120);
        $node[] = $tree->insert(115);
        $node[] = $tree->insert(112);
//
        foreach (range(1,20) as $anon) {
//                $node[] = $tree->insert(mt_rand(1, 999));
        }

//        var_dump($tree->getSuccessor($node[4]) == $node[3]);
//        var_dump($tree->getSuccessor($node[2]) == $node[3]);
//        var_dump($tree->getSuccessor($node[6]));

        $tree->delete($node[0]);
        var_dump($tree->showTree());
        $show1 = $tree->walkTree($tree->getRoot(), 1);

        var_dump($show1);
        $show2 = $tree->walkTree($tree->getRoot());
        $count1 = array_count_values($show1);
        $count2 = array_count_values($show2);
//        print_r([array_count_values($show1), array_count_values($show2)]);
//        print_r([$count1[110] ?? null, $count2[110] ?? null]);
//        print_r(array_diff($show1, $show2));

//        $tree->showTree();
//        var_dump($tree->findMinNode($tree->getRoot())->getKey());
//        var_dump($tree->findMaxNode($tree->getRoot())->getKey());
//        var_dump($tree->getSuccessor($node[4]) === $node[5]);
//        var_dump($tree->getPredecessor($node[4]) === $node[3]);
//        var_dump($tree->getPredecessor($node[1])->getKey());
//        var_dump($tree->getSuccessor($node[1])->getKey());

//        var_dump($tree->search(4) === $node[3]);
//        var_dump($tree->searchRecursion(4) === $node[3]);

        $a = new Node(1);
        $b = new Node(1);
        $c = $a;
//        $c->setKey(5);
//        var_dump($a === $b);
//        var_dump($a === $c);

//        BenchMark::executeTime(function () { echo 11 . "\n";}, [], 4);
//        BenchMark::executeTime('Share\Util\BenchMark::test', [], 4);
//        BenchMark::executeTime('Share\Util\BenchMark::test', [], 4);
    }

    public function testWalkTree()
    {
        $tree = new BinarySearchTree();
        $node[] = $tree->insert(ord('g'));
        $node[] = $tree->insert(ord('d'));
        $node[] = $tree->insert(ord('m'));
        $node[] = $tree->insert(ord('a'));
        $node[] = $tree->insert(ord('f'));
        $node[] = $tree->insert(ord('e'));
        $node[] = $tree->insert(ord('h'));
        $node[] = $tree->insert(ord('z'));
        $tree->delete($node[0]);
        $tree->showTree();
        print_r(array_map('chr', $tree->walkTree($tree->getRoot())));
        print_r(array_map('chr', $tree->walkTree($tree->getRoot(), 1)));
        print_r(array_map('chr', $tree->walkTree($tree->getRoot(), 2)));
    }
    public function testWalk()
    {
        $tree = new BinarySearchTree();
        $node[] = $tree->insert(15);
        $node[] = $tree->insert(6);
        $node[] = $tree->insert(18);
        $node[] = $tree->insert(17);
        $node[] = $tree->insert(20);
        $node[] = $tree->insert(3);
        $node[] = $tree->insert(7);
        $node[] = $tree->insert(2);
        $node[] = $tree->insert(4);
        $node[] = $tree->insert(13);
        $node[] = $tree->insert(9);
//        $tree->delete($node[0]);
        $tree->showTree();
        print_r(join(' ', $tree->walkTree($tree->getRoot(), 0)) . "\n");
        print_r(join(' ', $tree->walkTree($tree->getRoot(), 1)) . "\n");
        print_r(join(' ', $tree->walkTree($tree->getRoot(), 2)) . "\n");
    }
}