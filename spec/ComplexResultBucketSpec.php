<?php

namespace spec\Kiboko\Component\ETL\Bucket;

use Kiboko\Component\ETL\Bucket\AcceptanceResultBucket;
use Kiboko\Component\ETL\Bucket\ComplexResultBucket;
use Kiboko\Component\ETL\Bucket\RejectionResultBucket;
use Kiboko\Component\ETL\Contracts\AcceptanceResultBucketInterface;
use Kiboko\Component\ETL\Contracts\RejectionResultBucketInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ComplexResultBucketSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ComplexResultBucket::class);
        $this->shouldBeAnInstanceOf(AcceptanceResultBucketInterface::class);
        $this->shouldBeAnInstanceOf(RejectionResultBucketInterface::class);
    }

    function it_has_non_empty_acceptance()
    {
        $this->beConstructedWith(
            new AcceptanceResultBucket(
                new \stdClass(),
                new \stdClass()
            ),
            new RejectionResultBucket(
                new \stdClass(),
                new \stdClass(),
                new \stdClass()
            ),
            new AcceptanceResultBucket(
                new \stdClass()
            )
        );

        $this->walkAcceptance()->shouldHaveCount(3);
    }

    function it_has_non_empty_rejection()
    {
        $this->beConstructedWith(
            new RejectionResultBucket(
                new \stdClass(),
                new \stdClass()
            ),
            new AcceptanceResultBucket(
                new \stdClass(),
                new \stdClass(),
                new \stdClass()
            ),
            new RejectionResultBucket(
                new \stdClass()
            )
        );

        $this->walkRejection()->shouldHaveCount(3);
    }

    function it_can_accept_values()
    {
        $this->accept(
            new \stdClass(),
            new \stdClass(),
            new \stdClass()
        );

        $this->walkAcceptance()->shouldHaveCount(3);
        $this->walkRejection()->shouldHaveCount(0);
    }

    function it_can_reject_values()
    {
        $this->reject(
            new \stdClass(),
            new \stdClass(),
            new \stdClass()
        );

        $this->walkAcceptance()->shouldHaveCount(0);
        $this->walkRejection()->shouldHaveCount(3);
    }
}
