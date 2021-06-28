<?php

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type
 * @implements Contract\RejectionResultBucketInterface<Type>
 */
final class IteratorRejectionResultBucket implements Contract\RejectionResultBucketInterface
{
    /** @var \Iterator<Type> */
    private \Iterator $iterator;

    /** @param \Iterator<Type> $iterator */
    public function __construct(\Iterator $iterator)
    {
        $this->iterator = $iterator;
    }

    /** @return iterable<Type> */
    public function walkRejection(): iterable
    {
        return $this->iterator;
    }
}
