<?php

require_once __DIR__ . '/vendor/autoload.php';

$graph = (new \Astar\Graph\CapitalsGraph())->getGraph();

$graphViz = new \Graphp\GraphViz\GraphViz();
$graphViz->display($graph);
