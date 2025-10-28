<?php

namespace Modules\Pages\GraphQL\Mutations;

use GraphQL\Error\Error;
use Illuminate\Support\Facades\DB;
use Modules\Pages\Enums\FeedbackStatus;
use Modules\Pages\Models\Feedback;

class CreateFeedback
{
    /**
     * @param array<string, mixed> $args
     * @throws Error
     */
    public function __invoke(null $_, array $args)
    {
        DB::beginTransaction();

        try {
            if (empty($args['first_name'])) {
                throw new Error("Поле є обов'язковим");
            }

            Feedback::query()
                ->create([
                    'first_name' => $args['first_name'],
                    'message' => $args['message'] ?? null,
                    'status' => FeedbackStatus::NOTPUBLISHED->value,
                    'mark' => $args['mark'],
                ]);

            DB::commit();

            return [
                'status' => 'success',
                'message' => 'Feedback Created Successfully',
            ];
        } catch (Error $error) {
            DB::rollBack();
            throw new Error($error->getMessage());
        }
    }
}
