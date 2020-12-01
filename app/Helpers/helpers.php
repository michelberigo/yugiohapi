<?php

if (!function_exists('gerarSelect')) {
    function gerarSelect($collection, $selectedOption = null)
    {
        $select = '<option value="">Selecionar</option>';

        foreach ($collection as $item) {
            $selected = ($selectedOption == $item['value']) ? ' selected' : '';

            $select .= "<option value='{$item['value']}'{$selected}>{$item['label']}</option>";
        }
        
        return $select;
    }
}
