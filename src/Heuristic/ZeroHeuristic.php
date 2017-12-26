<?php

namespace Astar\Heuristic;

use Fhaculty\Graph\Vertex;

class ZeroHeuristic implements Heuristic
{
    public function estimateCost(Vertex $start, Vertex $goal): int
    {
        return 0;
    }
}
