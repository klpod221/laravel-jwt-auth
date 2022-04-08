<?php

return [
    'credential_not_match' => ['code' => 1000, 'message' => 'Account or password not match.'],
    'email_already_use' => ['code' => 1001, 'message' => 'Email address is already use.'],
    'phone_already_use' => ['code' => 1002, 'message' => 'Phone address is already use.'],
    'confirmation_code_not_match' => ['code' => 1003, 'message' => 'Confirmation code does not match or invalid.'],
    'confirmation_code_expired' => ['code' => 1004, 'message' => 'Confirmation code has expired.'],
    'account_confirmed' => ['code' => 1005, 'message' => 'Account has been confirmed.'],
    'account_not_confirmed' => ['code' => 1006, 'message' => 'Account is not confirmed.'],
    'account_deactivated' => ['code' => 1007, 'message' => 'Account is deactivated.'],
    'account_locked' => ['code' => 1008, 'message' => 'Account is locked.'],
    'user_cannot_apply' => ['code' => 1009, 'message' => 'Apply not available for user type.'],
    'apply_invalid_resume' => ['code' => 1010, 'message' => 'Resume is invalid or not owned by you.'],
    'already_applied' => ['code' => 1011, 'message' => 'Resume already applied with job.'],

    // Common
    'cannot_force_delete' => ['code' => 1099, 'message' => 'Cannot force delete.'],
];
