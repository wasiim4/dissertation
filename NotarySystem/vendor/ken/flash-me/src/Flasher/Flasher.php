<?php

namespace Ken\FlashMe\Flasher;

use Illuminate\Translation\Translator;
use Ken\FlashMe\Storage\FlashSession as Session;

class Flasher
{
    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    /**
     * Flash success
     * @param  string $title
     * @param  string $message
     * @param  array  $options
     */
    public function success()
    {
        $this->flash(
            trans('flash_me.success.type'), 
            trans('flash_me.success.title'), 
            trans('flash_me.success.message'), 
            trans('flash_me.success.options')
        );
    }
    /**
     * Flash info
     * @param  string $title
     * @param  string $message
     * @param  array  $options
     */
    public function info()
    {
        $this->flash(
            trans('flash_me.info.type'), 
            trans('flash_me.info.title'), 
            trans('flash_me.info.message'), 
            trans('flash_me.info.options')
        );
    }
    /**
     * Flash warning
     * @param  string $title
     * @param  string $message
     * @param  array  $options
     */
    public function warning()
    {
        $this->flash(
            trans('flash_me.warning.type'), 
            trans('flash_me.warning.title'), 
            trans('flash_me.warning.message'), 
            trans('flash_me.warning.options')
        );
    }
    /**
     * Flash error
     * @param  string $title
     * @param  string $message
     * @param  array  $options
     */
    public function error()
    {
        $this->flash(
            trans('flash_me.error.type'), 
            trans('flash_me.error.title'), 
            trans('flash_me.error.message'), 
            trans('flash_me.error.options')
        );
    }
    /**
     * Flash a message.
     *
     * @param  string $type
     * @param  string $title
     * @param  string $message
     * @param  array  $options
     *
     * @return void
     */
    public function flash($type = null, $title = null, $message, array $options = [])
    {
        $this->session->flash([
            'flashMe.type' => $type,
            'flashMe.title' => $title,
            'flashMe.message' => $message,
            'flashMe.options' => json_encode($options),
        ]);
    }
    
    /**
     * Get the message
     *
     * @param  boolean $array
     * @return array
     */
    public function get($array = false)
    {
        return [
            'type' => $this->type(),
            'title' => $this->title(),
            'message' => $this->message(),
            'options' => $this->options($array),
        ];
    }

    /**
     * If a message is ready to be shown.
     *
     * @return bool
     */
    public function ok()
    {
        return $this->session;
    }

    /**
     * Get the stored type.
     *
     * @return string
     */
    public function type()
    {
        return $this->session->get('flashMe.type');
    }

    /**
     * Get the stored title.
     *
     * @return string
     */
    public function title()
    {
        return $this->session->get('flashMe.title');
    }

    /**
     * Get the stored message.
     *
     * @return string
     */
    public function message()
    {
        return $this->session->get('flashMe.message');
    }

    /**
     * Get an additional stored options.
     *
     * @param  boolean $array
     * @return mixed
     */
    public function options($array = false)
    {
        return json_decode($this->session->get('flashMe.options'), $array);
    }

    /**
     * Get a stored option.
     *
     * @param  string $key
     * @return string
     */
    public function option($key, $default = null)
    {
        return array_get($this->options(true), $key, $default);
    }
}
