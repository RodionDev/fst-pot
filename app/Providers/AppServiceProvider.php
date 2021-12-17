<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Form;
class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }
    public function boot()
    {
        Form::component('vspotText', 'form-components.text', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('vspotEmail', 'form-components.text', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('vspotPassword', 'form-components.password', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('vspotSubmit', 'form-components.btn-submit', ['text' => 'Speichern']);
        Form::component('vspotBack', 'form-components.btn-back', ['text' => 'Zurück']);
    }
}
