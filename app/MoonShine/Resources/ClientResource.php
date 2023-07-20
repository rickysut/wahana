<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Text;
use MoonShine\Fields\File;
use MoonShine\Fields\Image;
use Illuminate\Http\UploadedFile;

class ClientResource extends Resource
{
	public static string $model = Client::class;


	public string $titleField = 'name';

    public static string $orderField = 'id';

    public static string $orderType = 'ASC';

    public function title(): string
    {
        return trans('moonshine::ui.resource.client');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.client');
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
        $noclient = Client::count('id')+1;
		return [
		    ID::make()->sortable()->hideOnIndex()->hideOnCreate()->hideOnUpdate(),
            Text::make('Client Name', 'name'),
            File::make('Image File', 'image')
            ->hideOnDetail()
            ->hideOnIndex()
            ->customName(fn(UploadedFile $file) => $file->storeAs('client', $file->getClientOriginalName(), 'local'), ), 
            Image::make('Image', 'image')
            ->hideOnCreate()
            ->hideOnUpdate(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id', 'name'];
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
        
    }
}
