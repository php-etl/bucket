<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type
 *
 * @implements Contract\AcceptanceResultBucketInterface<Type>
 */
final readonly class IteratorAcceptanceResultBucket implements Contract\AcceptanceResultBucketInterface
{
    /** @param \Iterator<Type> $iterator */
    public function __construct(private \Iterator $iterator)
    {
    }

    /** @return iterable<Type> */
    public function walkAcceptance(): iterable
    {
        return $this->iterator;
    }
}
