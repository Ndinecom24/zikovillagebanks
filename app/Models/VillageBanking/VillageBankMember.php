<?php

namespace App\Models\VillageBanking;

use Illuminate\Database\Eloquent\Relations\Pivot;

class VillageBankMember extends Pivot
{
    protected $table = 'village_bank_members';

    public $incrementing = true;

    protected $fillable = [
        'village_bank_id',
        'user_id',
        'role',
        'joined_at',
        'rules_acknowledged',
        'rules_acknowledged_at',
        'constitution_acknowledged',
        'constitution_acknowledged_at',
    ];

    protected $casts = [
        'joined_at'                    => 'datetime',
        'rules_acknowledged'           => 'boolean',
        'rules_acknowledged_at'        => 'datetime',
        'constitution_acknowledged'    => 'boolean',
        'constitution_acknowledged_at' => 'datetime',
    ];

    /* ── Compliance helpers ────────────── */

    /**
     * Has this member acknowledged all active rules?
     */
    public function hasAcknowledgedRules(): bool
    {
        return (bool) $this->rules_acknowledged;
    }

    /**
     * Has this member acknowledged the constitution?
     */
    public function hasAcknowledgedConstitution(): bool
    {
        return (bool) $this->constitution_acknowledged;
    }

    /**
     * Is this member fully compliant (rules + constitution if required)?
     */
    public function isCompliant(): bool
    {
        $bank = VillageBank::find($this->village_bank_id);
        if (! $bank) return true;

        $config = $bank->configuration ?? VillageBankConfiguration::forBank($bank->id);

        // Check rules compliance
        if ($config->require_rules_before_activity && ! $this->rules_acknowledged) {
            return false;
        }

        // Check constitution compliance (only if constitution is enabled)
        if ($config->constitution_enabled
            && $config->require_constitution_before_activity
            && ! $this->constitution_acknowledged) {
            return false;
        }

        return true;
    }

    /**
     * Get list of compliance items this member is missing.
     */
    public function complianceGaps(): array
    {
        $gaps = [];
        $bank = VillageBank::find($this->village_bank_id);
        if (! $bank) return $gaps;

        $config = $bank->configuration ?? VillageBankConfiguration::forBank($bank->id);

        if ($config->require_rules_before_activity && ! $this->rules_acknowledged) {
            $gaps[] = 'You must read and acknowledge all village bank rules before proceeding.';
        }

        if ($config->constitution_enabled
            && $config->require_constitution_before_activity
            && ! $this->constitution_acknowledged) {
            $gaps[] = 'You must read and sign the village bank constitution before proceeding.';
        }

        return $gaps;
    }
}
