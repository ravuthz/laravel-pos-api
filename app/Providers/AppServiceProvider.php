<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Database\Schema\Blueprint;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blueprint::macro('addAuditColumns', function ($excludes = []) {
            if (!in_array('status', $excludes)) {
                $this->tinyInteger('status')->nullable()->default(1);
            }

            if (!in_array('created_at', $excludes)) {
                $this->timestamp('created_at');
            }

            if (!in_array('updated_at', $excludes)) {
                $this->timestamp('updated_at');
            }

            if (!in_array('deleted_at', $excludes)) {
                $this->softDeletes();
            }

            if (!in_array('created_by', $excludes)) {
                $this->foreignId('created_by')->nullable()
                    ->constrained('users')->nullOnDelete();
            }

            if (!in_array('updated_by', $excludes)) {
                $this->foreignId('updated_by')->nullable()
                    ->constrained('users')->nullOnDelete();
            }

            if (!in_array('deleted_by', $excludes)) {
                $this->foreignId('deleted_by')->nullable()
                    ->constrained('users')->nullOnDelete();
            }
        });

        Blueprint::macro('dropAuditColumns', function ($excludes = []) {
            if (!in_array('status', $excludes)) {
                $this->dropColumn('status');
            }

            if (!in_array('created_at', $excludes)) {
                $this->dropColumn('created_at');
            }

            if (!in_array('updated_at', $excludes)) {
                $this->dropColumn('updated_at');
            }

            if (!in_array('deleted_at', $excludes)) {
                $this->dropColumn('deleted_at');
            }

            if (!in_array('created_by', $excludes)) {
                $this->dropColumn('created_by');
            }

            if (!in_array('updated_by', $excludes)) {
                $this->dropColumn('updated_by');
            }

            if (!in_array('deleted_by', $excludes)) {
                $this->dropColumn('deleted_by');
            }
        });

        Passport::enablePasswordGrant();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
