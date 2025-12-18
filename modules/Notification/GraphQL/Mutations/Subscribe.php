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

            SubscribeModel::query()
                ->firstOrCreate([
                    'email' => $email
                ]);

            DB::commit();

            return [
                'status' => 'success',
                'message' => 'Ви успішно підписались'
            ];
        } catch (Error $error) {
            throw new Error($error->getMessage());
        }
    }
}
