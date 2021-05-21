<?php

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket\RejectionResultBucketInterface;

final class AppendableIteratorRejectionResultBucket implements RejectionResultBucketInterface
{
    private iterable $iterator;

    public function __construct(\Iterator ...$iterators)
    {
        $this->iterator = new \AppendIterator();
        foreach ($iterators as $iterator) {
            $this->iterator->append($iterator);
        }
    }

    public function append(\Iterator ...$iterators)
    {
        foreach ($iterators as $iterator) {
            $this->iterator->append($iterator);
        }
    }

    public function walkRejection(): iterable
    {
        return $this->iterator;
    }
}
