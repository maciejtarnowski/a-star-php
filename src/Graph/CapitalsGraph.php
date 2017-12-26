<?php

namespace Astar\Graph;

use Fhaculty\Graph\Edge\Undirected;
use Fhaculty\Graph\Graph;

class CapitalsGraph implements GraphLoader
{
    public const LATITUDE = 'lat';
    public const LONGITUDE = 'lon';

    public function getGraph(): Graph
    {
        $graph = new Graph();

        $warsaw = $graph->createVertex('Warsaw');
        $warsaw->setAttribute(self::LATITUDE, '52.232222');
        $warsaw->setAttribute(self::LONGITUDE, '21.008333');

        $berlin = $graph->createVertex('Berlin');
        $berlin->setAttribute(self::LATITUDE, '52.518611');
        $berlin->setAttribute(self::LONGITUDE, '13.408333');

        $paris = $graph->createVertex('Paris');
        $paris->setAttribute(self::LATITUDE, '48.866667');
        $paris->setAttribute(self::LONGITUDE, '2.35');

        $london = $graph->createVertex('London');
        $london->setAttribute(self::LATITUDE, '51.5');
        $london->setAttribute(self::LONGITUDE, '-0.116667');

        $madrid = $graph->createVertex('Madrid');
        $madrid->setAttribute(self::LATITUDE, '40.417778');
        $madrid->setAttribute(self::LONGITUDE, '-3.694722');

        $rome = $graph->createVertex('Rome');
        $rome->setAttribute(self::LATITUDE, '41.883333');
        $rome->setAttribute(self::LONGITUDE, '12.483333');

        $stockholm = $graph->createVertex('Stockholm');
        $stockholm->setAttribute(self::LATITUDE, '59.333333');
        $stockholm->setAttribute(self::LONGITUDE, '18.05');

        $copenhagen = $graph->createVertex('Copenhagen');
        $copenhagen->setAttribute(self::LATITUDE, '55.666667');
        $copenhagen->setAttribute(self::LONGITUDE, '12.566667');

        $oslo = $graph->createVertex('Oslo');
        $oslo->setAttribute(self::LATITUDE, '59.912997');
        $oslo->setAttribute(self::LONGITUDE, '10.737997');

        $lisbon = $graph->createVertex('Lisbon');
        $lisbon->setAttribute(self::LATITUDE, '38.7');
        $lisbon->setAttribute(self::LONGITUDE, '-9.183333');

        $vilnius = $graph->createVertex('Vilnius');
        $vilnius->setAttribute(self::LATITUDE, '54.683333');
        $vilnius->setAttribute(self::LONGITUDE, '25.283333');

        $riga = $graph->createVertex('Riga');
        $riga->setAttribute(self::LATITUDE, '56.966667');
        $riga->setAttribute(self::LONGITUDE, '24.133333');

        $tallinn = $graph->createVertex('Tallinn');
        $tallinn->setAttribute(self::LATITUDE, '59.433333');
        $tallinn->setAttribute(self::LONGITUDE, '24.75');

        $prague = $graph->createVertex('Prague');
        $prague->setAttribute(self::LATITUDE, '50.087778');
        $prague->setAttribute(self::LONGITUDE, '14.421111');

        $bratislava = $graph->createVertex('Bratislava');
        $bratislava->setAttribute(self::LATITUDE, '48.146825');
        $bratislava->setAttribute(self::LONGITUDE, '17.107239');

        $vienna = $graph->createVertex('Vienna');
        $vienna->setAttribute(self::LATITUDE, '48.216667');
        $vienna->setAttribute(self::LONGITUDE, '16.366667');

        $budapest = $graph->createVertex('Budapest');
        $budapest->setAttribute(self::LATITUDE, '47.5');
        $budapest->setAttribute(self::LONGITUDE, '19.05');

        $brussels = $graph->createVertex('Brussels');
        $brussels->setAttribute(self::LATITUDE, '50.833333');
        $brussels->setAttribute(self::LONGITUDE, '4.35');

        $amsterdam = $graph->createVertex('Amsterdam');
        $amsterdam->setAttribute(self::LATITUDE, '52.366667');
        $amsterdam->setAttribute(self::LONGITUDE, '4.9');

        $bern = $graph->createVertex('Bern');
        $bern->setAttribute(self::LATITUDE, '46.95');
        $bern->setAttribute(self::LONGITUDE, '7.45');

        $helsinki = $graph->createVertex('Helsinki');
        $helsinki->setAttribute(self::LATITUDE, '60.166667');
        $helsinki->setAttribute(self::LONGITUDE, '24.933333');

        $kiev = $graph->createVertex('Kiev');
        $kiev->setAttribute(self::LATITUDE, '50.45');
        $kiev->setAttribute(self::LONGITUDE, '30.5');

        $minsk = $graph->createVertex('Minsk');
        $minsk->setAttribute(self::LATITUDE, '53.9');
        $minsk->setAttribute(self::LONGITUDE, '27.55');

        $edges = [
            [$warsaw, $berlin, 518],
            [$berlin, $paris, 878],
            [$paris, $london, 344],
            [$london, $madrid, 1265],
            [$paris, $madrid, 1054],
            [$paris, $brussels, 264],
            [$amsterdam, $brussels, 173],
            [$berlin, $rome, 1184],
            [$warsaw, $stockholm, 840],
            [$warsaw, $vilnius, 393],
            [$warsaw, $prague, 518],
            [$prague, $bratislava, 290],
            [$prague, $vienna, 251],
            [$bratislava, $vienna, 55],
            [$vilnius, $riga, 262],
            [$riga, $tallinn, 279],
            [$tallinn, $helsinki, 82],
            [$helsinki, $oslo, 788],
            [$helsinki, $stockholm, 385],
            [$stockholm, $oslo, 415],
            [$berlin, $copenhagen, 356],
            [$warsaw, $copenhagen, 672],
            [$madrid, $lisbon, 503],
            [$bratislava, $budapest, 162],
            [$bern, $vienna, 670],
            [$kiev, $warsaw, 690],
            [$warsaw, $minsk, 476],
            [$kiev, $minsk, 434]
        ];

        foreach ($edges as $edge) {
            /** @var Undirected $undirectedEdge */
            $undirectedEdge = $edge[0]->createEdge($edge[1]);
            $undirectedEdge->setWeight($edge[2]);
        }

        return $graph;
    }
}
