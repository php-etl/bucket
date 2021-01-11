<?php

namespace Kiboko\Component\Bucket;

use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;
use Kiboko\Contract\Bucket\RejectionResultBucketInterface;
use Kiboko\Contract\Bucket\ResultBucketInterface;

final class ComplexResultBucket implements
    AcceptanceResultBucketInterface,
    RejectionResultBucketInterface
{
    /** @var RejectionResultBucketInterface[] */
    private $rejections;
    /** @var AcceptanceResultBucketInterface[] */
    private $acceptances;

    public function __construct(ResultBucketInterface... $buckets)
    {
        $this->acceptances = array_filter(
            $buckets,
            function (ResultBucketInterface $bucket) {
                return $bucket instanceof AcceptanceResultBucketInterface;
            }
        );

        $this->rejections = array_filter(
            $buckets,
            function (ResultBucketInterface $bucket) {
                return $bucket instanceof RejectionResultBucketInterface;
            }
        );
    }

    public function accept(...$values): void
    {
        $this->acceptances[] = new AcceptanceResultBucket(...$values);
    }

    public function reject(...$values): void
    {
        $this->rejections[] = new RejectionResultBucket(...$values);
    }

    public function walkAcceptance(): iterable
    {
        $iterator = new \AppendIterator();
        foreach ($this->acceptances as $child) {
            /** @var array|\Traversable $acceptance */
            $acceptance = $child->walkAcceptance();
            if ($acceptance instanceof \Iterator) {
                $iterator->append($acceptance);
            } else if (is_array($acceptance)) {
                $iterator->append(new \ArrayIterator($acceptance));
            } else {
                $iterator->append(new \IteratorIterator($acceptance));
            }
        }

        return $iterator;
    }

    public function walkRejection(): iterable
    {
        $iterator = new \AppendIterator();
        foreach ($this->rejections as $child) {
            /** @var array|\Traversable $rejection */
            $rejection = $child->walkRejection();
            if ($rejection instanceof \Iterator) {
                $iterator->append($rejection);
            } else if (is_array($rejection)) {
                $iterator->append(new \ArrayIterator($rejection));
            } else {
                $iterator->append(new \IteratorIterator($rejection));
            }
        }

        return $iterator;
    }
}
