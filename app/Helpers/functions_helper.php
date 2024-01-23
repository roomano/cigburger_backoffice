<?php
function displayError(string $field, array $erros = null)
{
    if (empty($erros)) {
        return;
    }

    if (array_key_exists($field, $erros)) {
        return "<div class='mt-2 px-1 bg-danger rounded'>
                    <span class='text-white px-1'><i class='fa-solid fa-triangle-exclamation me-2'></i>$erros[$field]</span>
                </div>";
    }
}
