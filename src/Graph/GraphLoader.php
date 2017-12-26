<?php
namespace Astar\Graph;

use Fhaculty\Graph\Graph;

interface GraphLoader
{
    public function getGraph(): Graph;
}
