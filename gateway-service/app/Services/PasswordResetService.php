<?php

namespace App\Services;

use App\Models\User;
use App\Clients\NotificationClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Exception;

class PasswordResetService
{
    /**
     * @param NotificationClient $notificationClient
     */
    public function __construct(
        private NotificationClient $notificationClient
    ) {}

    /**
     * Send reset password email
     *
     * @param string $email
     * @return void
     */
    public function send(string $email): void
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return;
        }

        $resetToken = Str::uuid()->toString();

        DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->delete();

        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => Hash::make($resetToken),
            'created_at' => now(),
        ]);

        $resetLink = url("/reset-password?token={$resetToken}");

        $this->notificationClient->sendPasswordReset(
            $user->email,
            $resetLink
        );
    }

    /**
     * Reset user password
     *
     * @param string $email
     * @param string $token
     * @param string $password
     * @return void
     * @throws Exception
     */
    public function reset(
        string $email,
        string $token,
        string $password
    ): void {

        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        if (!$record) {
            throw new Exception('Invalid reset request');
        }

        if (!Hash::check($token, $record->token)) {
            throw new Exception('Invalid token');
        }

        if (Carbon::parse($record->created_at)->addMinutes(60)->isPast()) {
            throw new Exception('Token expired');
        }

        $user = User::where('email', $email)->firstOrFail();

        $user->password = Hash::make($password);
        $user->save();

        DB::table('password_reset_tokens')
            ->where('email', $email)
            ->delete();
    }
}
