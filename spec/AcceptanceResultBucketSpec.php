<?php

namespace spec\Kiboko\Component\Bucket;

use Kiboko\Component\Bucket\AcceptanceResultBucket;
use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AcceptanceResultBucketSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AcceptanceResultBucket::class);
        $this->shouldBeAnInstanceOf(AcceptanceResultBucketInterface::class);
    }

    function it_has_non_empty_acceptance()
    {
        $this->beConstructedWith(
            new \stdClass(),
            new \stdClass(),
            new \stdClass()
        );

        $this->walkAcceptance()->shouldHaveCount(3);
    }
}
