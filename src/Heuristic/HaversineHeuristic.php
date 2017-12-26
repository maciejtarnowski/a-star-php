<?php

namespace Astar\Heuristic;

use Astar\Graph\CapitalsGraph;
use Fhaculty\Graph\Vertex;

class HaversineHeuristic implements Heuristic
{
    public function estimateCost(Vertex $start, Vertex $goal): int
    {
        $latFrom = deg2rad((float) $start->getAttribute(CapitalsGraph::LATITUDE));
        $lonFrom = deg2rad((float) $start->getAttribute(CapitalsGraph::LONGITUDE));
        $latTo = deg2rad((float) $goal->getAttribute(CapitalsGraph::LATITUDE));
        $lonTo = deg2rad((float) $goal->getAttribute(CapitalsGraph::LONGITUDE));

        $deltaLat = $latTo - $latFrom;
        $deltaLon = $lonTo - $lonFrom;

        $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos($latFrom) * cos($latTo) * sin($deltaLon / 2) * sin($deltaLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return 6371 * $c;
    }
}
