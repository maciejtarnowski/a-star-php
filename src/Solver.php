<?php

namespace Astar;

use Astar\Heuristic\Heuristic;
use Astar\Logger\Logger;
use Fhaculty\Graph\Edge\Undirected;
use Fhaculty\Graph\Graph;
use Fhaculty\Graph\Set\Vertices;
use Fhaculty\Graph\Vertex;

class Solver
{
    /**
     * @var Graph
     */
    private $graph;

    /**
     * @var Heuristic
     */
    private $heuristic;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * Solver constructor.
     * @param Graph $graph
     * @param Heuristic $heuristic
     * @param Logger $logger
     */
    public function __construct(Graph $graph, Heuristic $heuristic, Logger $logger)
    {
        $this->graph = $graph;
        $this->heuristic = $heuristic;
        $this->logger = $logger;
    }

    /**
     * @param Vertex $start
     * @param Vertex $goal
     * @return Vertices
     * @throws RouteNotFoundException
     */
    public function findRoute(Vertex $start, Vertex $goal): Vertices
    {
        /**
         * @see https://en.wikipedia.org/wiki/A*_search_algorithm#Pseudocode
         */

        $this->logger->logStart($start);
        $this->logger->logGoal($goal);

        $evaluatedVertices = [];

        $verticesToEvaluate = [$start];

        $cameFrom = [];

        // ['NODE_ID' => value], where value is a cost of getting from start to node with NODE_ID
        $gScore = [];

        foreach ($this->graph->getVertices() as $gScoreVertex) {
            /** @var Vertex $gScoreVertex */
            $gScore[$gScoreVertex->getId()] = INF;
        }

        // cost from start -> start equals 0
        $gScore[$start->getId()] = 0;

        // priority queue: (value: NODE_ID, priority: cost)
        // where cost is a cost of getting from start to goal passing by node with NODE_ID
        $fScore = new ReversePriorityQueue();

        foreach ($this->graph->getVertices() as $fScoreVertex) {
            /** @var Vertex $fScoreVertex */
            if ($fScoreVertex->getId() === $start->getId()) {
                continue;
            }
            $fScore->insert($fScoreVertex->getId(), INF);
        }

        $fScore->insert($start->getId(), $this->heuristic->estimateCost($start, $goal));
        $this->logger->logStartGoalEstimation($this->heuristic->estimateCost($start, $goal));

        while (!empty($verticesToEvaluate)) {
            $current = $this->graph->getVertices()->getVertexId($fScore->extract());

            if ($current->getId() === $goal->getId()) {
                $reconstructedPath = $this->reconstructPath($cameFrom, $current);

                $this->logger->logReconstructedPath($reconstructedPath);
                $this->logger->logRouteDistance($gScore[$current->getId()]);

                return $reconstructedPath;
            }

            if (($key = array_search($current, $verticesToEvaluate, true)) !== false) {
                unset($verticesToEvaluate[$key]);
            }

            $evaluatedVertices[] = $current;

            /** @var Undirected $edge */
            foreach ($current->getEdges() as $edge) {
                $neighbor = $edge->getVertexToFrom($current);

                $this->logger->logNeighbor($neighbor);

                if (true === \in_array($neighbor, $evaluatedVertices, true)) {
                    continue;
                }

                if (false === \in_array($neighbor, $verticesToEvaluate, true)) {
                    $verticesToEvaluate[] = $neighbor;
                }

                $tentativeScore = $gScore[$current->getId()] + $edge->getWeight();
                $this->logger->logTentativeScore($tentativeScore);

                if ($tentativeScore >= $gScore[$neighbor->getId()]) {
                    continue;
                }

                $cameFrom[$neighbor->getId()] = $current;
                $gScore[$neighbor->getId()] = $tentativeScore;
                $calculatedFScore = $tentativeScore + $this->heuristic->estimateCost($neighbor, $goal);
                $fScore->insert($neighbor->getId(), $calculatedFScore);

                $this->logger->logFScore($calculatedFScore);
            }
        }

        throw new RouteNotFoundException(
            vsprintf('Route from: %s to: %s not found', [$start->getId(), $goal->getId()])
        );
    }

    private function reconstructPath(array $cameFrom, Vertex $current): Vertices
    {
        $path = [$current];

        while (array_key_exists($current->getId(), $cameFrom)) {
            $current = $cameFrom[$current->getId()];
            array_unshift($path, $current);
        }

        return Vertices::factory($path);
    }
}
