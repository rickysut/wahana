<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Solution;

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

class SolutionResource extends Resource
{
	public static string $model = Solution::class;

	public string $titleField = 'title';

    public static string $orderField = 'id';

    public static string $orderType = 'ASC';

    public function title(): string
    {
        return trans('moonshine::ui.resource.solution');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.solution');
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
                    Block::make('Slider Information', [
                        Flex::make([
                            Text::make('Title', 'title'),
                            Text::make('Sub Title', 'subtitle'),
                        ])
                            ->justifyAlign('start') // Based on tailwind classes justify-[param]
                            ->itemsAlign('center'), // Based on tailwind classes items-[param]
                        Flex::make([
                            Image::make('Image', 'image')
                                ->hint('Background Image')
                                ->customName(fn(UploadedFile $file) => $file->storeAs('solutions', $file->getClientOriginalName(), 'local'), )
                                ,
                            Text::make('Icon', 'icon')
                                ->hint('Ref. icon to Bootstrap icon https://icons.getbootstrap.com/icons'),
                        ])
                            ->justifyAlign('start') // Based on tailwind classes justify-[param]
                            ->itemsAlign('center'), // Based on tailwind classes items-[param]
                    ]),
                ]),

                Column::make([
                    Block::make('Detail Information', [
                        Text::make('Slogan', 'slogan')->hideOnIndex(),
                        TinyMce::make('Detail', 'detail')->hideOnIndex()

                    ]),
                ]),
            ]),
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
