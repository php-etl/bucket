<?php

namespace spec\Kiboko\Component\Bucket;

use Kiboko\Component\Bucket\EmptyresultBucket;
use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;
use Kiboko\Contract\Bucket\RejectionResultBucketInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmptyResultBucketSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EmptyresultBucket::class);
        $this->shouldBeAnInstanceOf(AcceptanceResultBucketInterface::class);
        $this->shouldBeAnInstanceOf(RejectionResultBucketInterface::class);
    }

    function it_has_empty_acceptance()
    {
        $this->walkAcceptance()->shouldHaveCount(0);
    }

    function it_has_empty_rejection()
    {
        $this->walkRejection()->shouldHaveCount(0);
    }
}
