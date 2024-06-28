<?php

namespace App\Helper;

use Symfony\Component\Form\FormInterface;

class Helper
{
    public function getFormErrors(FormInterface $form): array
    {
        $errors = [];
        foreach ($form->getErrors(true) as $error) {
            $errors[] = $error->getMessage();
        }
        return $errors;
    }
}