<?php

namespace App\Core\ViewComposers;


use View;


class MedicalHistoryComposer{



    public function compose($view){

        $medical_history = [
            
            [
                'id' => 'MC1001',
                'name' => 'Hypertension',
            ],
            
            [
                'id' => 'MC1002',
                'name' => 'Vertigo / Chronic Headache',
            ],
            
            [
                'id' => 'MC1003',
                'name' => 'Diabetes',
            ],
            
            [
                'id' => 'MC1004',
                'name' => 'High Cholesterol',
            ],
            
            [
                'id' => 'MC1005',
                'name' => 'Asthma',
            ],
            
            [
                'id' => 'MC1006',
                'name' => 'Tuberculosis',
            ],
            
            [
                'id' => 'MC1007',
                'name' => 'EENT Disorder',
            ],
            
            [
                'id' => 'MC1008',
                'name' => 'Chronic Obstructive',
            ],
            
            [
                'id' => 'MC1009',
                'name' => 'Heart Disorder',
            ],
            
            [
                'id' => 'MC1010',
                'name' => 'Kidney Desease',
            ],
            
            [
                'id' => 'MC1011',
                'name' => 'Liver / Gallbladder Disease',
            ],
            
            [
                'id' => 'MC1012',
                'name' => 'Peptic Ulcer',
            ],
            
            [
                'id' => 'MC1013',
                'name' => 'UTI',
            ],
            
            [
                'id' => 'MC1014',
                'name' => 'Allergies',
            ],
            
            [
                'id' => 'MC1015',
                'name' => 'Infectious Disease',
            ],
            
            [
                'id' => 'MC1016',
                'name' => 'Stress Disorder',
            ],
            
            [
                'id' => 'MC1017',
                'name' => 'Measles',
            ],
            
            [
                'id' => 'MC1018',
                'name' => 'Chicken Pox',
            ],
            
            [
                'id' => 'MC1019',
                'name' => 'Depression / Anxiety Disorder',
            ],
            
            [
                'id' => 'MC1020',
                'name' => 'Hepatitis',
            ],
            
            [
                'id' => 'MC1021',
                'name' => 'Anemia',
            ],
            
            [
                'id' => 'MC1022',
                'name' => 'Epilepsy',
            ],

            [
                'id' => 'MC1023',
                'name' => 'Others',
            ],

        ];  

    	$view->with('global_medical_history_all', $medical_history);

    }
    



}