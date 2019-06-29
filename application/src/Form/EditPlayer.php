<?php
namespace Main\Form;

use E4u\Form;
use Main\Model\Game;

class EditPlayer extends Form\Base
{
    public function init()
    {
        $this->addFields([

            new Form\Element\TextField('name', [
                'label' => 'Nazwa gracza',
                'required' => 'Podaj nazwę gracza.',
                'model' => $this->getModel('player'),
            ]),

            new Form\Element\FileUpload('picture', [
                'label' => 'Załaduj zdjęcie',
                'accept' => 'image',
            ]),

            new Form\Element\Submit('submit', 'Zapisz zmiany'),

        ]);
    }

    public function validate()
    {
        parent::validate();
        // sprawdzic czy player o takiej nazwie juz istnieje
        $values = $this->getValues();

        return $this;
    }

    /**
     * @return Game
     */
    private function getGame()
    {
        return $this->getModel('game');
    }
}