<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket\Tests\Unit;

use Kiboko\Component\Bucket\AcceptanceResultBucket;
use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;
use PHPUnit\Framework\TestCase;

final class AcceptanceResultBucketTest extends TestCase
{
    public function testItIsInitializable(): void
    {
        $bucket = new AcceptanceResultBucket(
            new \stdClass(),
            new \stdClass(),
            new \stdClass()
        );

        $this->assertInstanceOf(AcceptanceResultBucket::class, $bucket);
        $this->assertInstanceOf(AcceptanceResultBucketInterface::class, $bucket);
    }

    public function testItHasNonEmptyAcceptance(): void
    {
        $bucket = new AcceptanceResultBucket(
            new \stdClass(),
            new \stdClass(),
            new \stdClass()
        );

        $this->assertCount(3, iterator_to_array($bucket->walkAcceptance()));
    }
}
