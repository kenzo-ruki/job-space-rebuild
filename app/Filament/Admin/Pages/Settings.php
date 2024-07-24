<?php

namespace App\Filament\Admin\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Set;
use Filament\Pages\Page;
use App\Models\Setting;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Setting $setting;

    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.admin.pages.settings';
    
    public function mount(Setting $setting): void
    {
        $this->setting = $setting;
        if($this->setting->toArray()) {
            echo '<pre>'; var_dump($this->setting->toArray()); echo '</pre>';
            die();
            
            $this->form->fill($this->setting->toArray());
        }
    }

    public function create(): void
    {
        echo '<pre>'; var_dump($this->form->getState()); echo '</pre>';
        die();
        
    }

    public function form(Form $form): Form
    {
        $schema = [];
        
        $settings = Setting::all(); 
        foreach($settings as $setting) {
            $schema[] = $this->getComponent($setting);
        } 
        return $form->schema($schema);
    }

    private function getComponent($setting): Forms\Components\Component
    {
        $this->setting = $setting;
        switch ($this->setting->type) {
            case 'select':
                return Forms\Components\Select::make($this->setting->label)
                    ->label($this->setting->label)
                    ->model($this->setting)
                    ->default($this->setting->value)
                    ->options($this->setting->attributes['options']);
                break;
            case 'number':
                return Forms\Components\TextInput::make($this->setting->label)
                    ->label($this->setting->label)
                    ->statePath('data')
                    ->model($this->setting)
                    ->default($this->setting->value)
                    ->type('number');
                break;
            case 'boolean':
                return Forms\Components\Toggle::make($this->setting->label)
                    ->statePath('data')
                    ->model($this->setting)
                    ->default($this->setting->value)
                    ->label($this->setting->label);
                break;
            default:
                return Forms\Components\TextInput::make($this->setting->label)
                    ->statePath('data')
                    ->model($this->setting)
                    ->default($this->setting->value)
                    ->label($this->setting->label);
                break;
        }
    }

}
