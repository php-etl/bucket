<?php

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;

final class AcceptanceAppendableResultBucket implements AcceptanceResultBucketInterface
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

    public function walkAcceptance(): iterable
    {
        return $this->iterator;
    }
}
