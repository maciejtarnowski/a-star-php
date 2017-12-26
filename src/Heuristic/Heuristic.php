<?php

namespace Astar\Heuristic;

use Fhaculty\Graph\Vertex;

interface Heuristic
{
    public function estimateCost(Vertex $start, Vertex $goal): int;
}
