<?php

namespace Kiboko\Component\ETL\Bucket;

use Kiboko\Component\ETL\Contracts\RejectionResultBucketInterface;

final class RejectionAppendableResultBucket implements RejectionResultBucketInterface
{
    /** @var \AppendIterator */
    private $iterator;

    public function __construct(\Iterator ...$iterators)
    {
        $this->iterator = new \AppendIterator();
        foreach ($iterators as $iterator){
            $this->iterator->append($iterator);
        }
    }

    public function append(\Iterator ...$iterators)
    {
        foreach ($iterators as $iterator){
            $this->iterator->append($iterator);
        }
    }

    public function walkRejection(): iterable
    {
        return $this->iterator;
    }
}
