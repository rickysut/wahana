<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\News;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Text;
use MoonShine\Fields\Image;
use Illuminate\Http\UploadedFile;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Heading;
use MoonShine\Decorations\Flex;
use MoonShine\Fields\TinyMce;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Column;
use Illuminate\Support\Facades\Log;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\SwitchBoolean;
use App\Jobs\GenerateNews;

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
		    ID::make()->sortable()->hideOnCreate()->hideOnIndex()->hideOnUpdate()->hideOnDetail(),

            Grid::make([
                Column::make([
                    Block::make('Index Information', [
                        SwitchBoolean::make('Show at index', 'is_show')->default(true)->hideOnIndex(),  
                        Flex::make([
                            Text::make('Title', 'title'),
                            Text::make('Sub Title', 'subtitle'),
                        ])
                            ->justifyAlign('start') // Based on tailwind classes justify-[param]
                            ->itemsAlign('center'), // Based on tailwind classes items-[param]
                        Flex::make([
                            Image::make('Front Image', 'front_image')
                                ->hint('Front Image'),
                            
                        ])
                            ->justifyAlign('start') // Based on tailwind classes justify-[param]
                            ->itemsAlign('center'), // Based on tailwind classes items-[param]
                    ]),
                ]),

                Column::make([
                    Block::make('Detail Information', [
                        Image::make('Slider Image', 'slider')
                                ->hint('Slider image, multiple support')
                                ->multiple(),
                        TinyMce::make('Detail', 'detail')->hideOnIndex(),
                        BelongsTo::make('Created By', 'user', 'name')->hideOnCreate()->hideOnForm()->hideOnUpdate(),
                            
                    ]),
                ]),
            ]),
        ];
	}

	public function rules(Model $item): array
	{
	    return [
            'image' => 'max:2048',
            'slider' => 'max:2048',
        ];
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

    protected function beforeCreating(Model $item)
    {
        $item->user_id = auth()->user()->id;
    }

    
    
    protected function afterCreated(Model $item)
    {
        // Event after adding a record
        $job = new GenerateNews();
        $job->dispatch();
    }
    
    protected function beforeUpdating(Model $item)
    {
        // Event before record update
    }
    
    protected function afterUpdated(Model $item)
    {
        // Event after record update
        $job = new GenerateNews();
        $job->dispatch();
    }
    
    protected function beforeDeleting(Model $item)
    {
        // Event before record deletion
    }
    
    protected function afterDeleted(Model $item)
    {
        // Event after record deletion
        $job = new GenerateNews();
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
