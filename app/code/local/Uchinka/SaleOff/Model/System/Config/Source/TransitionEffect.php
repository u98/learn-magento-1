<?php
class Uchinka_SaleOff_Model_System_Config_Source_TransitionEffect {
    public function toOptionArray ()
    {
        return array(
            array('value' => 'none', 'label' => 'none'),
            array('value' => 'fade', 'label' => 'Fade'),
            array('value' => 'fadeOut', 'label' => 'Fade Out'),
            array('value' => 'scrollHorz', 'label' => 'Scroll Horizontal'),
        );
    }
}