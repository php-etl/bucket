<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket\Tests\Unit;

use Kiboko\Component\Bucket\EmptyResultBucket;
use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;
use Kiboko\Contract\Bucket\RejectionResultBucketInterface;
use PHPUnit\Framework\TestCase;

final class EmptyResultBucketTest extends TestCase
{
    public function testItIsInitializable(): void
    {
        $bucket = new EmptyResultBucket();

        $this->assertInstanceOf(EmptyResultBucket::class, $bucket);
        $this->assertInstanceOf(AcceptanceResultBucketInterface::class, $bucket);
        $this->assertInstanceOf(RejectionResultBucketInterface::class, $bucket);
    }

    public function testItHasEmptyAcceptance(): void
    {
        $bucket = new EmptyResultBucket();

        $this->assertCount(0, iterator_to_array($bucket->walkAcceptance()));
    }

    public function testItHasEmptyRejection(): void
    {
        $bucket = new EmptyResultBucket();

        $this->assertCount(0, iterator_to_array($bucket->walkRejection()));
    }
}
