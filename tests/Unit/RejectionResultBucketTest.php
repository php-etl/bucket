<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket\Tests\Unit;

use Kiboko\Component\Bucket\RejectionResultBucket;
use Kiboko\Contract\Bucket\RejectionResultBucketInterface;
use PHPUnit\Framework\TestCase;

final class RejectionResultBucketTest extends TestCase
{
    public function testItIsInitializable(): void
    {
        $bucket = new RejectionResultBucket(
            'Lorem ipsum dolor sit amet',
            new \Exception('Lorem ipsum dolor sit amet'),
        );

        $this->assertInstanceOf(RejectionResultBucket::class, $bucket);
        $this->assertInstanceOf(RejectionResultBucketInterface::class, $bucket);
    }

    public function testItHasNonEmptyRejection(): void
    {
        $bucket = new RejectionResultBucket(
            'Lorem ipsum dolor sit amet',
            new \Exception('Lorem ipsum dolor sit amet'),
            new \stdClass(),
            new \stdClass(),
            new \stdClass(),
        );

        $this->assertCount(3, iterator_to_array($bucket->walkRejection()));
    }
}
