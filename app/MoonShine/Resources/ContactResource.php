<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Fields\Text;
use App\Jobs\GenerateWhatsapp;

class ContactResource extends Resource
{
	public static string $model = Contact::class;

	public string $titleField = 'name';

    public static string $orderField = 'id';

    public static string $orderType = 'ASC';

    public function title(): string
    {
        return trans('moonshine::ui.resource.contact');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.contact');
    }

    public static bool $withPolicy = true;

    public static array $activeActions = ['show','create','edit','delete'];

    
    public static int $itemsPerPage = 10; // Number of items per page

    

    public function trStyles(Model $item, int $index): string
    {
        if(!empty($item->deleted_at)) {
            return 'background: #ffa1b8;';
        }

        return parent::trStyles($item, $index);
    }

	public function fields(): array
	{
		return [
		    ID::make()->sortable()->hideOnIndex()->hideOnCreate()->hideOnUpdate()->hideOnDetail(),
            SwitchBoolean::make('Active', 'active')->readonly(),
            Text::make('Name', 'name'),
            Text::make('Number', 'number'),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['name', 'number'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }

    protected function beforeCreating(Model $item)
    {
        // Event before adding an entry
        
    }
    
    protected function afterCreated(Model $item)
    {
        // Event after adding a record
        if ($item->active == 1){
            Contact::where('id', '!=' , $item->id)->update(['active' => 0]);
        }

        $job = new GenerateWhatsapp();
        $job->dispatch();
    }
    
    protected function beforeUpdating(Model $item)
    {
        // Event before record update
        
    }
    
    protected function afterUpdated(Model $item)
    {
        // Event after record update
        
        // Log::debug($item->active);
        if ($item->active == 1){
            Contact::where('id', '!=' , $item->id)->update(['active' => 0]);
        }
        $job = new GenerateWhatsapp();    
        $job->dispatch();
    }
    
    protected function beforeDeleting(Model $item)
    {
        // Event before record deletion
        
    }
    
    protected function afterDeleted(Model $item)
    {
        // Event after record deletion
        $job = new GenerateWhatsapp();    
        $job->dispatch();
    }
    
    protected function beforeMassDeleting(array $ids)
    {
        // Event before mass deletion of records
    }
    
    protected function afterMassDeleted(array $ids)
    {
        // Event after mass deletion of records
    } 
}
