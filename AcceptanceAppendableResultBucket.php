<?php

namespace Kiboko\Component\ETL\Bucket;

use Kiboko\Component\ETL\Contracts\AcceptanceResultBucketInterface;

final class AcceptanceAppendableResultBucket implements AcceptanceResultBucketInterface
{
    /**
     * @var \Iterator
     */
    private $iterator;

    /**
     * @param \Iterator ...$iterators
     */
    public function __construct(\Iterator ...$iterators)
    {
        $this->iterator = new \AppendIterator();
        foreach ($iterators as $iterator){
            $this->iterator->append($iterator);
        }
    }

    /**
     * @param \Iterator ...$iterators
     */
    public function append(\Iterator ...$iterators)
    {
        foreach ($iterators as $iterator){
            $this->iterator->append($iterator);
        }
    }

    public function walkAcceptance(): iterable
    {
        return $this->iterator;
    }
}
