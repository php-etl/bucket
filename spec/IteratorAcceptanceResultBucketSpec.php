<?php

namespace spec\Kiboko\Component\Bucket;

use Kiboko\Component\Bucket\IteratorAcceptanceResultBucket;
use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IteratorAcceptanceResultBucketSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(new \EmptyIterator());

        $this->shouldHaveType(IteratorAcceptanceResultBucket::class);
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
