# ColorManager

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
