<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Text;
use MoonShine\Filters\TextFilter;
use Illuminate\Support\Facades\Log;

class DestinationResource extends Resource
{
	public static string $model = Destination::class;

	public string $titleField = 'name';

    public static string $orderField = 'id';

    public static string $orderType = 'ASC';

    public function title(): string
    {
        return trans('moonshine::ui.resource.destination');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.destination');
    }

    public static bool $withPolicy = true;

    public static array $activeActions = ['show','create','edit','delete'];

    // protected string $itemsView = 'vendor.moonshine.crud.shared.table_karyawan';    
    // protected string $formView = 'vendor.moonshine.crud.shared.form_karyawan';
    // protected string $detailView = 'crud.detail-card-karyawan';

    public static int $itemsPerPage = 10; // Number of items per page

    // public static array $with = ['attendance'];

    // public function query(): Builder
    // {
    //     return parent::query()
    //         ->withTrashed();
    // }

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
		    ID::make()->sortable()->hideOnCreate()->hideOnIndex(),
            Text::make('Name', 'name'),
            Text::make('URL' ,'url'),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id', 'name', 'url'];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Name', 'name'),
            TextFilter::make('URL', 'url'),
        ];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
