<?php

namespace Modules\Request\GraphQL\Mutations;

use GraphQL\Error\Error;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Request\Enums\RequestStatus;
use Modules\Request\Models\Request;
use Throwable;

class CreateRequest
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     * @return array
     * @throws Error
     * @throws Throwable
     */
    public function __invoke(null $_, array $args): array
    {
        try {
            DB::beginTransaction();

            $args['request_status'] = RequestStatus::NEW->value;

            Request::query()->create($args);

            DB::commit();
            return [
                'status' => 'Успіх',
                'message' => 'Заявка успішно створена!',
            ];
        } catch (Error $error) {
            DB::rollBack();
            throw new Error($error->getMessage());
        }
    }
}
