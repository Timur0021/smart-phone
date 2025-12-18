<?php

namespace Modules\Notification\GraphQL\Mutations;

use GraphQL\Error\Error;
use Illuminate\Support\Facades\DB;
use Throwable;
use Modules\Notification\Models\Subscribe as SubscribeModel;

class Subscribe
{
    /**
     * @param array{}
     * $args
     * @throws Error
     * @throws Throwable
     */
    public function __invoke(null $_, array $args): array
    {
        DB::beginTransaction();
        try {
            $email = $args['email'] ?? null;

            if (empty($email)) {
                throw new Error('Емейл не введений');
            }

            $subscribe = SubscribeModel::query()->firstOrNew(['email' => $email]);

            if (!$subscribe->exists) {
                $subscribe->save();
                DB::commit();

                return [
                    'status' => 'success',
                    'message' => 'Ви успішно підписались'
                ];
            } else {
                DB::rollBack();
                return [
                    'status' => 'error',
                    'message' => 'Ви вже підписані на розсилку'
                ];
            }
        } catch (Error $error) {
            DB::rollBack();
            throw new Error($error->getMessage());
        }
    }
}
