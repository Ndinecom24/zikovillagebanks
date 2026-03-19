{{-- ===== Modern Password Change Modal ===== --}}
<div class="modal fade" id="modal-change-password" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 520px;">
        <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">

            {{-- Modal Header --}}
            <div style="background: linear-gradient(135deg, #004D2E 0%, #006B3F 60%, #00895A 100%); padding: 2rem 2rem 1.5rem; text-align: center; color: #fff; position: relative;">
                <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(255,255,255,0.15); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                    <i class="bi bi-shield-lock" style="font-size: 1.5rem;"></i>
                </div>
                <h4 style="margin: 0 0 0.35rem; font-size: 1.3rem; font-weight: 700;">Change Your Password</h4>
                <p style="margin: 0; opacity: 0.8; font-size: 0.875rem;">Create a strong, secure password for your account</p>
            </div>

            {{-- Modal Body --}}
            <form method="POST" action="{{ route('user.change.password') }}" id="passwordChangeForm">
                @csrf
                <div style="padding: 1.75rem 2rem 0.5rem;">

                    {{-- Password Requirements Info --}}
                    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; padding: 0.875rem 1rem; margin-bottom: 1.5rem; font-size: 0.8rem; color: #166534;">
                        <div style="font-weight: 600; margin-bottom: 0.5rem;"><i class="bi bi-info-circle mr-1"></i> Password Requirements:</div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.3rem;">
                            <span id="req-length" style="color: #9ca3af;"><i class="bi bi-circle"></i> Min 8 characters</span>
                            <span id="req-upper" style="color: #9ca3af;"><i class="bi bi-circle"></i> Uppercase letter</span>
                            <span id="req-lower" style="color: #9ca3af;"><i class="bi bi-circle"></i> Lowercase letter</span>
                            <span id="req-number" style="color: #9ca3af;"><i class="bi bi-circle"></i> Number (0-9)</span>
                            <span id="req-special" style="color: #9ca3af;"><i class="bi bi-circle"></i> Special character</span>
                            <span id="req-match" style="color: #9ca3af;"><i class="bi bi-circle"></i> Passwords match</span>
                        </div>
                    </div>

                    {{-- Old Password --}}
                    <div style="margin-bottom: 1.15rem;">
                        <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.35rem;">Current Password</label>
                        <div style="position: relative;">
                            <input id="cp_old_password" type="password"
                                   class="form-control @error('old_password') is-invalid @enderror"
                                   name="old_password"
                                   placeholder="Enter current password"
                                   required autocomplete="current-password"
                                   style="padding: 0.7rem 2.75rem 0.7rem 2.75rem; border-radius: 8px; border: 1.5px solid #e2e8f0; font-size: 0.9rem;">
                            <i class="bi bi-lock" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #9ca3af; pointer-events: none;"></i>
                            <button type="button" class="cp-toggle-pwd" data-target="cp_old_password" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #9ca3af; cursor: pointer; padding: 0;">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        @error('old_password')
                            <span style="font-size: 0.8rem; color: #dc3545; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- New Password --}}
                    <div style="margin-bottom: 1.15rem;">
                        <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.35rem;">New Password</label>
                        <div style="position: relative;">
                            <input id="cp_new_password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   placeholder="Create a strong password"
                                   required autocomplete="new-password"
                                   style="padding: 0.7rem 2.75rem 0.7rem 2.75rem; border-radius: 8px; border: 1.5px solid #e2e8f0; font-size: 0.9rem;">
                            <i class="bi bi-key" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #9ca3af; pointer-events: none;"></i>
                            <button type="button" class="cp-toggle-pwd" data-target="cp_new_password" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #9ca3af; cursor: pointer; padding: 0;">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        {{-- Strength meter --}}
                        <div style="margin-top: 0.5rem;">
                            <div style="height: 4px; background: #e5e7eb; border-radius: 4px; overflow: hidden;">
                                <div id="pwd-strength-bar" style="height: 100%; width: 0%; border-radius: 4px; transition: all 0.3s ease;"></div>
                            </div>
                            <span id="pwd-strength-text" style="font-size: 0.75rem; color: #9ca3af; margin-top: 0.2rem; display: inline-block;"></span>
                        </div>
                        @error('password')
                            <span style="font-size: 0.8rem; color: #dc3545; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.35rem;">Confirm New Password</label>
                        <div style="position: relative;">
                            <input id="cp_confirm_password" type="password"
                                   class="form-control"
                                   name="password_confirmation"
                                   placeholder="Re-enter new password"
                                   required autocomplete="new-password"
                                   style="padding: 0.7rem 2.75rem 0.7rem 2.75rem; border-radius: 8px; border: 1.5px solid #e2e8f0; font-size: 0.9rem;">
                            <i class="bi bi-lock-fill" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #9ca3af; pointer-events: none;"></i>
                            <button type="button" class="cp-toggle-pwd" data-target="cp_confirm_password" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #9ca3af; cursor: pointer; padding: 0;">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                </div>

                {{-- Modal Footer --}}
                <div style="padding: 0 2rem 1.75rem; display: flex; gap: 0.75rem;">
                    <button type="submit" id="btn-change-pwd"
                            style="flex: 1; padding: 0.75rem; background: linear-gradient(135deg, #006B3F, #00895A); color: #fff; border: none; border-radius: 8px; font-size: 0.925rem; font-weight: 600; cursor: pointer; transition: all 0.25s; box-shadow: 0 2px 8px rgba(0,107,63,0.25); display: flex; align-items: center; justify-content: center; gap: 0.5rem;"
                            onmouseover="this.style.background='linear-gradient(135deg, #004D2E, #006B3F)'; this.style.boxShadow='0 4px 14px rgba(0,107,63,0.35)';"
                            onmouseout="this.style.background='linear-gradient(135deg, #006B3F, #00895A)'; this.style.boxShadow='0 2px 8px rgba(0,107,63,0.25)';">
                        <i class="bi bi-check-circle"></i>
                        Change Password
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    document.querySelectorAll('.cp-toggle-pwd').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var input = document.getElementById(this.getAttribute('data-target'));
            var icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            }
        });
    });

    var newPwd = document.getElementById('cp_new_password');
    var confirmPwd = document.getElementById('cp_confirm_password');
    var strengthBar = document.getElementById('pwd-strength-bar');
    var strengthText = document.getElementById('pwd-strength-text');

    function checkRequirements() {
        var pwd = newPwd.value;
        var confirm = confirmPwd.value;
        var score = 0;

        var checks = {
            'req-length':  pwd.length >= 8,
            'req-upper':   /[A-Z]/.test(pwd),
            'req-lower':   /[a-z]/.test(pwd),
            'req-number':  /[0-9]/.test(pwd),
            'req-special': /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?`~]/.test(pwd),
            'req-match':   pwd.length > 0 && pwd === confirm
        };

        for (var key in checks) {
            var el = document.getElementById(key);
            if (checks[key]) {
                el.style.color = '#16a34a';
                el.querySelector('i').className = 'bi bi-check-circle-fill';
                if (key !== 'req-match') score++;
            } else {
                el.style.color = '#9ca3af';
                el.querySelector('i').className = 'bi bi-circle';
            }
        }

        // Strength meter
        var percent = (score / 5) * 100;
        strengthBar.style.width = percent + '%';
        if (score <= 1) {
            strengthBar.style.background = '#ef4444';
            strengthText.textContent = 'Very weak';
            strengthText.style.color = '#ef4444';
        } else if (score === 2) {
            strengthBar.style.background = '#f97316';
            strengthText.textContent = 'Weak';
            strengthText.style.color = '#f97316';
        } else if (score === 3) {
            strengthBar.style.background = '#eab308';
            strengthText.textContent = 'Fair';
            strengthText.style.color = '#eab308';
        } else if (score === 4) {
            strengthBar.style.background = '#22c55e';
            strengthText.textContent = 'Strong';
            strengthText.style.color = '#22c55e';
        } else {
            strengthBar.style.background = '#16a34a';
            strengthText.textContent = 'Very strong';
            strengthText.style.color = '#16a34a';
        }

        if (pwd.length === 0) {
            strengthBar.style.width = '0%';
            strengthText.textContent = '';
        }
    }

    if (newPwd) {
        newPwd.addEventListener('input', checkRequirements);
        confirmPwd.addEventListener('input', checkRequirements);
    }
});
</script>
