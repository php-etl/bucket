<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type
 *
 * @implements Contract\RejectionResultBucketInterface<Type>
 */
final readonly class IteratorRejectionResultBucket implements Contract\RejectionResultBucketInterface
{
    /** @param \Iterator<Type> $iterator */
    public function __construct(private \Iterator $iterator)
    {
    }

    /** @return iterable<Type> */
    public function walkRejection(): iterable
    {
        return $this->iterator;
    }
}
