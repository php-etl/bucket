<?php

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;
use Kiboko\Contract\Bucket\RejectionResultBucketInterface;

final class EmptyResultBucket implements
    AcceptanceResultBucketInterface,
    RejectionResultBucketInterface
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
