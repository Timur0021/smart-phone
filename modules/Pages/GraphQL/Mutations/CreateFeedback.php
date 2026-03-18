<?php

namespace Modules\Pages\GraphQL\Mutations;

use GraphQL\Error\Error;
use Illuminate\Support\Facades\DB;
use Modules\Pages\Enums\FeedbackStatus;
use Modules\Pages\Models\Feedback;
use Modules\Telegram\Services\TelegramService;
use Throwable;

class CreateFeedback
{
    /**
     * @param array<string, mixed> $args
     * @throws Error
     * @throws Throwable
     */
    public function __invoke(null $_, array $args): array
    {
        DB::beginTransaction();

        try {
            if (empty($args['first_name'])) {
                throw new Error("Поле є обов'язковим");
            }

            $feedback = Feedback::query()
                ->create([
                    'first_name' => $args['first_name'],
                    'phone' => $args['phone'] ?? null,
                    'email' => $args['email'] ?? null,
                    'message' => $args['message'] ?? null,
                    'status' => FeedbackStatus::NOT_PUBLISHED->value,
                    'mark' => $args['mark'],
                ]);

            TelegramService::send($feedback);

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
