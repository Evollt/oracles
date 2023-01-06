<?php

namespace App\Html;

use Illuminate\Support\Str;
use Collective\Html\FormBuilder as CollectiveFormBuilder;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ViewErrorBag;

/**
 * Helper methods for rendering form elements. Will render errors as well.
 */
class FormBuilder extends CollectiveFormBuilder
{
    /** @var ViewErrorBag */
    protected $errors;
    protected $defaultClass = 'form-control';

    /**
     * {@inheritDoc}
     */
    public function open(array $options = []): HtmlString
    {
        if (array_key_exists('errors', $options)) {
            $this->errors = $options['errors'];
            unset($options['errors']);
        }

        return parent::open($options);
    }

    /**
     * {@inheritDoc}
     */
    public function close(): string
    {
        $this->errors = null;

        return parent::close();
    }

    /**
     * {@inheritDoc}
     */
    public function label($name, $value = null, $options = [], $escape_html = true): HtmlString
    {
        $options = $this->addClass('form-label', $options);

        return parent::label($name, $value, $options, $escape_html);
    }

    /**
     * Echo out a info p tag
     *
     * @param  string $text The text that it should echo
     * @return HtmlString
     */
    public function info(string $text): HtmlString
    {
        // TODO: Please move this HTML to a view.
        return $this->toHtmlString('<p class="text-main-color font-medium text-sm leading-tight pt-1 px-1 italic mb-0">' . $text . '</p>');
    }

    /**
     * {@inheritDoc}
     */
    public function text($name, $value = null, $options = []): HtmlString
    {
        $options = $this->addClass($this->defaultClass, $options);
        $options = $this->addClass('form-input', $options);

        $this->addInvalidClass($name, $options);

        $html = parent::text($name, $value, $options);
        $html .= $this->addErrors($name);

        return $this->toHtmlString($html);
    }

    /**
     * {@inheritDoc}
     */
    public function search($name, $value = null, $options = []): HtmlString
    {
        $options = $this->addClass($this->defaultClass, $options);
        $options = $this->addClass('form-input', $options);

        $this->addInvalidClass($name, $options);

        $html = parent::search($name, $value, $options);
        $html .= $this->addErrors($name);

        return $this->toHtmlString($html);
    }

    /**
     * {@inheritDoc}
     */
    public function date($name, $value = null, $options = []): HtmlString
    {
        $options = $this->addClass($this->defaultClass, $options);

        $this->addInvalidClass($name, $options);

        $html = parent::date($name, $value, $options);
        $html .= $this->addErrors($name);

        return $this->toHtmlString($html);
    }

    /**
     * {@inheritDoc}
     */
    public function number($name, $value = null, $options = []): HtmlString
    {
        $options = $this->addClass($this->defaultClass, $options);

        $this->addInvalidClass($name, $options);

        $html = parent::number($name, $value, $options);
        $html .= $this->addErrors($name);

        return $this->toHtmlString($html);
    }

    /**
     * {@inheritDoc}
     */
    public function email($name, $value = null, $options = []): HtmlString
    {
        $options = $this->addClass($this->defaultClass, $options);

        $this->addInvalidClass($name, $options);

        $html = parent::email($name, $value, $options);
        $html .= $this->addErrors($name);

        return $this->toHtmlString($html);
    }

    /**
     * {@inheritDoc}
     */
    public function password($name, $options = []): HtmlString
    {
        $options = $this->addClass($this->defaultClass, $options);

        $this->addInvalidClass($name, $options);

        $html = parent::password($name, $options);
        $html .= $this->addErrors($name);

        return $this->toHtmlString($html);
    }

    /**
     * {@inheritDoc}
     */
    public function select($name, $list = [], $selected = null, array $selectAttributes = [], array $optionsAttributes = [], array $options = []): HtmlString
    {
        $selectAttributes = $this->addClass($this->defaultClass, $selectAttributes);
        if(!array_key_exists('dont-use-select2', $selectAttributes)){
            $selectAttributes = $this->addClass('select2', $selectAttributes);
        }

        $this->addInvalidClass($name, $options);

        $html = parent::select($name, $list, $selected, $selectAttributes, $optionsAttributes);
        $html .= $this->addErrors($name);

        return $this->toHtmlString($html);
    }

    /**
     * {@inheritDoc}
     */
    public function textarea($name, $value = null, $options = []): HtmlString
    {
        $options = $this->addClass($this->defaultClass, $options);

        $this->addInvalidClass($name, $options);

        $html = parent::textarea($name, $value, $options);
        $html .= $this->addErrors($name);


        return $this->toHtmlString($html);
    }

    /**
     * {@inheritDoc}
     */
    public function file($name, $options = []): HtmlString
    {
        $this->addInvalidClass($name, $options);

        $html = parent::file($name, $options);
        $html .= $this->addErrors($name);

        return $this->toHtmlString($html);
    }

    /**
     * {@inheritDoc}
     */
    public function radio($name, $value = null, $checked = null, $options = [])
    {
        $options = $this->addClass('form-check-input', $options);

        return parent::radio($name, $value, $checked, $options);
    }

    /**
     * {@inheritDoc}
     */
    public function checkbox($name, $value = null, $checked = null, $options = [])
    {
        $options = $this->addClass('form-check-input', $options);

        return parent::checkbox($name, $value, $checked, $options);
    }

    public function addInvalidClass($name, &$options): void
    {
        if (! $name || is_null($name)) {
            return;
        }

        $arrayDottedName = str_replace(['[', ']'], ['.', ''], $name);

        $class = 'border-danger border-2';

        if ($this->errors instanceof ViewErrorBag && (count($this->errors->get($name)) > 0 || $this->errors->get($arrayDottedName))) {
            $options = $this->addClass($class, $options);
        } elseif (is_object($this->errors) && ($this->errors->has($name) || $this->errors->has($arrayDottedName))) {
            $options = $this->addClass($class, $options);
        }
    }

    /**
     * Combines given class name with class names in options.
     *
     * @param string $class
     * @param array $options
     *
     * @return array
     */
    protected function addClass($class, array $options = []): array
    {
        if (!array_key_exists('class', $options)) {
            $options['class'] = $class;
        } elseif (! Str::contains($options['class'], $class)) {
            $options['class'] .= ' ' . $class;
        }

        return $options;
    }

    /**
     * Add HTML for error message to $this->errors.
     *
     * @param string $name
     *
     * @return string
     */
    private function addErrors($name): string
    {
        if (! $name || is_null($name)) {
            return '';
        }

        if ($this->errors !== null) {
            if ($this->errors->has($name)) {
                // TODO: Please move this HTML to a view
                return '<p class="text-danger font-bold mt-2 text-xs">' . $this->errors->first($name) . '</p>';
            }

            $arrayDotted = str_replace(['[', ']'], ['.', ''], $name);
            if ('.' === substr($arrayDotted, -1)) {
                $arrayDotted .= '*';
            }

            if ($this->errors->has($arrayDotted)) {
                // TODO: Please move this HTML to a view
                return '<p class="text-danger font-bold mt-2 text-xs">' . $this->errors->first($arrayDotted) . '</p>';
            }
        }

        return '';
    }
}
