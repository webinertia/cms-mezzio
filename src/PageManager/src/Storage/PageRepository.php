<?php

declare(strict_types=1);

namespace PageManager\Storage;

use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Hydrator\ReflectionHydrator;
use Webinertia\Db\EntityInterface;
use Webinertia\Db;

final class PageRepository implements Db\RepositoryInterface, Db\RepositoryCommandInterface
{
    public function __construct(
        private ReflectionHydrator $hydrator = new ReflectionHydrator(),
        private Db\TableGateway $gateway
    ) {
    }

    public function save(EntityInterface $entity): EntityInterface|int
    {
        $set = $this->hydrator->extract($entity);
        if ($set === []) {
            throw new \InvalidArgumentException('Repository can not save empty entity.');
        }
        try {
            if (! isset($set['id']) ) {
                // insert
                $this->gateway->insert($set);
                $set['id'] = $this->gateway->getLastInsertValue();
            }
            $this->gateway->update($set, ['id' => $set['id']]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $this->hydrator->hydrate($set, $entity);
    }

    public function delete(EntityInterface $entity): int { }

    public function findOneById(int $id): EntityInterface { }

    public function findOneByColumn(string $column, int|string $value): ResultSetInterface|EntityInterface { }

    public function findManyByColumn(array $titles): ResultSetInterface { }

    public function fetchAll(): ResultSetInterface { }
}
