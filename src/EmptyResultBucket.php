<?php

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket as Contract;

/**
 * @implements Contract\AcceptanceResultBucketInterface<void>
 * @implements Contract\RejectionResultBucketInterface<void>
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
