# InForm
Inform is an information kiosk system for displaying and interacting with public monitors.
Inform is currently in development.

## InForm Modules 
Inform can be expanded with modules. Created modules must be registered in the system.
Module management ist based on the <a href="https://nwidart.com/laravel-modules/v6/introduction">nwidart/laravel-modules</a> package.


## Create a new Module

```bash
php artisan module:make YourModuleName
```

## Register ScreenBuilder Components
In the ModuleServiceProvider (e.g. YourModuleNameServiceProvider) you have to register all Livewire Components you need for your Module.
```php
// The Builder Component 
\Livewire::component('yourmodname::modname-builder',ContainerBuilder::class);

// The view-side in Builder-Component
\Livewire::component('yourmodname::modname-builder-view',ContainerBuilderView::class);

// The Screen-Side component
\Livewire::component('yourmodname::modname-view',ContainerBuilderView::class);
``````

Register your Module
```php
// Without data
ModuleManager::register($this->moduleNameLower,$touchable,$builderComponent,$builderViewComponent,$viewComponent,$arrayOfDefaultSettings)


// With example data
ModuleManager::register($this->moduleNameLower,true,"container::container-builder","container::container-builder-view",null,[
    'colors' => ColorManager::generateInitData(['container-bg','container-border']),
    'shadow' => 0,
    'rounded' => 0,
    'border' => 0,
    ]
);

``````
If view component is 'null' inform will display your builder view component in screen mode.

# InForm ColorManager

ColorManager is a automatic Colorpicker-Tool for DisplayBuilder

## Basic Concept

Add the HasColor Trait to the Builder and the View Component<br>
Add Colors in module initialisation


## Register colors in Module Init

```php
        ModuleManager::register($this->moduleNameLower,true,"example::example-builder","example::example-builder-view",null,[
            'colors' => ColorManager::generateInitData(['example-bg','example-border']),
            ]
        );
```

## Use ColorManager in your component

```php
class ExampleBuilder extends Builder implements BuilderInterface {

    use \App\Components\ColorManager\HasColors;
    ...
```

## Use ColorManager in your view

```html
    <p>Color 1</p>
    @livewire("inform-colorpicker",['color' => $this->getColor('example-bg')])

    <p>Color 2</p>
    @livewire("inform-colorpicker",['color' => $this->getColor('example-border')])
```

## Use ColorManager´s Colorpicker in your own 

```html
    <p>Color 1</p>
    @livewire("inform-colorpicker",['color' => old('my-input-name','slate-500'),'inputName' => 'my-input-name'])
    
```
