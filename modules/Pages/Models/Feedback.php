<?php

namespace Modules\Pages\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Telegram\Contracts\TelegramInterface;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Feedback extends Model implements TelegramInterface
{
    use HasTranslations;

    protected $table = 'feedback';

    protected $fillable = [
        'first_name',
        'phone',
        'email',
        'message',
        'status',
        'mark',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public array $translatable = [
        'first_name',
        'message',
    ];

    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class, 'feedback_page')->withPivot('sort_order');
    }

    public function sliders(): BelongsToMany
    {
        return $this->belongsToMany(Slider::class, 'slider_feedback', 'feedback_id', 'slider_id');
    }

    public function adminUrl(): string
    {
        return config('app.url') . "/admin/feedback";
    }

    public function telegramTitle(): ?string
    {
        return "У вас новий відгук: {$this->id}";
    }

    public function telegramFields(): array
    {
        $fullStars = floor($this->mark);
        $halfStar  = ($this->mark - $fullStars) >= 0.5 ? '⯨' : '';
        $stars = str_repeat('⭐', $fullStars) . $halfStar;

        $stars = "<span style='color:gold;'>$stars</span>";

        return [
            "Ім'я та прізвище:"     => $this->first_name,
            "Телефон:"               => $this->phone,
            "Емейл:"                 => $this->email,
            "Оцінка користувача:"    => $stars,
            "Повідомлення:"          => $this->message,
        ];
    }
}
