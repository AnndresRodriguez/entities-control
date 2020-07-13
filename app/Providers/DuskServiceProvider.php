<?php

namespace App\Providers;

use Laravel\Dusk\Browser;
use Illuminate\Support\ServiceProvider;


class DuskServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->environment('local', 'testing')) {
            /*
            * DILIGENCIAR FORMULARIO DE PACIENTE
            */
            Browser::macro('formPaciente', function ($value=null) {
                /** @var Browser $this */
                $this->type('#documento', $value)                    
                        ->select('#tipo-documento', 'CC')
                        ->pause(2000)
                        ->type('#nombres', 'JUAN ANTONIO')
                        ->type('#apellidos', 'PEREZ DIAZ')
                        ->type('#nacimiento', '01-01-1990')
                        ->select('#genero', 'M');
            
                return $this;
            });


            /*
            * SELECCIONAR UNA OPCION DE UN SELECT2 AJAX DENTRO DE UNA VENTANA MODAL
            */
            Browser::macro('select2Modal', function ($field, $value = null, $waitSearch=500, $wait = 2, $suffix = ' + .select2') {
                /** @var Browser $this */

                $elementSelector     = $field.$suffix;
                $highlightedClass    = '.select2-results__option--highlighted';
                $highlightedSelector = '.select2-results__options '.$highlightedClass;
                $searchSelector      = '.select2-container.select2-container--open > .select2-dropdown--below .select2-search__field';
                $inputSearchModal    = 'input-select2-modal-'. \time() .'-'. rand(1000, 10000) .'';
                $optionSearchModal   = 'option-select2-modal-'. \time() .'-'. rand(1000, 10000) .'';

                $this->click($elementSelector);

                $this->script("document.querySelector('". $searchSelector ."').setAttribute('id', '". $inputSearchModal ."')"); 
                $inputSearchModal = '#'. $inputSearchModal;

            
                // check if search field exists and fill it.
                if ($element = $this->element($inputSearchModal)) { //var_dump($inputSearchModal);
                    try {
                        foreach ((array) $value as $item) {  
                            $element->sendKeys($item);
                            $this->pause($waitSearch);

                            $this->script("document.querySelector('". $highlightedSelector ."').setAttribute('id', '". $optionSearchModal ."')");
                            $optionSearchModal = '#'. $optionSearchModal;

                            $this->waitFor($optionSearchModal, $wait);
                            $this->click($optionSearchModal);
                        }
            
                        return $this;
                    } catch (ElementNotVisibleException $exception) {
                        // ignore the exception and try another way
                    }
                }
                else {
                    $element = $this->element($inputSearchModal);
                    //var_dump($element, $inputSearchModal, $optionSearchModal);
                }
            
                return $this;
            });

            /*
            * ASIGANAR UN ID A UNA CLASE
            */
            Browser::macro('doClickToNumberElementXFromAClass', function ($clase, $numero=0) {
                /** @var Browser $this */
                $this->script("$('$clase:eq($numero)').click();");  var_dump("$('$clase:eq($numero)').click();  -- ");
            
                return $this;
            });


            /*
            * ESCRIBIR UNA FECHA EN UN INPUT DATEPICKER
            */
            Browser::macro('datepicker', function ($id, $valor) {
                /** @var Browser $this */
                $id_input = 'datepicker-'. \time() .'-'. rand(1000, 10000) .'';

                $this->script("document.querySelector('$id input').setAttribute('id', '$id_input');"); 
                $this->clear('#'.$id_input);
                $this->type('#'.$id_input, $valor);
            
                return $this;
            });


            /*
            * REORDENAR UNA TABLA DATATABLE POR EL NUMERO DE LA COLUMNA
            */
            Browser::macro('reorderDatatable', function ($selector, $columna=0) {
                /** @var Browser $this */
                $this->script("$('$selector thead tr th:eq($columna)').click();");
            
                return $this;
            });


            /*
            * HACER SCROLL LEFT A UNA TABLA DENTRO DE UNA VENTANA MODAL
            */
            Browser::macro('scrollTableIntoModal', function ($class_modal, $scroll) {
                /** @var Browser $this */
                $this->script("$('$class_modal .table-responsive').scrollLeft($scroll)");
            
                return $this;
            });


            /*
            * HACER SCROLL LEFT A UNA TABLA DENTRO DE UNA VENTANA MODAL
            */
            Browser::macro('scrollTopModal', function ($id_modal, $scroll) {
                /** @var Browser $this */
                $this->script("document.getElementById('$id_modal').scrollTop = $scroll"); dump("document.getElementById('$id_modal').scrollLeft = $scroll");
            
                return $this;
            });


            /*
            * MOSTRAR BOTONES OCULTOS DE UNA TABLA DATATABLE
            */
            Browser::macro('showBotonsTableDatatable', function ($selector, $columna=0) {
                /** @var Browser $this */
                $this->script("$('#$selector td.sorting_1:eq($columna)').click()");
            
                return $this;
            });

            /*
            * HACER SCROLL A UNA COORDENADA (X, Y) EN LA VENTANA
            */
            Browser::macro('scrollWindow', function ($x, $y) {
                /** @var Browser $this */
                $this->script("window.scrollTo({$x}, ${y});");
            
                return $this;
            });

        }
        
    }
}
