<?php

namespace Kiboko\Component\ETL\Bucket;

use Kiboko\Component\ETL\Contracts\AcceptanceResultBucketInterface;
use Kiboko\Component\ETL\Contracts\RejectionResultBucketInterface;

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
