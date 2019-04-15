<?php

class Uchinka_CustomGrid_Block_Adminhtml_Widget_Grid_Column_Renderer_Select extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $name = $this->getColumn()->getName() ? $this->getColumn()->getName() : $this->getColumn()->getId();
        $html = '<select name="' . $this->escapeHtml($name) . '" ' . $this->getColumn()->getValidateClass() . '>';
        $value = $row->getData($this->getColumn()->getIndex());
        foreach ($this->getColumn()->getOptions() as $item) {
            $selected = ( ($item['value'] == $value && (!is_null($value))) ? ' selected="selected"' : '' );
            $html .= '<option value="' . $this->escapeHtml($item['value']) . '"' . $selected . '>';
            $html .= $this->escapeHtml($item['label']) . '</option>';
        }
        $html .='</select>';
        return $html;
    }
}