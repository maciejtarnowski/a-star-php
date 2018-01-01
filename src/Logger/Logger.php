<?php

namespace Astar\Logger;

use Fhaculty\Graph\Set\Vertices;
use Fhaculty\Graph\Vertex;

class Logger
{
    public function logStart(Vertex $start): void
    {
        vprintf('Starting point: %s' . PHP_EOL, [$start->getId()]);
    }

    public function logGoal(Vertex $goal): void
    {
        vprintf('Goal: %s' . PHP_EOL, [$goal->getId()]);
    }

    public function logStartGoalEstimation(float $estimation): void
    {
        vprintf('Estimated distance between start and goal: %.3f' . PHP_EOL . PHP_EOL, [$estimation]);
    }

    public function logCurrentlyEvaluatedVertex(Vertex $current): void
    {
        vprintf('Evaluating vertex: %s' . PHP_EOL, [$current->getId()]);
    }

    public function logReconstructedPath(Vertices $path): void
    {
        echo PHP_EOL . 'Found path: ';
        $this->logPath($path);
        echo PHP_EOL;
    }

    private function logPath(Vertices $path): void
    {
        $formattedPath = '';

        /** @var Vertex $vertex */
        foreach ($path as $key => $vertex) {
            if ($key > 0) {
                $formattedPath .= ' -> ';
            }
            $formattedPath .= $vertex->getId();
        }

        echo $formattedPath;
    }

    public function logNeighbor(Vertex $neighbor): void
    {
        vprintf('Checking neighbor: %s' . PHP_EOL, [$neighbor->getId()]);
    }

    public function logTentativeScore(float $tentativeScore): void
    {
        vprintf('Calculated tentative score: %.3f' . PHP_EOL, [$tentativeScore]);
    }

    public function logFScore(float $fScore): void
    {
        vprintf('Calculated fScore: %.3f' . PHP_EOL, [$fScore]);
    }

    public function logRouteDistance(float $gScore): void
    {
        vprintf('Total length of found route: %.3f' . PHP_EOL, [$gScore]);
    }
}
