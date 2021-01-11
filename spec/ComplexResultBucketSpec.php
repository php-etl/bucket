<?php

namespace spec\Kiboko\Component\Bucket;

use Kiboko\Component\Bucket\AcceptanceResultBucket;
use Kiboko\Component\Bucket\ComplexResultBucket;
use Kiboko\Component\Bucket\RejectionResultBucket;
use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;
use Kiboko\Contract\Bucket\RejectionResultBucketInterface;
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
            ),
            new class implements AcceptanceResultBucketInterface, RejectionResultBucketInterface {
                public function walkAcceptance(): iterable
                {
                    return [
                        new \stdClass(),
                        new \stdClass()
                    ];
                }

                public function walkRejection(): iterable
                {
                    return [
                        new \stdClass(),
                        new \stdClass()
                    ];
                }
            },
            new class implements AcceptanceResultBucketInterface, RejectionResultBucketInterface {
                public function walkAcceptance(): iterable
                {
                    return new class implements \IteratorAggregate {
                        public function getIterator()
                        {
                            yield from [
                                new \stdClass(),
                                new \stdClass()
                            ];
                        }
                    };
                }

                public function walkRejection(): iterable
                {
                    return new class implements \IteratorAggregate {
                        public function getIterator()
                        {
                            yield from [
                                new \stdClass(),
                                new \stdClass()
                            ];
                        }
                    };
                }
            }
        );

        $this->walkAcceptance()->shouldHaveCount(7);
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
            ),
            new class implements AcceptanceResultBucketInterface, RejectionResultBucketInterface {
                public function walkAcceptance(): iterable
                {
                    return [
                        new \stdClass(),
                        new \stdClass()
                    ];
                }

                public function walkRejection(): iterable
                {
                    return [
                        new \stdClass(),
                        new \stdClass()
                    ];
                }
            },
            new class implements AcceptanceResultBucketInterface, RejectionResultBucketInterface {
                public function walkAcceptance(): iterable
                {
                    return new class implements \IteratorAggregate {
                        public function getIterator()
                        {
                            yield from [
                                new \stdClass(),
                                new \stdClass()
                            ];
                        }
                    };
                }

                public function walkRejection(): iterable
                {
                    return new class implements \IteratorAggregate {
                        public function getIterator()
                        {
                            yield from [
                                new \stdClass(),
                                new \stdClass()
                            ];
                        }
                    };
                }
            }
        );

        $this->walkRejection()->shouldHaveCount(7);
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
