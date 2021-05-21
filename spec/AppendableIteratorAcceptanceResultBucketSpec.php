<?php

namespace spec\Kiboko\Component\Bucket;

use Kiboko\Component\Bucket\AppendableIteratorAcceptanceResultBucket;
use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AppendableIteratorAcceptanceResultBucketSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AppendableIteratorAcceptanceResultBucket::class);
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

    function it_can_append_acceptance()
    {
        $this->beConstructedWith(
            new \EmptyIterator()
        );

        $this->append(
            new \ArrayIterator([
                new \stdClass(),
                new \stdClass(),
            ])
        );

        $this->append(
            new \ArrayIterator([
                new \stdClass(),
            ])
        );

        $this->walkAcceptance()->shouldHaveCount(3);
    }
}
