<?php

namespace TypiCMS\BootForms\Elements;

use TypiCMS\Form\Elements\Text;

class InputGroup extends Text
{
    protected $beforeAddon = [];

    protected $afterAddon = [];

    protected $control;

    public function __construct($name, $control = null)
    {
        parent::__construct($name);
        if ($control)
        {
            $this->control = $control;
            $this->control->addClass('form-control');
        }
    }

    public function beforeAddon($addon)
    {
        $this->beforeAddon[] = $addon;

        return $this;
    }

    public function afterAddon($addon)
    {
        $this->afterAddon[] = $addon;

        return $this;
    }

    public function type($type)
    {
        $this->attributes['type'] = $type;

        return $this;
    }

    protected function renderAddons($addons, $class)
    {
        $html = '';

        foreach ($addons as $addon) {
            $html .= sprintf('<span class="input-group-%s">', $class);
            $html .= $addon;
            $html .= '</span>';
        }

        return $html;
    }

    public function render()
    {
        $html = '<div class="input-group">';
        $html .= $this->renderAddons($this->beforeAddon, 'prepend');
        if ($this->control)
        {
            $this->control->setAttribute('required',$this->getAttribute('required'));
            $html .= $this->control->render();
        }
        else
            $html .= parent::render();
        $html .= $this->renderAddons($this->afterAddon, 'append');
        $html .= '</div>';

        return $html;
    }
}
