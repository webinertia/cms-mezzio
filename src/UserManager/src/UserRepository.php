<?php

declare(strict_types=1);

namespace UserManager;

use Laminas\Db\Sql\Where;
use Mezzio\Authentication\UserInterface;
use Mezzio\Authentication\UserRepositoryInterface;
use Webinertia\Db\TableGateway;

use function array_flip;
use function array_intersect_key;
use function password_verify;

final class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        protected TableGateway $gateway,
        protected array $config
    ) {
    }

    public function authenticate(string $credential, ?string $password = null): ?UserInterface
    {
        /**
         * class aliased as UserRepositoryInterface so that it will be called to authenticate a user
         * Provide a factory to supply the db table instance via constructor
         * this class should query the database and populate as DefaultUser class and return it
         */
        $where = new Where();
        $where->equalTo($this->config['username'], $credential);
        /** @var Laminas\Db\ResultSet\ResultSet $result */
        $result = $this->gateway->select($where);
        $user   = $result->current();
        if ($user === null) {
            return $user;
        } elseif (! password_verify($password, $user->password)) {
            return null;
        }
        return new Authentication\CurrentUser(
            $user->userName,
            (array) $user->role,
            array_intersect_key($user->getArrayCopy(), array_flip($this->config['details']))
        );
    }
}
