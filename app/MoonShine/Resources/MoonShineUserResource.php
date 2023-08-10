<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Validation\Rule;
use MoonShine\Actions\ExportAction;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Date;
use MoonShine\Fields\Email;
use MoonShine\Fields\ID;
use MoonShine\Fields\Image;
use MoonShine\Fields\Password;
use MoonShine\Fields\PasswordRepeat;
use MoonShine\Fields\Text;
use MoonShine\Filters\DateFilter;
use MoonShine\Filters\TextFilter;
use MoonShine\FormComponents\ChangeLogFormComponent;
use MoonShine\FormComponents\PermissionFormComponent;
use MoonShine\Models\MoonshineUser;
use MoonShine\Models\MoonshineUserRole;
use MoonShine\Traits\Resource\WithUserPermissions;
use MoonShine\Resources\Resource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineUserResource extends Resource
{
    use WithUserPermissions;

    public static string $model = MoonshineUser::class;

    public string $titleField = 'name';

    protected static bool $system = true;

    public function title(): string
    {
        return trans('moonshine::ui.resource.admins_title');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.admins_title');
    }


    public function fields(): array
    {
        return [
            Grid::make([
                Column::make([
                    Block::make(trans('moonshine::ui.resource.main_information'), [
                        ID::make()
                            ->sortable()
                            ->useOnImport()
                            ->showOnExport()
                            ->hideOnIndex(),

                        BelongsTo::make(
                            trans('moonshine::ui.resource.role'),
                            'moonshine_user_role_id',
                            new MoonShineUserRoleResource()
                        )
                            ->showOnExport(),

                        Text::make(trans('moonshine::ui.resource.name'), 'name')
                            ->required()
                            ->useOnImport()
                            ->showOnExport(),

                        // Text::make(trans('moonshine::ui.resource.username'), 'username')
                        //     ->required()
                        //     ->useOnImport()
                        //     ->showOnExport(),

                        Image::make(trans('moonshine::ui.resource.avatar'), 'avatar')
                            // ->hideOnUpdate()
                            ->removable()
                            ->showOnExport()
                            ->disk('public')
                            // ->disk(config('filesystems.default'))
                            ->dir('moonshine_users')
                            ->allowedExtensions(['jpg', 'png', 'jpeg', 'gif']),

                        Date::make(trans('moonshine::ui.resource.created_at'), 'created_at')
                            ->format("d-m-Y")
                            ->default(now()->toDateTimeString())
                            ->sortable()
                            ->hideOnForm()
                            ->showOnExport(),

                        Email::make(trans('moonshine::ui.resource.email'), 'email')
                            ->sortable()
                            ->showOnExport()
                            ->required(),
                    ]),

                    Block::make(trans('moonshine::ui.resource.change_password'), [
                        Password::make(trans('moonshine::ui.resource.password'), 'password')
                            ->customAttributes(['autocomplete' => 'new-password'])
                            ->hideOnIndex()
                            ->hideOnExport()
                            ->hideOnDetail()
                            ->eye(),

                        PasswordRepeat::make(trans('moonshine::ui.resource.repeat_password'), 'password_repeat')
                            ->customAttributes(['autocomplete' => 'confirm-password'])
                            ->hideOnIndex()
                            ->hideOnExport()
                            ->hideOnDetail()
                            ->eye(),
                    ]),
                ]),
            ]),
        ];
    }

    public function components(): array
    {
        return [
            PermissionFormComponent::make('Permissions')
                // ->canSee(fn ($user) => $user->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID),
                ->canSee(fn ($user) => auth()->user()->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID),

            ChangeLogFormComponent::make('Change log')
                // ->canSee(fn ($user) => $user->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID),
                ->canSee(fn ($user) => auth()->user()->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID),
        ];
    }

    public function rules($item): array
    {
        return [
            'name' => 'required',
            'moonshine_user_role_id' => 'required',
            'email' => [
                'sometimes',
                'bail',
                'required',
                'email',
                Rule::unique('moonshine_users')->ignoreModel($item),
            ],
            'password' => ! $item->exists
                ? 'required|min:6|required_with:password_repeat|same:password_repeat'
                : 'sometimes|nullable|min:6|required_with:password_repeat|same:password_repeat',
        ];
    }

    public function search(): array
    {
        return ['id', 'name'];
    }

    public function filters(): array
    {
        return [
            TextFilter::make(trans('moonshine::ui.resource.name'), 'name'),
            DateFilter::make(trans('moonshine::ui.resource.created_at'), 'created_at'),
            
        ];
    }

    public function actions(): array
    {
        return [
            ExportAction::make(trans('moonshine::ui.export')),
        ];
    }
}
