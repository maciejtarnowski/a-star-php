<?php

namespace Astar;

class ReversePriorityQueue extends \SplPriorityQueue
{
    public function compare($priority1, $priority2)
    {
        return parent::compare($priority2, $priority1);
    }
}
