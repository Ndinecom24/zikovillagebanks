<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StrongPassword implements Rule
{
    /**
     * The failure messages.
     */
    protected array $failedChecks = [];

    /**
     * Common weak passwords to reject.
     */
    protected array $commonPasswords = [
        'Zesco123', 'zesco123', 'zesco@123', 'Zesco@123',
        'Zesco12345', 'zesco12345', 'Zesco@12345', 'zesco@12345',
        'Password1', 'password1', 'Password123', 'password123',
        'Password@1', 'Admin123', 'admin123', 'Welcome1',
        'Qwerty123', 'qwerty123', '12345678', '123456789',
    ];

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value): bool
    {
        $this->failedChecks = [];

        if (strlen($value) < 8) {
            $this->failedChecks[] = 'at least 8 characters';
        }

        if (!preg_match('/[A-Z]/', $value)) {
            $this->failedChecks[] = 'at least one uppercase letter';
        }

        if (!preg_match('/[a-z]/', $value)) {
            $this->failedChecks[] = 'at least one lowercase letter';
        }

        if (!preg_match('/[0-9]/', $value)) {
            $this->failedChecks[] = 'at least one number';
        }

        if (!preg_match('/[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?`~]/', $value)) {
            $this->failedChecks[] = 'at least one special character (!@#$%^&* etc.)';
        }

        if (in_array($value, $this->commonPasswords)) {
            $this->failedChecks[] = 'not be a commonly used password';
        }

        return empty($this->failedChecks);
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        if (count($this->failedChecks) === 1) {
            return 'The password must contain ' . $this->failedChecks[0] . '.';
        }

        return 'The password must contain: ' . implode(', ', $this->failedChecks) . '.';
    }
}
