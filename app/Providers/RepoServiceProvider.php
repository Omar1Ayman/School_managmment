<?php

namespace App\Providers;

use App\Repository\StudentRepositoryinterface;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use TeacherRepository;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    $this->app->bind(
            'App\Repository\TeacherRepositoryInterface',
            'App\Repository\TeacherRepository');

    $this->app->bind(
           'App\Repository\StudentRepositoryinterface',
           'App\Repository\StudentRepository',
       );

    $this->app->bind(
           'App\Repository\StudentPromotionRepositoryInterface',
           'App\Repository\StudentPromotionRepository',
       );

    $this->app->bind(
        'App\Repository\StudentGraduatedRepositoryInterface',
        'App\Repository\StudentGraduatedRepository',
    );

    $this->app->bind(
        'App\Repository\FeesRepositoryInterface',
        'App\Repository\FeesRepository',
    );

    $this->app->bind(
        'App\Repository\FeeInvoicesRepositoryInterface',
        'App\Repository\FeeInvoicesRepository',
    );

    $this->app->bind(
        'App\Repository\ReceiptStudentRepositoryInterface',
        'App\Repository\ReceiptStudentRepository',
    );


     $this->app->bind(
        'App\Repository\ProcessingFeeRepositoryInterface',
        'App\Repository\ProcessingFeeRepository',
    );


    $this->app->bind(
        'App\Repository\PaymentRepositoryInterface',
        'App\Repository\PaymentRepository',
    );

    $this->app->bind(
        'App\Repository\AttendanceRepositoryInterface',
        'App\Repository\AttendanceRepository',
    );

    $this->app->bind(
        'App\Repository\SubjectRepositoryInterface',
        'App\Repository\SubjectRepository',
    );

    $this->app->bind(
        'App\Repository\QuizzRepositoryInterface',
        'App\Repository\QuizzRepository',
    );

    $this->app->bind(
        'App\Repository\QuestionRepositoryInterface',
        'App\Repository\QuestionRepository',
    );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
