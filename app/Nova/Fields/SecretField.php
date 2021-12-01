<?php

namespace App\Nova\Fields;

use Laravel\Nova\Fields\Field;

class SecretField extends Field
{
    protected array $translations;

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        $this->translations = [
            'labelCopyToClipboard' => __('Copy to clipboard'),
            'labelShow'            => __('Show'),
            'msgCopyToClipboard'   => __('Copied to the clipboard')
        ];

        parent::__construct($name, $attribute, $resolveCallback);
        $this->withMeta(array_merge(['showCopyToClipboard'  => true], $this->translations));
    }

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-secret-field';

    /**
     * @param bool $showCopyToClipboard
     * @return SecretField .\App\Nova\Fields\SecretField.withMeta
     */
    public function showCopyToClipboard(bool $showCopyToClipboard = true): static
    {
        return $this->withMeta(array_merge(['showCopyToClipboard'  => $showCopyToClipboard], $this->translations));
    }

    /**
     * @return SecretField .\App\Nova\Fields\SecretField.withMeta
     */
    public function cannotCopyToClipboard(): static
    {
        return $this->withMeta(array_merge(['showCopyToClipboard'  => false], $this->translations));
    }

    /**
     * @return SecretField .\App\Nova\Fields\SecretField.withMeta
     */
    public function canCopyToClipboard(): static
    {
        return $this->withMeta(array_merge(['showCopyToClipboard'  => true], $this->translations));
    }
}
