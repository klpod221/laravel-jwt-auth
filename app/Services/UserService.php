<?php

namespace App\Services;

use Carbon\Carbon;
use Throwable, DB;
use App\Models\User;
use App\Models\Access;
use App\Services\BaseService;
use App\Events\User\UserCreated;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends BaseService
{
    /**
     * UserService constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param array $params
     * @return User
     * @throws Throwable
     */
    public function create(array $params = []): User
    {
        DB::beginTransaction();
        try {
            $user = $this->model::create([
                'name' => $params['name'] ?? null,
                'email' => $params['email'] ?? null,
                'password' => $params['password'] ?? null,
                'phone' => $params['phone'] ?? null,
                'birthday' => $params['birthday'] ?? null,
                'marital' => $params['marital'] ?? null,
                'gender' => $params['gender'] ?? null,
                'type' => $params['type'] ?? $this->model::TYPE_CANDIDATE,
                'status' => $params['status'] ?? $this->model::STATUS_WAIT_ACTIVATION,
                'address' => [
                    'country_id' => config('const.default_country_id'), // Default VN
                    'province_id' => $params['address']['province_id'] ?? null,
                    'district_id' => $params['address']['district_id'] ?? null,
                    'ward_id' => $params['address']['ward_id'] ?? null,
                    'street_id' => $params['address']['street_id'] ?? null,
                    'detail' => $params['address']['detail'] ?? null,
                ]
            ]);

            if (isset($params['provider_id'])) {
                $user->access()->create([
                    'provider' =>  $params['provider'] ?? null,
                    'provider_id' => $params['provider_id'] ?? null
                ]);
            } else {
                $user->access()->create([
                    'confirmation_code' => str_shuffle(md5(uniqid(mt_rand(), true)) . time())
                ]);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new GeneralException($exception->getMessage());
        }
        event(new UserCreated($user));
        DB::commit();

        return $user;
    }

    /**
     * @return mixed
     */
    public function getAdministrators()
    {
        return $this->model->where('type', $this->model::TYPE_ADMIN)->get();
    }

    /**
     * @param $code
     * @return User
     */
    public function getByConfirmationCode($code)
    {
        return $this->model->whereHas('access', function (Builder $query) use ($code) {
            $query->where('confirmation_code', $code);
        })->first();
    }

    /**
     * @param User $user
     * @return bool
     * @throws Throwable
     */
    public function updateConfirmation(User $user)
    {
        DB::beginTransaction();
        try {
            $user->status = $this->model::STATUS_ACTIVATED;
            $user->access()->update([
                'verified_at' => carbon()->now(),
                'verify_type' => Access::VERIFY_TYPE_EMAIL
            ]);
            $user->save();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new GeneralException($e->getMessage());
        }
        DB::commit();

        return true;
    }

    /**
     * @param User $user
     * @param $newPassword
     * @return bool
     */
    public function updatePassword(User $user, $newPassword): bool
    {
        $user->password = $newPassword;
        tap($user)->update();

        return true;
    }
}
