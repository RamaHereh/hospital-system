<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;





use App\Interfaces\Doctor\DiagnosisRepositoryInterface;
use App\Interfaces\Doctor\InvoiceRepositoryInterface;




class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Admin\SectionRepositoryInterface', 'App\Repository\Admin\SectionRepository');
        $this->app->bind('App\Interfaces\Admin\DoctorRepositoryInterface','App\Repository\Admin\DoctorRepository');
        $this->app->bind('App\Interfaces\Admin\Services\InsuranceRepositoryInterface', 'App\Repository\Admin\Services\InsuranceRepository');
        $this->app->bind('App\Interfaces\Admin\Services\AmbulanceRepositoryInterface','App\Repository\Admin\Services\AmbulanceRepository');
        $this->app->bind('App\Interfaces\Admin\Services\IndividualRepositoryInterface','App\Repository\Admin\Services\IndividualRepository');
        $this->app->bind('App\Interfaces\Admin\PatientRepositoryInterface','App\Repository\Admin\PatientRepository');
        $this->app->bind('App\Interfaces\Admin\ReceiptRepositoryInterface','App\Repository\Admin\ReceiptRepository');
        $this->app->bind('App\Interfaces\Admin\RayEmpRepositoryInterface','App\Repository\Admin\RayEmpRepository');
        $this->app->bind('App\Interfaces\Admin\LaboratoryEmpRepositoryInterface','App\Repository\Admin\LaboratoryEmpRepository');

        $this->app->bind('App\Interfaces\Doctor\InvoiceRepositoryInterface', 'App\Repository\Doctor\InvoiceRepository');
        $this->app->bind('App\Interfaces\Doctor\DiagnosisRepositoryInterface', 'App\Repository\Doctor\DiagnosisRepository');
        $this->app->bind('App\Interfaces\Doctor\RayRepositoryInterface', 'App\Repository\Doctor\RayRepository');
        $this->app->bind('App\Interfaces\Doctor\LaboratoryRepositoryInterface', 'App\Repository\Doctor\LaboratoryRepository');
    
        $this->app->bind('App\Interfaces\RayEmp\RayRepositoryInterface', 'App\Repository\RayEmp\RayRepository');

        $this->app->bind('App\Interfaces\LaboratoryEmp\LaboratoryRepositoryInterface', 'App\Repository\LaboratoryEmp\LaboratoryRepository');

        $this->app->bind('App\Interfaces\Patient\PatientRepositoryInterface', 'App\Repository\Patient\PatientRepository');
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
