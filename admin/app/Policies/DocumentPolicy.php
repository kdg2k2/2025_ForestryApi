<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;

class DocumentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Document $document): bool
    {
        $role = $user->role;
        $viewLimit = $role->view_limit_per_month;

        if (is_null($viewLimit))
            return true;

        $viewsThisMonth = $user->viewDocumentLog()
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->count();

        return $viewsThisMonth < $viewLimit;
    }
}
