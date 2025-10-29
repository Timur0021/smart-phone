<?php

namespace Modules\SiteSettings\Policies;

use Modules\Team\Models\User;
use Modules\SiteSettings\Models\Word;
use Illuminate\Auth\Access\HandlesAuthorization;

class WordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_word');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Word $word): bool
    {
        return $user->can('view_word');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_word');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Word $word): bool
    {
        return $user->can('update_word');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Word $word): bool
    {
        return $user->can('delete_word');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_word');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Word $word): bool
    {
        return $user->can('force_delete_word');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_word');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Word $word): bool
    {
        return $user->can('restore_word');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_word');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Word $word): bool
    {
        return $user->can('replicate_word');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_word');
    }
}
