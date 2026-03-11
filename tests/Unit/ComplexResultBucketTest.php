<?php

declare(strict_types=1);

namespace Kiboko\Component\Bucket\Tests\Unit;

use Kiboko\Component\Bucket\AcceptanceResultBucket;
use Kiboko\Component\Bucket\ComplexResultBucket;
use Kiboko\Component\Bucket\RejectionResultBucket;
use Kiboko\Contract\Bucket\AcceptanceResultBucketInterface;
use Kiboko\Contract\Bucket\RejectionResultBucketInterface;
use PHPUnit\Framework\TestCase;

final class ComplexResultBucketTest extends TestCase
{
    public function testItIsInitializable(): void
    {
        $bucket = new ComplexResultBucket(
            new AcceptanceResultBucket(new \stdClass(), new \stdClass()),
            new RejectionResultBucket('Lorem ipsum dolor sit amet', new \Exception('Lorem ipsum dolor sit amet')),
            new AcceptanceResultBucket(new \stdClass()),
            new class implements AcceptanceResultBucketInterface, RejectionResultBucketInterface {
                public function walkAcceptance(): iterable
                {
                    return [new \stdClass(), new \stdClass()];
                }

                public function walkRejection(): iterable
                {
                    return [new \stdClass(), new \stdClass()];
                }

                public function reasons(): ?array
                {
                    return null;
                }

                public function exceptions(): ?array
                {
                    return null;
                }
            },
            new class implements AcceptanceResultBucketInterface, RejectionResultBucketInterface {
                public function walkAcceptance(): iterable
                {
                    return new class implements \IteratorAggregate {
                        public function getIterator(): \Traversable
                        {
                            yield from [new \stdClass(), new \stdClass()];
                        }
                    };
                }

                public function walkRejection(): iterable
                {
                    return new class implements \IteratorAggregate {
                        public function getIterator(): \Traversable
                        {
                            yield from [new \stdClass(), new \stdClass()];
                        }
                    };
                }

                public function reasons(): ?array
                {
                    return null;
                }

                public function exceptions(): ?array
                {
                    return null;
                }
            }
        );

        $this->assertInstanceOf(ComplexResultBucket::class, $bucket);
        $this->assertInstanceOf(AcceptanceResultBucketInterface::class, $bucket);
        $this->assertInstanceOf(RejectionResultBucketInterface::class, $bucket);
    }

    public function testItHasNonEmptyAcceptance(): void
    {
        $bucket = new ComplexResultBucket(
            new AcceptanceResultBucket(new \stdClass(), new \stdClass()),
            new RejectionResultBucket('Lorem ipsum dolor sit amet', new \Exception('Lorem ipsum dolor sit amet'), new \stdClass(), new \stdClass(), new \stdClass()),
            new AcceptanceResultBucket(new \stdClass()),
            new class implements AcceptanceResultBucketInterface, RejectionResultBucketInterface {
                public function walkAcceptance(): iterable
                {
                    return [new \stdClass(), new \stdClass()];
                }

                public function walkRejection(): iterable
                {
                    return [new \stdClass(), new \stdClass()];
                }

                public function reasons(): ?array
                {
                    return null;
                }

                public function exceptions(): ?array
                {
                    return null;
                }
            },
            new class implements AcceptanceResultBucketInterface, RejectionResultBucketInterface {
                public function walkAcceptance(): iterable
                {
                    return new class implements \IteratorAggregate {
                        public function getIterator(): \Traversable
                        {
                            yield from [new \stdClass(), new \stdClass()];
                        }
                    };
                }

                public function walkRejection(): iterable
                {
                    return new class implements \IteratorAggregate {
                        public function getIterator(): \Traversable
                        {
                            yield from [new \stdClass(), new \stdClass()];
                        }
                    };
                }

                public function reasons(): ?array
                {
                    return null;
                }

                public function exceptions(): ?array
                {
                    return null;
                }
            }
        );

        $this->assertCount(7, iterator_to_array($bucket->walkAcceptance()));
    }

    public function testItHasNonEmptyRejection(): void
    {
        $bucket = new ComplexResultBucket(
            new RejectionResultBucket('Lorem ipsum dolor sit amet', new \Exception('Lorem ipsum dolor sit amet'), new \stdClass(), new \stdClass()),
            new AcceptanceResultBucket(new \stdClass(), new \stdClass(), new \stdClass()),
            new RejectionResultBucket('Lorem ipsum dolor sit amet', new \Exception('Lorem ipsum dolor sit amet'), new \stdClass()),
            new class implements AcceptanceResultBucketInterface, RejectionResultBucketInterface {
                public function walkAcceptance(): iterable
                {
                    return [new \stdClass(), new \stdClass()];
                }

                public function walkRejection(): iterable
                {
                    return [new \stdClass(), new \stdClass()];
                }

                public function reasons(): ?array
                {
                    return null;
                }

                public function exceptions(): ?array
                {
                    return null;
                }
            },
            new class implements AcceptanceResultBucketInterface, RejectionResultBucketInterface {
                public function walkAcceptance(): iterable
                {
                    return new class implements \IteratorAggregate {
                        public function getIterator(): \Traversable
                        {
                            yield from [new \stdClass(), new \stdClass()];
                        }
                    };
                }

                public function walkRejection(): iterable
                {
                    return new class implements \IteratorAggregate {
                        public function getIterator(): \Traversable
                        {
                            yield from [new \stdClass(), new \stdClass()];
                        }
                    };
                }

                public function reasons(): ?array
                {
                    return null;
                }

                public function exceptions(): ?array
                {
                    return null;
                }
            }
        );

        $this->assertCount(7, iterator_to_array($bucket->walkRejection()));
    }

    public function testItCanAcceptValues(): void
    {
        $bucket = new ComplexResultBucket();

        $bucket->accept(
            new \stdClass(),
            new \stdClass(),
            new \stdClass()
        );

        $this->assertCount(3, iterator_to_array($bucket->walkAcceptance()));
        $this->assertCount(0, iterator_to_array($bucket->walkRejection()));
    }

    public function testItCanRejectValues(): void
    {
        $bucket = new ComplexResultBucket();

        $bucket->reject(
            'Lorem ipsum dolor sit amet',
            new \Exception('Lorem ipsum dolor sit amet'),
            new \stdClass(),
            new \stdClass(),
            new \stdClass()
        );

        $this->assertCount(0, iterator_to_array($bucket->walkAcceptance()));
        $this->assertCount(3, iterator_to_array($bucket->walkRejection()));
    }
}
