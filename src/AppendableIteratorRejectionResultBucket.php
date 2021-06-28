<?php

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type
 * @implements Contract\RejectionResultBucketInterface<Type>
 */
final class AppendableIteratorRejectionResultBucket implements Contract\RejectionResultBucketInterface
{
    /** @var \AppendIterator<Type>  */
    private \AppendIterator $iterator;

    /** @param \Iterator<Contract\RejectionResultBucketInterface<Type>> ...$iterators */
    public function __construct(\Iterator ...$iterators)
    {
        $this->iterator = new \AppendIterator();
        foreach ($iterators as $iterator) {
            $this->iterator->append($iterator);
        }
    }

    /** @param \Iterator<Contract\RejectionResultBucketInterface<Type>> ...$iterators */
    public function append(\Iterator ...$iterators): void
    {
        foreach ($iterators as $iterator) {
            $this->iterator->append($iterator);
        }
    }

    /** @return iterable<Type> */
    public function walkRejection(): iterable
    {
        return $this->iterator;
    }
}
