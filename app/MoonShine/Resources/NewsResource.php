<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\News;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Date;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Fields\Image;
use MoonShine\Fields\Textarea;

class NewsResource extends Resource
{
	public static string $model = News::class;

	public string $titleField = 'title';

    public static string $orderField = 'id';

    public static string $orderType = 'ASC';

    public function title(): string
    {
        return trans('moonshine::ui.resource.news');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.news');
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
		    ID::make()->sortable()->hideOnIndex(),
            Text::make('Title', 'title'),
            Date::make('Date', 'event_date')->withTime(),
            Textarea::make('Description',  'description')->hideOnIndex(),
            Text::make('Exerpt', 'exerpt')->hideOnIndex(),
            Text::make('Place Name', 'place'),
            Text::make('Full address', 'location')->hideOnIndex(),
            Number::make('Available Seat', 'available_seat')->hideOnIndex(),
            Text::make('Speaker', 'speaker'),
            Image::make('Banner Image', 'big_image')
            ->hideOnIndex()
            ->dir('/news') // The directory where the files will be stored in storage (by default /)
            ->disk('public') // Filesystems disk
            ->allowedExtensions(['jpg', 'gif', 'png']), // Allowable extensions,
            Image::make('Title Image', 'small_image')
            ->hideOnIndex()
            ->dir('/news') // The directory where the files will be stored in storage (by default /)
            ->disk('public') // Filesystems disk
            ->allowedExtensions(['jpg', 'gif', 'png']), // Allowable extensions,
            
            
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id'];
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
}
