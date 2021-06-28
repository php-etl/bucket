<?php

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type
 * @implements Contract\AcceptanceResultBucketInterface<Type>
 */
final class IteratorAcceptanceResultBucket implements Contract\AcceptanceResultBucketInterface
{
    /** @var \Iterator<Type> */
    private \Iterator $iterator;

    /** @param \Iterator<Type> $iterator */
    public function __construct(\Iterator $iterator)
    {
        $this->iterator = $iterator;
    }

    /** @return iterable<Type> */
    public function walkAcceptance(): iterable
    {
        return $this->iterator;
    }
}
