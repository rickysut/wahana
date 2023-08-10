<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use DateTime;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Flex;
use MoonShine\Fields\Select;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Fields\Text;
use MoonShine\Fields\Image;
use MoonShine\Fields\TinyMce;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Date;
use App\Jobs\GenerateEvents;
use App\Jobs\GenerateFooter;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\ItemActions\ItemAction;

class EventResource extends Resource
{
	public static string $model = Event::class;

	public string $titleField = 'title';

    public static string $orderField = 'id';

    public static string $orderType = 'ASC';

    public function title(): string
    {
        return trans('moonshine::ui.resource.event');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.event');
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

    public function query(): Builder
    {
        return parent::query()
            ->withTrashed();
    }

	public function fields(): array
	{
		return [
		    ID::make()->sortable()->hideOnCreate()->hideOnIndex()->hideOnUpdate()->hideOnDetail(),

            Grid::make([
                Column::make([
                    Block::make('Headers', [
                        Flex::make([
                            SwitchBoolean::make('Show at index', 'is_show')->default(true)->hideOnIndex(), 
                            Select::make('Event / Workshop', 'kind') ->options([
                                '1' => 'Event',
                                '2' => 'Workshop'
                            ]), 

                        ])
                            ->justifyAlign('start') // Based on tailwind classes justify-[param]
                            ->itemsAlign('center'), // Based on tailwind classes items-[param]
                        
                        Flex::make([
                            Text::make('Title', 'title'),
                            Text::make('Sub Title', 'subtitle')->hideOnIndex(),
                            
                        ])
                            ->justifyAlign('start') // Based on tailwind classes justify-[param]
                            ->itemsAlign('center'), // Based on tailwind classes items-[param]

                        Flex::make([
                            Image::make('Front Image', 'front_image'),
                            Text::make('Event Information', 'information')->hideOnIndex(),
                        ])
                            ->justifyAlign('start') // Based on tailwind classes justify-[param]
                            ->itemsAlign('center'), // Based on tailwind classes items-[param]

                        Flex::make([
                                Text::make('Location', 'location'),
                                Date::make('Event date', 'event_date') ->format('d/m/Y')->withTime() ,
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
                        Flex::make([
                            Text::make('Speaker', 'speaker_name'),
                            Text::make('Spk. Title', 'speaker_title')->hideOnIndex(),
                            Image::make('Speaker Picture', 'speaker_img')->hideOnIndex(),    

                        ])->justifyAlign('start') // Based on tailwind classes justify-[param]
                        ->itemsAlign('center'), // Based on tailwind classes items-[param]
                        
                        TinyMce::make('Detail', 'detail')->hideOnIndex(),
                            
                    ]),
                ]),
            ]),
        ];
	}

	public function rules(Model $item): array
	{
	    return [
            'front_image' => 'max:2048',
            'speaker_img' => 'max:2048',
            'slider' => 'max:2048',
        ];
    }

    public function search(): array
    {
        return ['id', 'title'];
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

    public function itemActions(): array
    {
        return [
            ItemAction::make('Restore', function (Model $item) {
                $item->restore();
            }, 'Retrieved')
            ->canSee(fn(Model $item) => $item->trashed()),

            ItemAction::make('Trash', function (Model $item) {
                $item->forceDelete();
            }, 'Move to trash')
            ->canSee(fn(Model $item) => $item->trashed())
        ];
    }

    protected function beforeCreating(Model $item)
    {
        //
    }

    
    
    protected function afterCreated(Model $item)
    {
        // Event after adding a record
        $job = new GenerateEvents();
        $job->dispatch();
        $job2 = new GenerateFooter();
        $job2->dispatch();
    }
    
    protected function beforeUpdating(Model $item)
    {
        // Event before record update
    }
    
    protected function afterUpdated(Model $item)
    {
        // Event after record update
        $job = new GenerateEvents();
        $job->dispatch();
        $job2 = new GenerateFooter();
        $job2->dispatch();
    }
    
    protected function beforeDeleting(Model $item)
    {
        // Event before record deletion
        $item->update([
            'front_image' => null,
            'speaker_img' => null,
            'slider' => [],
        ]);
    }
    
    protected function afterDeleted(Model $item)
    {
        // Event after record deletion
        $job = new GenerateEvents();
        $job->dispatch();
        $job2 = new GenerateFooter();
        $job2->dispatch();
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
