<?php

namespace spec\Kiboko\Component\ETL\Bucket;

use Kiboko\Component\ETL\Bucket\AcceptanceAppendableResultBucket;
use Kiboko\Component\ETL\Contracts\AcceptanceResultBucketInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AcceptanceAppendableResultBucketSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AcceptanceAppendableResultBucket::class);
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
