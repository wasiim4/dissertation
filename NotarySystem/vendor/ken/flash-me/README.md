# Simple Flash Alert for Laravel
[![FlashMe](https://s1.postimg.org/5xuztfxqfj/flash-me.png)](https://postimg.org/image/7bhixh8sgb/)
Flash Alert for Laravel, Elegant, responsive, flexible and lightweight notification plugin with no dependencies, simple and easy to use

## Getting Started

How to use this packages

### Installing

```bash
composer require ken/flash-me
```

and 

```bash
php artisan vendor:publish --tag="flashMe"
```

## Optional Setting

config/flash_me.php

```php
/**
 * Change this /path if you load assets from local
 * example 'css' => asset('/css/app.css'),
 */
return [
	'css' => 'https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.1.5/css/iziToast.min.css',
	'js' => 'https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.1.5/js/iziToast.min.js',
];
```

resources/lang/en/flash_me.php 

```php
return [
	'success' => [
		'type' => 'success',
		'title' => 'Hi...',
		'message' => 'FlashMe is Ready!',
		'options' => [
			'position' => 'topRight', // this is an example option, you can add another option
			'transitionIn' => 'bounceInLeft',
    			'transitionOut' => 'fadeOut',
		],
	],
	'info' => [
		'type' => 'info',
		'title' => 'Hi...',
		'message' => 'FlashMe is Ready!',
		'options' => [
			'position' => 'topRight', // this is an example option, you can add another option
			'transitionIn' => 'bounceInLeft',
    			'transitionOut' => 'fadeOut',
		],
	],
	'warning' => [
		'type' => 'warning',
		'title' => 'Hi...',
		'message' => 'FlashMe is Ready!',
		'options' => [
			'position' => 'topRight', // this is an example option, you can add another option
			'transitionIn' => 'bounceInLeft',
    			'transitionOut' => 'fadeOut',
		],
	],
	'error' => [
		'type' => 'error',
		'title' => 'Hi...',
		'message' => 'FlashMe is Ready!',
		'options' => [
			'position' => 'topRight', // this is an example option, you can add another option
			'transitionIn' => 'bounceInLeft',
    			'transitionOut' => 'fadeOut',
		],
	],
];
```

other options can use 

```
	id: null, 
	class: '',
	title: '',
	titleColor: '',
	titleSize: '',
	titleLineHeight: '',
	message: '',
	messageColor: '',
	messageSize: '',
	messageLineHeight: '',
	backgroundColor: '',
	theme: 'light', // dark
	color: '', // blue, red, green, yellow
	icon: '',
	iconText: '',
	iconColor: '',
	image: '',
	imageWidth: 50,
	maxWidth: null,
	zindex: null,
	layout: 1,
	balloon: false,
	close: true,
	closeOnEscape: false,
	rtl: false,
	position: 'bottomRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
	target: '',
	targetFirst: true,
	toastOnce: false,
	timeout: 5000,
	animateInside: true,
	drag: true,
	pauseOnHover: true,
	resetOnHover: false,
	progressBar: true,
	progressBarColor: '',
	progressBarEasing: 'linear',
	overlay: false,
	overlayClose: false,
	overlayColor: 'rgba(0, 0, 0, 0.6)',
	transitionIn: 'fadeInUp',
	transitionOut: 'fadeOut',
	transitionInMobile: 'fadeInUp',
	transitionOutMobile: 'fadeOutDown',
```

## Usage

How to use if you will send flash alert to view?
example if this is controller on your project

```php

public function testFlash()
{
	flashMe()->success();
	return view('your_view');
}
```

## Another function 

```php
flashMe()->success();
flashMe()->info();
flashMe()->warning();
flashMe()->error();
```

## Display

you can display on your master template or single blade, before end of body tag

```php
@if (flashMe()->ok())
  {!! flashMe_flash() !!}
@endif
```

## Built With

* [IziToast](http://izitoast.marcelodolce.com/) - IziToast

## Demo

* [DEMO](http://izitoast.marcelodolce.com/)

## Contributing

Please read [CONTRIBUTING.md]() for details on our code of conduct, and the process for submitting pull requests to us.

## License

This project is licensed under the MIT License - see the [LICENSE.md]() file for details