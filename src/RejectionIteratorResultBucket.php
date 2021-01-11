<?php

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket\RejectionResultBucketInterface;

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
