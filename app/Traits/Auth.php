<?php

namespace App\Traits;

use App\Exceptions\Unauthorized as UnauthorizedException;
use App\Models\User as UserModel;
use App\Repos\User as UserRepo;
use App\Services\Auth as AuthService;
use App\Validators\Validator as AppValidator;
use Phalcon\Di;
use Yansongda\Supports\Collection;

trait Auth
{

    /**
     * @return UserModel
     */
    public function getCurrentUser()
    {
        $authUser = $this->getAuthUser();

        if (!$authUser) {
            return $this->getGuestUser();
        }

        $userRepo = new UserRepo();

        return $userRepo->findById($authUser->id);
    }

    /**
     * @return UserModel
     * @throws UnauthorizedException
     */
    public function getLoginUser()
    {
        $authUser = $this->getAuthUser();

        $validator = new AppValidator();

        $validator->checkAuthUser($authUser);

        $userRepo = new UserRepo();

        return $userRepo->findById($authUser->id);
    }

    /**
     * @return UserModel
     */
    public function getGuestUser()
    {
        $user = new UserModel();

        $user->id = 0;
        $user->name = 'guest';

        return $user;
    }

    /**
     * @return Collection|null
     */
    public function getAuthUser()
    {
        /**
         * @var AuthService $auth
         */
        $auth = Di::getDefault()->get('auth');

        return $auth->getAuthInfo();
    }

}