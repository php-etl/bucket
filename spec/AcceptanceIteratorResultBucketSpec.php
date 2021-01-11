<?php

namespace spec\Kiboko\Component\Bucket;

use Kiboko\Component\Bucket\AcceptanceIteratorResultBucket;
use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AcceptanceIteratorResultBucketSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(new \EmptyIterator());

        $this->shouldHaveType(AcceptanceIteratorResultBucket::class);
        $this->shouldBeAnInstanceOf(AcceptanceResultBucketInterface::class);
    }

    function it_has_non_empty_acceptance()
    {
        $this->beConstructedWith(
            new \ArrayIterator([
                new \stdClass(),
                new \stdClass(),
                new \stdClass(),
            ])
        );

        $this->walkAcceptance()->shouldHaveCount(3);
    }
}
