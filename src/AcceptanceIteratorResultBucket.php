<?php

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;

final class AcceptanceIteratorResultBucket implements AcceptanceResultBucketInterface
{
    /** @var \Iterator */
    private $iterator;

    /**
     * @param \Iterator $iterator
     */
    public function __construct(\Iterator $iterator)
    {
        $this->iterator = $iterator;
    }

    public function walkAcceptance(): iterable
    {
        return $this->iterator;
    }
}
