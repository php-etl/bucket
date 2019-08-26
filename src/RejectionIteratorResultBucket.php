<?php

namespace Kiboko\Component\ETL\Bucket;

use Kiboko\Component\ETL\Contracts\RejectionResultBucketInterface;

final class RejectionIteratorResultBucket implements RejectionResultBucketInterface
{
    /** @var \Iterator */
    private $iterator;

    public function __construct(\Iterator $iterator)
    {
        $this->iterator = $iterator;
    }

    public function walkRejection(): iterable
    {
        return $this->iterator;
    }
}
