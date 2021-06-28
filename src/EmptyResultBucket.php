<?php

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @template Type
 * @implements Contract\AcceptanceResultBucketInterface<Type>
 * @implements Contract\RejectionResultBucketInterface<Type>
 */
final class EmptyResultBucket implements
    Contract\AcceptanceResultBucketInterface,
    Contract\RejectionResultBucketInterface
{
    public function walkAcceptance(): iterable
    {
        return new \EmptyIterator();
    }

    public function walkRejection(): iterable
    {
        return new \EmptyIterator();
    }
}
